<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolClass extends Model
{
    protected $table = 'classes';

    protected $fillable = [
        'name',
    ];

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }
}
