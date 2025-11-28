<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VpSas\VpSasDashboardController;
use App\Http\Controllers\Auth\SigninUserContoroller;
use App\Http\Controllers\Office\ClearanceApprovalController;

// 🧭 VP-SAS Dashboard
Route::prefix('vp_sas')
    ->middleware(['auth'])
    ->name('vp_sas.')
    ->group(function () {

        Route::get('/dashboard', [VpSasDashboardController::class, 'index'])
            ->name('dashboard');

        Route::post('/logout', [SigninUserContoroller::class, 'destroy'])
            ->name('logout');

        Route::get('/clearance-requests', [ClearanceApprovalController::class, 'vpSasIndex'])
            ->name('clearances.index');

        Route::post('/clearance-requests/{id}/accept', [ClearanceApprovalController::class, 'vpSasAccept'])
            ->name('clearances.accept');

        Route::post('/clearance-requests/{id}/hold', [ClearanceApprovalController::class, 'vpSasHold'])
            ->name('clearances.hold');
    });
