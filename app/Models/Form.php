<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Form extends Model
{
    use HasFactory ,LogsActivity;
    protected static $logAttributes = ['form_code', 'form_name','school_id'];
    protected static $logOnlyDirty = true;

    protected $fillable =[
        'form_id',
        'form_code',
    ];

    protected $hidden =[
        'school_id'
    ];


    // relationship with subject
    // public function subjects()
    // {
    //     return $this->hasManyThrough(Subject::class,Level::class);
    // }


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
        return $this->hasMany(Assignment::class);
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
        return $this->hasMany(Conference::class);
    }

    /**
     * results
     */
    public function examresults()
    {
        return $this->hasMany(Examresult::class);
    }

    /**
     * get form level
     */
    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function streams()
    {
        return $this->belongsToMany(Stream::class);
    }

    // topics
    public function topics()
    {
        return $this->hasMany(Topic::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class)
                     ->withPivot(['year','stream_id'])
                     ->withTimeStamps();

    }
}