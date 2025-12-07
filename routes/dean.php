<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dean\DeanDashboardController;
use App\Http\Controllers\Auth\SigninUserController;
use App\Http\Controllers\Dean\ClearanceController;
use App\Http\Controllers\Office\ClearanceApprovalController;

// 🧭 Dean Dashboard
Route::prefix('dean')
    ->middleware(['auth'])
    ->name('dean.')
    ->group(function () {

        Route::get('/dashboard', [DeanDashboardController::class, 'index'])
            ->name('dashboard');

        Route::post('/logout', [SigninUserController::class, 'destroy'])
            ->name('logout');

        Route::get('/clearances', [ClearanceController::class, 'index'])
            ->name('clearances.index');

        Route::post('/clearances/{clearance}/activate', [ClearanceController::class, 'activate'])
            ->name('clearances.activate');

        Route::get('/clearance-requests', [ClearanceApprovalController::class, 'deanIndex'])
            ->name('clearance_requests.index');

        Route::post('/clearance-requests/{id}/accept', [ClearanceApprovalController::class, 'deanAccept'])
            ->name('clearance_requests.accept');

        Route::post('/clearance-requests/{id}/hold', [ClearanceApprovalController::class, 'deanHold'])
            ->name('clearance_requests.hold');
    });
