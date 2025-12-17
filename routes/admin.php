<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Auth\SigninUserContoroller;
use App\Http\Controllers\Admin\SystemLogController;
use App\Http\Controllers\Admin\ClearanceController;
use App\Http\Controllers\BusinessOffice\ClearanceController as BOClearanceController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\ProfileController;

Route::prefix('admin')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');


    Route::post('logout', [SigninUserContoroller::class, 'destroy'])->name('logout.admin');
    Route::prefix('admin')->name('admin.')->middleware(['auth', 'verified'])->group(function () {
    Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
});
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/system-logs', [SystemLogController::class, 'index'])->name('admin.system-logs');
});
Route::prefix('admin')->name('admin.')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/clearances', [ClearanceController::class, 'index'])->name('clearances.index');
    Route::get('/clearances/create', [ClearanceController::class, 'create'])->name('clearances.create');
    Route::post('/clearances/store', [ClearanceController::class, 'store'])->name('clearances.store');
    Route::post('/clearances/{clearance}/publish', [ClearanceController::class, 'publish'])->name('clearances.publish');
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
});

