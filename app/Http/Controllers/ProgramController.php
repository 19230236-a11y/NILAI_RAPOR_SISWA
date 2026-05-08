<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Student;
use App\Models\SchoolClass;
use App\Models\SchoolYear;
use App\Models\Semester;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    /**
     * Display a listing of all programs.
     */
    public function index()
    {
        $programs = Program::withCount(['students', 'classes'])
            ->orderBy('name')
            ->paginate(10);

        return view('programs.index', compact('programs'));
    }

    /**
     * Display the specified program with details.
     */
    public function show(Program $program)
    {
        $program->load(['students' => function ($query) {
            $query->orderBy('name')->paginate(15);
        }, 'classes']);
        
        $students = Student::where('program_id', $program->id)
            ->orderBy('name')
            ->paginate(15);
        
        // Data untuk form input nilai
        $classes = SchoolClass::orderBy('name')->get();
        $years = SchoolYear::orderBy('year')->get();
        $semesters = Semester::orderBy('name')->get();
        $subjects = Subject::orderBy('name')->get();
        $teachers = Teacher::orderBy('name')->get();

        return view('programs.show', compact('program', 'students', 'classes', 'years', 'semesters', 'subjects', 'teachers'));
    }

    /**
     * Remove the specified program from storage.
     */
    public function destroy(Program $program)
    {
        $program->delete();
        return redirect()->route('programs.index')->with('success', 'Program berhasil dihapus.');
    }
}
