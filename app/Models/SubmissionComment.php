<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubmissionComment extends Model
{
    use HasFactory;

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
}
