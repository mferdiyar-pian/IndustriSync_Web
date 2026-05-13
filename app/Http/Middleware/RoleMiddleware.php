<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();
        
        // Ensure user has a role relation loaded
        if (!$user->role) {
            $user->load('role');
        }

        // Management (Admin, Owner, Staff) can access user pages if the route requires 'user'
        if (in_array('user', $roles) && $user->role && in_array($user->role->slug, ['admin', 'owner', 'staff'])) {
            return $next($request);
        }

        // If no roles specified, allow (shouldn't happen with our routes)
        if (empty($roles)) {
            return $next($request);
        }

        foreach ($roles as $role) {
            if ($user->role && $user->role->slug === trim($role)) {
                return $next($request);
            }
        }

        abort(403, 'Unauthorized action.');
    }
}
