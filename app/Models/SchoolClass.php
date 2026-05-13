<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolClass extends Model
{
    protected $table = 'classes';

    protected $fillable = [
        'name',
        'program_id',
        'level',
        'class_code',
    ];

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    /**
     * Get display name without level (program + code only)
     * Example: "Teknik Kendaraan Ringan 1" (without the "X" level)
     */
    public function getDisplayNameWithoutLevelAttribute()
    {
        if (!$this->program || !$this->class_code) {
            return $this->name;
        }
        return $this->program->name . ' ' . $this->class_code;
    }
}
