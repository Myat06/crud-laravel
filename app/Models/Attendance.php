<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'enrollment_id',
        'date',
        'status',
        'remarks'
    ];

    protected $casts = [
        'date' => 'date'
    ];

    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class);
    }

    public function student()
    {
        return $this->hasOneThrough(Student::class, Enrollment::class);
    }

    public function batch()
    {
        return $this->hasOneThrough(Batch::class, Enrollment::class);
    }
}
