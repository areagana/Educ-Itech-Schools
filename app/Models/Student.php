<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable =[
        'firstname','middlename','lastname','email','bar_code','contact','email','nationality',
        'school_id','nin','lin','gender','year','form_id','stream_id','payment_code','address',
        'parent_id','stream_id','user_id'
    ];

    protected $with = ['form','stream'];
    

    // relationship
    public function school()
    {
        return $this->belongsTo(School::class);
    }

    //form
    public function form()
    {
        return $this->belongsTo(Form::class);
    }

    /**
     * user forms
     */
    public function forms()
    {
        return $this->belongsToMany(Form::class)
                    ->withPivot(['year','stream_id'])
                    ->withTimeStamps();
    }

    /**
     * student stream
     */
    public function stream()
    {
        return $this->belongsTo(Stream::class);
    }

    //subjects
    public function subjects()
    {
        return $this->belongsToMany(Subject::class)
                    ->withPivot('form_id','stream_id','term_id','enrolment_date','user_id')
                    ->withTimeStamps();
    }

    // courseworks
    public function courseworks()
    {
        return $this->hasMany(Coursework::class);
    }

    // exam results
    public function examresults()
    {
        return $this->hasMany(Examresult::class);
    }

    /**
     * assignment submissions
     */
    public function assignment_submissions()
    {
        return $this->hasMany(AssignmentSubmission::class);
    }

    /**
     * submission comments
     */
    public function submission_comments()
    {
        return $this->hasMany(SubmissionComment::class);
    }

    /**
     * sudent parent
     */
    public function parent()
    {
        return $this->belongsTo(User::class);
    }

}
