<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Registrar\RegistrarDashboardController;
use App\Http\Controllers\Registrar\RegistrarClearanceController;

Route::prefix('registrar')
    ->middleware(['auth'])
    ->name('registrar.')
    ->group(function () {

        Route::get(
            '/dashboard',
            [RegistrarDashboardController::class, 'index']
        )->name('dashboard');

        Route::post(
            'logout',
            [RegistrarDashboardController::class, 'logout']
        )->name('logout');

        // ✅ Marching Clearances
        Route::get(
            '/marching-clearances',
            [RegistrarClearanceController::class, 'marchingIndex']
        )->name('marching.index');

        Route::get(
            '/marching-clearances/{clearance}/requests',
            [RegistrarClearanceController::class, 'marchingRequests']
        )->name('marching.requests');

        Route::post(
            '/marching-requests/{request}/approve',
            [RegistrarClearanceController::class, 'approve']
        )->name('marching.approve');

        Route::post(
            '/marching-requests/{request}/hold',
            [RegistrarClearanceController::class, 'hold']
        )->name('marching.hold');
    });
