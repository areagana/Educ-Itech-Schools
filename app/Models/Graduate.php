<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Graduate extends Model
{
    use HasFactory;
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
