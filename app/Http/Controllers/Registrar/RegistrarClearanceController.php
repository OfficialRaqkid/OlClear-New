<?php

namespace App\Http\Controllers\Registrar;

use App\Http\Controllers\Controller;
use App\Models\Clearance;
use App\Models\ClearanceRequest;

class RegistrarClearanceController extends Controller
{
    /**
     * Show published marching clearances
     */
    public function marchingIndex()
    {
        $clearances = Clearance::whereHas('clearanceType', function ($q) {
                $q->where('name', 'Marching Clearance');
            })
            ->where('is_published', true)
            ->latest()
            ->get();

        return view(
            'dashboard.registrar.clearances.marching',
            compact('clearances')
        );
    }

    /**
     * Show student requests per marching clearance
     */
public function marchingRequests(Clearance $clearance)
{
    $requests = ClearanceRequest::with('student')
        ->where('clearance_id', $clearance->id)
        ->where('current_office', 'registrar') // 🔒 activation only
        ->whereIn('status', [
            'pending',               // ✅ FIRST activation request
            'activation_pending',
            'activation_approved',
            'held',
        ])
        ->latest()
        ->get();

    return view(
        'dashboard.registrar.clearances.requests',
        compact('requests', 'clearance')
    );
}

    /**
     * Approve student request (send back to student)
     */
public function approve(ClearanceRequest $request)
{
    $request->update([
        'status' => 'activation_approved',
    ]);

    return back()->with(
        'success',
        'Marching clearance activated. Student may now proceed.'
    );
}
    /**
     * Hold student request
     */
    public function hold(ClearanceRequest $request)
    {
        $request->update([
            'status' => 'held',
        ]);

        return back()->with(
            'success',
            'Student request has been held.'
        );
    }
}
