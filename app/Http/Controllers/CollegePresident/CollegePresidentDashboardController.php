<?php

namespace App\Http\Controllers\CollegePresident;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CollegePresidentDashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.college_president.dashboard', [
            'user' => Auth::user(),
        ]);
    }
}
