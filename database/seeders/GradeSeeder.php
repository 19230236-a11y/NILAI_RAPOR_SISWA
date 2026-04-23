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
        $teachers = Teacher::all()->keyBy('subject_id');

        $classByLevel = [
            10 => SchoolClass::where('name', 'like', 'Kelas 10%')->first(),
            11 => SchoolClass::where('name', 'like', 'Kelas 11%')->first(),
            12 => SchoolClass::where('name', 'like', 'Kelas 12%')->first(),
        ];

        $yearByLevel = [
            10 => SchoolYear::where('year', '2023/2024')->first(),
            11 => SchoolYear::where('year', '2024/2025')->first(),
            12 => SchoolYear::where('year', '2025/2026')->first(),
        ];

        $semesters = Semester::orderBy('id')->get();

        if ($students->isEmpty() || $subjects->isEmpty() || $semesters->isEmpty()) {
            return;
        }

        foreach ($students as $studentIndex => $student) {
            foreach ([10, 11, 12] as $level) {
                $class = $classByLevel[$level];
                $year = $yearByLevel[$level];

                if (!$class || !$year) {
                    continue;
                }

                foreach ($semesters as $semesterIndex => $semester) {
                    foreach ($subjects as $subjectIndex => $subject) {
                        $base = 72 + ($studentIndex * 2) + ($level - 10) + $semesterIndex;
                        $nilaiTugas = min(98, $base + ($subjectIndex % 4));
                        $nilaiUts = min(98, $base + 2 + ($subjectIndex % 5));
                        $nilaiUas = min(99, $base + 3 + ($subjectIndex % 3));

                        Grade::create([
                            'student_id' => $student->id,
                            'subject_id' => $subject->id,
                            'teacher_id' => optional($teachers->get($subject->id))->id ?? Teacher::inRandomOrder()->value('id'),
                            'class_id' => $class->id,
                            'school_year_id' => $year->id,
                            'semester_id' => $semester->id,
                            'nilai_tugas' => $nilaiTugas,
                            'nilai_uts' => $nilaiUts,
                            'nilai_uas' => $nilaiUas,
                        ]);
                    }
                }
            }
        }
    }
}
