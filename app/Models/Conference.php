<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Conference extends Model
{
    use HasFactory ,LogsActivity;
    protected static $logAttributes = [
        'conference_name',
        'conference_duration',
        'conference_link',
        'conference_start_date',
        'conference_end_date',
        'status',
        'subject_id'
    ];
    protected static $logOnlyDirty = true;

    protected $fillable =[
        'conference_name',
        'conference_duration',
        'conference_link',
        'conference_start_date',
        'conference_end_date',
        'status'
    ];

    protected $hidden =[
        'subject_id'
    ];

    // relationship with subject
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    /**
     * define user conference relationship
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
