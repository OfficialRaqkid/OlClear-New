<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\SystemLogController;
use App\Http\Controllers\Admin\ClearanceController;
use App\Http\Controllers\BusinessOffice\ClearanceController as BOClearanceController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.signin');
});

Route::get('/dashboard', function () {
    return view('dashboard.student.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('admin')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard.admin.dashboard');
    })->name('admin.dashboard');
});

Route::prefix('dean')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard.dean.dashboard');
    })->name('dean.dashboard');
});

Route::prefix('registrar')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard.registrar.dashboard');
    })->name('registrar.dashboard');
});

Route::prefix('business-office')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard.business_office.dashboard');
    })->name('business office.dashboard');
});

Route::prefix('vp-sas')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard.vp_sas.dashboard');
    })->name('vp_sas.dashboard');
});

Route::prefix('library-in-charge')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard.library_in_charge.dashboard');
    })->name('library_in_charge.dashboard');
});


Route::prefix('admin')->name('admin.')->middleware(['auth', 'verified'])->group(function () {
    Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
});

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/system-logs', [SystemLogController::class, 'index'])->name('admin.system-logs');
});


Route::prefix('business-office')->name('business_office.')->group(function () {
    Route::get('/clearances', [BOClearanceController::class, 'index'])
        ->name('clearances.index');
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

require __DIR__ . '/auth.php';
require __DIR__ . '/student.php';
require __DIR__ . '/staff.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/dean.php';
require __DIR__ . '/registrar.php';
require __DIR__ . '/business_office.php';
require __DIR__ . '/vp_sas.php';
require __DIR__ . '/library_in_charge.php';
