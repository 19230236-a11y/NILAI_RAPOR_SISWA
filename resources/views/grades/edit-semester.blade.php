@extends('layouts.app')

@section('title', 'Edit Nilai Semester - ' . $student->name)

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
        <h2 class="mb-1">Edit Nilai Semester</h2>
        <p class="text-secondary mb-0">Siswa: <strong>{{ $student->name }}</strong> ({{ $student->nis }})</p>
        <p class="text-secondary mb-0">{{ $semester->name }} - {{ $schoolYear->year }}</p>
    </div>
    <a href="{{ route('students.show', $student) }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-2"></i>Kembali
    </a>
</div>

@include('components.form-errors')

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form action="{{ route('grades.semester-update', ['student' => $student, 'semesterId' => $semester->id, 'yearId' => $schoolYear->id]) }}" method="POST">
            @csrf
            @method('PATCH')

            @if($grades->isEmpty())
                <div class="alert alert-warning">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    Belum ada nilai untuk semester ini
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>Mata Pelajaran</th>
                                <th style="width: 150px">Nilai (0-100)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($grades as $grade)
                                <tr>
                                    <td>{{ $grade->subject->name ?? '-' }}</td>
                                    <td>
                                        <input type="number" 
                                               name="grades[{{ $grade->id }}]" 
                                               class="form-control form-control-sm" 
                                               step="0.01" 
                                               min="0" 
                                               max="100" 
                                               value="{{ $grade->nilai }}"
                                               placeholder="0-100">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-brand">
                    <i class="bi bi-check-circle me-2"></i>Simpan Perubahan
                </button>
                <a href="{{ route('students.show', $student) }}" class="btn btn-outline-secondary">
                    <i class="bi bi-x-circle me-2"></i>Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
