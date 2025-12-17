<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VpAcademic\VpAcademicDashboardController;
use App\Http\Controllers\Auth\SigninUserContoroller;

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
    });