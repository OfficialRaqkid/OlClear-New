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

        foreach ($clearances as $clearance) {
            $clearance->offices = json_decode($clearance->offices, true);
        }

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
        ]);

        $type = ClearanceType::findOrFail($data['clearance_type_id']);

        // Force title = type name (no duplicates)
        $data['title'] = $type->name;

        $data['offices'] = json_encode($data['offices']);
        $data['is_published'] = true;

        // Departmental
        if ($type->id === ClearanceType::DEPARTMENTAL) {
            $data['department_id'] = auth()->user()->department_id;
        }

        // Marching
        if ($type->id === ClearanceType::MARCHING) {
            $data['department_id'] = null;
        }

        Clearance::create($data);

        return redirect()->route('admin.clearances.index')
            ->with('success', 'Clearance created successfully!');
    }

    /**
     * Publish clearance
     */
    public function publish(Clearance $clearance)
    {
        $clearance->update(['is_published' => true]);
        return redirect()->route('admin.clearances.index')
            ->with('success', 'Clearance published successfully!');
    }

    /**
     * Unpublish clearance
     */
    public function unpublish(Clearance $clearance)
    {
        $clearance->update(['is_published' => false]);
        return redirect()->route('admin.clearances.index')
            ->with('success', 'Clearance unpublished successfully!');
    }
}
