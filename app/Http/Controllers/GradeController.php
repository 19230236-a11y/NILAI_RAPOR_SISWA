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
     * Display archived grade records with filters.
     */
    public function index()
    {
        $allowedSorts = ['created_at', 'nilai_akhir', 'student_id', 'class_id', 'school_year_id'];
        $sort = request('sort', 'created_at');
        $sort = in_array($sort, $allowedSorts, true) ? $sort : 'created_at';

        $direction = request('direction', 'desc');
        $direction = $direction === 'asc' ? 'asc' : 'desc';

        $search = trim((string) request('search', ''));
        $classFilter = request('class');
        $yearFilter = request('year');
        $semesterFilter = request('semester');
        $programFilter = request('program');

        $query = Grade::with(['student', 'subject', 'teacher', 'schoolClass', 'schoolYear', 'semester']);

        if ($search !== '') {
            $query->whereHas('student', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('nis', 'like', "%{$search}%");
            });
        }

        if ($classFilter) {
            $query->where('class_id', $classFilter);
        }

        if ($yearFilter) {
            $query->where('school_year_id', $yearFilter);
        }

        if ($semesterFilter) {
            $query->where('semester_id', $semesterFilter);
        }

        // Filter by program through student
        if ($programFilter) {
            $query->whereHas('student', function ($q) use ($programFilter) {
                $q->where('program_id', $programFilter);
            });
        }

        $grades = $query->orderBy($sort, $direction)->paginate(15)->withQueryString();

        $classes = SchoolClass::orderBy('name')->get();
        $years = SchoolYear::orderBy('year')->get();
        $semesters = Semester::orderBy('name')->get();

        return view('grades.index', compact(
            'grades',
            'classes',
            'years',
            'semesters',
            'sort',
            'direction',
            'search',
            'classFilter',
            'yearFilter',
            'semesterFilter',
            'programFilter'
        ));
    }

    public function create()
    {
        $students = Student::orderBy('name')->get();
        $subjects = Subject::orderBy('name')->get();
        $teachers = Teacher::orderBy('name')->get();
        $classes = SchoolClass::orderBy('name')->get();
        $years = SchoolYear::orderBy('year')->get();
        $semesters = Semester::orderBy('name')->get();

        return view('grades.create', compact('students', 'subjects', 'teachers', 'classes', 'years', 'semesters'));
    }

    /**
     * Show form for bulk creating grades
     */
    public function bulkCreate()
    {
        $students = Student::with('program')->orderBy('name')->get();
        $programs = Program::orderBy('name')->get();
        $subjects = Subject::orderBy('name')->get();
        $teachers = Teacher::orderBy('name')->get();
        $classes = SchoolClass::orderBy('name')->get();
        $years = SchoolYear::orderBy('year')->get();
        $semesters = Semester::orderBy('name')->get();

        return view('grades.bulk-create', compact('students', 'programs', 'subjects', 'teachers', 'classes', 'years', 'semesters'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_name' => 'required|string|max:255',
            'subject_name' => 'required|string|max:255',
            'teacher_name' => 'required|string|max:255',
            'class_name' => 'required|string|max:255',
            'school_year' => 'required|string|max:255',
            'semester_name' => 'required|string|max:255',
            'nilai_tugas' => 'required|numeric|min:0|max:100',
            'nilai_uts' => 'required|numeric|min:0|max:100',
            'nilai_uas' => 'required|numeric|min:0|max:100',
        ]);

        $studentName = preg_replace('/\s+/', ' ', trim($request->student_name));
        $subjectName = preg_replace('/\s+/', ' ', trim($request->subject_name));
        $teacherName = preg_replace('/\s+/', ' ', trim($request->teacher_name));
        $className = preg_replace('/\s+/', ' ', trim($request->class_name));
        $yearName = preg_replace('/\s+/', ' ', trim($request->school_year));
        $semesterName = preg_replace('/\s+/', ' ', trim($request->semester_name));

        $student = Student::firstOrCreate(
            ['name' => $studentName],
            [
                'nis' => $this->generateUniqueNis(),
                'gender' => 'L',
                'birth_date' => '2000-01-01',
                'address' => '-',
            ]
        );

        $subject = Subject::firstOrCreate(['name' => $subjectName]);

        $teacher = Teacher::firstOrCreate(
            ['name' => $teacherName],
            [
                'nip' => $this->generateUniqueNip(),
                'subject_id' => $subject->id,
            ]
        );

        $schoolClass = SchoolClass::firstOrCreate(['name' => $className]);
        $year = SchoolYear::firstOrCreate(['year' => $yearName]);
        $semester = Semester::firstOrCreate(['name' => $semesterName]);

        $duplicate = Grade::where('student_id', $student->id)
            ->where('subject_id', $subject->id)
            ->where('class_id', $schoolClass->id)
            ->where('school_year_id', $year->id)
            ->where('semester_id', $semester->id)
            ->exists();

        if ($duplicate) {
            return back()->withInput()->withErrors(['subject_name' => 'Mapel ini sudah diinput untuk siswa pada kelas, tahun ajaran, dan semester yang sama.']);
        }

        Grade::create([
            'student_id' => $student->id,
            'subject_id' => $subject->id,
            'teacher_id' => $teacher->id,
            'class_id' => $schoolClass->id,
            'school_year_id' => $year->id,
            'semester_id' => $semester->id,
            'nilai_tugas' => $request->nilai_tugas,
            'nilai_uts' => $request->nilai_uts,
            'nilai_uas' => $request->nilai_uas,
            'nilai_akhir' => round((($request->nilai_tugas * 30) + ($request->nilai_uts * 30) + ($request->nilai_uas * 40)) / 100, 2),
        ]);

        return redirect()->route('grades.index')->with('success', 'Nilai rapor berhasil disimpan.');
    }

    /**
     * Store bulk grades for a student
     */
    public function bulkStore(Request $request)
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

        return redirect()->route('grades.index')
            ->with('success', "Nilai rapor berhasil disimpan! ($createdCount pelajaran ditambahkan)");
    }

    private function generateUniqueNis(): string
    {
        return 'NIS' . uniqid();
    }

    private function generateUniqueNip(): string
    {
        return 'NIP' . uniqid();
    }

    public function edit(Grade $grade)
    {
        $students = Student::orderBy('name')->get();
        $subjects = Subject::orderBy('name')->get();
        $teachers = Teacher::orderBy('name')->get();
        $classes = SchoolClass::orderBy('name')->get();
        $years = SchoolYear::orderBy('year')->get();
        $semesters = Semester::orderBy('name')->get();

        return view('grades.edit', compact('grade', 'students', 'subjects', 'teachers', 'classes', 'years', 'semesters'));
    }

    public function update(Request $request, Grade $grade)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'subject_id' => [
                'required',
                'exists:subjects,id',
                Rule::unique('grades', 'subject_id')
                    ->ignore($grade->id)
                    ->where(function ($query) use ($request) {
                        return $query
                            ->where('student_id', $request->student_id)
                            ->where('class_id', $request->class_id)
                            ->where('school_year_id', $request->school_year_id)
                            ->where('semester_id', $request->semester_id);
                    }),
            ],
            'teacher_id' => 'required|exists:teachers,id',
            'class_id' => 'required|exists:classes,id',
            'school_year_id' => 'required|exists:school_years,id',
            'semester_id' => 'required|exists:semesters,id',
            'nilai_tugas' => 'required|numeric|min:0|max:100',
            'nilai_uts' => 'required|numeric|min:0|max:100',
            'nilai_uas' => 'required|numeric|min:0|max:100',
        ], [
            'subject_id.unique' => 'Mapel ini sudah diinput untuk siswa pada kelas, tahun ajaran, dan semester yang sama.',
        ]);

        $grade->update($request->all());

        return redirect()->route('grades.index')->with('success', 'Nilai rapor berhasil diperbarui.');
    }

    public function destroy(Grade $grade)
    {
        $grade->delete();

        return redirect()->route('grades.index')->with('success', 'Nilai rapor berhasil dihapus.');
    }

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