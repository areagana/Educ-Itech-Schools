<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Subject extends Model
{
    use HasFactory ,LogsActivity;
    protected static $logAttributes = [
        'subject_name',
        'subject_code',
        'form_id',
        'term_id',
        'course_code'
    ];
    protected static $logOnlyDirty = true;

    protected $fillable =[
        'subject_name','subject_code'
    ];

    protected $hidden =[
        'form_id','term_id'
    ];

    // attachment to the class
    public function form()
    {
        return $this->belongsTo(Form::class);
    }

    //relationship with users
    public function users()
    {
        return $this->belongsToMany(User::class)
                    ->withTimeStamps();
    }

    // subject announcements
    public function notices()
    {
        return $this->hasMany(Notice::class);
    }

    //assignment relationship
    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

    //corse relationship
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    //corse relationship
    public function school()
    {
        return $this->belongsTo(School::class);
    }

    /**
     * get subject term
     */
    public function term()
    {
        return $this->belongsTo(Term::class);
    }

    /**
     * assignment submissions
     */
    public function assignment_submissions()
    {
        return $this->hasManyThrough(AssignmentSubmission::class,Assignment::class);
    }

    /**
     * a subject has many modules
     */
    public function modules()
    {
        return $this->hasMany(Module::class);
    }

    /**
     * define subject conference relationship
     */
    public function conferences()
    {
        return $this->hasMany(Conference::class);
    }

    // schemes

    public function schemes()
    {
        return $this->hasMany(Scheme::class);
    }

    /**
     * results
     */
    public function examresults()
    {
        return $this->hasMany(Examresult::class);
    }
}
