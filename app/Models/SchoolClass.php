<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolClass extends Model
{
    protected $table = 'classes';

    protected $fillable = [
        'name',
        'program_id',
    ];

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}
