<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\SchoolClass;
use App\Models\SchoolYear;
use App\Models\Semester;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    /**
     * Display list of grades with filters
     */
    public function index()
    {
        $sort = request('sort', 'student_id');
        $direction = request('direction', 'asc');
        $search = request('search');
        $classFilter = request('class');
        $yearFilter = request('year');
        $semesterFilter = request('semester');
        
        $query = Grade::with('student', 'subject', 'teacher', 'schoolClass', 'schoolYear', 'semester');
        
        if ($search) {
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
        
        $grades = $query->orderBy($sort, $direction)->paginate(15)->appends(request()->query());
        
        $classes = SchoolClass::all();
        $years = SchoolYear::all();
        $semesters = Semester::all();
        
        return view('grades.index', compact('grades', 'classes', 'years', 'semesters', 'sort', 'direction', 'search', 'classFilter', 'yearFilter', 'semesterFilter'));
    }

    /**
     * Show form for entering grades for a student
     */
    public function create()
    {
        $students = Student::all();
        $subjects = Subject::all();
        $teachers = Teacher::all();
        $classes = SchoolClass::all();
        $years = SchoolYear::all();
        $semesters = Semester::all();
        
        return view('grades.create', compact('students', 'subjects', 'teachers', 'classes', 'years', 'semesters'));
    }

    /**
     * Store grade record
     */
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'subject_id' => 'required|exists:subjects,id',
            'teacher_id' => 'required|exists:teachers,id',
            'class_id' => 'required|exists:classes,id',
            'school_year_id' => 'required|exists:school_years,id',
            'semester_id' => 'required|exists:semesters,id',
            'nilai_tugas' => 'required|numeric|min:0|max:100',
            'nilai_uts' => 'required|numeric|min:0|max:100',
            'nilai_uas' => 'required|numeric|min:0|max:100',
        ]);

        Grade::create($request->all());

        return redirect()->route('grades.index')->with('success', 'Nilai siswa berhasil disimpan.');
    }

    /**
     * Show edit form for grade
     */
    public function edit(Grade $grade)
    {
        $students = Student::all();
        $subjects = Subject::all();
        $teachers = Teacher::all();
        $classes = SchoolClass::all();
        $years = SchoolYear::all();
        $semesters = Semester::all();
        
        return view('grades.edit', compact('grade', 'students', 'subjects', 'teachers', 'classes', 'years', 'semesters'));
    }

    /**
     * Update grade record
     */
    public function update(Request $request, Grade $grade)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'subject_id' => 'required|exists:subjects,id',
            'teacher_id' => 'required|exists:teachers,id',
            'class_id' => 'required|exists:classes,id',
            'school_year_id' => 'required|exists:school_years,id',
            'semester_id' => 'required|exists:semesters,id',
            'nilai_tugas' => 'required|numeric|min:0|max:100',
            'nilai_uts' => 'required|numeric|min:0|max:100',
            'nilai_uas' => 'required|numeric|min:0|max:100',
        ]);

        $grade->update($request->all());

        return redirect()->route('grades.index')->with('success', 'Nilai siswa berhasil diperbarui.');
    }

    /**
     * Delete grade record
     */
    public function destroy(Grade $grade)
    {
        $grade->delete();
        return redirect()->route('grades.index')->with('success', 'Nilai siswa berhasil dihapus.');
    }

    /**
     * Show student transcript (rapor arsip kelas 10-12)
     */
    public function transcript(Student $student)
    {
        $grades = Grade::where('student_id', $student->id)
            ->with('subject', 'teacher', 'schoolClass', 'schoolYear', 'semester')
            ->orderBy('school_year_id')
            ->orderBy('semester_id')
            ->get();
        
        // Group by school year and semester for better display
        $groupedGrades = $grades->groupBy(function ($grade) {
            return "{$grade->schoolYear->year} - {$grade->semester->name}";
        });
        
        return view('grades.transcript', compact('student', 'grades', 'groupedGrades'));
    }
}
