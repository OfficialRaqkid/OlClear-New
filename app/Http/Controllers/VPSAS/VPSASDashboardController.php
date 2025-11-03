<?php

namespace App\Http\Controllers\VPSAS;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\ClearanceRequest;

class VPSASDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // ✅ Count all pending requests currently in VP-SAS
        $pendingCount = ClearanceRequest::where('current_office', 'vp_sas')
            ->where('status', 'pending')
            ->count();

        // ✅ Count all clearances already approved by VP-SAS and forwarded to final business office
        $clearedCount = ClearanceRequest::where('current_office', 'final_business_office')
            ->where('status', 'accepted')
            ->count();

        // ✅ Count all held requests (considered “Overdue”)
        $overdueCount = ClearanceRequest::where('current_office', 'vp_sas')
            ->where('status', 'held')
            ->count();

        // ✅ Optional: Get a few of the most recent pending requests
        $recentPending = ClearanceRequest::where('current_office', 'vp_sas')
            ->where('status', 'pending')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard.vp_sas.dashboard', [
            'user' => $user,
            'pendingCount' => $pendingCount,
            'clearedCount' => $clearedCount,
            'overdueCount' => $overdueCount,
            'recentPending' => $recentPending,
        ]);
    }
}
