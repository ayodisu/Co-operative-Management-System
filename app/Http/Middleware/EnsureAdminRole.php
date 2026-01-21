<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdminRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        $user = Auth::guard('admin')->user();

        // Super Admin can access everything
        if ($user->isSuperAdmin()) {
            return $next($request);
        }

        // If specific role is required and user doesn't have it
        if ($user->role !== $role) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
