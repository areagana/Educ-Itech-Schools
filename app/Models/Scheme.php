<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Scheme extends Model
{
    use HasFactory ,LogsActivity;
    protected static $logAttributes = [
        'form_id',
        'school_id',
        'term_id',
        'subject_id',
        'scheme_title'
    ];
    protected static $logOnlyDirty = true;

    protected $fillable =[];
    protected $hidden =[];

    /**
     * relationship
     */

     // school
    public function school()
    {
        return $this->belongsTo(School::class);
    }

    //// school
    public function Subject()
    {
        return $this->belongsTo(Subject::class);
    }

    //course
    // school
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * term
     */
    // school
    public function term()
    {
        return $this->belongsTo(Term::class);
    }

    /**
     * form
     */
    // school
    public function form()
    {
        return $this->belongsTo(Form::class);
    }

}

