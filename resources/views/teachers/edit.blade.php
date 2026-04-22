@extends('layouts.app')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
    <div>
        <h2 class="mb-1">Edit Guru</h2>
        <p class="text-secondary mb-0">Perbarui data guru dan mapel pengampu.</p>
    </div>
    <a href="{{ route('teachers.index') }}" class="btn btn-outline-secondary">Kembali</a>
</div>

@include('components.form-errors')

<form action="{{ route('teachers.update', $teacher) }}" method="POST" class="card border-0 shadow-sm">
    <div class="card-body">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nip" class="form-label">NIP</label>
            <input id="nip" type="text" name="nip" class="form-control @error('nip') is-invalid @enderror" value="{{ old('nip', $teacher->nip) }}" required>
            @error('nip') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input id="name" type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $teacher->name) }}" required>
            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-0">
            <label for="subject_id" class="form-label">Mata Pelajaran</label>
            <select id="subject_id" name="subject_id" class="form-select @error('subject_id') is-invalid @enderror" required>
                @foreach($subjects as $subject)
                <option value="{{ $subject->id }}" {{ (string) old('subject_id', $teacher->subject_id) === (string) $subject->id ? 'selected' : '' }}>{{ $subject->name }}</option>
                @endforeach
            </select>
            @error('subject_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
    </div>
    <div class="card-footer bg-white border-0 d-flex justify-content-end gap-2">
        <a href="{{ route('teachers.index') }}" class="btn btn-light border">Batal</a>
        <button type="submit" class="btn btn-brand">Update</button>
    </div>
</form>
@endsection