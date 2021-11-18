<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Category extends Model
{
    use HasFactory ,LogsActivity;

    protected $fillable =[];
    protected $hidden =[];

    protected static $logAttributes = [
        'category_name',
        'category_level'
    ];
    protected static $logOnlyDirty = true;
    /**
     * relationship
     */
    public function schools()
    {
        return $this->hasMany(School::class);
    }

    /**
     * reports
     */

}
