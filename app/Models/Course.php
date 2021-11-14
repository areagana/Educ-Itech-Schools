<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Course extends Model
{
    use HasFactory ,LogsActivity;
    protected static $logAttributes = [
        'course_name',
        'course_code',
        'school_id'
    ];
    protected static $logOnlyDirty = true;

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
