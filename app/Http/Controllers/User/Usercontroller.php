<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $rules = [
            'username'   => 'required|unique:users,username',
            'first_name' => 'required',
            'last_name'  => 'required',
            'role_id' => 'required|integer|in:2,3,4,5,7,8,9'
 
        ];

        // If Dean → require department_id
        if ($request->role_id == 3) {
            $rules['department_id'] = 'required|exists:departments,id';
        }
        $request->validate($rules);

        // Create the user
        $user = User::create([
            'name'      => $request->first_name . ' ' . $request->last_name,
            'username'  => $request->username,
            'password'  => Hash::make('123456'),
            'role_id'   => $request->role_id,
            'is_active' => true,
        ]);

        // Create their profile
        $user->profile()->create([
            'first_name'     => $request->first_name,
            'middle_name'    => $request->middle_name,
            'last_name'      => $request->last_name,
            'suffix'         => $request->suffix,
            'academic_title' => $request->academic_title,
            'profile_photo'  => $request->profile_photo,
            'program_id'     => $request->program_id, 
        ]);

        return redirect()->back()->with('success', 'User added successfully (default password: 123456)');
    }
}
