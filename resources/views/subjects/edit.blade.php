@extends('layouts.app')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
    <div>
        <h2 class="mb-1">Edit Mata Pelajaran</h2>
        <p class="text-secondary mb-0">Perbarui nama mapel sesuai kurikulum terbaru.</p>
    </div>
    <a href="{{ route('subjects.index') }}" class="btn btn-outline-secondary">Kembali</a>
</div>

@include('components.form-errors')

<form action="{{ route('subjects.update', $subject) }}" method="POST" class="card border-0 shadow-sm">
    <div class="card-body">
        @csrf
        @method('PUT')
        <div class="mb-0">
            <label for="name" class="form-label">Nama Mata Pelajaran</label>
            <input id="name" type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $subject->name) }}" required>
            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
    </div>
    <div class="card-footer bg-white border-0 d-flex justify-content-end gap-2">
        <a href="{{ route('subjects.index') }}" class="btn btn-light border">Batal</a>
        <button type="submit" class="btn btn-brand">Update</button>
    </div>
</form>
@endsection