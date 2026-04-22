<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'nis',
        'name',
        'gender',
        'birth_date',
        'address',
    ];

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }
}
