<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\DashboardController;
use App\Http\Controllers\Student\ClearanceController;
use App\Http\Controllers\Student\ProfileController;
use App\Http\Controllers\Auth\SigninUserContoroller;

Route::prefix('student')
    ->middleware(['auth']) // ✅ Use student guard middleware
    ->name('student.')
    ->group(function () {

        // 👤 Student Profile
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');
        Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

        // 🏠 Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        // 📜 View all published clearances
        Route::get('/clearances', [ClearanceController::class, 'index'])
            ->name('clearances.index');

        // 📨 Request a clearance
        Route::post('/clearances/{id}/request', [ClearanceController::class, 'requestClearance'])
            ->name('clearances.request');

        // 👀 View student's own clearance requests
        Route::get('/my-clearances', [ClearanceController::class, 'myRequests'])
            ->name('clearances.my');

        // 🚪 Logout
        Route::post('/logout', [SigninUserContoroller::class, 'destroy'])
            ->name('logout');
    });
