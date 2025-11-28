<?php
namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Override handle method to capture guards and pass to redirectTo.
     */
    public function handle(Request $request, \Closure $next, ...$guards)
    {
        $this->guards = $guards;

        return parent::handle($request, $next, ...$guards);
    }

    /**
     * Guard-aware redirect for unauthenticated users.
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            if (in_array('student', $this->guards)) {
                return route('login.student'); // Redirect student guard to signin route
            }
            // Default fallback redirect for all other guards
            return route('login');
        }
    }
}
