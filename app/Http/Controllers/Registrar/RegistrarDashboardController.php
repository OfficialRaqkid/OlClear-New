<?php

namespace App\Http\Controllers\Registrar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegistrarDashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.registrar.dashboard', [
            'user' => Auth::user()
        ]);
    }
}