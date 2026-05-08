<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\SchoolClass;
use App\Models\SchoolYear;
use App\Models\Semester;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Program;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class GradeController extends Controller
{
    /**
     * Display archived transcript (kelas 10-12) for one student.
     */
    public function transcript(Student $student)
    {
        $data = $this->buildTranscriptData($student);

        return view('grades.transcript', $data);
    }

    public function transcriptPdf(Student $student)
    {
        $data = $this->buildTranscriptData($student);

        $pdf = Pdf::loadView('grades.transcript-pdf', $data)->setPaper('a4', 'portrait');

        return $pdf->download('rapor-' . $student->nis . '.pdf');
    }

    private function buildTranscriptData(Student $student): array
    {
        $grades = Grade::where('student_id', $student->id)
            ->with(['subject', 'teacher', 'schoolClass', 'schoolYear', 'semester'])
            ->orderBy('school_year_id')
            ->orderBy('semester_id')
            ->orderBy('subject_id')
            ->get();

        $classBuckets = [
            'Kelas 10' => collect(),
            'Kelas 11' => collect(),
            'Kelas 12' => collect(),
            'Kelas Lainnya' => collect(),
        ];

        foreach ($grades as $grade) {
            $className = $grade->schoolClass->name ?? '';

            if (preg_match('/\b10\b/', $className)) {
                $classBuckets['Kelas 10']->push($grade);
            } elseif (preg_match('/\b11\b/', $className)) {
                $classBuckets['Kelas 11']->push($grade);
            } elseif (preg_match('/\b12\b/', $className)) {
                $classBuckets['Kelas 12']->push($grade);
            } else {
                $classBuckets['Kelas Lainnya']->push($grade);
            }
        }

        $gradesByClass = collect($classBuckets)
            ->filter(function ($items) {
                return $items->isNotEmpty();
            })
            ->map(function ($items) {
                $periods = $items->groupBy(function ($grade) {
                    return $grade->schoolYear->year . ' - ' . $grade->semester->name;
                });

                return [
                    'periods' => $periods,
                    'summary' => [
                        'count' => $items->count(),
                        'avg' => $items->avg('nilai_akhir'),
                        'max' => $items->max('nilai_akhir'),
                        'min' => $items->min('nilai_akhir'),
                    ],
                ];
            });

        return [
            'student' => $student,
            'grades' => $grades,
            'gradesByClass' => $gradesByClass,
        ];
    }

    /**
     * Show form for bulk creating grades by student
     */
    public function bulkCreateByStudent(Student $student)
    {
        $subjects = Subject::orderBy('name')->get();
        $teachers = Teacher::orderBy('name')->get();
        $classes = SchoolClass::orderBy('name')->get();
        $years = SchoolYear::orderBy('year')->get();
        $semesters = Semester::orderBy('name')->get();

        return view('grades.bulk-create-by-student', compact(
            'student',
            'subjects',
            'teachers',
            'classes',
            'years',
            'semesters'
        ));
    }

    /**
     * Store bulk grades for a student
     */
    public function bulkStoreByStudent(Request $request, Student $student)
    {
        $validated = $request->validate([
            'class_id' => 'required|exists:classes,id',
            'school_year_id' => 'required|exists:school_years,id',
            'semester_id' => 'required|exists:semesters,id',
            'grades' => 'required|array',
            'grades.*.subject_id' => 'required|exists:subjects,id',
            'grades.*.teacher_id' => 'nullable|exists:teachers,id',
            'grades.*.nilai_tugas' => 'nullable|numeric|min:0|max:100',
            'grades.*.nilai_uts' => 'nullable|numeric|min:0|max:100',
            'grades.*.nilai_uas' => 'nullable|numeric|min:0|max:100',
        ]);

        $studentId = $student->id;
        $classId = $validated['class_id'];
        $yearId = $validated['school_year_id'];
        $semesterId = $validated['semester_id'];
        $createdCount = 0;

        foreach ($validated['grades'] as $gradeData) {
            // Skip if all values are empty
            if (!$gradeData['nilai_tugas'] && !$gradeData['nilai_uts'] && !$gradeData['nilai_uas']) {
                continue;
            }

            // Check for duplicates
            $duplicate = Grade::where('student_id', $studentId)
                ->where('subject_id', $gradeData['subject_id'])
                ->where('class_id', $classId)
                ->where('school_year_id', $yearId)
                ->where('semester_id', $semesterId)
                ->exists();

            if ($duplicate) {
                continue;
            }

            // Calculate final grade
            $tugas = (float)($gradeData['nilai_tugas'] ?? 0);
            $uts = (float)($gradeData['nilai_uts'] ?? 0);
            $uas = (float)($gradeData['nilai_uas'] ?? 0);
            $nilaiAkhir = round((($tugas * 30) + ($uts * 30) + ($uas * 40)) / 100, 2);

            Grade::create([
                'student_id' => $studentId,
                'subject_id' => $gradeData['subject_id'],
                'teacher_id' => $gradeData['teacher_id'] ?? null,
                'class_id' => $classId,
                'school_year_id' => $yearId,
                'semester_id' => $semesterId,
                'nilai_tugas' => $tugas ?? 0,
                'nilai_uts' => $uts ?? 0,
                'nilai_uas' => $uas ?? 0,
                'nilai_akhir' => $nilaiAkhir,
            ]);

            $createdCount++;
        }

        return redirect()->route('students.show', $student)
            ->with('success', "Nilai rapor berhasil disimpan! ($createdCount pelajaran ditambahkan)");
    }

    /**
     * Show form for creating individual grade by student
     */
    public function createByStudent(Student $student)
    {
        $subjects = Subject::orderBy('name')->get();
        $teachers = Teacher::orderBy('name')->get();
        $classes = SchoolClass::orderBy('name')->get();
        $years = SchoolYear::orderBy('year')->get();
        $semesters = Semester::orderBy('name')->get();

        return view('grades.create-by-student', compact(
            'student',
            'subjects',
            'teachers',
            'classes',
            'years',
            'semesters'
        ));
    }

    /**
     * Show form for bulk creating grades by program
     */
    public function bulkCreateByProgram(Program $program)
    {
        $students = Student::where('program_id', $program->id)->orderBy('name')->get();
        $subjects = Subject::orderBy('name')->get();
        $teachers = Teacher::orderBy('name')->get();
        $classes = SchoolClass::orderBy('name')->get();
        $years = SchoolYear::orderBy('year')->get();
        $semesters = Semester::orderBy('name')->get();

        return view('grades.bulk-create-by-program', compact(
            'program',
            'students',
            'subjects',
            'teachers',
            'classes',
            'years',
            'semesters'
        ));
    }

    /**
     * Store bulk grades for a student by program
     */
    public function bulkStoreByProgram(Request $request, Program $program)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'class_id' => 'required|exists:classes,id',
            'school_year_id' => 'required|exists:school_years,id',
            'semester_id' => 'required|exists:semesters,id',
            'grades' => 'required|array',
            'grades.*.subject_id' => 'required|exists:subjects,id',
            'grades.*.teacher_id' => 'nullable|exists:teachers,id',
            'grades.*.nilai_tugas' => 'nullable|numeric|min:0|max:100',
            'grades.*.nilai_uts' => 'nullable|numeric|min:0|max:100',
            'grades.*.nilai_uas' => 'nullable|numeric|min:0|max:100',
        ]);

        $studentId = $validated['student_id'];
        $classId = $validated['class_id'];
        $yearId = $validated['school_year_id'];
        $semesterId = $validated['semester_id'];
        $createdCount = 0;

        foreach ($validated['grades'] as $gradeData) {
            // Skip if all values are empty
            if (!$gradeData['nilai_tugas'] && !$gradeData['nilai_uts'] && !$gradeData['nilai_uas']) {
                continue;
            }

            // Check for duplicates
            $duplicate = Grade::where('student_id', $studentId)
                ->where('subject_id', $gradeData['subject_id'])
                ->where('class_id', $classId)
                ->where('school_year_id', $yearId)
                ->where('semester_id', $semesterId)
                ->exists();

            if ($duplicate) {
                continue;
            }

            // Calculate final grade
            $tugas = (float)($gradeData['nilai_tugas'] ?? 0);
            $uts = (float)($gradeData['nilai_uts'] ?? 0);
            $uas = (float)($gradeData['nilai_uas'] ?? 0);
            $nilaiAkhir = round((($tugas * 30) + ($uts * 30) + ($uas * 40)) / 100, 2);

            Grade::create([
                'student_id' => $studentId,
                'subject_id' => $gradeData['subject_id'],
                'teacher_id' => $gradeData['teacher_id'] ?? null,
                'class_id' => $classId,
                'school_year_id' => $yearId,
                'semester_id' => $semesterId,
                'nilai_tugas' => $tugas ?? 0,
                'nilai_uts' => $uts ?? 0,
                'nilai_uas' => $uas ?? 0,
                'nilai_akhir' => $nilaiAkhir,
            ]);

            $createdCount++;
        }

        return redirect()->route('programs.show', $program)
            ->with('success', "Nilai rapor berhasil disimpan! ($createdCount pelajaran ditambahkan)");
    }

    /**
     * Show form for creating individual grade by program
     */
    public function createByProgram(Program $program)
    {
        $students = Student::where('program_id', $program->id)->orderBy('name')->get();
        $subjects = Subject::orderBy('name')->get();
        $teachers = Teacher::orderBy('name')->get();
        $classes = SchoolClass::orderBy('name')->get();
        $years = SchoolYear::orderBy('year')->get();
        $semesters = Semester::orderBy('name')->get();

        return view('grades.create-by-program', compact(
            'program',
            'students',
            'subjects',
            'teachers',
            'classes',
            'years',
            'semesters'
        ));
    }
}