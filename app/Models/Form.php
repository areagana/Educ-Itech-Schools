<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Form extends Model
{
    use HasFactory ,LogsActivity;

    protected $fillable =[
        'form_id',
        'form_code',
    ];

    protected $hidden =[
        'school_id'
    ];

    protected static $logAttributes = ['form_id', 'form_code', 'form_name','school_id'];
    protected static $logOnlyDirty = true;

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
     * timetables
     */
    public function timetables()
    {
        return $this->hasMany(TimeTable::class);
    }

    /**
     * assignments
     */
    public function assignments()
    {
        return $this->hasManyThrough(Assignment::class,Subject::class);
    }

    /**
     * schemes
     */
    public function schemes()
    {
        return $this->hasMany(Scheme::class);
    }

    /**
     * exams
     */
    public function exams()
    {
        return $this->belongsToMany(Exam::class);
    }

    /**
     * schemes
     */
    public function conferences()
    {
        return $this->hasManyThrough(Conference::class,Subject::class);
    }

}
