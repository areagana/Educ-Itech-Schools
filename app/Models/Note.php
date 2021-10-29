<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;
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
