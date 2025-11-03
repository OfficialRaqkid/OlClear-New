<?php

namespace App\Http\Controllers\LibraryInCharge;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\ClearanceRequest;

class LibraryInChargeDashboardController extends Controller
{
    public function index()
    {
        // ✅ Count pending clearance requests for Library In-Charge
        $pendingCount = ClearanceRequest::where('current_office', 'library_in_charge')
            ->where('status', 'pending')
            ->count();

        // ✅ Count cleared (approved) clearances
        $clearedCount = ClearanceRequest::where('current_office', 'library_in_charge')
            ->where('status', 'accepted')
            ->count();

        // ✅ Total requests handled by library
        $totalRequests = ClearanceRequest::where('current_office', 'library_in_charge')->count();

        // ✅ Overdue requests (optional example: status = 'overdue')
        $overdueCount = ClearanceRequest::where('current_office', 'library_in_charge')
            ->where('status', 'overdue')
            ->count();

        // ✅ Optional: recent pending requests
        $recentPending = ClearanceRequest::where('current_office', 'library_in_charge')
            ->where('status', 'pending')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard.library_in_charge.dashboard', [
            'user' => Auth::user(),
            'pendingCount' => $pendingCount,
            'clearedCount' => $clearedCount,
            'overdueCount' => $overdueCount,
            'totalRequests' => $totalRequests,
            'recentPending' => $recentPending,
        ]);
    }
}
