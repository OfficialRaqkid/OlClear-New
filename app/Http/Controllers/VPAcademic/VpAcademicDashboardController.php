<?php

namespace App\Http\Controllers\VpAcademic;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class VpAcademicDashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.vp_academic.dashboard', [
            'user' => Auth::user(),
        ]);
    }
}
