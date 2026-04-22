@extends('layouts.app')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
    <div>
        <h2 class="mb-1">Detail Guru</h2>
        <p class="text-secondary mb-0">Informasi guru dan mapel pengampu.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('teachers.edit', $teacher) }}" class="btn btn-outline-warning">Edit</a>
        <a href="{{ route('teachers.index') }}" class="btn btn-outline-secondary">Kembali</a>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-6">
                <p class="text-secondary mb-1">NIP</p>
                <p class="fw-semibold mb-0">{{ $teacher->nip }}</p>
            </div>
            <div class="col-md-6">
                <p class="text-secondary mb-1">Nama</p>
                <p class="fw-semibold mb-0">{{ $teacher->name }}</p>
            </div>
            <div class="col-12">
                <p class="text-secondary mb-1">Mata Pelajaran</p>
                <p class="fw-semibold mb-0">{{ $teacher->subject->name ?? '-' }}</p>
            </div>
        </div>
    </div>
</div>
@endsection