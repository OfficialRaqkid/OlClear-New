<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VpSas\VpSasDashboardController;
use App\Http\Controllers\Auth\SigninUserContoroller;
use App\Http\Controllers\Office\ClearanceApprovalController;

// 🧭 VP-SAS Dashboard
Route::prefix('vp_sas')
    ->middleware(['auth', 'verified'])
    ->name('vp_sas.')
    ->group(function () {

        // 📊 VP-SAS Dashboard
        Route::get('/dashboard', [VpSasDashboardController::class, 'index'])
            ->name('dashboard');

        // 🚪 Logout
        Route::post('/logout', [SigninUserContoroller::class, 'destroy'])
            ->name('logout');

        // 📋 Clearance Requests (VP-SAS side)
        Route::get('/clearance-requests', [ClearanceApprovalController::class, 'vpSasIndex'])
            ->name('clearances.index');

        // ✅ Approve request
        Route::post('/clearance-requests/{id}/accept', [ClearanceApprovalController::class, 'vpSasAccept'])
            ->name('clearances.accept');

        // ⏸️ Hold request
        Route::post('/clearance-requests/{id}/hold', [ClearanceApprovalController::class, 'vpSasHold'])
            ->name('clearances.hold');
    });
