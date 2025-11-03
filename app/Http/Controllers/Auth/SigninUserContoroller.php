<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class SigninUserContoroller extends Controller
{
    public function index()
    {
        return view('auth.signin');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('username', $request->username)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors([
                'login' => 'Invalid username or password.',
            ])->withInput();
        }

        if (!$user->is_active) {
            return back()->withErrors([
                'login' => 'You are not allowed to login. Please contact admin.',
            ])->withInput();
        }

        Auth::login($user);

    
        switch ($user->role_id) {
    case 1:  
        return redirect()->route('admin.dashboard');

    case 2: 
        return redirect()->route('library_in_charge.dashboard'); 

    case 3:
        return redirect()->route('dean.dashboard');

    case 4:
        return redirect()->route('vp_sas.dashboard');

    case 5:
        return redirect()->route('business_office.dashboard');

    case 6:
        return redirect()->route('student.dashboard');

            default:
                Auth::logout();
                return back()->withErrors([
                    'login' => 'Your role is not authorized to access this portal.',
                ]);
        }

    }

    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.student')->with('status', 'You have been logged out.');
    }
}
