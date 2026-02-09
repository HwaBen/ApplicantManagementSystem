<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {

            // 🔒 Block inactive accounts
            if (Auth::user()->status !== 'active') {
                Auth::logout();

                return back()->withErrors([
                    'email' => 'Your account has been deactivated. Please contact the Super Administrator.',
                ]);
            }

            // ✅ Login success
            $request->session()->regenerate();

            // ✅ Record last login ONLY for active users
            Auth::user()->update([
                'last_login' => now()
            ]);

            return $this->redirectByRole(Auth::user());
        }

        return back()->withErrors([
            'email' => 'Invalid login credentials.',
        ]);
    }


    /**
     * Redirect user based on role
     */
    protected function redirectByRole($user)
    {
        switch ($user->role) {
            case 'super_admin':
                return redirect()->route('superadmin.dashboard');

            case 'admin':
                return redirect()->route('admin.dashboard');

            default:
                return redirect()->route('user.dashboard');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
