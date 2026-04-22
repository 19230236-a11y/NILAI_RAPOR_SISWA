@extends('layouts.app')

@section('content')
<div class="d-flex flex-column flex-lg-row align-items-lg-end justify-content-between gap-3 mb-4">
    <div>
        <h2 class="mb-1">Dashboard Sistem Rapor</h2>
        <p class="text-secondary mb-0">Akses semua fitur inti dengan cepat dari satu halaman.</p>
    </div>
    <div class="d-flex flex-wrap gap-2">
        <a href="{{ route('students.create') }}" class="btn btn-brand">Tambah Siswa</a>
        <a href="{{ route('subjects.create') }}" class="btn btn-outline-primary">Tambah Mapel</a>
        <a href="{{ route('teachers.create') }}" class="btn btn-outline-primary">Tambah Guru</a>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-12 col-md-4">
        <article class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <p class="text-secondary text-uppercase small mb-1">Total Siswa</p>
                <p class="display-6 mb-0 fw-bold">{{ number_format($stats['students'] ?? 0) }}</p>
            </div>
        </article>
    </div>
    <div class="col-12 col-md-4">
        <article class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <p class="text-secondary text-uppercase small mb-1">Total Mapel</p>
                <p class="display-6 mb-0 fw-bold">{{ number_format($stats['subjects'] ?? 0) }}</p>
            </div>
        </article>
    </div>
    <div class="col-12 col-md-4">
        <article class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <p class="text-secondary text-uppercase small mb-1">Total Guru</p>
                <p class="display-6 mb-0 fw-bold">{{ number_format($stats['teachers'] ?? 0) }}</p>
            </div>
        </article>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-12 col-md-6 col-xl-4">
        <article class="card h-100 border-0 shadow-sm">
            <div class="card-body">
                <h3 class="h5">Data Siswa</h3>
                <p class="text-secondary">Kelola profil, biodata, dan pembaruan data siswa.</p>
                <div class="d-flex gap-2">
                    <a href="{{ route('students.index') }}" class="btn btn-sm btn-brand">Lihat Data</a>
                    <a href="{{ route('students.create') }}" class="btn btn-sm btn-light border">Tambah</a>
                </div>
            </div>
        </article>
    </div>
    <div class="col-12 col-md-6 col-xl-4">
        <article class="card h-100 border-0 shadow-sm">
            <div class="card-body">
                <h3 class="h5">Mata Pelajaran</h3>
                <p class="text-secondary">Atur daftar mapel yang digunakan dalam penilaian rapor.</p>
                <div class="d-flex gap-2">
                    <a href="{{ route('subjects.index') }}" class="btn btn-sm btn-brand">Lihat Data</a>
                    <a href="{{ route('subjects.create') }}" class="btn btn-sm btn-light border">Tambah</a>
                </div>
            </div>
        </article>
    </div>
    <div class="col-12 col-md-6 col-xl-4">
        <article class="card h-100 border-0 shadow-sm">
            <div class="card-body">
                <h3 class="h5">Data Guru</h3>
                <p class="text-secondary">Kelola identitas guru dan relasi guru ke mata pelajaran.</p>
                <div class="d-flex gap-2">
                    <a href="{{ route('teachers.index') }}" class="btn btn-sm btn-brand">Lihat Data</a>
                    <a href="{{ route('teachers.create') }}" class="btn btn-sm btn-light border">Tambah</a>
                </div>
            </div>
        </article>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <h3 class="h6 text-uppercase text-secondary mb-2">Alur kerja cepat</h3>
        <ol class="mb-0">
            <li>Tambahkan Mata Pelajaran terlebih dahulu.</li>
            <li>Tambahkan data Guru dan hubungkan ke mapel.</li>
            <li>Tambahkan data Siswa lalu lanjut proses akademik.</li>
        </ol>
    </div>
</div>
@endsection