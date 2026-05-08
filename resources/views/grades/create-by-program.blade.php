@extends('layouts.app')

@section('title', 'Input Nilai - ' . $program->name)

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
        <h2 class="mb-1">Input Nilai Per Jurusan</h2>
        <p class="text-secondary mb-0">Jurusan: <strong>{{ $program->name }}</strong></p>
    </div>
    <a href="{{ route('programs.show', $program) }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-2"></i>Kembali
    </a>
</div>

@include('components.form-errors')

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form action="{{ route('grades.store') }}" method="POST">
            @csrf
            
            <div class="row g-3">
                <div class="col-12 col-md-6">
                    <label class="form-label">Siswa <span class="text-danger">*</span></label>
                    <select name="student_id" class="form-select" id="studentSelect" required>
                        <option value="">-- Pilih Siswa --</option>
                        @foreach($students as $student)
                            <option value="{{ $student->id }}" data-nis="{{ $student->nis }}">{{ $student->nis }} - {{ $student->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 col-md-6">
                    <label class="form-label">Mata Pelajaran <span class="text-danger">*</span></label>
                    <select name="subject_id" class="form-select" required>
                        <option value="">-- Pilih Mata Pelajaran --</option>
                        @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 col-md-6">
                    <label class="form-label">Guru <span class="text-danger">*</span></label>
                    <select name="teacher_id" class="form-select" required>
                        <option value="">-- Pilih Guru --</option>
                        @foreach($teachers as $teacher)
                            <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 col-md-6">
                    <label class="form-label">Kelas <span class="text-danger">*</span></label>
                    <select name="class_id" class="form-select" required>
                        <option value="">-- Pilih Kelas --</option>
                        @foreach($classes as $class)
                            <option value="{{ $class->id }}">{{ $class->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 col-md-6">
                    <label class="form-label">Tahun Ajaran <span class="text-danger">*</span></label>
                    <select name="school_year_id" class="form-select" required>
                        <option value="">-- Pilih Tahun Ajaran --</option>
                        @foreach($years as $year)
                            <option value="{{ $year->id }}">{{ $year->year }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 col-md-6">
                    <label class="form-label">Semester <span class="text-danger">*</span></label>
                    <select name="semester_id" class="form-select" required>
                        <option value="">-- Pilih Semester --</option>
                        @foreach($semesters as $semester)
                            <option value="{{ $semester->id }}">{{ $semester->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12">
                    <hr class="my-3">
                    <h5>Nilai Siswa</h5>
                </div>

                <div class="col-12 col-md-4">
                    <label class="form-label">Nilai Tugas (30%) <span class="text-danger">*</span></label>
                    <input type="number" name="nilai_tugas" class="form-control nilai-input" step="0.01" min="0" max="100" placeholder="0-100" value="{{ old('nilai_tugas') }}" required>
                    <small class="text-secondary">Bobot: 30% dari nilai akhir</small>
                </div>

                <div class="col-12 col-md-4">
                    <label class="form-label">Nilai UTS (30%) <span class="text-danger">*</span></label>
                    <input type="number" name="nilai_uts" class="form-control nilai-input" step="0.01" min="0" max="100" placeholder="0-100" value="{{ old('nilai_uts') }}" required>
                    <small class="text-secondary">Bobot: 30% dari nilai akhir</small>
                </div>

                <div class="col-12 col-md-4">
                    <label class="form-label">Nilai UAS (40%) <span class="text-danger">*</span></label>
                    <input type="number" name="nilai_uas" class="form-control nilai-input" step="0.01" min="0" max="100" placeholder="0-100" value="{{ old('nilai_uas') }}" required>
                    <small class="text-secondary">Bobot: 40% dari nilai akhir</small>
                </div>

                <div class="col-12 col-md-12">
                    <label class="form-label">Nilai Akhir (Otomatis)</label>
                    <input type="text" class="form-control" id="nilaiAkhir" disabled placeholder="Nilai akhir akan dihitung otomatis">
                </div>
            </div>

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-brand">
                    <i class="bi bi-check-circle me-2"></i>Simpan Nilai
                </button>
                <a href="{{ route('programs.show', $program) }}" class="btn btn-outline-secondary">
                    <i class="bi bi-x-circle me-2"></i>Batal
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    // Calculate final grade
    document.querySelectorAll('.nilai-input').forEach(input => {
        input.addEventListener('input', function() {
            const tugas = parseFloat(document.querySelector('input[name="nilai_tugas"]').value) || 0;
            const uts = parseFloat(document.querySelector('input[name="nilai_uts"]').value) || 0;
            const uas = parseFloat(document.querySelector('input[name="nilai_uas"]').value) || 0;

            const akhir = (tugas * 0.3) + (uts * 0.3) + (uas * 0.4);
            document.getElementById('nilaiAkhir').value = akhir.toFixed(2);
        });
    });
</script>
@endsection
