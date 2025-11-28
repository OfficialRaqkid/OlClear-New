<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class StudentMiddleware
{
    public function handle($request, Closure $next)
    {
        // If student is not logged in, redirect to /signin
        if (!Auth::guard('student')->check()) {
            return redirect()->route('login.student'); // 👈 Uses your existing named route
        }

        return $next($request);
    }
}
