<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Archive extends Model
{
    use HasFactory ,LogsActivity;
    protected static $logAttributes = [];
    protected static $logOnlyDirty = true;


    protected $fillable=[
        'user_id','school_id',
        'firstname','lastname',
        'middlename','form_id',
        'created_by','email','academic_year','admin_no'
    ];
        protected $hidden =[];

    /**
     * use relationships with the school
     */
    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
