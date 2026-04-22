@extends('layouts.app')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
    <div>
        <h2 class="mb-1">Rapor Arsip - {{ $student->name }}</h2>
        <p class="text-secondary mb-0">Riwayat nilai rapor dari tahun ajaran ke tahun ajaran (Kelas 10 - 12)</p>
    </div>
    <a href="{{ route('students.show', $student) }}" class="btn btn-outline-secondary">Kembali</a>
</div>

<div class="alert alert-info">
    <strong>NIS:</strong> {{ $student->nis }} | <strong>Nama:</strong> {{ $student->name }}
</div>

@if($groupedGrades->isEmpty())
    <div class="alert alert-warning">
        Belum ada data nilai rapor untuk siswa ini.
    </div>
@else
    @foreach($groupedGrades as $period => $periodGrades)
        <div class="card border-0 shadow-sm mb-4">
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
    
    @if($groupedGrades->count() > 0)
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
