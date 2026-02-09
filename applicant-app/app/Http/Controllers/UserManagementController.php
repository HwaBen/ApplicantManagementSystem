<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
    
    public function index(Request $request)
    {
        /* ===========================
        * USERS LIST
        * =========================== */
        $users = User::orderByDesc('last_login')
            ->orderByDesc('created_at')
            ->paginate(10, ['*'], 'users_page');

        /* ===========================
        * PERFORMED BY FILTER OPTIONS
        * =========================== */
        $performedUsers = User::whereIn(
            'id',
            UserLog::select('performed_by')->distinct()
        )->orderBy('name')->get();


        /* ===========================
        * LOG HISTORY
        * =========================== */
        $logsQuery = UserLog::with(['performedBy', 'user'])
            ->orderByDesc('created_at');

        // 🔍 KEYWORD SEARCH (WORKS FOR DELETED USERS)
        if ($request->filled('log_keyword')) {
            $keyword = $request->log_keyword;

            $logsQuery->where(function ($q) use ($keyword) {
                $q->where('action', 'like', "%{$keyword}%")
                ->orWhere('details->name', 'like', "%{$keyword}%")
                ->orWhere('details->email', 'like', "%{$keyword}%")
                ->orWhere('details->role', 'like', "%{$keyword}%")
                ->orWhere('details->performed_by_name', 'like', "%{$keyword}%");
            });
        }

        // 🧾 ACTION FILTER
        if ($request->filled('action')) {
            $logsQuery->whereIn('action', $request->action);
        }

        // 👤 PERFORMED BY FILTER
        if ($request->filled('performed_by')) {
            $logsQuery->where('performed_by', $request->performed_by);
        }

        // 📅 DATE FILTER
        if ($request->filled('date_from')) {
            $logsQuery->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $logsQuery->whereDate('created_at', '<=', $request->date_to);
        }

        $logs = $logsQuery
            ->paginate(20, ['*'], 'logs_page')
            ->appends($request->query());

        return view('users.index', compact(
            'users',
            'logs',
            'performedUsers'
        ));

    }



    public function create()
    {
        return view('users.create');
    }

    public function edit(User $user)
    {
        // Prevent editing other super admins
        if ($user->role === 'super_admin' && auth()->id() !== $user->id) {
            abort(403);
        }

        return view('users.edit', compact('user'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'role'     => 'required|in:super_admin,admin,user',
            'status'   => 'required|in:active,inactive',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'role'     => $validated['role'],
            'status'   => $validated['status'],
            'password' => Hash::make($validated['password']),
        ]);

        UserLog::create([
            'performed_by' => auth()->id(),
            'user_id'      => $user->id,
            'action'       => 'created',
            'details'      => [
                'name'   => $user->name,
                'email'  => $user->email,
                'role'   => $user->role,
                'status' => $user->status,
                'performed_by_name' => auth()->user()->name,
            ],
        ]);

        return redirect()
            ->route('users.index')
            ->with('success', 'Account created successfully.');
    }

    public function update(Request $request, User $user)
    {
        // Prevent editing other super admins
        if ($user->role === 'super_admin' && auth()->id() !== $user->id) {
            abort(403);
        }

        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'role'     => 'required|in:super_admin,admin,user',
            'status'   => 'required|in:active,inactive',
            'password' => 'nullable|min:8|confirmed',
        ]);

        // Capture BEFORE
        $before = $user->only(['name', 'email', 'role', 'status']);

        $user->name   = $validated['name'];
        $user->email  = $validated['email'];
        $user->role   = $validated['role'];
        $user->status = $validated['status'];

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        // Capture AFTER
        $after = $user->only(['name', 'email', 'role', 'status']);

        // 🔹 Log only if something changed (professional touch)
        if ($before !== $after) {
            UserLog::create([
                'performed_by' => auth()->id(),
                'user_id'      => $user->id,
                'action'       => 'updated',
                'details' => [
                    'name'  => $user->name,
                    'email' => $user->email,
                    'role'  => $user->role,
                    'before' => $before,
                    'after'  => $after,
                    'performed_by_name' => auth()->user()->name,
                ]
            ]);
        }

        return redirect()
            ->route('users.index')
            ->with('success', 'Account updated successfully.');
    }


    public function destroy(User $user)
    {
        // Rule 1: Prevent self-delete
        if (auth()->id() === $user->id) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        // Rule 2: Prevent deleting last super admin
        if ($user->role === 'super_admin') {
            $superAdminCount = User::where('role', 'super_admin')->count();

            if ($superAdminCount <= 1) {
                return back()->with('error', 'At least one Super Admin must exist.');
            }
        }

        // Snapshot before delete
        $deletedUserData = [
            'name'   => $user->name,
            'email'  => $user->email,
            'role'   => $user->role,
            'status' => $user->status,
        ];

        $deletedUserId = $user->id;

        // 🔹 Create log FIRST
        UserLog::create([
            'performed_by' => auth()->id(),
            'user_id'      => $deletedUserId,
            'action'       => 'deleted',
            'details'      => array_merge($deletedUserData, [
            'performed_by_name' => auth()->user()->name,
            ]),
        ]);


        // 🔥 HARD DELETE 
        $user->forceDelete();

        return redirect()
            ->route('users.index')
            ->with('success', 'User account deleted successfully.');
    }

}
