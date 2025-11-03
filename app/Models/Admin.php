<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $table = 'users'; // correct — don't change this

    protected $fillable = ['name', 'username', 'password', 'role_id'];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'password' => 'hashed', // or use bcrypt manually when inserting
        'email_verified_at' => 'datetime',
    ];
}

