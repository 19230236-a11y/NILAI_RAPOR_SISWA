@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Dashboard Sistem Raport</h1>
    <p>Selamat datang di sistem pengarsipan dan perhitungan nilai rapor siswa SMA.</p>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Students</h5>
                    <p class="card-text">Kelola data siswa.</p>
                    <a href="{{ route('students.index') }}" class="btn btn-primary">Go</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Subjects</h5>
                    <p class="card-text">Kelola mata pelajaran.</p>
                    <a href="{{ route('subjects.index') }}" class="btn btn-primary">Go</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Teachers</h5>
                    <p class="card-text">Kelola data guru.</p>
                    <a href="{{ route('teachers.index') }}" class="btn btn-primary">Go</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection