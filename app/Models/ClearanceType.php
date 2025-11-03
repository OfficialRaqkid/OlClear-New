<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClearanceType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public function clearances()
    {
        return $this->hasMany(Clearance::class);
    }
}
