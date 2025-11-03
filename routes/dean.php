<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dean\DeanDashboardController;
use App\Http\Controllers\Auth\SigninUserController;
use App\Http\Controllers\Office\ClearanceApprovalController;

// 🧭 Dean Dashboard
Route::prefix('dean')
    ->middleware(['auth', 'verified'])
    ->name('dean.')
    ->group(function () {

        // 📊 Dean Dashboard
        Route::get('/dashboard', [DeanDashboardController::class, 'index'])
            ->name('dashboard');

        // 🚪 Logout
        Route::post('/logout', [SigninUserController::class, 'destroy'])
            ->name('logout');

        // 📋 Clearance Requests (Dean side)
        Route::get('/clearance-requests', [ClearanceApprovalController::class, 'deanIndex'])
            ->name('clearances.index');

        // ✅ Approve request
        Route::post('/clearance-requests/{id}/accept', [ClearanceApprovalController::class, 'deanAccept'])
            ->name('clearances.accept');

        // ⏸️ Hold request
        Route::post('/clearance-requests/{id}/hold', [ClearanceApprovalController::class, 'deanHold'])
            ->name('clearances.hold');
    });

