<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Clearance;
use App\Models\ClearanceRequest;

class ClearanceController extends Controller
{
    /* =========================================================
     |  SHOW AVAILABLE CLEARANCES (ALL TYPES)
     ========================================================= */
  public function index()
{
    $student = auth()->user()->studentProfile
        ?? abort(403, 'Student profile missing');

    $clearances = Clearance::where(function ($q) use ($student) {

        /* ===============================
         | FINANCIAL (NORMAL)
         =============================== */
        $q->where(function ($x) {
            $x->whereHas('clearanceType', fn ($t) =>
                $t->where('name', 'Financial Clearance')
            )
            ->where('is_active', true);
        });

        /* ===============================
         | DEPARTMENTAL (NORMAL)
         =============================== */
        $q->orWhere(function ($x) use ($student) {
            $x->whereHas('clearanceType', fn ($t) =>
                $t->where('name', 'Departmental Clearance')
            )
            ->where('department_id', $student->department_id)
            ->where('is_active', true);
        });

        /* ===============================
         | MARCHING (SPECIAL CASE)
         =============================== */
        if ((int) $student->year_level_id === 4) {
            $q->orWhereHas('clearanceType', fn ($t) =>
                $t->where('name', 'Marching Clearance')
            );
        }

    })
    ->with('clearanceType')
    ->get();

    return view('dashboard.student.clearances.index', compact('clearances'));
}

    /* =========================================================
     |  REQUEST CLEARANCE (ENTRY POINT)
     ========================================================= */
public function requestClearance($id)
{
    $student = auth()->user()->studentProfile
        ?? abort(403, 'Student profile not found.');

    $clearance = Clearance::with('clearanceType')->findOrFail($id);

    // 🚫 Prevent duplicate active requests (NOT for marching)
    if ($clearance->clearanceType->name !== 'Marching Clearance') {

        $exists = ClearanceRequest::where([
                'student_id'   => $student->id,
                'clearance_id' => $clearance->id,
            ])
            ->whereIn('status', ['pending', 'held', 'accepted'])
            ->exists();

        if ($exists) {
            return back()->with('warning', 'You already have an active request.');
        }
    }

    return match ($clearance->clearanceType->name) {

        'Marching Clearance' =>
            $this->requestMarching($student, $clearance),

        'Departmental Clearance' =>
            $this->requestDepartmental($student, $clearance),

        'Financial Clearance' =>
            $this->requestFinancial($student, $clearance),

        default =>
            abort(400, 'Invalid clearance type.'),
    };
}

    /* =========================================================
     |  MARCHING — REGISTRAR FIRST
     ========================================================= */
private function requestMarching($student, $clearance)
{
    if ($student->year_level_id !== 4) {
        abort(403, 'Only 4th year students may request marching clearance.');
    }

    $request = ClearanceRequest::where([
        'student_id'   => $student->id,
        'clearance_id' => $clearance->id,
    ])->latest()->first();

    /**
     * 1️⃣ FIRST CLICK → ACTIVATION REQUEST
     */
    if (!$request) {
        ClearanceRequest::create([
            'student_id'     => $student->id,
            'clearance_id'   => $clearance->id,
            'status'         => 'pending',
            'current_office' => 'registrar',
        ]);

        return back()->with(
            'success',
            'Marching clearance activation request sent.'
        );
    }

    /**
     * 2️⃣ SECOND CLICK → START AUTO FLOW
     */
    if ($request->status === 'activation_approved') {
        $request->update([
            'status'         => 'pending',
            'current_office' => 'dean',
        ]);

        return back()->with(
            'success',
            'Marching clearance process started.'
        );
    }

    return back()->with(
        'warning',
        'Marching clearance is already in progress.'
    );
}

    /* =========================================================
     |  DEPARTMENTAL — DEAN
     ========================================================= */
    private function requestDepartmental($student, $clearance)
    {
        ClearanceRequest::create([
            'student_id'     => $student->id,
            'clearance_id'   => $clearance->id,
            'status'         => 'pending',
            'current_office' => 'dean',
        ]);

        return back()->with(
            'success',
            'Departmental clearance submitted to the Dean.'
        );
    }

    /* =========================================================
     |  FINANCIAL — LIBRARY / BO
     ========================================================= */
    private function requestFinancial($student, $clearance)
    {
        ClearanceRequest::create([
            'student_id'     => $student->id,
            'clearance_id'   => $clearance->id,
            'status'         => 'pending',
            'current_office' => 'library_in_charge',
        ]);

        return back()->with(
            'success',
            'Financial clearance submitted.'
        );
    }

    /* =========================================================
     |  SHOW MARCHING CLEARANCES (STUDENT VIEW)
     ========================================================= */
    public function marching()
    {
        $student = auth()->user()->studentProfile
            ?? abort(403, 'Student profile not found.');

        if ($student->year_level_id !== 4) {
            abort(403, 'Marching clearance is for 4th year students only.');
        }

        $clearances = Clearance::whereHas('clearanceType', fn ($q) =>
                $q->where('name', 'Marching Clearance')
            )
            ->latest()
            ->get();

        $requests = ClearanceRequest::where('student_id', $student->id)
            ->get()
            ->keyBy('clearance_id');

        return view(
            'dashboard.student.clearances.marching',
            compact('clearances', 'requests')
        );
    }

    /* =========================================================
     |  MY REQUESTS
     ========================================================= */
    public function myRequests()
    {
        $student = auth()->user()->studentProfile
            ?? abort(403, 'Student profile not found.');

        $requests = ClearanceRequest::with('clearance.clearanceType')
            ->where('student_id', $student->id)
            ->latest()
            ->get();

        return view('dashboard.student.clearances.requests', compact('requests'));
    }
}
