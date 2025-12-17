<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClearanceType extends Model
{
    use HasFactory;

    // 🔒 SAFE CONSTANTS
    const FINANCIAL    = 1;
    const DEPARTMENTAL = 2;
    const RELEASE      = 3;
    const MARCHING     = 4;

    protected $fillable = [
        'name',
        'description',
    ];

    public function clearances()
    {
        return $this->hasMany(Clearance::class);
    }
}
