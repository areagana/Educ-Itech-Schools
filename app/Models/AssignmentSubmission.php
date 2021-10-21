<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignmentSubmission extends Model
{
    use HasFactory;

    protected $fillable=[

    ];

    protected $hidden =[

    ];

    /**
     * relationships
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Assignments. An assignment has many but the many belongs to one assignment
     */
    public function Assignment()
    {
        return $this->belongsTo(Assignment::class);
    }

    /**
     * get the subject
     */
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    /**
     * check the class submitting
     */
    public function form()
    {
        return $this->belongsTo(Form::class);
    }

    /**
     * has many comments
     */
    public function submission_comments()
    {
        return $this->hasMany(SubmissionComment::class);
    }
}
