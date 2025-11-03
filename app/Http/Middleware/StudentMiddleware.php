<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class StudentMiddleware
{
    public function handle($request, Closure $next)
{
    if (!Auth::guard('student')->check()) {
        return redirect()->route('login.student');
    }

    return $next($request);
}
}

