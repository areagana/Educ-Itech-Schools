<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    protected $fillable =[
        'name','subject_id','term_id'
    ];

    // connections to other models
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    // form 
    public function form()
    {
        return $this->belongsTo(Form::class);
    }

    //term connection
    public function term()
    {
        return $this->belongsTo(Term::class);
    }

    // records
    public function records()
    {
        return $this->hasMany(Coursework::class);
    }
}
