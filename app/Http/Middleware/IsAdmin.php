<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated and is an admin
        if (!Auth::check() || Auth::user()->type != 1) {
            return redirect('/home'); // Redirect if not an admin
        }
        return $next($request);
    }
}
