<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    use HasFactory;

    
    protected $fillable =[
        'notice_title',
        'notice_content',
        'notice_attachment',
        'start_date',
        'start_time',
        'close_date',
        'close_time'
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
