<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Note extends Model
{
    use HasFactory ,LogsActivity;
    protected static $logAttributes = [
        'subject_id',
        'module_id',
        'note_title'
    ];
    protected static $logOnlyDirty = true;
    
    protected $fillable=[];
    protected $hidden =[];

    /**
     * relationships
     */
    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    /**
     * subject
     */
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
