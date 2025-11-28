<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dean\DeanDashboardController;
use App\Http\Controllers\Auth\SigninUserController;
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

        Route::get('/clearance-requests', [ClearanceApprovalController::class, 'deanIndex'])
            ->name('clearances.index');

        Route::post('/clearance-requests/{id}/accept', [ClearanceApprovalController::class, 'deanAccept'])
            ->name('clearances.accept');

        Route::post('/clearance-requests/{id}/hold', [ClearanceApprovalController::class, 'deanHold'])
            ->name('clearances.hold');
    });
