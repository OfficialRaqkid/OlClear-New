<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CollegePresident\CollegePresidentDashboardController;
use App\Http\Controllers\CollegePresident\StudentAccountController;
use App\Http\Controllers\Auth\SigninUserContoroller;
use App\Http\Controllers\Office\ClearanceApprovalController;

Route::prefix('college-president')
    ->middleware(['auth'])
    ->name('college_president.')
    ->group(function () {

        Route::get('/dashboard',
            [CollegePresidentDashboardController::class, 'index']
        )->name('dashboard');

        Route::post('/logout',
            [SigninUserContoroller::class, 'destroy']
        )->name('logout');

        Route::get('/clearance-requests',
            [ClearanceApprovalController::class, 'presidentIndex']
        )->name('clearance_requests.index');

        Route::post('/clearance-requests/{id}/accept',
            [ClearanceApprovalController::class, 'presidentAccept']
        )->name('clearances.accept');

        Route::post('/clearance-requests/{id}/hold',
            [ClearanceApprovalController::class, 'presidentHold']
        )->name('clearances.hold');

        // ✅ STUDENT ACCOUNTS
        Route::get('/student-accounts',
            [StudentAccountController::class, 'index']
        )->name('student_accounts');
    });
