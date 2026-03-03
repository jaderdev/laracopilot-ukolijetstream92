<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     * Usage in routes: ->middleware('role:composer|admin')
     */
    public function handle(Request $request, Closure $next, string $roles): Response
    {
        if (!$request->user()) {
            return redirect()->route('login');
        }

        $allowed = explode('|', $roles);

        if (!in_array($request->user()->role, $allowed)) {
            abort(403, 'You do not have permission to access this page.');
        }

        return $next($request);
    }
}