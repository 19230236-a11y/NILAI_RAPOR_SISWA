<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;

Route::get('/', function () {
    return view('dashboard');
});

Route::get('home', function () {
    return view('dashboard');
})->name('home');

Route::resource('students', StudentController::class);
Route::resource('subjects', SubjectController::class);
Route::resource('teachers', TeacherController::class);
