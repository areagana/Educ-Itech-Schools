<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;

    protected $fillable =[
        'form_id',
        'form_code',
    ];

    protected $hidden =[
        'school_id'
    ];

    // relationship with subject
    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }


    // school relationship
    public function school()
    {
        return $this->belongsTo(School::class);
    }

    // users relationship
    public function users()
    {
        return $this->belongsToMany(User::class)
                    ->withTimeStamps();
    }

    /**
     * assignment submissions
     */
    public function assignment_submissions()
    {
        return $this->hasMany(AssignmentSubmission::class);
    }

    /**
     * timetables
     */
    public function timetables()
    {
        return $this->hasMany(TimeTable::class);
    }
}
