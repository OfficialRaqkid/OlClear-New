<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Auth\SigninUserContoroller;
use App\Http\Controllers\Admin\SystemLogController;
use App\Http\Controllers\Admin\ClearanceController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'verified'])
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        // Manage Users Page
        Route::get('/manage-users', [AdminDashboardController::class, 'manageUsers'])
            ->name('users');

        // Store User
        Route::post('/users/store', [UserController::class, 'store'])
            ->name('users.store');

        // System Logs
        Route::get('/system-logs', [SystemLogController::class, 'index'])
            ->name('system-logs');

        // Clearances
        Route::get('/clearances', [ClearanceController::class, 'index'])
            ->name('clearances.index');

        Route::get('/clearances/create', [ClearanceController::class, 'create'])
            ->name('clearances.create');

        Route::post('/clearances/store', [ClearanceController::class, 'store'])
            ->name('clearances.store');

        Route::post('/clearances/{clearance}/publish', [ClearanceController::class, 'publish'])
            ->name('clearances.publish');

        // Logout
        Route::post('/logout', [SigninUserContoroller::class, 'destroy'])
            ->name('logout');
    });

/*
|--------------------------------------------------------------------------
| Profile Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
