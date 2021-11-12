<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    protected $fillable =[
        'school_code',
        'reg_no',
        'address',
        'email',
        'main_contact',
        'school_website_link',
        'school_logo'
    ];

    protected $hidden =['user_id'];

    //relationship with users
    public function users()
    {
        return $this->hasMany(User::class);
    }

    //relationship with terms
    public function terms()
    {
        return $this->hasMany(Term::class);
    }

    //announcement relationship
    public function announcements()
    {
        return $this->hasMany(Announcement::class);
    }

    //forms relationship
    public function forms()
    {
        return $this->hasMany(Form::class);
    }

    //courses
    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    //school subjects 
    public function subjects()
    {
        return $this->hasManyThrough(Subject::class,Course::class);
    }

    /**
     * connect school to its graduates
     */
    public function graduates()
    {
        return $this->hasMany(Graduate::class);
    }

    /**
     * timetable relationship
     */
    public function timetables()
    {
        return $this->hasMany(TimeTable::class);
    }
}
