<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check kung naka-login at admin
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        if (Auth::check() && Auth::user()->user_type === 'admin') {
            return $next($request); // Payagan ang access
        }

        // Kung hindi admin, i-redirect sa landing page ng customer
        return redirect()->route('customer.dashboard');
    }
}
