<?php

namespace Database\Seeders;

use App\Models\Grade;
use App\Models\SchoolClass;
use App\Models\SchoolYear;
use App\Models\Semester;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Database\Seeder;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = Student::take(5)->get();
        $subjects = Subject::all();

        // Get first class code for each level (code 1)
        $classByLevel = [
            'X' => SchoolClass::where('level', 'X')->where('class_code', 1)->first(),
            'XI' => SchoolClass::where('level', 'XI')->where('class_code', 1)->first(),
            'XII' => SchoolClass::where('level', 'XII')->where('class_code', 1)->first(),
        ];

        $yearByLevel = [
            'X' => SchoolYear::where('year', '2023/2024')->first(),
            'XI' => SchoolYear::where('year', '2024/2025')->first(),
            'XII' => SchoolYear::where('year', '2025/2026')->first(),
        ];

        $semesters = Semester::orderBy('id')->get();
        $teachers = Teacher::all();

        if ($students->isEmpty() || $subjects->isEmpty() || $semesters->isEmpty() || $teachers->isEmpty()) {
            return;
        }

        foreach ($students as $studentIndex => $student) {
            foreach (['X', 'XI', 'XII'] as $level) {
                $class = $classByLevel[$level];
                $year = $yearByLevel[$level];

                if (!$class || !$year) {
                    continue;
                }

                foreach ($semesters as $semesterIndex => $semester) {
                    foreach ($subjects as $subjectIndex => $subject) {
                        $levelNum = $level === 'X' ? 10 : ($level === 'XI' ? 11 : 12);
                        $base = 72 + ($studentIndex * 2) + ($levelNum - 10) + $semesterIndex;
                        $nilai = min(98, $base + ($subjectIndex % 4));
                        $teacher = $teachers->random();

                        Grade::updateOrCreate(
                            [
                                'student_id' => $student->id,
                                'subject_id' => $subject->id,
                                'class_id' => $class->id,
                                'school_year_id' => $year->id,
                                'semester_id' => $semester->id,
                            ],
                            [
                                'teacher_id' => $teacher->id,
                                'nilai' => $nilai,
                            ]
                        );
                    }
                }
            }
        }
    }
}
