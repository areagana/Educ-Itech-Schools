<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paper extends Model
{
    use HasFactory;

    protected $fillable =[
        'subject_id',
        'name',
        'code'
    ];

    // relationships
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    // school
    public function school()
    {
        return $this->belongsTo(School::class);
    }

    //exam results 
    public function examresults()
    {
        return $this->hasMany(Examresult::class);
    }
}
