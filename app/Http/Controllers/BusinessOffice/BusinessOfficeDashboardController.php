<?php

namespace App\Http\Controllers\BusinessOffice;

use App\Http\Controllers\Controller;
use App\Models\ClearanceRequest;
use App\Models\ClearanceType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BusinessOfficeDashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.business_office.dashboard', [
            'user' => Auth::user(),
        ]);
    }

    /**
     * VIEW COMPLETED FINANCIAL CLEARANCES ONLY
     */
   public function completed(Request $request)
{
    $financialTypeId = ClearanceType::FINANCIAL;

    $completedRequests = ClearanceRequest::with([
            'student.program.department',
            'student.yearLevel',
            'clearance',
        ])
        ->where('status', 'completed')
        ->whereNull('current_office') // ✅ THIS is the key
        ->whereHas('clearance', function ($q) use ($financialTypeId, $request) {
            $q->where('clearance_type_id', $financialTypeId);

            if ($request->school_year) {
                $q->where('school_year', $request->school_year);
            }

            if ($request->semester) {
                $q->where('semester', $request->semester);
            }
        })
        ->select('clearance_id')
        ->distinct()
        ->get();

    return view('dashboard.business_office.completed', compact('completedRequests'));
}

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Logged out successfully.');
    }
}
