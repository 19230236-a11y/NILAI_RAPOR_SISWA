<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Program;
use App\Models\SchoolClass;
use App\Models\SchoolYear;
use App\Models\Semester;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search', '');
        $sort = $request->get('sort', 'name');
        $direction = $request->get('direction', 'asc');
        $programId = $request->get('program', null);

        $query = Student::query();

        // Filter by program if specified
        if ($programId) {
            $query->where('program_id', $programId);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('nis', 'like', "%{$search}%")
                    ->orWhere('nisn', 'like', "%{$search}%");
            });
        }

        $students = $query->orderBy($sort, $direction)->paginate(15)->withQueryString();

        // Get program if filtered
        $program = $programId ? Program::find($programId) : null;
        
        // Get data for input form (only if filtered by program)
        $classes = SchoolClass::orderBy('name')->get();
        $years = SchoolYear::orderBy('year')->get();
        $semesters = Semester::orderBy('name')->get();
        $subjects = Subject::orderBy('name')->get();
        $teachers = Teacher::orderBy('name')->get();

        return view('students.index', compact('students', 'search', 'sort', 'direction', 'program', 'programId', 'classes', 'years', 'semesters', 'subjects', 'teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $programId = $request->get('program', null);
        $program = $programId ? Program::find($programId) : null;

        $classes = SchoolClass::orderBy('name')->get();
        $years = SchoolYear::orderBy('year')->get();
        $semesters = Semester::orderBy('name')->get();
        $subjects = Subject::orderBy('name')->get();
        $teachers = Teacher::orderBy('name')->get();

        return view('students.create', compact('program', 'programId', 'classes', 'years', 'semesters', 'subjects', 'teachers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nis' => 'required|unique:students|digits_between:6,20',
            'nisn' => 'nullable|digits:10',
            'name' => 'required|string|max:255',
            'gender' => 'required|in:L,P',
            'birth_date' => 'required|date',
            'birth_place' => 'required|string|max:255',
            'address' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
            'parent_name' => 'nullable|string|max:255',
            'parent_phone' => 'nullable|string|max:20',
            'program_id' => 'nullable|exists:programs,id',
            'grades' => 'nullable|array',
            'grades.*.subject_id' => 'nullable|exists:subjects,id',
            'grades.*.teacher_id' => 'nullable|exists:teachers,id',
            'grades.*.class_id' => 'nullable|exists:classes,id',
            'grades.*.school_year_id' => 'nullable|exists:school_years,id',
            'grades.*.semester_id' => 'nullable|exists:semesters,id',
            'grades.*.nilai_tugas' => 'nullable|numeric|min:0|max:100',
            'grades.*.nilai_uts' => 'nullable|numeric|min:0|max:100',
            'grades.*.nilai_uas' => 'nullable|numeric|min:0|max:100',
        ]);
        $student = Student::create($validated);

        // Handle optional grades input (array of grades) - only create when subject present
        $gradesInput = $validated['grades'] ?? [];
        foreach ($gradesInput as $g) {
            if (empty($g['subject_id'])) continue;

            // skip if no scores provided
            $hasScore = isset($g['nilai_tugas']) || isset($g['nilai_uts']) || isset($g['nilai_uas']);
            if (!$hasScore) continue;

            \App\Models\Grade::create([
                'student_id' => $student->id,
                'subject_id' => $g['subject_id'],
                'teacher_id' => $g['teacher_id'] ?? null,
                'class_id' => $g['class_id'] ?? null,
                'school_year_id' => $g['school_year_id'] ?? null,
                'semester_id' => $g['semester_id'] ?? null,
                'nilai_tugas' => $g['nilai_tugas'] ?? 0,
                'nilai_uts' => $g['nilai_uts'] ?? 0,
                'nilai_uas' => $g['nilai_uas'] ?? 0,
            ]);
        }

        return redirect()->route('students.index', ['program' => $validated['program_id'] ?? null])
            ->with('success', 'Data siswa dan nilai (jika ada) berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        $student->load(['grades.subject', 'grades.schoolClass', 'grades.semester']);
        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'nis' => 'required|digits_between:6,20|unique:students,nis,' . $student->id,
            'nisn' => 'nullable|digits:10',
            'name' => 'required|string|max:255',
            'gender' => 'required|in:L,P',
            'birth_date' => 'required|date',
            'birth_place' => 'required|string|max:255',
            'address' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
            'parent_name' => 'nullable|string|max:255',
            'parent_phone' => 'nullable|string|max:20',
        ]);

        $student->update($validated);

        return redirect()->route('students.show', $student)
            ->with('success', 'Data siswa berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index')
            ->with('success', 'Data siswa berhasil dihapus.');
    }
}