<?php

use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\GradeController;

Route::get('/', function () {
    $stats = [
        'students' => Schema::hasTable('students') ? Student::count() : 0,
        'subjects' => Schema::hasTable('subjects') ? Subject::count() : 0,
        'teachers' => Schema::hasTable('teachers') ? Teacher::count() : 0,
    ];

    return view('dashboard', compact('stats'));
});

Route::get('home', function () {
    $stats = [
        'students' => Schema::hasTable('students') ? Student::count() : 0,
        'subjects' => Schema::hasTable('subjects') ? Subject::count() : 0,
        'teachers' => Schema::hasTable('teachers') ? Teacher::count() : 0,
    ];

    return view('dashboard', compact('stats'));
})->name('home');

Route::resource('students', StudentController::class);
Route::resource('subjects', SubjectController::class);
Route::resource('teachers', TeacherController::class);
Route::resource('grades', GradeController::class);
Route::get('students/{student}/transcript', [GradeController::class, 'transcript'])->name('students.transcript');
