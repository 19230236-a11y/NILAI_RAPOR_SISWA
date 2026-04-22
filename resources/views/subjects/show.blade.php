@extends('layouts.app')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
    <div>
        <h2 class="mb-1">Detail Mata Pelajaran</h2>
        <p class="text-secondary mb-0">Informasi mapel yang tersimpan di sistem.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('subjects.edit', $subject) }}" class="btn btn-outline-warning">Edit</a>
        <a href="{{ route('subjects.index') }}" class="btn btn-outline-secondary">Kembali</a>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <p class="text-secondary mb-1">Nama Mata Pelajaran</p>
        <p class="fw-semibold mb-0">{{ $subject->name }}</p>
    </div>
</div>
@endsection