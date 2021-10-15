<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable =[
        'assignment_name',
        'assignment_content',
        'assignment_attachment',
        'assignment_status',
        'start_date',
        'end_date',
        'close_date'
    ];

    protected $hidden =[
        'subject_id'
    ];

    // relationship with subject
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}