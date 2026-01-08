<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.admin.dashboard');
    }

    public function manageUsers()
    {
        $departments = Department::all();

        return view('dashboard.admin.manage_users', compact('departments'));
    }
}
