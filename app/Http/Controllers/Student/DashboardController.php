<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\ClearanceRequest;

class DashboardController extends Controller
{
    public function index()
    {
        $student = Auth::user()->studentProfile;

        // 🔹 Get the latest clearance request for this student
        $latestClearance = ClearanceRequest::where('student_id', $student->id ?? null)
            ->latest()
            ->first();

        // 🔹 Get the 3 most recent "approved" or "updated" clearances (simulate office approvals)
$recentApprovals = ClearanceRequest::where('student_id', $student->id ?? null)
    ->orderByDesc('updated_at')
    ->take(5)
    ->get();


        return view('dashboard.student.dashboard', compact('student', 'latestClearance', 'recentApprovals'));
    }
}
