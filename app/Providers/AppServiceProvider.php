<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // ✅ Share $student and $userProfile globally across all views
        View::composer('*', function ($view) {
            $student = null;
            $userProfile = null;

            if (Auth::check()) {
                $user = Auth::user();

                // If the logged-in user has a student profile
                if ($user->studentProfile) {
                    $student = $user->studentProfile;
                }

                // If the logged-in user has a general user profile (admin/faculty)
                if ($user->profile) {
                    $userProfile = $user->profile;
                }
            }

            $view->with(compact('student', 'userProfile'));
        });
    }
}
