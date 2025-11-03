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
            'clearance_type_id' => 'required|exists:clearance_types,id', // ✅ linked to dropdown
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'offices' => 'required|array|min:1',
            'offices.*' => 'string|in:business_office,dean,vp_sas,library_in_charge',
            'is_published' => 'nullable|boolean',
        ]);

        $data['offices'] = json_encode($data['offices']);
        $data['is_published'] = $request->has('is_published');

        // ✅ Save clearance record
        Clearance::create($data);

        return redirect()->route('admin.clearances.index')
            ->with('success', 'Clearance created successfully!');
    }

    public function publish(Clearance $clearance)
    {
        $clearance->update(['is_published' => true]);

        return back()->with('success', 'Clearance published and sent to corresponding office!');
    }
}
