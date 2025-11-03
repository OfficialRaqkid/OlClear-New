<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EnrolledStudent extends Model
{
    use HasFactory;

    protected $table = 'enrolled_students';

    protected $fillable = [
        'student_id',
        'full_name',
    ];
}
