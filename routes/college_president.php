<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CollegePresident\CollegePresidentDashboardController;
use App\Http\Controllers\Auth\SigninUserContoroller;

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
    });