<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department; // <-- Add this

class AdminDashboardController extends Controller
{
    public function index()
    {
    $departments = Department::all(); // ✅ Get all departments
        return view('dashboard.admin.dashboard', compact('departments'));
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout(); 
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Logged out successfully.');
    }
}
