<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable =[
        'announcement_title',
        'announcement_category',
        'announcement_attachment',
        'start_date',
        'start_time',
        'end_date',
        'close_time'
    ];

    protected $hidden =[
        'school_id'
    ];


    // school relationship
    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
