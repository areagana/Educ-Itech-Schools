<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dashcard extends Model
{
    use HasFactory;

    protected $fillable =[
        'user_id','form_id','stream_id','term_id','subject_id'
    ];

    // relationships
    public function teachers()
    {
        return $this->belongsToMany(User::class)
                    ->where('role','teacher')
                    ->orderBy('firstname', 'asc');
    }

    //students
    public function students()
    {
        return $this->belongsToMany(User::class)
                    ->where('role','student')
                    ->where('form',$this->form())
                    ->orderBy('firstname', 'asc');
    }

    // forms
    public function form()
    {
        return $this->belongsTo(Form::class);
    }

    //stream connection
    public function stream()
    {
        return $this->belongsTo(Stream::class);
    }

    //term connection
    public function term()
    {
        return $this->belongsTo(Term::class);
    }

    //creater
    public function user()
    {
        return $this->belongsTo(User::class.'created_by');
    }

    //subject
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
