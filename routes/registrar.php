<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Registrar\RegistrarDashboardController;
use App\Http\Controllers\Registrar\RegistrarClearanceController;
use App\Http\Controllers\Office\ClearanceApprovalController;

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

        Route::get('/clearance-requests', [ClearanceApprovalController::class, 'registrarIndex'])
            ->name('clearances.index');

        Route::post('/clearance-requests/{id}/accept', [ClearanceApprovalController::class, 'registrarAccept'])
            ->name('clearances.accept');

        Route::post('/clearance-requests/{id}/hold', [ClearanceApprovalController::class, 'registrarHold'])
            ->name('clearances.hold');

        Route::get('/reports/completed', [ClearanceApprovalController::class, 'registrarCompletedClearances'])
            ->name('reports.completed');
    });
