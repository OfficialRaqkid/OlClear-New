<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'username',
        'password',
        'role_id',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // ✅ Relationship for user profile (e.g., admin/faculty)
    public function profile()
    {
        return $this->hasOne(\App\Models\UserProfile::class);
    }

    // ✅ Relationship for student profile (used in clearance system)
    public function studentProfile()
    {
        return $this->hasOne(\App\Models\StudentProfile::class, 'user_id');
    }
}
