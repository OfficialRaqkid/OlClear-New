<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClearanceRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'clearance_id',
        'status',
        'current_office',
        'notes',
    ];

    public function student()
    {
        return $this->belongsTo(StudentProfile::class, 'student_id');
    }

    public function clearance()
    {
        return $this->belongsTo(Clearance::class, 'clearance_id');
    }
}
