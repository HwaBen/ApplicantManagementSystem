<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\UserLog;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('profile.edit', [
            'user' => auth()->user()
        ]);
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'nullable|confirmed|min:8',
        ]);

        $before = [
            'name' => $user->name,
        ];

        $after = [];

        // 🔹 Name change
        if ($validated['name'] !== $user->name) {
            $user->name = $validated['name'];
            $after['name'] = $validated['name'];
        }

        // 🔹 Password change (DO NOT STORE PASSWORD)
        $passwordChanged = false;

        if (!empty($validated['password'])) {
            $user->password = bcrypt($validated['password']);
            $passwordChanged = true;
        }

        $user->save();

        // 🔹 Build log details safely
        $logDetails = [];

        // Name changes
        if (!empty($after)) {
            $logDetails['before'] = $before;
            $logDetails['after']  = $after;
        }

        // Password change (DO NOT log password)
        if ($passwordChanged) {
            $logDetails['password_changed'] = true;
        }

        // 🔹 Only log if something actually changed
        if (!empty($logDetails)) {
            UserLog::create([
                'performed_by' => $user->id,
                'user_id'      => $user->id,
                'action'       => 'updated',
                'details'      => [
                    // 🔐 SNAPSHOT (CRITICAL)
                    'name'  => $user->name,
                    'email' => $user->email,
                    'role'  => $user->role,

                    // 🔁 CHANGE TRACKING
                    'before' => $before,
                    'after'  => $after,
                    'password_changed' => $passwordChanged,
                    'performed_by_name' => $user->name,
                ],
            ]);

        }

        return redirect()
            ->route('profile.edit')
            ->with('success', 'Profile updated successfully.');
    }

}
