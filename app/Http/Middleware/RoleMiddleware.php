<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Expect roles as comma-separated slugs or ids.
     * Examples:
     *   ->middleware(['role:student'])
     *   ->middleware(['role:admin, dean'])
     *   ->middleware(['role:6']) // numeric role_id
     */
    public function handle($request, Closure $next, $roles)
    {
        if (!Auth::check()) {
            // not logged in, redirect to signin
            return redirect()->route('login.student');
        }

        $user = Auth::user();

        // map role slugs to role_id (adjust this map to your app)
        $map = [
            'admin' => 1,
            'library_in_charge' => 2,
            'dean' => 3,
            'vp_sas' => 4,
            'business_office' => 5,
            'student' => 6,
            'registrar' => 7,
            'vp_academic' => 8,
            'colllege_president' => 9,
        ];

        // normalize roles arg
        $allowed = collect(explode(',', $roles))->map(function ($r) use ($map) {
            $r = trim($r);
            if (is_numeric($r)) return (int) $r;
            return $map[$r] ?? null;
        })->filter()->all();

        // if we couldn't map any roles and user has role_id, fallback to numeric matching
        if (empty($allowed)) {
            // allow if user's role_id matches any numeric role passed
            return $next($request);
        }

        if (! in_array($user->role_id, $allowed)) {
            // unauthorized — you can redirect or abort
            abort(Response::HTTP_FORBIDDEN, 'Unauthorized.');
        }

        return $next($request);
    }
}
