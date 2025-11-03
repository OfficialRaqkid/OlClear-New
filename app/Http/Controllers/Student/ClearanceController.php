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
        $clearances = Clearance::where('is_published', true)
            ->where('is_active', true)
            ->whereHas('clearanceType', function ($query) {
                $query->where('name', 'Financial Clearance');
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

        // 🔍 Check if a request already exists for this clearance
        $existingRequest = ClearanceRequest::where('student_id', $student->studentProfile->id)
            ->where('clearance_id', $id)
            ->whereIn('status', ['pending', 'accepted', 'held', 'completed']) // any active or finished request
            ->first();

        if ($existingRequest) {
            return redirect()->back()->with('warning', 'You have already submitted this clearance request.');
        }

        // ✅ Create new clearance request if none exists
        ClearanceRequest::create([
            'student_id' => $student->studentProfile->id,
            'clearance_id' => $id,
            'status' => 'pending',
            'current_office' => 'library_in_charge',
        ]);

        return redirect()->back()->with('success', 'Your clearance request has been submitted!');
    }
}
