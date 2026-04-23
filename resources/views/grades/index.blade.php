@extends('layouts.app')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
    <div>
        <h2 class="mb-1">Manajemen Nilai Rapor</h2>
        <p class="text-secondary mb-0">Input dan arsip nilai rapor siswa per mapel per semester.</p>
    </div>
    <a href="{{ route('grades.create') }}" class="btn btn-brand">+ Input Nilai</a>
</div>

<div class="row g-3 mb-3">
    <div class="col-12">
        <form method="GET" action="{{ route('grades.index') }}" class="row g-2 align-items-end">
            <div class="col-12 col-md-6 col-lg-3">
                <label class="form-label">Cari Siswa</label>
                <input type="text" name="search" placeholder="Nama atau NIS..." class="form-control" value="{{ $search ?? '' }}">
            </div>
            
            <div class="col-12 col-md-6 col-lg-2">
                <label class="form-label">Kelas</label>
                <select name="class" class="form-select">
                    <option value="">Semua Kelas</option>
                    @foreach($classes as $class)
                        <option value="{{ $class->id }}" {{ $classFilter == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="col-12 col-md-6 col-lg-2">
                <label class="form-label">Tahun Ajaran</label>
                <select name="year" class="form-select">
                    <option value="">Semua Tahun</option>
                    @foreach($years as $year)
                        <option value="{{ $year->id }}" {{ $yearFilter == $year->id ? 'selected' : '' }}>{{ $year->year }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="col-12 col-md-6 col-lg-2">
                <label class="form-label">Semester</label>
                <select name="semester" class="form-select">
                    <option value="">Semua Semester</option>
                    @foreach($semesters as $semester)
                        <option value="{{ $semester->id }}" {{ $semesterFilter == $semester->id ? 'selected' : '' }}>{{ $semester->name }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="col-12 col-lg-1">
                <button type="submit" class="btn btn-outline-primary w-100">Filter</button>
            </div>
            
            @if($search || $classFilter || $yearFilter || $semesterFilter)
                <div class="col-12 col-lg-1">
                    <a href="{{ route('grades.index') }}" class="btn btn-outline-secondary w-100">Reset</a>
                </div>
            @endif
        </form>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-hover align-middle">
        <thead>
            <tr>
                <th>Siswa</th>
                <th>Mapel</th>
                <th>Kelas</th>
                <th>Tahun Ajaran</th>
                <th>Semester</th>
                <th>Nilai Akhir</th>
                <th>Grade</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($grades as $grade)
                <tr>
                    <td class="fw-semibold">{{ $grade->student->name }}</td>
                    <td>{{ $grade->subject->name }}</td>
                    <td>{{ $grade->schoolClass->name }}</td>
                    <td>{{ $grade->schoolYear->year }}</td>
                    <td>{{ $grade->semester->name }}</td>
                    <td>
                        <span class="badge bg-primary">{{ number_format($grade->nilai_akhir, 2) }}</span>
                    </td>
                    <td>
                        @php
                            $grade_letter = 'E';
                            if ($grade->nilai_akhir >= 85) $grade_letter = 'A';
                            elseif ($grade->nilai_akhir >= 75) $grade_letter = 'B';
                            elseif ($grade->nilai_akhir >= 65) $grade_letter = 'C';
                            elseif ($grade->nilai_akhir >= 55) $grade_letter = 'D';
                        @endphp
                        <span class="badge bg-{{ $grade_letter == 'A' ? 'success' : ($grade_letter == 'B' ? 'info' : ($grade_letter == 'C' ? 'warning' : 'danger')) }}">{{ $grade_letter }}</span>
                    </td>
                    <td class="text-center">
                        <div class="d-flex flex-wrap justify-content-center gap-2">
                            <a href="{{ route('students.transcript', $grade->student) }}" class="btn btn-sm btn-outline-primary">Transcript</a>
                            <a href="{{ route('students.transcript.pdf', $grade->student) }}" class="btn btn-sm btn-outline-success">PDF</a>
                            <a href="{{ route('grades.edit', $grade) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                            <form action="{{ route('grades.destroy', $grade) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus nilai ini?')">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center text-secondary py-4">Belum ada data nilai.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-3">
    {{ $grades->links() }}
</div>
@endsection
