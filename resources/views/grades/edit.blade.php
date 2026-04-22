@extends('layouts.app')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
    <div>
        <h2 class="mb-1">Edit Nilai Rapor</h2>
        <p class="text-secondary mb-0">Perbarui nilai tugas, UTS, dan UAS siswa.</p>
    </div>
</div>

@include('components.form-errors')

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form action="{{ route('grades.update', $grade) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row g-3">
                <div class="col-12 col-md-6">
                    <label class="form-label">Siswa <span class="text-danger">*</span></label>
                    <select name="student_id" class="form-select" required>
                        @foreach($students as $student)
                            <option value="{{ $student->id }}" {{ old('student_id', $grade->student_id) == $student->id ? 'selected' : '' }}>
                                {{ $student->name }} ({{ $student->nis }})
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="col-12 col-md-6">
                    <label class="form-label">Mapel <span class="text-danger">*</span></label>
                    <select name="subject_id" class="form-select" required>
                        @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}" {{ old('subject_id', $grade->subject_id) == $subject->id ? 'selected' : '' }}>
                                {{ $subject->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="col-12 col-md-6">
                    <label class="form-label">Guru Pengajar <span class="text-danger">*</span></label>
                    <select name="teacher_id" class="form-select" required>
                        @foreach($teachers as $teacher)
                            <option value="{{ $teacher->id }}" {{ old('teacher_id', $grade->teacher_id) == $teacher->id ? 'selected' : '' }}>
                                {{ $teacher->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="col-12 col-md-6">
                    <label class="form-label">Kelas <span class="text-danger">*</span></label>
                    <select name="class_id" class="form-select" required>
                        @foreach($classes as $class)
                            <option value="{{ $class->id }}" {{ old('class_id', $grade->class_id) == $class->id ? 'selected' : '' }}>
                                {{ $class->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="col-12 col-md-6">
                    <label class="form-label">Tahun Ajaran <span class="text-danger">*</span></label>
                    <select name="school_year_id" class="form-select" required>
                        @foreach($years as $year)
                            <option value="{{ $year->id }}" {{ old('school_year_id', $grade->school_year_id) == $year->id ? 'selected' : '' }}>
                                {{ $year->year }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="col-12 col-md-6">
                    <label class="form-label">Semester <span class="text-danger">*</span></label>
                    <select name="semester_id" class="form-select" required>
                        @foreach($semesters as $semester)
                            <option value="{{ $semester->id }}" {{ old('semester_id', $grade->semester_id) == $semester->id ? 'selected' : '' }}>
                                {{ $semester->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="col-12">
                    <hr class="my-3">
                    <h5>Nilai Siswa</h5>
                </div>
                
                <div class="col-12 col-md-4">
                    <label class="form-label">Nilai Tugas (30%) <span class="text-danger">*</span></label>
                    <input type="number" name="nilai_tugas" class="form-control" step="0.01" min="0" max="100" value="{{ old('nilai_tugas', $grade->nilai_tugas) }}" required>
                    <small class="text-secondary">Bobot: 30% dari nilai akhir</small>
                </div>
                
                <div class="col-12 col-md-4">
                    <label class="form-label">Nilai UTS (30%) <span class="text-danger">*</span></label>
                    <input type="number" name="nilai_uts" class="form-control" step="0.01" min="0" max="100" value="{{ old('nilai_uts', $grade->nilai_uts) }}" required>
                    <small class="text-secondary">Bobot: 30% dari nilai akhir</small>
                </div>
                
                <div class="col-12 col-md-4">
                    <label class="form-label">Nilai UAS (40%) <span class="text-danger">*</span></label>
                    <input type="number" name="nilai_uas" class="form-control" step="0.01" min="0" max="100" value="{{ old('nilai_uas', $grade->nilai_uas) }}" required>
                    <small class="text-secondary">Bobot: 40% dari nilai akhir</small>
                </div>
                
                <div class="col-12">
                    <div class="alert alert-info">
                        <strong>Nilai Akhir Otomatis:</strong> {{ number_format($grade->nilai_akhir, 2) }}
                        <span class="badge bg-primary ms-2">
                            @php
                                $grade_letter = 'E';
                                if ($grade->nilai_akhir >= 85) $grade_letter = 'A';
                                elseif ($grade->nilai_akhir >= 75) $grade_letter = 'B';
                                elseif ($grade->nilai_akhir >= 65) $grade_letter = 'C';
                                elseif ($grade->nilai_akhir >= 55) $grade_letter = 'D';
                            @endphp
                            Grade: {{ $grade_letter }}
                        </span>
                    </div>
                </div>
            </div>
            
            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-brand">Perbarui Nilai</button>
                <a href="{{ route('grades.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
