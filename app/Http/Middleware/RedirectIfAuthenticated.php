<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {

                $user = Auth::guard($guard)->user();

                // Role-based redirection
                switch ($user->role_id) {

                    case 1: // Admin
                        return redirect()->route('admin.dashboard');

                    case 2: // Library In Charge
                        return redirect()->route('library.dashboard');

                    case 3: // Dean
                        return redirect()->route('dean.dashboard');

                    case 4: // VP SAS
                        return redirect()->route('vp_sas.dashboard');

                    case 5: // Business Office
                        return redirect()->route('business.dashboard');

                    case 6: // Student
                        return redirect()->route('student.dashboard');
                }

                // fallback if role_id doesn't match any
                return redirect()->route('home');
            }
        }

        return $next($request);
    }
}
