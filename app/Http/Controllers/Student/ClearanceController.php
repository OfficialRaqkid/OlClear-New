<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Clearance;
use App\Models\ClearanceRequest;
use Illuminate\Http\Request;

class ClearanceController extends Controller
{
public function index()
{
    $student = auth()->user()->studentProfile;

    $clearances = Clearance::where('is_published', true)
        ->where('is_active', true)
        ->where(function ($q) use ($student) {

            // Financial (everyone sees this)
            $q->whereHas('clearanceType', function ($type) {
                $type->where('name', 'Financial Clearance');
            });

            // Departmental (only same department)
            $q->orWhere(function ($d) use ($student) {
                $d->whereHas('clearanceType', function ($type) {
                    $type->where('name', 'Departmental Clearance');
                })
                ->where('department_id', $student->department_id);
            });
        })
        ->latest()
        ->get();

    return view('dashboard.student.clearances.index', compact('clearances'));
}


    public function requestClearance($id)
{
    $student = auth()->user();

    if (!$student->studentProfile) {
        return redirect()->back()->with('error', 'No student profile found for your account.');
    }

    $clearance = Clearance::findOrFail($id);

    // Prevent duplicate requests
    $existingRequest = ClearanceRequest::where('student_id', $student->studentProfile->id)
        ->where('clearance_id', $id)
        ->whereIn('status', ['pending', 'accepted', 'held', 'completed'])
        ->first();

    if ($existingRequest) {
        return redirect()->back()->with('warning', 'You have already submitted this clearance request.');
    }

    // Determine the FIRST office
    if ($clearance->clearanceType->name === 'Departmental Clearance') {
        $firstOffice = 'dean'; // 👍 Dean first
    } else {
        $firstOffice = 'library_in_charge'; // 👍 Financial goes to Library
    }

    ClearanceRequest::create([
        'student_id' => $student->studentProfile->id,
        'clearance_id' => $id,
        'status' => 'pending',
        'current_office' => $firstOffice, // 🔥 Correct starting office
    ]);

    return redirect()->back()->with('success', 'Your clearance request has been submitted!');
}
}
