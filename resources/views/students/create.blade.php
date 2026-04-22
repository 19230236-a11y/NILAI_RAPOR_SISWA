@extends('layouts.app')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
    <div>
        <h2 class="mb-1">Tambah Siswa</h2>
        <p class="text-secondary mb-0">Isi data siswa baru untuk dimasukkan ke sistem.</p>
    </div>
    <a href="{{ route('students.index') }}" class="btn btn-outline-secondary">Kembali</a>
</div>

@include('components.form-errors')

<form action="{{ route('students.store') }}" method="POST" class="card border-0 shadow-sm">
    <div class="card-body">
        @csrf
        <div class="mb-3">
            <label for="nis" class="form-label">NIS</label>
            <input id="nis" type="text" name="nis" value="{{ old('nis') }}" class="form-control @error('nis') is-invalid @enderror" required>
            @error('nis') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" required>
            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label for="gender" class="form-label">Gender</label>
            <select id="gender" name="gender" class="form-select @error('gender') is-invalid @enderror" required>
                <option value="L" {{ old('gender') === 'L' ? 'selected' : '' }}>Laki-laki</option>
                <option value="P" {{ old('gender') === 'P' ? 'selected' : '' }}>Perempuan</option>
            </select>
            @error('gender') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label for="birth_date" class="form-label">Tanggal Lahir</label>
            <input id="birth_date" type="date" name="birth_date" value="{{ old('birth_date') }}" class="form-control @error('birth_date') is-invalid @enderror" required>
            @error('birth_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-0">
            <label for="address" class="form-label">Alamat</label>
            <textarea id="address" name="address" class="form-control @error('address') is-invalid @enderror" rows="4" required>{{ old('address') }}</textarea>
            @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
    </div>
    <div class="card-footer bg-white border-0 d-flex justify-content-end gap-2">
        <a href="{{ route('students.index') }}" class="btn btn-light border">Batal</a>
        <button type="submit" class="btn btn-brand">Simpan</button>
    </div>
</form>
@endsection