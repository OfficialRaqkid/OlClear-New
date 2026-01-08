<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dean\DeanDashboardController;
use App\Http\Controllers\Auth\SigninUserContoroller;
use App\Http\Controllers\Dean\ClearanceController;
use App\Http\Controllers\Office\ClearanceApprovalController;

// 🧭 Dean Dashboard
Route::prefix('dean')
    ->middleware(['auth'])
    ->name('dean.')
    ->group(function () {

        // 📊 Dashboard
        Route::get('/dashboard', [DeanDashboardController::class, 'index'])
            ->name('dashboard');

        // 🚪 Logout
        Route::post('/logout', [SigninUserContoroller::class, 'destroy'])
            ->name('logout');

        // 📂 Clearance management
        Route::get('/clearances', [ClearanceController::class, 'index'])
            ->name('clearances.index');

        Route::post('/clearances/{clearance}/activate', [ClearanceController::class, 'activate'])
            ->name('clearances.activate');

        // 🧾 Clearance requests (pending / action)
        Route::get('/clearance-requests', [ClearanceApprovalController::class, 'deanIndex'])
            ->name('clearance_requests.index');

        Route::post('/clearance-requests/{id}/accept', [ClearanceApprovalController::class, 'deanAccept'])
            ->name('clearance_requests.accept');

        Route::post('/clearance-requests/{id}/hold', [ClearanceApprovalController::class, 'deanHold'])
            ->name('clearance_requests.hold');

        // ✅ COMPLETED DEPARTMENTAL CLEARANCES  🔥 NEW
        Route::get('/completed-clearances', [DeanDashboardController::class, 'completed'])
            ->name('completed');

    });
