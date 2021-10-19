<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    
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

}
