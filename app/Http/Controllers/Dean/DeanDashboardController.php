<?php

namespace App\Http\Controllers\Dean;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\ClearanceRequest;

class DeanDashboardController extends Controller
{
    public function index()
    {
        $dean = Auth::user();
        $departmentId = $dean->department_id ?? null;

        // Base query limited to Dean's department
        $baseQuery = ClearanceRequest::whereHas('student.program', function ($q) use ($departmentId) {
            if ($departmentId) {
                $q->where('department_id', $departmentId);
            }
        });

        // ✅ Pending: waiting for Dean (whether status is pending or accepted from prev office)
        $pendingCount = (clone $baseQuery)
            ->where('current_office', 'dean')
            ->whereIn('status', ['pending', 'accepted'])
            ->count();

        // ✅ Approved: Dean already forwarded to VP-SAS
        $approvedCount = (clone $baseQuery)
            ->where('status', 'accepted')
            ->where('current_office', 'vp_sas')
            ->count();

        // ✅ Total requests (all)
        $totalRequests = (clone $baseQuery)->count();

        // ✅ Recent pending items
        $recentPending = (clone $baseQuery)
            ->where('current_office', 'dean')
            ->whereIn('status', ['pending', 'accepted'])
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard.dean.dashboard', [
            'user' => $dean,
            'pendingCount' => $pendingCount,
            'approvedCount' => $approvedCount,
            'totalRequests' => $totalRequests,
            'recentPending' => $recentPending,
        ]);
    }
}
