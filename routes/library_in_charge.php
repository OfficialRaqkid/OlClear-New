<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LibraryInCharge\LibraryInChargeDashboardController;
use App\Http\Controllers\Auth\SigninUserController;
use App\Http\Controllers\Office\ClearanceApprovalController;

// 🧭 Library In-Charge Dashboard
Route::prefix('library_in_charge')
    ->middleware(['auth'])
    ->name('library_in_charge.')
    ->group(function () {

        Route::get('/dashboard', [LibraryInChargeDashboardController::class, 'index'])
            ->name('dashboard');

        Route::post('/logout', [SigninUserController::class, 'destroy'])
            ->name('logout');

        Route::get('/clearance-requests', [ClearanceApprovalController::class, 'libraryIndex'])
            ->name('clearances.index');

        Route::post('/clearance-requests/{id}/accept', [ClearanceApprovalController::class, 'libraryAccept'])
            ->name('clearances.accept');

        Route::post('/clearance-requests/{id}/hold', [ClearanceApprovalController::class, 'libraryHold'])
            ->name('clearances.hold');
    });
