<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role)
    {
        if (!auth()->check()) {
            \Log::info('User not authenticated'); // Log auth check failure
            abort(403);
        }

        if (auth()->user()->role !== $role) {
            \Log::info('User role mismatch: ' . auth()->user()->role . ' required: ' . $role);
            abort(403);
        }

        return $next($request);
    }
}
