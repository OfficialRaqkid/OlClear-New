<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Student extends Authenticatable
{
    use Notifiable;

    protected $table = 'students'; // ⚠️ Only if you have a students table — if not, use 'users'

    protected $fillable = [
        'name',
        'username', // student ID or email
        'password',
        'user_role',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
        'email_verified_at' => 'datetime',
    ];

    // ✅ Only this version of the relationship is needed
    public function profile()
    {
        return $this->hasOne(StudentProfile::class, 'student_id');
    }
}
