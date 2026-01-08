<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Clearance;
use App\Models\ClearanceType;
use Illuminate\Http\Request;

class ClearanceController extends Controller
{
    /**
     * Show all clearances
     */
    public function index()
    {
        $clearances = Clearance::latest()->get();

        return view('dashboard.admin.clearances.index', compact('clearances'));
    }

    /**
     * Show create clearance form
     */
    public function create()
    {
        $offices = [
            'dean'              => 'Dean',
            'business_office'   => 'Business Office',
            'registrar'         => 'Registrar',
            'vp_academic'       => 'VP Academic',
            'vp_sas'            => 'VP SAS',
            'library_in_charge' => 'Library In-Charge',
            'college_president' => 'College President',
        ];

        $clearanceTypes = ClearanceType::all();

        return view('dashboard.admin.clearances.create', compact('offices', 'clearanceTypes'));
    }

    /**
     * Store a new clearance
     */
    public function store(Request $request)
{
    $data = $request->validate([
        'clearance_type_id' => 'required|exists:clearance_types,id',
        'title'             => 'required|string|max:255',
        'description'       => 'nullable|string',
        'offices'           => 'required|array|min:1',
        'offices.*'         => 'string',
        'school_year'       => 'required|string',
        'semester'          => 'nullable|string',
    ]);

    $type = ClearanceType::findOrFail($data['clearance_type_id']);

    // Force title = clearance type name
    $data['title'] = $type->name;

    $data['is_published'] = true;

    // Departmental → semester + department
    if ($type->id === ClearanceType::DEPARTMENTAL) {
        if (empty($data['semester'])) {
            return back()
                ->withErrors(['semester' => 'Semester is required for Departmental clearance.'])
                ->withInput();
        }

        $data['department_id'] = auth()->user()->department_id;
    }

    // Financial → semester required
    if ($type->id === ClearanceType::FINANCIAL) {
        if (empty($data['semester'])) {
            return back()
                ->withErrors(['semester' => 'Semester is required for Financial clearance.'])
                ->withInput();
        }
    }

    // Marching → school year only
    if ($type->id === ClearanceType::MARCHING) {
        $data['semester'] = null;
        $data['department_id'] = null;
    }

    Clearance::create($data);

    return redirect()->route('admin.clearances.index')
        ->with('success', 'Clearance created successfully!');
}
}