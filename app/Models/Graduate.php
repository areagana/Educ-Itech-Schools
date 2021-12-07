<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Graduate extends Model
{
    use HasFactory ,LogsActivity;
    protected static $logAttributes = [];
    protected static $logOnlyDirty = true;

    
    protected $fillable=[];
    protected $hidden =[];

    /**
     * use relationships with the school
     */
    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
