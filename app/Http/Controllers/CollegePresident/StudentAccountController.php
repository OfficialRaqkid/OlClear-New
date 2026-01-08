<?php

namespace App\Http\Controllers\CollegePresident;

use App\Http\Controllers\Controller;
use App\Models\User;

class StudentAccountController extends Controller
{
    public function index()
    {
        $students = User::with([
            'studentProfile.program.department',
            'studentProfile.yearLevel'
        ])
        ->whereHas('studentProfile')
        ->get();

        return view(
            'dashboard.college_president.student_accounts',
            compact('students')
        );
    }
}
