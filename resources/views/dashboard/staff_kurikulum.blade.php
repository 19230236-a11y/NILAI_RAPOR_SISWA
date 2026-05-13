@extends('layouts.app')

@section('title', 'Dashboard - Staff Kurikulum')

@section('content')
<div class="row g-4 mb-4">
    <div class="col-12">
        <h2 class="h4">Selamat Datang, {{ Auth::user()->name }}!</h2>
        <p class="text-muted">Panel Staff Kurikulum - Kelola mata pelajaran, guru, dan input nilai per jurusan.</p>
    </div>
</div>

<div class="row g-4">
    <!-- Total Mata Pelajaran -->
    <div class="col-6 col-lg-3">
        <div class="card stat-card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="bg-warning bg-opacity-10 rounded-circle p-3">
                            <i class="bi bi-book fs-4 text-warning"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <p class="text-muted mb-0 small">Mata Pelajaran</p>
                        <h3 class="mb-0">{{ $stats['total_mapel'] }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Guru -->
    <div class="col-6 col-lg-3">
        <div class="card stat-card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="bg-success bg-opacity-10 rounded-circle p-3">
                            <i class="bi bi-person-badge fs-4 text-success"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <p class="text-muted mb-0 small">Total Guru</p>
                        <h3 class="mb-0">{{ $stats['total_guru'] }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Kelas -->
    <div class="col-6 col-lg-3">
        <div class="card stat-card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                            <i class="bi bi-door-open fs-4 text-primary"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <p class="text-muted mb-0 small">Total Kelas</p>
                        <h3 class="mb-0">{{ $stats['total_kelas'] }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Nilai -->
    <div class="col-6 col-lg-3">
        <div class="card stat-card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="bg-info bg-opacity-10 rounded-circle p-3">
                            <i class="bi bi-clipboard-data fs-4 text-info"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <p class="text-muted mb-0 small">Rekap Nilai Per Jurusan</p>
                        <h3 class="mb-0">{{ $stats['total_nilai'] }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mt-2">
    <!-- Quick Actions -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0">
                <h5 class="mb-0"><i class="bi bi-lightning me-2"></i>Aksi Cepat</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('subjects.index') }}" class="btn btn-outline-warning">
                        <i class="bi bi-book me-2"></i>Kelola Mapel
                    </a>
                    <a href="{{ route('teachers.index') }}" class="btn btn-outline-success">
                        <i class="bi bi-person-badge me-2"></i>Kelola Guru
                    </a>
                    <a href="{{ route('programs.index') }}" class="btn btn-outline-primary">
                        <i class="bi bi-mortarboard me-2"></i>Kelola Jurusan
                    </a>
                    <a href="{{ route('students.index') }}" class="btn btn-outline-info">
                        <i class="bi bi-people me-2"></i>Data Siswa
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Grades -->
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="bi bi-clock-history me-2"></i>Rekap Nilai Per Jurusan</h5>
                <a href="{{ route('programs.index') }}" class="btn btn-sm btn-outline-secondary">Lihat Jurusan</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Siswa</th>
                                <th>Mata Pelajaran</th>
                                <th>Kelas</th>
                                <th>Nilai Akhir</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentGrades as $grade)
                            <tr>
                                <td>{{ $grade->student->name ?? '-' }}</td>
                                <td>{{ $grade->subject->name ?? '-' }}</td>
                                <td>{{ $grade->schoolClass->name ?? '-' }}</td>
                                <td>
                                    <span class="badge bg-{{ $grade->nilai_akhir >= 85 ? 'success' : ($grade->nilai_akhir >= 75 ? 'primary' : ($grade->nilai_akhir >= 65 ? 'warning' : 'danger')) }}">
                                        {{ number_format($grade->nilai_akhir, 2) }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">Belum ada rekap nilai per jurusan</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Subject Statistics -->
<div class="row g-4 mt-2">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0">
                <h5 class="mb-0"><i class="bi bi-bar-chart me-2"></i>Statistik Mata Pelajaran</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    @forelse($subjects as $subject)
                    <div class="col-6 col-md-4 col-lg-2">
                        <div class="text-center p-3 border rounded">
                            <h4 class="mb-0">{{ $subject->grades_count }}</h4>
                            <small class="text-muted">{{ $subject->name }}</small>
                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-center text-muted py-4">Belum ada mata pelajaran</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection