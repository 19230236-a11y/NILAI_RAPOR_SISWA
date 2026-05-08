<?php

use App\Http\Controllers\GradeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SchoolClassController;
use App\Http\Controllers\SchoolYearController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\PasswordResetLinkController;
use Laravel\Fortify\Http\Controllers\NewPasswordController;

Route::get('/', function () {
    return redirect('/dashboard');
});

// ==================== AUTH ROUTES (GUEST) ====================
Route::middleware('guest')->group(function () {
    // Login View & POST
    Route::get('/login', function () {
        return view('pages.auth.auth-login-new');
    })->name('login');
    
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.store');
});

// Logout
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

// Dashboard - accessible by all authenticated users
Route::middleware('auth')->get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// ==================== KEPALA SEKOLAH (ADMIN) ROUTES ====================
Route::middleware(['auth', 'role:admin|kepala_sekolah'])->group(function () {
    // Register - Hanya Admin/Kepala Sekolah yang bisa membuat akun
    Route::get('/register', function () {
        return view('pages.auth.auth-register-new');
    })->name('register');
    
    Route::post('/register', [RegisteredUserController::class, 'store']);
    
    // Forgot Password & Reset Password - Hanya Admin yang bisa reset password
    Route::get('/forgot-password', function () {
        return view('pages.auth.auth-forgot-password-new');
    })->name('password.request');
    
    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');
    
    Route::get('/reset-password/{token}', function ($token) {
        return view('pages.auth.auth-reset-password-new', ['request' => request()]);
    })->name('password.reset');
    
    Route::post('/reset-password', [NewPasswordController::class, 'store'])
        ->name('password.update');
    
    // Buat dan edit akun Staff TU
    Route::resource('users', \App\Http\Controllers\UserController::class)->except(['show']);
    
    // Reset password akun Staff TU
    Route::get('users/{user}/reset-password', [\App\Http\Controllers\UserController::class, 'resetPassword'])->name('users.reset-password');
    Route::post('users/{user}/reset-password', [\App\Http\Controllers\UserController::class, 'storeResetPassword'])->name('users.store-reset-password');
});

// ==================== STAFF TU ROUTES ====================
Route::middleware(['auth', 'role:staff_tu'])->group(function () {
    // Manajemen data siswa, kelas, tahun ajaran, dan nilai
    Route::resource('students', StudentController::class);
    Route::resource('classes', SchoolClassController::class);
    Route::resource('school-years', SchoolYearController::class);
    Route::resource('grades', GradeController::class)->except(['show']);
    
    // Program management
    Route::resource('programs', \App\Http\Controllers\ProgramController::class)->except(['edit', 'update']);
    
    // Bulk input nilai - Dashboard
    Route::get('grades-bulk/create', [GradeController::class, 'bulkCreate'])->name('grades.bulk-create');
    Route::post('grades-bulk/store', [GradeController::class, 'bulkStore'])->name('grades.bulk-store');
    
    // Per-student grade input
    Route::get('students/{student}/grades/bulk-create', [GradeController::class, 'bulkCreateByStudent'])->name('students.grades.bulk-create');
    Route::post('students/{student}/grades/bulk-store', [GradeController::class, 'bulkStoreByStudent'])->name('students.grades.bulk-store');
    Route::get('students/{student}/grades/create', [GradeController::class, 'createByStudent'])->name('students.grades.create');
    
    // Program-specific grade input
    Route::get('programs/{program}/grades/bulk-create', [GradeController::class, 'bulkCreateByProgram'])->name('programs.grades.bulk-create');
    Route::post('programs/{program}/grades/bulk-store', [GradeController::class, 'bulkStoreByProgram'])->name('programs.grades.bulk-store');
    Route::get('programs/{program}/grades/create', [GradeController::class, 'createByProgram'])->name('programs.grades.create');
});

// ==================== REPORT ROUTES (Admin, Kepala Sekolah, dan Staff TU) ====================
Route::middleware(['auth', 'role:admin|kepala_sekolah|staff_tu'])->group(function () {
    Route::get('reports/grades', [GradeController::class, 'index'])->name('reports.grades');
    Route::get('reports/transcript/{student}', [GradeController::class, 'transcript'])->name('reports.transcript');
    Route::get('reports/transcript/{student}/pdf', [GradeController::class, 'transcriptPdf'])->name('reports.transcript.pdf');
});

// Redirect old routes
Route::any('rapor/{any?}', function () {
    return redirect('/dashboard');
})->where('any', '.*');
