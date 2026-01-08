<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClearanceRequest;

class ClearanceApprovalController extends Controller
{
    /* =========================================================
     |  MARCHING AUTO-FLOW
     ========================================================= */
    private function marchingFlow(): array
    {
        return [
            'dean',
            'business_office',
            'registrar',
            'vp_academic',
            'college_president',
        ];
    }

    private function moveToNextOffice(ClearanceRequest $request)
    {
        $flow = $this->marchingFlow();
        $currentIndex = array_search($request->current_office, $flow, true);

        if ($currentIndex === false) {
            abort(500, 'Invalid marching clearance flow state.');
        }

        if (!isset($flow[$currentIndex + 1])) {
            $request->update([
                'status' => 'completed',
                'current_office' => null,
            ]);
        } else {
            $request->update([
                'status' => 'accepted',
                'current_office' => $flow[$currentIndex + 1],
            ]);
        }
    }

    /* =========================================================
     |  FINANCIAL FLOW
     ========================================================= */
    private function financialFlow(): array
    {
        return [
            'library_in_charge',
            'dean',
            'vp_sas',
            'business_office',
        ];
    }

    private function moveFinancialToNextOffice(ClearanceRequest $request)
    {
        $flow = $this->financialFlow();
        $currentIndex = array_search($request->current_office, $flow, true);

        if ($currentIndex === false) {
            abort(500, 'Invalid financial clearance flow.');
        }

        if (!isset($flow[$currentIndex + 1])) {
            $request->update([
                'status' => 'completed',
                'current_office' => null,
            ]);
        } else {
            $request->update([
                'status' => 'pending',
                'current_office' => $flow[$currentIndex + 1],
            ]);
        }
    }

    /* =========================================================
     |  BUSINESS OFFICE
     ========================================================= */
    public function businessOfficeIndex()
    {
        $requests = ClearanceRequest::with(['student.program', 'student.yearLevel'])
            ->where('current_office', 'business_office')
            ->whereIn('status', ['pending', 'accepted', 'held'])
            ->get();

        return view('dashboard.business_office.clearance_requests.index', compact('requests'));
    }

    public function businessOfficeAccept($id)
    {
        $request = ClearanceRequest::findOrFail($id);
        $type = $request->clearance->clearanceType->name;

        if ($type === 'Financial Clearance') {
            $this->moveFinancialToNextOffice($request);
        } elseif ($type === 'Marching Clearance') {
            $this->moveToNextOffice($request);
        }

        return back()->with('success', 'Request processed by Business Office.');
    }

    public function businessOfficeHold(Request $req, $id)
    {
        ClearanceRequest::findOrFail($id)->update([
            'status' => 'held',
            'hold_reason' => $req->hold_reason,
        ]);

        return back()->with('warning', 'Request put on hold by Business Office.');
    }

    /* =========================================================
 |  LIBRARY IN-CHARGE (FINANCIAL – FIRST STEP)
 ========================================================= */
public function libraryIndex()
{
    $requests = ClearanceRequest::with(['student.program', 'student.yearLevel'])
        ->where('current_office', 'library_in_charge')
        ->whereHas('clearance.clearanceType', fn ($q) =>
            $q->where('name', 'Financial Clearance')
        )
        ->whereIn('status', ['pending', 'accepted', 'held'])
        ->get();

    return view(
        'dashboard.library_in_charge.clearance_requests.index',
        compact('requests')
    );
}

public function libraryAccept($id)
{
    $request = ClearanceRequest::findOrFail($id);

    if ($request->clearance->clearanceType->name === 'Financial Clearance') {
        $this->moveFinancialToNextOffice($request);
    }

    return back()->with('success', 'Financial clearance approved by Library.');
}

public function libraryHold(Request $req, $id)
{
    ClearanceRequest::findOrFail($id)->update([
        'status'      => 'held',
        'hold_reason' => $req->hold_reason,
    ]);

    return back()->with('warning', 'Request put on hold by Library.');
}

    /* =========================================================
     |  DEAN  ✅ (ERROR FIXED)
     ========================================================= */
    public function deanIndex()
    {
        $dean = auth()->user();
        $departmentId = $dean->department_id ?? null;

        $requests = ClearanceRequest::with(['student.program.department', 'student.yearLevel'])
            ->where('current_office', 'dean')
            ->when($departmentId, fn ($query) =>
                $query->whereHas('student.program', fn ($q) =>
                    $q->where('department_id', $departmentId)
                )
            )
            ->get();

        return view('dashboard.dean.clearance_requests.index', compact('requests'));
    }

    public function deanAccept($id)
    {
        $request = ClearanceRequest::findOrFail($id);
        $type = $request->clearance->clearanceType->name;

        if ($type === 'Departmental Clearance') {
            $request->update([
                'status' => 'completed',
                'current_office' => null,
            ]);
        } elseif ($type === 'Financial Clearance') {
            $this->moveFinancialToNextOffice($request);
        } elseif ($type === 'Marching Clearance') {
            $this->moveToNextOffice($request);
        }

        return back()->with('success', 'Request approved by Dean.');
    }

    public function deanHold(Request $req, $id)
    {
        ClearanceRequest::findOrFail($id)->update([
            'status' => 'held',
            'hold_reason' => $req->hold_reason,
        ]);

        return back()->with('warning', 'Request put on hold by Dean.');
    }

    /* =========================================================
 |  VP SAS (FINANCIAL)
 ========================================================= */
public function vpSasIndex()
{
    $requests = ClearanceRequest::with(['student.program', 'student.yearLevel'])
        ->where('current_office', 'vp_sas')
        ->whereHas('clearance.clearanceType', fn ($q) =>
            $q->where('name', 'Financial Clearance')
        )
        ->whereIn('status', ['pending', 'accepted', 'held'])
        ->get();

    return view(
        'dashboard.vp_sas.clearance_requests.index',
        compact('requests')
    );
}

public function vpSasAccept($id)
{
    $request = ClearanceRequest::findOrFail($id);

    if ($request->clearance->clearanceType->name === 'Financial Clearance') {
        $this->moveFinancialToNextOffice($request);
    }

    return back()->with('success', 'Financial clearance approved by VP SAS.');
}

public function vpSasHold(Request $req, $id)
{
    ClearanceRequest::findOrFail($id)->update([
        'status'      => 'held',
        'hold_reason' => $req->hold_reason,
    ]);

    return back()->with('warning', 'Request put on hold by VP SAS.');
}

/* =========================================================
 |  REGISTRAR – FLOW (FINANCIAL + MARCHING)
 ========================================================= */
public function registrarIndex()
{
    $requests = ClearanceRequest::with([
            'student.program',
            'student.yearLevel',
            'clearance.clearanceType',
        ])
        ->where('current_office', 'registrar')

        ->where(function ($q) {

            // ✅ ALWAYS show non-marching clearances
            $q->whereHas('clearance.clearanceType', function ($t) {
                $t->where('name', '!=', 'Marching Clearance');
            });

            // ✅ Show marching ONLY if already in flow
            $q->orWhere(function ($mq) {
                $mq->whereHas('clearance.clearanceType', function ($t) {
                    $t->where('name', 'Marching Clearance');
                })
                ->whereNotIn('status', [
                    'pending',              // activation request
                    'activation_pending',
                    'activation_approved',
                ]);
            });

        })
        ->get();

    return view(
        'dashboard.registrar.clearance_requests.index',
        compact('requests')
    );
}

    public function registrarAccept($id)
    {
        $request = ClearanceRequest::findOrFail($id);

        if ($request->clearance->clearanceType->name === 'Marching Clearance') {
            $this->moveToNextOffice($request);
        }

        return back()->with('success', 'Marching clearance approved by Registrar.');
    }

    public function registrarHold(Request $req, $id)
    {
        ClearanceRequest::findOrFail($id)->update([
            'status' => 'held',
            'hold_reason' => $req->hold_reason,
        ]);

        return back()->with('warning', 'Request put on hold by Registrar.');
    }

    /* =========================================================
     |  REGISTRAR – COMPLETED MARCHING
     ========================================================= */
    public function registrarCompletedClearances(Request $request)
    {
        $schoolYear = $request->school_year;

        $completedRequests = ClearanceRequest::with([
                'student.program',
                'student.yearLevel',
                'clearance.clearanceType',
            ])
            ->where('status', 'completed')
            ->whereHas('clearance.clearanceType', fn ($q) =>
                $q->where('name', 'Marching Clearance')
            )
            ->when($schoolYear, fn ($q) =>
                $q->whereHas('clearance', fn ($cq) =>
                    $cq->where('school_year', $schoolYear)
                )
            )
            ->orderByDesc('updated_at')
            ->get();

        return view(
            'dashboard.registrar.clearance_requests.completed',
            compact('completedRequests', 'schoolYear')
        );
    }

    /* =========================================================
     |  VP ACADEMIC
     ========================================================= */
    public function vpAcademicIndex()
    {
        $requests = ClearanceRequest::with(['student.program', 'student.yearLevel'])
            ->where('current_office', 'vp_academic')
            ->whereHas('clearance.clearanceType', fn ($q) =>
                $q->where('name', 'Marching Clearance')
            )
            ->get();

        return view('dashboard.vp_academic.clearance_requests.index', compact('requests'));
    }

    public function vpAcademicAccept($id)
    {
        $request = ClearanceRequest::findOrFail($id);

        if ($request->clearance->clearanceType->name === 'Marching Clearance') {
            $this->moveToNextOffice($request);
        }

        return back()->with('success', 'Marching clearance approved by VP Academic.');
    }

    public function vpAcademicHold(Request $req, $id)
    {
        ClearanceRequest::findOrFail($id)->update([
            'status' => 'held',
            'hold_reason' => $req->hold_reason,
        ]);

        return back()->with('warning', 'Request put on hold by VP Academic.');
    }

    /* =========================================================
     |  BUSINESS OFFICE – COMPLETED (ALL TYPES)
     ========================================================= */
    public function completedClearancesIndex(Request $request)
    {
        $schoolYear = $request->school_year;
        $semester   = $request->semester;

        $completedRequests = ClearanceRequest::with([
                'student.program',
                'student.yearLevel',
                'clearance.clearanceType'
            ])
            ->where('status', 'completed')
            ->when($schoolYear, fn ($q) =>
                $q->whereHas('clearance', fn ($cq) =>
                    $cq->where('school_year', $schoolYear)
                )
            )
            ->when($semester, fn ($q) =>
                $q->whereHas('clearance', fn ($cq) =>
                    $cq->where('semester', $semester)
                )
            )
            ->orderByDesc('updated_at')
            ->get();

        return view(
            'dashboard.business_office.clearance_requests.completed',
            compact('completedRequests', 'schoolYear', 'semester')
        );
    }

    /* =========================================================
     |  COLLEGE PRESIDENT
     ========================================================= */
    public function presidentIndex()
    {
        $requests = ClearanceRequest::with(['student.program', 'student.yearLevel'])
            ->where('current_office', 'college_president')
            ->whereHas('clearance.clearanceType', fn ($q) =>
                $q->where('name', 'Marching Clearance')
            )
            ->get();

        return view('dashboard.college_president.clearance_requests.index', compact('requests'));
    }

    public function presidentAccept($id)
    {
        $request = ClearanceRequest::findOrFail($id);

        if ($request->clearance->clearanceType->name === 'Marching Clearance') {
            $this->moveToNextOffice($request);
        }

        return back()->with('success', 'Marching clearance approved by College President.');
    }

    public function presidentHold(Request $req, $id)
    {
        ClearanceRequest::findOrFail($id)->update([
            'status' => 'held',
            'hold_reason' => $req->hold_reason,
        ]);

        return back()->with('warning', 'Request put on hold by College President.');
    }
}
