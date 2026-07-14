<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // 1. If the user is not logged in, redirect them to the login page
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // 2. Check if the user's role matches the allowed role
      if (strtolower(auth()->user()->role->name) !== strtolower($role)) {
    abort(403, 'Unauthorized action. You do not have permission to access this page.');
}

        return $next($request);
    }
}