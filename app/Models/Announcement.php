<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Announcement extends Model
{
    use HasFactory ,LogsActivity;
    protected static $logAttributes = [
        'announcement_title',
        'announcement_category',
        'announcement_attachment',
        'start_date',
        'start_time',
        'end_date',
        'close_time',
        'school_id'
    ];
    protected static $logOnlyDirty = true;

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
