@extends('layouts.app')

@section('title', 'Tahun Ajaran')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="h4 mb-1">Tahun Ajaran</h2>
        <p class="text-muted mb-0">Kelola tahun ajaran sekolah</p>
    </div>
    <a href="{{ route('school-years.create') }}" class="btn btn-brand">
        <i class="bi bi-plus-lg me-2"></i>Tambah Tahun Ajaran
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Tahun Ajaran</th>
                        <th>Status</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($years as $year)
                    <tr>
                        <td><strong>{{ $year->year }}</strong></td>
                        <td>
                            @if($year->is_active)
                            <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>Aktif</span>
                            @else
                            <span class="badge bg-secondary">Nonaktif</span>
                            @endif
                        </td>
                        <td>{{ $year->start_date ? \Carbon\Carbon::parse($year->start_date)->format('d/m/Y') : '-' }}</td>
                        <td>{{ $year->end_date ? \Carbon\Carbon::parse($year->end_date)->format('d/m/Y') : '-' }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('school-years.show', $year) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></a>
                                <a href="{{ route('school-years.edit', $year) }}" class="btn btn-sm btn-outline-warning"><i class="bi bi-pencil"></i></a>
                                @if(!$year->is_active)
                                <form method="POST" action="{{ route('school-years.setActive', $year) }}" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-success" title="Jadikan Aktif">
                                        <i class="bi bi-check2"></i>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center py-4 text-muted">Belum ada tahun ajaran</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mt-4">{{ $years->links() }}</div>
    </div>
</div>
@endsection