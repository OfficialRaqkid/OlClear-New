<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClearanceRequest;

class ClearanceApprovalController extends Controller
{
    /**
     * 🏛️ BUSINESS OFFICE — View all requests
     */
    public function businessOfficeIndex()
    {
        $requests = ClearanceRequest::with(['student.program', 'student.yearLevel'])
            ->where('current_office', 'business_office')
            ->whereIn('status', ['pending', 'accepted', 'held'])
            ->get();

        return view('dashboard.business_office.clearance_requests.index', compact('requests'));
    }

    /**
     * ✅ BUSINESS OFFICE — Accept and complete clearance
     */
    public function businessOfficeAccept($id)
    {
        $request = ClearanceRequest::findOrFail($id);

        $request->status = 'completed';
        $request->current_office = null;
        $request->save();

        return redirect()->back()->with('success', 'Clearance fully signed and completed by Business Office!');
    }

    /**
     * ⏸️ BUSINESS OFFICE — Hold
     */
    public function businessOfficeHold(Request $req, $id)
    {
        $request = ClearanceRequest::findOrFail($id);
        $request->status = 'held';
        $request->hold_reason = $req->hold_reason;
        $request->save();

        return redirect()->back()->with('warning', 'Request put on hold by Business Office.');
    }

    /**
     * 📚 LIBRARY — View requests
     */
    public function libraryIndex()
    {
        $requests = ClearanceRequest::with(['student.program', 'student.yearLevel'])
            ->where('current_office', 'library_in_charge')
            ->get();

        return view('dashboard.library_in_charge.clearance_requests.index', compact('requests'));
    }

    public function libraryAccept($id)
    {
        $request = ClearanceRequest::findOrFail($id);
        $request->status = 'accepted';
        $request->current_office = 'dean';
        $request->save();

        return redirect()->back()->with('success', 'Request approved and sent to Dean.');
    }

    public function libraryHold(Request $req, $id)
    {
        $request = ClearanceRequest::findOrFail($id);
        $request->status = 'held';
        $request->hold_reason = $req->hold_reason;
        $request->save();

        return redirect()->back()->with('warning', 'Request put on hold.');
    }

    /**
     * 🎓 DEAN — View requests
     */
    public function deanIndex()
    {
        $dean = auth()->user();
        $departmentId = $dean->department_id ?? null;

        $requests = ClearanceRequest::with(['student.program.department', 'student.yearLevel'])
            ->where('current_office', 'dean')
            ->when($departmentId, function ($query, $departmentId) {
                $query->whereHas('student.program', function ($q) use ($departmentId) {
                    $q->where('department_id', $departmentId);
                });
            })
            ->get();

        return view('dashboard.dean.clearance_requests.index', compact('requests'));
    }

    public function deanAccept($id)
    {
        $request = ClearanceRequest::findOrFail($id);
        $request->status = 'accepted';
        $request->current_office = 'vp_sas';
        $request->save();

        return redirect()->back()->with('success', 'Request approved and sent to VP-SAS.');
    }

    public function deanHold(Request $req, $id)
    {
        $request = ClearanceRequest::findOrFail($id);
        $request->status = 'held';
        $request->hold_reason = $req->hold_reason;
        $request->save();

        return redirect()->back()->with('warning', 'Request put on hold.');
    }

    /**
     * 🏛️ VP-SAS — View requests
     */
    public function vpSasIndex()
    {
        $requests = ClearanceRequest::with(['student.program', 'student.yearLevel'])
            ->where('current_office', 'vp_sas')
            ->get();

        return view('dashboard.vp_sas.clearance_requests.index', compact('requests'));
    }

    public function vpSasAccept($id)
    {
        $request = ClearanceRequest::findOrFail($id);
        $request->status = 'accepted';
        $request->current_office = 'business_office';
        $request->save();

        return redirect()->back()->with('success', 'Request approved and sent to Business Office for final completion.');
    }

    public function vpSasHold(Request $req, $id)
    {
        $request = ClearanceRequest::findOrFail($id);
        $request->status = 'held';
        $request->hold_reason = $req->hold_reason;
        $request->save();

        return redirect()->back()->with('warning', 'Request put on hold.');
    }

    /**
     * 📊 BUSINESS OFFICE — Completed Clearances
     */
    public function completedClearancesIndex()
    {
        $completedRequests = ClearanceRequest::with(['student.program', 'student.yearLevel'])
            ->where('status', 'completed')
            ->orderByDesc('updated_at')
            ->get();

        return view('dashboard.business_office.clearance_requests.completed', compact('completedRequests'));
    }
}
