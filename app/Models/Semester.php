<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    protected $fillable = [
        'name',
    ];

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }
}
