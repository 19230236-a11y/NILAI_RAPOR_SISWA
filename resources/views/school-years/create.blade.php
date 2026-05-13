@extends('layouts.app')

@section('title', 'Tambah Tahun Ajaran')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div><h2 class="h4 mb-1">Tambah Tahun Ajaran</h2></div>
    <a href="{{ route('school-years.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-2"></i>Kembali</a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form method="POST" action="{{ route('school-years.store') }}">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="year" class="form-label">Tahun Ajaran <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('year') is-invalid @enderror" id="year" name="year" value="{{ old('year') }}" placeholder="Contoh: 2024/2025" required>
                    @error('year')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label for="is_active" class="form-label">Status</label>
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active') ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">Jadikan tahun ajaran aktif</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="start_date" class="form-label">Tanggal Mulai</label>
                    <input type="date" class="form-control" id="start_date" name="start_date" value="{{ old('start_date') }}">
                </div>
                <div class="col-md-6">
                    <label for="end_date" class="form-label">Tanggal Selesai</label>
                    <input type="date" class="form-control" id="end_date" name="end_date" value="{{ old('end_date') }}">
                </div>
                <div class="col-12 mt-4">
                    <button type="submit" class="btn btn-brand"><i class="bi bi-check-lg me-2"></i>Simpan</button>
                    <a href="{{ route('school-years.index') }}" class="btn btn-outline-secondary ms-2">Batal</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection