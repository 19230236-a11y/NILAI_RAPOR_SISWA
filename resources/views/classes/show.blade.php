@extends('layouts.app')

@section('title', 'Detail Kelas - ' . $class->name)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="h4 mb-1">{{ $class->name }}</h2>
        <p class="text-muted mb-0">Kelas {{ $class->level ?? '-' }} {{ $class->jurusan ? '- ' . $class->jurusan : '' }}</p>
    </div>
    <div>
        <a href="{{ route('classes.edit', $class) }}" class="btn btn-outline-warning"><i class="bi bi-pencil me-2"></i>Edit</a>
        <a href="{{ route('classes.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-2"></i>Kembali</a>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0"><h5 class="mb-0">Informasi Kelas</h5></div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr><td class="text-muted">Nama</td><td><strong>{{ $class->name }}</strong></td></tr>
                    <tr><td class="text-muted">Tingkat</td><td>{{ $class->level ?? '-' }}</td></tr>
                    <tr><td class="text-muted">Jurusan</td><td>{{ $class->jurusan ?? '-' }}</td></tr>
                    <tr><td class="text-muted">Wali Kelas</td><td>{{ $class->wali_kelas ?? '-' }}</td></tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0"><h5 class="mb-0"><i class="bi bi-clipboard-data me-2"></i>Nilai Kelas</h5></div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead><tr><th>Siswa</th><th>Mata Pelajaran</th><th>Semester</th><th>Nilai Akhir</th></tr></thead>
                    <tbody>
                        @forelse($class->grades->take(10) as $grade)
                        <tr>
                            <td>{{ $grade->student->name ?? '-' }}</td>
                            <td>{{ $grade->subject->name ?? '-' }}</td>
                            <td>{{ $grade->semester->name ?? '-' }}</td>
                            <td><strong>{{ number_format($grade->nilai_akhir, 2) }}</strong></td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="text-center text-muted py-3">Belum ada nilai</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection