@extends('layouts.app')

@section('title', 'Daftar Jurusan')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
        <h2 class="mb-1">Daftar Jurusan</h2>
        <p class="text-secondary mb-0">Kelola jurusan dan input nilai per jurusan.</p>
    </div>
</div>

@if($programs->count() > 0)
    <div class="row g-4">
        @foreach($programs as $program)
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100 hover-shadow" style="transition: box-shadow 0.3s ease;">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between mb-3">
                            <div>
                                <h5 class="card-title mb-1">{{ $program->name }}</h5>
                                @if($program->code)
                                    <p class="text-muted small mb-0">Kode: {{ $program->code }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="row g-2 mb-3">
                            <div class="col-6">
                                <div class="bg-light rounded-2 p-2 text-center">
                                    <div class="small text-muted">Siswa</div>
                                    <div class="h6 mb-0"><strong>{{ $program->students_count }}</strong></div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="bg-light rounded-2 p-2 text-center">
                                    <div class="small text-muted">Kelas</div>
                                    <div class="h6 mb-0"><strong>{{ $program->classes_count }}</strong></div>
                                </div>
                            </div>
                        </div>

                        @if($program->description)
                            <p class="card-text small text-muted mb-3">{{ $program->description }}</p>
                        @endif

                        <a href="{{ route('programs.show', $program) }}" class="btn btn-primary btn-sm w-100">
                            <i class="bi bi-arrow-right me-1"></i>Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $programs->links() }}
    </div>
@else
    <div class="alert alert-info text-center py-5">
        <i class="bi bi-info-circle me-2"></i>Belum ada jurusan. Tambahkan jurusan terlebih dahulu.
    </div>
@endif
@endsection

<style>
    .hover-shadow:hover {
        box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15) !important;
    }
</style>
