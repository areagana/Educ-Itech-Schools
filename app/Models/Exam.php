<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;
    protected $fillable=[];
    protected $hidden = [];

    /**
     * public function
     */
    public function term()
    {
        return $this->belongsTo(Term::class);
    }

    /**
     * an exams is attached to classes
     */
    public function forms()
    {
        return $this->hasMany(Form::class);
    }

    /**
     * exam user relationships
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
