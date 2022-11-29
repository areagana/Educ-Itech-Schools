<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examresult extends Model
{
    use HasFactory;
    protected $fillable =['student_id','exam_id','form_id','school_id','term_id','user_id','subject_id','subjectpaper_id','marks','comment','effor','teacher_id'];
    protected $hidden =[];

    /**
     * relationships
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * teacher
     */
    public function teacher()
    {
        return $this->belongsTo(User::class,'teacher_id');
    }

    /**
     * exam
     */
    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    /**
     * term
     */
    public function term()
    {
        return $this->belongsTo(Term::class);
    }

    /**
     * subject
     */
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    /**
     * subject paper
     */
    public function subjectpaper() // not yet created/ added
    {
        return;
    }
}
