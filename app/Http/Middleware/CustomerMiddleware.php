<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CustomerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check kung naka-login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Check kung customer ang user
        if (Auth::user()->user_type === 'user') {
            return $next($request); // Payagan ang access sa customer routes
        }

        // Kung admin, i-redirect sa admin dashboard
        return redirect()->route('admin.dashboard');
    }
}