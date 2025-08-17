<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsGuest
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'guest') {
            return $next($request);
        }

        // If not a guest, redirect to home or wherever
        return redirect('/')->with('error', 'You do not have access to this page.');
    }
}
