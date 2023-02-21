<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Academicyear extends Model
{
    use HasFactory;

    // relationships
    public function school()
    {
        return $this->belongsTo(School::class);
    }

    //terms
    public function terms()
    {
        return $this->hasMany(Term::class);
    }

    // exams
    public function exams()
    {
        return $this->hasManyThrough(Exam::class,Term::class);
    }
}
