<?php

namespace App\Http\Controllers\Dean;

use App\Http\Controllers\Controller;
use App\Models\Clearance;
use Illuminate\Http\Request;

class ClearanceController extends Controller
{
    public function index()
    {
        $deanDepartmentId = auth()->user()->department_id;

        $clearances = Clearance::where('is_published', true)
            ->where('department_id', $deanDepartmentId)
            ->whereHas('clearanceType', function ($query) {
                $query->where('name', 'Departmental Clearance');
            })
            ->latest()
            ->get();

        return view('dashboard.dean.clearances.index', compact('clearances'));
    }

    public function activate(Clearance $clearance)
    {
        $deanDepartmentId = auth()->user()->department_id;

        // Restrict activation to same department
        if ($clearance->department_id !== $deanDepartmentId) {
            return back()->with('error', 'You cannot activate clearance from another department.');
        }

        $clearance->update(['is_active' => true]);

        return back()->with('success', 'Departmental clearance is now visible to students.');
    }
}
