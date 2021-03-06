<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class SubmissionComment extends Model
{
    use HasFactory ,LogsActivity;
    protected static $logAttributes = [
        'comment',
        'assignment_submission_id'
    ];
    protected static $logOnlyDirty = true;

    protected $fillable=[

    ];
    protected $hidden =[

    ];

    /**
     * relationship
     */
    public function assignment_submission()
    {
        return $this->belongsTo(AssignmentSubmission::class);
    }

    /**
     * user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
