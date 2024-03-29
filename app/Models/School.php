<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class School extends Model
{
    use HasFactory ,LogsActivity;
    protected static $logAttributes = [
        'school_code',
        'reg_no',
        'address',
        'email',
        'emis_no',
        'main_contact',
        'school_website_link',
        'school_logo',
        'water_mark'
    ];
    protected static $logOnlyDirty = true;

    protected $fillable =[
        'school_id',
        'reg_no',
        'address',
        'email',
        'emis_no',
        'main_contact',
        'school_website_link',
        'school_logo',
        'water_mark'
    ];

    protected $hidden =['user_id'];
    protected $with=['academicyears'                                                                                                                                                                                                                                                                                                                    ];

    /**
     * school category
     */

     public function category()
     {
         return $this->belongsTo(Category::class);
     }
     
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

    //forms relationship
    public function streams()
    {
        return $this->hasMany(Stream::class);
    }

    //courses
    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    //school subjects 
    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }

    /**
     * connect school to its graduates
     */
    public function graduates()
    {
        return $this->hasMany(Graduate::class);
    }

    /**
     * connect school to its graduates
     */
    public function archives()
    {
        return $this->hasMany(Archive::class);
    }

    /**
     * timetable relationship
     */
    public function timetables()
    {
        return $this->hasMany(TimeTable::class);
    }

    //schemes
    public function schemes()
    {
        return $this->hasMany(Scheme::class);
    }

    /**
     * school exams relationship
     */
    public function exams()
    {
        return $this->hasManyThrough(Exam::class,Term::class);
    }

    /**
     * results
     */
    public function examresults()
    {
        return $this->hasMany(Examresult::class);
    }

    /**
     * school user roles as levels
     */
    public function userlevels()
    {
        return $this->hasManyThrough(Role::class,User::class);
    }

    /**
     * school user roles as levels
     */
    public function levels()
    {
        return $this->hasMany(Level::class);
    }

    // students
    public function students()
    {
        return $this->hasMany(Student::class);
    }

    // grading 
    public function gradings()
    {
        return $this->hasManyThrough(Grading::class,Level::class);
    }

    // papers
    public function papers()
    {
        return $this->hasManyThrough(Paper::class,Subject::class);
    }

    // academic years
    public function academicyears()
    {
        return $this->hasMany(Academicyear::class);
    }

    // //academic year
    // public function academicyear()
    // {
    //     $acyear = $this->academicyears()->where('start_date','<=',date('Y-m-d'))
    //                                     ->where('end_date','>=',date('Y-m-d'))
    //                                     ->first()
    //                                     ->get();
    //     return $acyear;
    // }
}
