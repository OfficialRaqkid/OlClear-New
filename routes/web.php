<?php

use Illuminate\Support\Facades\Route;

// Public landing → go to student signin
Route::get('/', function () {
    return redirect()->route('login.student');
});

// Include all module route files
require __DIR__ . '/auth.php';
require __DIR__ . '/student.php';
require __DIR__ . '/staff.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/dean.php';
require __DIR__ . '/registrar.php';
require __DIR__ . '/business_office.php';
require __DIR__ . '/vp_sas.php';
require __DIR__ . '/library_in_charge.php';
