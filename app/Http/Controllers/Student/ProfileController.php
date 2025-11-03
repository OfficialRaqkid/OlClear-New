<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        // Get the logged-in user's student profile
        $student = Auth::user()->studentProfile; // null if none

        return view('dashboard.student.profile', compact('student'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'profile_photo' => 'nullable|image|max:2048', // max 2MB
            'first_name'    => 'sometimes|string|max:255',
            'last_name'     => 'sometimes|string|max:255',
            // add other fields to validate if you accept editing them
        ]);

        $student = Auth::user()->studentProfile;
        if (! $student) {
            return redirect()->back()->with('error', 'Student profile not found.');
        }

        // If a file is uploaded, store it in public disk and save path
        if ($request->hasFile('profile_photo')) {
            $file = $request->file('profile_photo');

            // optional: delete old photo
            if ($student->profile_photo) {
                Storage::disk('public')->delete($student->profile_photo);
            }

            $path = $file->store('student_images', 'public'); // storage/app/public/student_images/...
            $student->profile_photo = $path;
        }

        // Update other editable fields if present
        if ($request->filled('first_name')) {
            $student->first_name = $request->first_name;
        }
        if ($request->filled('last_name')) {
            $student->last_name = $request->last_name;
        }

        $student->save();

        return redirect()->route('student.profile')->with('success', 'Profile updated.');
    }
}
