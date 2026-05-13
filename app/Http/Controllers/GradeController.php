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
                        'avg' => $items->avg('nilai'),
                        'max' => $items->max('nilai'),
                        'min' => $items->min('nilai'),
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
        $student->load('schoolClass');
        
        $subjects = Subject::orderBy('name')->get();
        $teachers = Teacher::orderBy('name')->get();
        // Filter classes by student's program only
        $classes = SchoolClass::where('program_id', $student->program_id)
            ->orderBy('name')
            ->get();
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
            'grades.*.nilai' => 'nullable|numeric|min:0|max:100',
            'jurusan_subject_1' => 'nullable|string|max:255',
            'jurusan_subject_2' => 'nullable|string|max:255',
            'jurusan_subject_3' => 'nullable|string|max:255',
            'jurusan_subject_4' => 'nullable|string|max:255',
            'jurusan_subject_5' => 'nullable|string|max:255',
            'jurusan_subject_6' => 'nullable|string|max:255',
            'jurusan_nilai_1' => 'nullable|numeric|min:0|max:100',
            'jurusan_nilai_2' => 'nullable|numeric|min:0|max:100',
            'jurusan_nilai_3' => 'nullable|numeric|min:0|max:100',
            'jurusan_nilai_4' => 'nullable|numeric|min:0|max:100',
            'jurusan_nilai_5' => 'nullable|numeric|min:0|max:100',
            'jurusan_nilai_6' => 'nullable|numeric|min:0|max:100',
        ]);

        $studentId = $student->id;
        $classId = $validated['class_id'];
        $yearId = $validated['school_year_id'];
        $semesterId = $validated['semester_id'];
        $createdCount = 0;

        foreach ($validated['grades'] as $gradeData) {
            // Skip if nilai is empty
            if (!isset($gradeData['nilai']) || $gradeData['nilai'] === '') {
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

            // Build data for creation
            $createData = [
                'student_id' => $studentId,
                'subject_id' => $gradeData['subject_id'],
                'class_id' => $classId,
                'school_year_id' => $yearId,
                'semester_id' => $semesterId,
                'nilai' => (float)$gradeData['nilai'],
            ];

            // Add jurusan subjects and values (only for first record per semester)
            if ($createdCount === 0) {
                for ($i = 1; $i <= 6; $i++) {
                    $createData['jurusan_subject_' . $i] = $validated['jurusan_subject_' . $i] ?? null;
                    $createData['jurusan_nilai_' . $i] = isset($validated['jurusan_nilai_' . $i]) && $validated['jurusan_nilai_' . $i] !== '' 
                        ? (float)$validated['jurusan_nilai_' . $i] 
                        : null;
                }
            }

            Grade::create($createData);

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
        $student->load('schoolClass');
        
        $subjects = Subject::orderBy('name')->get();
        $teachers = Teacher::orderBy('name')->get();
        // Filter classes by student's program only
        $classes = SchoolClass::where('program_id', $student->program_id)
            ->orderBy('name')
            ->get();
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
            'grades.*.nilai' => 'nullable|numeric|min:0|max:100',
        ]);

        $studentId = $validated['student_id'];
        $classId = $validated['class_id'];
        $yearId = $validated['school_year_id'];
        $semesterId = $validated['semester_id'];
        $createdCount = 0;

        foreach ($validated['grades'] as $gradeData) {
            // Skip if nilai is empty
            if (!isset($gradeData['nilai']) || $gradeData['nilai'] === '') {
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

            Grade::create([
                'student_id' => $studentId,
                'subject_id' => $gradeData['subject_id'],
                'class_id' => $classId,
                'school_year_id' => $yearId,
                'semester_id' => $semesterId,
                'nilai' => (float)$gradeData['nilai'],
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

    public function storeByStudent(Request $request, Student $student)
    {
        $validated = $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'class_id' => 'required|exists:classes,id',
            'school_year_id' => 'required|exists:school_years,id',
            'semester_id' => 'required|exists:semesters,id',
            'nilai' => 'required|numeric|min:0|max:100',
        ]);

        // Check for existing grade
        $existingGrade = Grade::where('student_id', $student->id)
            ->where('subject_id', $validated['subject_id'])
            ->where('class_id', $validated['class_id'])
            ->where('school_year_id', $validated['school_year_id'])
            ->where('semester_id', $validated['semester_id'])
            ->first();

        if ($existingGrade) {
            // Update existing grade
            $existingGrade->update([
                'nilai' => $validated['nilai'],
            ]);
            $message = 'Nilai rapor berhasil diperbarui!';
        } else {
            // Create new grade
            Grade::create([
                'student_id' => $student->id,
                'subject_id' => $validated['subject_id'],
                'class_id' => $validated['class_id'],
                'school_year_id' => $validated['school_year_id'],
                'semester_id' => $validated['semester_id'],
                'nilai' => $validated['nilai'],
            ]);
            $message = 'Nilai rapor berhasil disimpan!';
        }

        return redirect()->route('students.show', $student)
            ->with('success', $message);
    }

    /**
     * Get semester grades for edit
     */
    public function editSemesterGrades(Student $student, $semesterId, $yearId)
    {
        $semester = Semester::find($semesterId);
        $schoolYear = SchoolYear::find($yearId);
        
        if (!$semester || !$schoolYear) {
            return redirect()->route('students.show', $student)
                ->with('error', 'Semester atau tahun ajaran tidak ditemukan');
        }

        // Get all grades for this student in this semester and year
        $grades = Grade::where('student_id', $student->id)
            ->where('semester_id', $semesterId)
            ->where('school_year_id', $yearId)
            ->with(['subject', 'schoolClass', 'schoolYear', 'semester'])
            ->orderBy('subject_id')
            ->get();

        return view('grades.edit-semester', compact('student', 'semester', 'schoolYear', 'grades'));
    }

    /**
     * Update all grades in a semester
     */
    public function updateSemesterGrades(Request $request, Student $student, $semesterId, $yearId)
    {
        $validated = $request->validate([
            'grades' => 'array',
            'grades.*' => 'numeric|min:0|max:100|nullable',
        ]);

        $updateCount = 0;
        if (isset($validated['grades']) && is_array($validated['grades'])) {
            foreach ($validated['grades'] as $gradeId => $nilai) {
                if ($nilai !== null && $nilai !== '') {
                    $grade = Grade::find($gradeId);
                    if ($grade && $grade->student_id == $student->id) {
                        $grade->update(['nilai' => $nilai]);
                        $updateCount++;
                    }
                }
            }
        }

        return redirect()->route('students.show', $student)
            ->with('success', "Nilai semester berhasil diperbarui! ($updateCount pelajaran diubah)");
    }

    /**
     * Delete all grades in a semester
     */
    public function destroySemesterGrades(Student $student, $semesterId, $yearId)
    {
        $deletedCount = Grade::where('student_id', $student->id)
            ->where('semester_id', $semesterId)
            ->where('school_year_id', $yearId)
            ->delete();

        return redirect()->route('students.show', $student)
            ->with('success', "Semua nilai semester berhasil dihapus! ($deletedCount pelajaran dihapus)");
    }
}