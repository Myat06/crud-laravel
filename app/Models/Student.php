<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'date_of_birth',
        'profile_picture',
        'course_id',
    ];

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    use HasFactory;
}