<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class StudentProfile extends Model
{
    use Notifiable;

    protected $table = 'student_profiles';

    protected $fillable = [
        'user_id',
        'first_name',
        'middle_name',
        'last_name',
        'suffix',
        'contact_number',
        'address',
        'program_id',
        'year_level_id',
        'profile_photo',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function yearLevel()
    {
        return $this->belongsTo(YearLevel::class);
    }

    // ✅ Corrected relationship (use student_id instead of user_id)
    public function clearanceRequests()
    {
        return $this->hasMany(ClearanceRequest::class, 'student_id');
    }
}
