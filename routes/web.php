<?php

use App\Http\Controllers\GradeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('grades.index');
});

Route::get('home', function () {
    return redirect()->route('grades.index');
})->name('home');

Route::resource('grades', GradeController::class)->except(['show']);
Route::get('rapor/{student}/transcript', [GradeController::class, 'transcript'])->name('students.transcript');
Route::get('rapor/{student}/transcript/pdf', [GradeController::class, 'transcriptPdf'])->name('students.transcript.pdf');

Route::any('students/{any?}', function () {
    return redirect()->route('grades.index');
})->where('any', '.*');

Route::any('subjects/{any?}', function () {
    return redirect()->route('grades.index');
})->where('any', '.*');

Route::any('teachers/{any?}', function () {
    return redirect()->route('grades.index');
})->where('any', '.*');
