<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stream extends Model
{
    use HasFactory;

    protected $fillable =[
        'name'
    ];

    protected $hidden =[
        'school_id'
    ];

    // connections to other tables
    public function school()
    {
        return $this->belongsTo(School::class);
    }

    // forms
    public function forms()
    {
        return $this->belongsToMany(Form::class);
    }

    //users
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
