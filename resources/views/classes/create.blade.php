@extends('layouts.app')

@section('title', 'Tambah Kelas')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div><h2 class="h4 mb-1">Tambah Kelas</h2></div>
    <a href="{{ route('classes.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-2"></i>Kembali</a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form method="POST" action="{{ route('classes.store') }}">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="name" class="form-label">Nama Kelas <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Contoh: X IPA 1" required>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label for="level" class="form-label">Tingkat</label>
                    <input type="number" class="form-control" id="level" name="level" value="{{ old('level') }}" min="1" max="12" placeholder="1-12">
                </div>
                <div class="col-md-6">
                    <label for="jurusan" class="form-label">Jurusan</label>
                    <input type="text" class="form-control" id="jurusan" name="jurusan" value="{{ old('jurusan') }}" placeholder="Contoh: IPA, IPS">
                </div>
                <div class="col-md-6">
                    <label for="wali_kelas" class="form-label">Wali Kelas</label>
                    <input type="text" class="form-control" id="wali_kelas" name="wali_kelas" value="{{ old('wali_kelas') }}">
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