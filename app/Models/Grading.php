<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grading extends Model
{
    use HasFactory;

//Relationships
    public function school()
    {
        return $this->belongsTo(School::class);
    }

    // level
    public function level()
    {
        return $this->belongsTo(Level::class);
    }
}
