<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable =[
        'course_name',
        'course_code',
    ];

    protected $hidden =[
        'school_id'
    ];


    // school relationship
    public function school()
    {
        return $this->belongsTo(School::class);
    }

    // course has many subjects
    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }

    /**
     * assignment submissions
     */
    public function assignment_submissions()
    {
        return $this->hasMany(AssignmentSubmission::class);
    }

    // schemes

    public function schemes()
    {
        return $this->hasManyThrough(Scheme::class,Subject::class);
    }
}
