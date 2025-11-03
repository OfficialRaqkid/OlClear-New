<?php

namespace App\Http\Controllers\BusinessOffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BusinessOfficeDashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.business_office.dashboard', [
            'user' => Auth::user(),
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Logged out successfully.');
    }
}


