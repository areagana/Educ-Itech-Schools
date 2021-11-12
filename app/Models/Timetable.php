<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timetable extends Model
{
    use HasFactory;

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
