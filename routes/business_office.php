<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BusinessOffice\BusinessOfficeDashboardController;
use App\Http\Controllers\Auth\SigninUserContoroller;
use App\Http\Controllers\BusinessOffice\ClearanceController;
use App\Http\Controllers\Office\ClearanceApprovalController;

// ✅ Business Office routes
Route::prefix('business-office')
    ->middleware(['auth'])
    ->name('business_office.')
    ->group(function () {

        Route::get('/dashboard', [BusinessOfficeDashboardController::class, 'index'])
            ->name('dashboard');

        Route::post('/logout', [BusinessOfficeDashboardController::class, 'logout'])
            ->name('logout');

        Route::get('/clearances', [ClearanceController::class, 'index'])
            ->name('clearances.index');

        Route::post('/clearances/{clearance}/activate', [ClearanceController::class, 'activate'])
            ->name('clearances.activate');

        Route::get('/clearance-requests', [ClearanceApprovalController::class, 'businessOfficeIndex'])
            ->name('clearance_requests.index');

        Route::post('/clearance-requests/{id}/accept', [ClearanceApprovalController::class, 'businessOfficeAccept'])
            ->name('clearance_requests.accept');

        Route::post('/clearance-requests/{id}/hold', [ClearanceApprovalController::class, 'businessOfficeHold'])
            ->name('clearance_requests.hold');

        Route::get('/reports/completed', [ClearanceApprovalController::class, 'completedClearancesIndex'])
            ->name('reports.completed');
    });
