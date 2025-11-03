<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Registrar\RegistrarDashboardController;

Route::prefix('registrar')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [RegistrarDashboardController::class, 'index'])->name('registrar.dashboard');
    
    Route::post('logout', [RegistrarDashboardController::class, 'logout'])->name('logout.registrar');
});
