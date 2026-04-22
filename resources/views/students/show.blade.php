@extends('layouts.app')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
    <div>
        <h2 class="mb-1">Detail Siswa</h2>
        <p class="text-secondary mb-0">Informasi lengkap profil siswa.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('students.edit', $student) }}" class="btn btn-outline-warning">Edit</a>
        <a href="{{ route('students.index') }}" class="btn btn-outline-secondary">Kembali</a>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-6">
                <p class="text-secondary mb-1">NIS</p>
                <p class="fw-semibold mb-0">{{ $student->nis }}</p>
            </div>
            <div class="col-md-6">
                <p class="text-secondary mb-1">Nama</p>
                <p class="fw-semibold mb-0">{{ $student->name }}</p>
            </div>
            <div class="col-md-6">
                <p class="text-secondary mb-1">Gender</p>
                <p class="fw-semibold mb-0">{{ $student->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
            </div>
            <div class="col-md-6">
                <p class="text-secondary mb-1">Tanggal Lahir</p>
                <p class="fw-semibold mb-0">{{ $student->birth_date }}</p>
            </div>
            <div class="col-12">
                <p class="text-secondary mb-1">Alamat</p>
                <p class="fw-semibold mb-0">{{ $student->address }}</p>
            </div>
        </div>
    </div>
</div>
@endsection