<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VpAcademic\VpAcademicDashboardController;
use App\Http\Controllers\Auth\SigninUserContoroller;
use App\Http\Controllers\Office\ClearanceApprovalController;

Route::prefix('vp-academic')
    ->middleware(['auth'])
    ->name('vp_academic.')
    ->group(function () {

        Route::get('/dashboard', 
            [VpAcademicDashboardController::class, 'index']
        )->name('dashboard');

        Route::post('/logout', 
            [SigninUserContoroller::class, 'destroy']
        )->name('logout');

         Route::get('/clearance-requests', [ClearanceApprovalController::class, 'vpAcademicIndex'])
            ->name('clearances.index');

        Route::post('/clearance-requests/{id}/accept', [ClearanceApprovalController::class, 'vpAcademicAccept'])
            ->name('clearances.accept');

        Route::post('/clearance-requests/{id}/hold', [ClearanceApprovalController::class, 'vpAcademicHold'])
            ->name('clearances.hold');
    });