<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'abbreviation',
    ];

    /**
     * A department has many programs.
     */
    public function programs()
    {
        return $this->hasMany(Program::class);
    }
}


