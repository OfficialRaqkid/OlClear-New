<?php

namespace App\Http\Controllers\BusinessOffice;

use App\Http\Controllers\Controller;
use App\Models\Clearance;
use Illuminate\Http\Request;

class ClearanceController extends Controller
{
    public function index()
    {
        // Show published Financial Clearances only
        $clearances = Clearance::where('is_published', true)
            ->whereHas('clearanceType', function ($query) {
                $query->where('name', 'Financial Clearance');
            })
            ->latest()
            ->get();

        return view('dashboard.business_office.clearances.index', compact('clearances'));
    }

    public function activate(Clearance $clearance)
    {
        // Mark as active for students
        $clearance->update(['is_active' => true]);

        return back()->with('success', 'Clearance has been activated and is now visible to students.');
    }
}
