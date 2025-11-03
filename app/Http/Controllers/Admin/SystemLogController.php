<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SystemLogController extends Controller
{
        public function index()
        {
            $logs = DB::table('users')
        ->join('roles', 'users.role_id', '=', 'roles.id')
        // ✅ Faculty/Staff (Dean, Registrar, etc.)
        ->leftJoin('user_profiles', 'users.id', '=', 'user_profiles.user_id')
        ->leftJoin('programs as up_programs', 'user_profiles.program_id', '=', 'up_programs.id')
        ->leftJoin('departments as up_departments', 'up_programs.department_id', '=', 'up_departments.id')

        // ✅ Students
        ->leftJoin('student_profiles', 'users.id', '=', 'student_profiles.user_id')
        ->leftJoin('programs as sp_programs', 'student_profiles.program_id', '=', 'sp_programs.id')
        ->leftJoin('departments as sp_departments', 'sp_programs.department_id', '=', 'sp_departments.id')
        ->leftJoin('year_levels', 'student_profiles.year_level_id', '=', 'year_levels.id')

        // ✅ Exclude Admins
        ->where('users.role_id', '!=', 1)

        // ✅ Select with COALESCE to merge both department sources
        ->select(
            'users.id',
            'users.name',
            'users.username',
            'roles.name as role_name',
            DB::raw('COALESCE(up_departments.name, sp_departments.name, "—") as department_name'),
            'year_levels.name as year_level',
            'users.created_at'
        )
        ->orderByDesc('users.created_at')
        ->get();

        return view('dashboard.admin.system-logs', compact('logs'));
    }
}
