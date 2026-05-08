@extends('layouts.app')

@section('title', 'Edit Kelas')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div><h2 class="h4 mb-1">Edit Kelas</h2></div>
    <a href="{{ route('classes.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-2"></i>Kembali</a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form method="POST" action="{{ route('classes.update', $class) }}">
            @csrf @method('PUT')
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="name" class="form-label">Nama Kelas <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $class->name) }}" required>
                </div>
                <div class="col-md-6">
                    <label for="level" class="form-label">Tingkat</label>
                    <input type="number" class="form-control" id="level" name="level" value="{{ old('level', $class->level) }}" min="1" max="12">
                </div>
                <div class="col-md-6">
                    <label for="jurusan" class="form-label">Jurusan</label>
                    <input type="text" class="form-control" id="jurusan" name="jurusan" value="{{ old('jurusan', $class->jurusan) }}">
                </div>
                <div class="col-md-6">
                    <label for="wali_kelas" class="form-label">Wali Kelas</label>
                    <input type="text" class="form-control" id="wali_kelas" name="wali_kelas" value="{{ old('wali_kelas', $class->wali_kelas) }}">
                </div>
                <div class="col-12 mt-4">
                    <button type="submit" class="btn btn-brand"><i class="bi bi-check-lg me-2"></i>Simpan</button>
                    <a href="{{ route('classes.index') }}" class="btn btn-outline-secondary ms-2">Batal</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection