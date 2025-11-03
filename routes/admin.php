<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Auth\SigninUserContoroller;

Route::prefix('admin')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');


    Route::post('logout', [SigninUserContoroller::class, 'destroy'])->name('logout.admin');
});

