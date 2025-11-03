<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clearance extends Model
{
    use HasFactory;

    protected $fillable = [
        'clearance_type_id',
        'title',
        'description',
        'offices',
        'is_published',
        'is_active',
    ];

    protected $casts = [
        'offices' => 'array',
        'is_published' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function clearanceType()
    {
        return $this->belongsTo(ClearanceType::class);
    }

    public function requests()
    {
        return $this->hasMany(ClearanceRequest::class, 'clearance_id');
    }
}
