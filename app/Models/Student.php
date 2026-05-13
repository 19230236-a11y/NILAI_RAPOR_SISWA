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
        'birth_place',
        'address',
        'phone',
        'parent_name',
        'program_id',
        'class_id',
        'graduation_year',
    ];

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }

    /**
     * Get class display name without level (program + code only)
     * Example: "Teknik Kendaraan Ringan 1" (without the "X" level)
     */
    public function getClassDisplayName()
    {
        if (!$this->schoolClass) {
            return '-';
        }

        $program = $this->schoolClass->program;
        $classCode = $this->schoolClass->class_code;
        
        if (!$program || !$classCode) {
            return $this->schoolClass->name;
        }

        return $program->name . ' ' . $classCode;
    }
}
