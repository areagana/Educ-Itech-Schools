<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coursework extends Model
{
    use HasFactory;

    protected $fillable =[
        'student_id','subject_id','topic_id','term_id','marks','school_id','created_by'
    ];

    // realtionships
    public function topics()
    {
        return $this->belongsTo(Topic::class);
    }

    //users
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //subject
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    //term 
    public function term()
    {
        return $this->belongsTo(Term::class);
    }

    // school
    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
