<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    use HasFactory;
    
    protected $fillable =[
        'term_name','term_start_date','term_end_date'
    ];

    protected $hidden =[
        'user_id','school_id'
    ];

    // relationship with the school
    public function school()
    {
        return $this->belongsTo(School::class);
    }

    // check subjects for the term under the school
    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }
}
