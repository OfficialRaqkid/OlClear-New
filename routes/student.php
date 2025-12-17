<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\DashboardController;
use App\Http\Controllers\Student\ClearanceController;
use App\Http\Controllers\Student\ProfileController;
use App\Http\Controllers\Auth\SigninUserContoroller;

Route::prefix('student')
    ->middleware(['auth'])
    ->name('student.')
    ->group(function () {

        // 👤 Student Profile
        Route::get('/profile', [ProfileController::class, 'edit'])
            ->name('profile');

        Route::post('/profile/update', [ProfileController::class, 'update'])
            ->name('profile.update');

        // 🏠 Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        // 📜 View available clearances
        Route::get('/clearances', [ClearanceController::class, 'index'])
            ->name('clearances.index');

        // 🎓 View Marching Clearance page (SIDEBAR LINK)
        Route::get('/clearances/marching', [ClearanceController::class, 'marching'])
            ->name('clearances.marching');

        // 📨 Initial clearance request (ALL TYPES)
        Route::post('/clearances/{id}/request', [ClearanceController::class, 'requestClearance'])
            ->name('clearances.request');

        // 🎓 Marching ONLY — request Dean after Registrar
        Route::post('/clearances/{id}/request-dean', [ClearanceController::class, 'requestDean'])
            ->name('clearances.requestDean');

        // 👀 Student's clearance requests
        Route::get('/my-clearances', [ClearanceController::class, 'myRequests'])
            ->name('clearances.my');

        // 🚪 Logout
        Route::post('/logout', [SigninUserContoroller::class, 'destroy'])
            ->name('logout');
    });
