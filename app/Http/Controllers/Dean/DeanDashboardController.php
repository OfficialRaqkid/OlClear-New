<?php

namespace App\Http\Controllers\Dean;

use App\Http\Controllers\Controller;
use App\Models\ClearanceRequest;
use App\Models\ClearanceType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeanDashboardController extends Controller
{
    public function index()
{
    $dean = Auth::user();
    $departmentId = $dean->department_id ?? null;

    $baseQuery = ClearanceRequest::whereHas('student.program', function ($q) use ($departmentId) {
        if ($departmentId) {
            $q->where('department_id', $departmentId);
        }
    });

    $pendingCount = (clone $baseQuery)
        ->where('current_office', 'dean')
        ->whereIn('status', ['pending', 'accepted'])
        ->count();

    $approvedCount = (clone $baseQuery)
        ->where('status', 'accepted')
        ->where('current_office', '!=', 'dean')
        ->count();

    $totalRequests = (clone $baseQuery)->count();

    $recentPending = (clone $baseQuery)
        ->where('current_office', 'dean')
        ->whereIn('status', ['pending', 'accepted'])
        ->latest()
        ->take(5)
        ->get();

    return view('dashboard.dean.dashboard', [
        'dean' => $dean,
        'user' => $dean, // 👈 ADD THIS
        'pendingCount' => $pendingCount,
        'approvedCount' => $approvedCount,
        'totalRequests' => $totalRequests,
        'recentPending' => $recentPending,
    ]);
}
public function completed(Request $request)
{
    $departmentalTypeId = ClearanceType::DEPARTMENTAL;

    $completedRequests = ClearanceRequest::with([
            'student.program.department',
            'student.yearLevel',
            'clearance.clearanceType',
        ])
        ->where('status', 'completed')
        ->whereNull('current_office') // ✅ CRITICAL FIX
        ->whereHas('clearance', function ($q) use ($departmentalTypeId, $request) {
            $q->where('clearance_type_id', $departmentalTypeId);

            if ($request->filled('school_year')) {
                $q->where('school_year', $request->school_year);
            }

            if ($request->filled('semester')) {
                $q->where('semester', $request->semester);
            }
        })
        ->orderByDesc('updated_at')
        ->get();

    return view('dashboard.dean.clearance_requests.completed', compact('completedRequests'));
}
}
