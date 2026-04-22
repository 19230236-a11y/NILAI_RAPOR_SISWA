<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\JurusanController;

Route::get('/', function () {
    return view('pages.auth.auth-login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('home', function () {
        return view('pages.dashboard', ['type_menu' => 'home']);
    })->name('home');

    Route::resource('users', UserController::class);
    Route::resource('companies', CompanyController::class);
    Route::resource('attendances', AttendanceController::class);
    Route::resource('permissions', PermissionController::class);

    // Routes Jurusan
    Route::get('jurusan/teknik-otomotif', [JurusanController::class, 'teknikOtomotif'])->name('jurusan.teknik-otomotif');
    Route::get('jurusan/teknik-komputer-jaringan', [JurusanController::class, 'teknikKomputerJaringan'])->name('jurusan.teknik-komputer-jaringan');
    Route::get('jurusan/keperawatan', [JurusanController::class, 'keperawatan'])->name('jurusan.keperawatan');
    Route::get('jurusan/farmasi', [JurusanController::class, 'farmasi'])->name('jurusan.farmasi');
    Route::get('jurusan/teknik-kendaraan-ringan', [JurusanController::class, 'teknikKendaraanRingan'])->name('jurusan.teknik-kendaraan-ringan');
});
