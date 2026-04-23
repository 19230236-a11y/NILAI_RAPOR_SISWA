@extends('layouts.app')

@push('style')
<style>
    @media print {
        .no-print {
            display: none !important;
        }

        .glass-panel,
        .card {
            box-shadow: none !important;
            border: 1px solid #d7e2f7 !important;
        }

        body {
            background: #fff !important;
        }
    }
</style>
@endpush

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
    <div>
        <h2 class="mb-1">Rapor Arsip - {{ $student->name }}</h2>
        <p class="text-secondary mb-0">Riwayat nilai rapor dari kelas 10 sampai 12 yang siap dicetak.</p>
    </div>
    <div class="d-flex gap-2 no-print">
        <a href="{{ route('students.transcript.pdf', $student) }}" class="btn btn-brand">Export PDF</a>
        <a href="{{ route('grades.index') }}" class="btn btn-outline-secondary">Kembali</a>
    </div>
</div>

<div class="card border-0 shadow-sm mb-3">
    <div class="card-body">
        <div class="row g-3">
            <div class="col-12 col-md-4">
                <p class="text-secondary mb-1">NIS</p>
                <p class="fw-semibold mb-0">{{ $student->nis }}</p>
            </div>
            <div class="col-12 col-md-4">
                <p class="text-secondary mb-1">Nama</p>
                <p class="fw-semibold mb-0">{{ $student->name }}</p>
            </div>
            <div class="col-12 col-md-4">
                <p class="text-secondary mb-1">Tanggal Cetak</p>
                <p class="fw-semibold mb-0">{{ now()->format('d-m-Y H:i') }}</p>
            </div>
        </div>
    </div>
</div>

@if($gradesByClass->isEmpty())
    <div class="alert alert-warning">
        Belum ada data nilai rapor untuk siswa ini.
    </div>
@else
    @foreach($gradesByClass as $classLabel => $classData)
        <div class="card border-0 shadow-sm mb-3 page-break-inside-avoid">
            <div class="card-body">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
                    <h4 class="mb-0">{{ $classLabel }}</h4>
                    <div class="d-flex flex-wrap gap-2">
                        <span class="badge text-bg-primary">Rata-rata: {{ number_format($classData['summary']['avg'] ?? 0, 2) }}</span>
                        <span class="badge text-bg-success">Tertinggi: {{ number_format($classData['summary']['max'] ?? 0, 2) }}</span>
                        <span class="badge text-bg-danger">Terendah: {{ number_format($classData['summary']['min'] ?? 0, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>

        @foreach($classData['periods'] as $period => $periodGrades)
        <div class="card border-0 shadow-sm mb-4 page-break-inside-avoid">
            <div class="card-header bg-light">
                <h5 class="mb-0">{{ $period }}</h5>
            </div>
            
            <div class="table-responsive">
                <table class="table table-sm table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Mapel</th>
                            <th>Guru</th>
                            <th class="text-center">Tugas (30%)</th>
                            <th class="text-center">UTS (30%)</th>
                            <th class="text-center">UAS (40%)</th>
                            <th class="text-center">Nilai Akhir</th>
                            <th class="text-center">Grade</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $totalNilai = 0;
                            $totalGrade = 0;
                        @endphp
                        @foreach($periodGrades as $grade)
                            @php
                                $grade_letter = 'E';
                                if ($grade->nilai_akhir >= 85) $grade_letter = 'A';
                                elseif ($grade->nilai_akhir >= 75) $grade_letter = 'B';
                                elseif ($grade->nilai_akhir >= 65) $grade_letter = 'C';
                                elseif ($grade->nilai_akhir >= 55) $grade_letter = 'D';
                                
                                $totalNilai += $grade->nilai_akhir;
                                $totalGrade++;
                            @endphp
                            <tr>
                                <td class="fw-semibold">{{ $grade->subject->name }}</td>
                                <td>{{ $grade->teacher->name }}</td>
                                <td class="text-center">{{ number_format($grade->nilai_tugas, 2) }}</td>
                                <td class="text-center">{{ number_format($grade->nilai_uts, 2) }}</td>
                                <td class="text-center">{{ number_format($grade->nilai_uas, 2) }}</td>
                                <td class="text-center">
                                    <span class="badge bg-primary">{{ number_format($grade->nilai_akhir, 2) }}</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-{{ $grade_letter == 'A' ? 'success' : ($grade_letter == 'B' ? 'info' : ($grade_letter == 'C' ? 'warning' : ($grade_letter == 'D' ? 'danger' : 'secondary'))) }}">
                                        {{ $grade_letter }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                        
                        @if($totalGrade > 0)
                            <tr class="table-light fw-bold">
                                <td colspan="5" class="text-end">Rata-rata Nilai:</td>
                                <td class="text-center">
                                    <span class="badge bg-info">{{ number_format($totalNilai / $totalGrade, 2) }}</span>
                                </td>
                                <td></td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        @endforeach
    @endforeach
    
    @if($gradesByClass->count() > 0)
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Statistik Keseluruhan</h5>
                
                @php
                    $allNilai = $grades->pluck('nilai_akhir');
                    $rataRata = $allNilai->avg();
                    $tertinggi = $allNilai->max();
                    $terendah = $allNilai->min();
                @endphp
                
                <div class="row g-3">
                    <div class="col-md-3">
                        <div class="p-3 bg-light rounded text-center">
                            <div class="text-secondary small">Rata-rata Keseluruhan</div>
                            <div class="h4 fw-bold">{{ number_format($rataRata, 2) }}</div>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="p-3 bg-light rounded text-center">
                            <div class="text-secondary small">Nilai Tertinggi</div>
                            <div class="h4 fw-bold text-success">{{ number_format($tertinggi, 2) }}</div>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="p-3 bg-light rounded text-center">
                            <div class="text-secondary small">Nilai Terendah</div>
                            <div class="h4 fw-bold text-danger">{{ number_format($terendah, 2) }}</div>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="p-3 bg-light rounded text-center">
                            <div class="text-secondary small">Total Mapel</div>
                            <div class="h4 fw-bold text-info">{{ $grades->count() }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endif

@endsection
