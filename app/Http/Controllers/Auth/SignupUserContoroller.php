<?php

namespace App\Http\Controllers\Auth;
use App\Models\Department;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Program;
use App\Models\YearLevel;
use App\Models\User;
use App\Models\StudentProfile;
use App\Models\EnrolledStudent;
use Illuminate\Support\Facades\Hash;

class SignupUserContoroller extends Controller
{
    public function index()
    {
    $departments = Department::all();
    $programs = Program::all();
    $yearLevels = YearLevel::all();

    return view('auth.signup', compact('departments', 'programs', 'yearLevels'));
}

    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'student_id'      => 'required|string|max:20|unique:users,username',
            'first_name'      => 'required|string|max:255',
            'middle_name'     => 'nullable|string|max:255',
            'last_name'       => 'required|string|max:255',
            'suffix'          => 'nullable|string|max:50',
            'program_id'      => 'required|exists:programs,id',
            'year_level_id'   => 'required|exists:year_levels,id',
            'contact_number'  => 'required|string|max:20',
            'address'         => 'required|string|max:255',
        ]);

        // Check if student ID is in enrolled list (optional)
        $isEnrolled = EnrolledStudent::where('student_id', $request->student_id)->exists();

        // Build full name
        $middleInitial = $request->middle_name ? strtoupper(substr($request->middle_name, 0, 1)) . '.' : '';
        $suffix = $request->suffix ?? '';
        $name = trim("{$request->first_name} {$middleInitial} {$request->last_name} {$suffix}");

        try {
            // Create the user
            $user = User::create([
                'name'      => $name,
                'username'  => $request->student_id, // store student ID as username
                'password'  => Hash::make('123456'), // default password
                'role_id'   => 6, // student role
                'is_active' => $isEnrolled ? 1 : 0,
            ]);

            // Create the student profile
            StudentProfile::create([
                'user_id'        => $user->id,
                'first_name'     => $request->first_name,
                'middle_name'    => $request->middle_name,
                'last_name'      => $request->last_name,
                'suffix'         => $request->suffix,
                'contact_number' => $request->contact_number,
                'address'        => $request->address,
                'program_id'     => $request->program_id,
                'year_level_id'  => $request->year_level_id,
            ]);

        } catch (\Exception $e) {
            // Catch any database errors and show the message
            dd("Database Error: " . $e->getMessage());
        }

        // Redirect to login with success
        return redirect()->route('login.student')->with('success', 'Account successfully registered!');
    }
}
