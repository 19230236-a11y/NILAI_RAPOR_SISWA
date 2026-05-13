@extends('layouts.app')

@section('title', 'Dashboard - Siswa')

@section('content')
<div class="row g-4 mb-4">
    <div class="col-12">
        <h2 class="h4">Selamat Datang, {{ Auth::user()->name }}!</h2>
        <p class="text-muted">Panel Siswa - Lihat nilai rapor Anda.</p>
    </div>
</div>

<div class="row g-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0">
                <h5 class="mb-0"><i class="bi bi-person-badge me-2"></i>Profil Siswa</h5>
            </div>
            <div class="card-body">
                @if($student)
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td class="text-muted">NIS</td>
                                <td>: {{ $student->nis }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Nama</td>
                                <td>: {{ $student->name }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Jenis Kelamin</td>
                                <td>: {{ $student->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td class="text-muted">Tempat, Tanggal Lahir</td>
                                <td>: {{ $student->birth_place }}, {{ \Carbon\Carbon::parse($student->birth_date)->format('d F Y') }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Alamat</td>
                                <td>: {{ $student->address ?? '-' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                @else
                <div class="alert alert-warning">
                    Data siswa tidak ditemukan. Silakan hubungi administrator.
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mt-2">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0">
                <h5 class="mb-0"><i class="bi bi-clipboard-data me-2"></i>Nilai Rapor</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Mata Pelajaran</th>
                                <th>Kelas</th>
                                <th>Semester</th>
                                <th>Tugas</th>
                                <th>UTS</th>
                                <th>UAS</th>
                                <th>Nilai Akhir</th>
                                <th>Predikat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($myGrades as $grade)
                            <tr>
                                <td>{{ $grade->subject->name ?? '-' }}</td>
                                <td>{{ $grade->schoolClass->name ?? '-' }}</td>
                                <td>{{ $grade->semester->name ?? '-' }}</td>
                                <td>{{ $grade->nilai_tugas ?? '-' }}</td>
                                <td>{{ $grade->nilai_uts ?? '-' }}</td>
                                <td>{{ $grade->nilai_uas ?? '-' }}</td>
                                <td>
                                    <strong>{{ number_format($grade->nilai_akhir, 2) }}</strong>
                                </td>
                                <td>
                                    <span class="badge bg-{{ $grade->nilai_akhir >= 85 ? 'success' : ($grade->nilai_akhir >= 75 ? 'primary' : ($grade->nilai_akhir >= 65 ? 'warning' : 'danger')) }}">
                                        {{ $grade->predicate }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">Belum ada nilai rapor</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection