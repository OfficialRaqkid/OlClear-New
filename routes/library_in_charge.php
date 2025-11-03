<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LibraryInCharge\LibraryInChargeDashboardController;
use App\Http\Controllers\Auth\SigninUserController;
use App\Http\Controllers\Office\ClearanceApprovalController;

// 🧭 Library In-Charge Dashboard
Route::prefix('library_in_charge')
    ->middleware(['auth', 'verified'])
    ->name('library_in_charge.')
    ->group(function () {

        // 📊 Library In-Charge Dashboard
        Route::get('/dashboard', [LibraryInChargeDashboardController::class, 'index'])
            ->name('dashboard');

        // 🚪 Logout
        Route::post('/logout', [SigninUserController::class, 'destroy'])
            ->name('logout');

        // 📋 Clearance Requests (Library side)
        Route::get('/clearance-requests', [ClearanceApprovalController::class, 'libraryIndex'])
            ->name('clearances.index');

        // ✅ Approve request
        Route::post('/clearance-requests/{id}/accept', [ClearanceApprovalController::class, 'libraryAccept'])
            ->name('clearances.accept');

        // ⏸️ Hold request
        Route::post('/clearance-requests/{id}/hold', [ClearanceApprovalController::class, 'libraryHold'])
            ->name('clearances.hold');
    });
