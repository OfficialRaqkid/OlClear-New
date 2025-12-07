<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Clearance;
use App\Models\ClearanceType;
use Illuminate\Http\Request;

class ClearanceController extends Controller
{
    public function index()
    {
        $clearances = Clearance::latest()->get();

        // 🔧 Decode offices JSON so Blade can loop through easily
        foreach ($clearances as $clearance) {
            $clearance->offices = json_decode($clearance->offices, true);
        }

        return view('dashboard.admin.clearances.index', compact('clearances'));
    }

    public function create()
    {
        $offices = [
            'business_office' => 'Business Office',
            'dean' => 'Dean',
            'vp_sas' => 'VP for SAS',
            'library_in_charge' => 'Library In-Charge',
        ];

        // ✅ Fetch clearance types for dropdown
        $clearanceTypes = ClearanceType::all();

        return view('dashboard.admin.clearances.create', compact('offices', 'clearanceTypes'));
    }

   public function store(Request $request)
{
    $data = $request->validate([
        'clearance_type_id' => 'required|exists:clearance_types,id',
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'offices' => 'required|array|min:1',
        'offices.*' => 'string|in:business_office,dean,vp_sas,library_in_charge',
        'is_published' => 'nullable|boolean',
    ]);

    $data['offices'] = json_encode($data['offices']);
    $data['is_published'] = $request->has('is_published');

    $type = \App\Models\ClearanceType::find($data['clearance_type_id']);

    // -----------------------------
    // FORCE DEAN TO USE THEIR OWN DEPARTMENT
    // -----------------------------
    if ($type->name === 'Departmental Clearance') {

        // Get dean's assigned department
        $dean = auth()->user();
        $deanDepartmentId = $dean->department_id;

        if (!$deanDepartmentId) {
            return back()->with('warning', 'Your account has no assigned department. Contact admin.');
        }

        // Auto-assign department to the clearance
        $data['department_id'] = $deanDepartmentId;
    }

    Clearance::create($data);

    return redirect()->route('admin.clearances.index')
        ->with('success', 'Clearance created successfully!');
}

}
