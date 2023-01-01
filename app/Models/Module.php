<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Module extends Model
{
    use HasFactory ,LogsActivity;
    protected static $logAttributes = [
        'modeule_name',
        'module_status',
        'subject_id'
    ];
    protected static $logOnlyDirty = true;

   
    protected $fillable =[
        'module_name','module_status'
    ];

    protected $hidden =[
        'subject_id'
    ];

    //subject relationship
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    /**
     * notes
     */
    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    // card
    public function dashcard()
    {
        return $this->belongsTo(Dashcard::class);
    }
}
