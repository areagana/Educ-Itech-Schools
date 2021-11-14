<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Timetable extends Model
{
    use HasFactory ,LogsActivity;
    protected static $logAttributes = [
        'school_id',
        'term_id',
        'title'
    ];
    protected static $logOnlyDirty = true;

    /**
     * relationships
     */
    public function form()
    {
        return $this->belongsTo(Form::class);
    }

    /**
     * school relationship
     */
    public function school()
    {
        return $this->belongsTo(School::class);
    }

    /**
     * term relationship
     */
    public function term()
    {
        return $this->belongsTo(Term::class);
    }
}
