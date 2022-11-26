<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Exam extends Model
{
    use HasFactory ,LogsActivity;
    protected static $logAttributes = [
        'exam_name',
        'term_id',
        'start_date',
        'end_date',
        'school_id'
    ];
    protected static $logOnlyDirty = true;
    
    protected $fillable=[];
    protected $hidden = [];

    //protected $with('term');
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
        return $this->belongsToMany(Form::class);
    }

    /**
     * exam user relationships
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * results
     */
    public function examresults()
    {
        return $this->hasMany(Examresult::class);
    }
}
