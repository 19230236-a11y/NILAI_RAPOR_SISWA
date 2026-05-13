<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $fillable = [
        'student_id',
        'subject_id',
        'teacher_id',
        'class_id',
        'school_year_id',
        'semester_id',
        'nilai',
        'jurusan_subject_1', 'jurusan_subject_2', 'jurusan_subject_3',
        'jurusan_subject_4', 'jurusan_subject_5', 'jurusan_subject_6',
        'jurusan_nilai_1', 'jurusan_nilai_2', 'jurusan_nilai_3',
        'jurusan_nilai_4', 'jurusan_nilai_5', 'jurusan_nilai_6',
    ];

    protected $casts = [
        'nilai' => 'decimal:2',
        'jurusan_nilai_1' => 'decimal:2',
        'jurusan_nilai_2' => 'decimal:2',
        'jurusan_nilai_3' => 'decimal:2',
        'jurusan_nilai_4' => 'decimal:2',
        'jurusan_nilai_5' => 'decimal:2',
        'jurusan_nilai_6' => 'decimal:2',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }

    public function schoolYear()
    {
        return $this->belongsTo(SchoolYear::class);
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function getPredikatAttribute()
    {
        $nilai = $this->nilai;
        if ($nilai >= 85) return 'A';
        if ($nilai >= 75) return 'B';
        if ($nilai >= 65) return 'C';
        if ($nilai >= 55) return 'D';
        return 'E';
    }
}
