<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;

    protected $fillable =[
        'name'
    ];

    // functions
    public function school()
    {
        return $this->belongsTo(School::class);
    }

    //subjects
    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }

    // forms
    public function forms()
    {
        return $this->hasMany(Form::class);
    }

    // grading 
    public function gradings()
    {
        return $this->hasMany(Grading::class);
    }
}
