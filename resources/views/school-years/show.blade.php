@extends('layouts.app')

@section('title', 'Detail Tahun Ajaran')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="h4 mb-1">{{ $schoolYear->year }}</h2>
        <p class="text-muted mb-0">
            @if($schoolYear->is_active)
            <span class="badge bg-success">Aktif</span>
            @else
            <span class="badge bg-secondary">Nonaktif</span>
            @endif
        </p>
    </div>
    <div>
        <a href="{{ route('school-years.edit', $schoolYear) }}" class="btn btn-outline-warning"><i class="bi bi-pencil me-2"></i>Edit</a>
        <a href="{{ route('school-years.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-2"></i>Kembali</a>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0"><h5 class="mb-0">Informasi</h5></div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr><td class="text-muted">Tahun Ajaran</td><td><strong>{{ $schoolYear->year }}</strong></td></tr>
                    <tr><td class="text-muted">Status</td>
                        <td>@if($schoolYear->is_active)<span class="badge bg-success">Aktif</span>@else<span class="badge bg-secondary">Nonaktif</span>@endif</td></tr>
                    <tr><td class="text-muted">Mulai</td><td>{{ $schoolYear->start_date ? \Carbon\Carbon::parse($schoolYear->start_date)->format('d F Y') : '-' }}</td></tr>
                    <tr><td class="text-muted">Selesai</td><td>{{ $schoolYear->end_date ? \Carbon\Carbon::parse($schoolYear->end_date)->format('d F Y') : '-' }}</td></tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0"><h5 class="mb-0"><i class="bi bi-calendar3 me-2"></i>Semester</h5></div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead><tr><th>Nama</th><th>Jenis</th><th>Jumlah Nilai</th></tr></thead>
                    <tbody>
                        @forelse($schoolYear->semesters as $semester)
                        <tr>
                            <td>{{ $semester->name }}</td>
                            <td>{{ $semester->type ?? '-' }}</td>
                            <td><span class="badge bg-info">{{ $semester->grades->count() }}</span></td>
                        </tr>
                        @empty
                        <tr><td colspan="3" class="text-center text-muted py-3">Belum ada semester</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection