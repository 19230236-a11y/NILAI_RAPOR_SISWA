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
                            <option value="{{ $student->id }}" data-nis="{{ $student->nis }}" data-name="{{ $student->name }}">{{ $student->nis }} - {{ $student->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 col-md-6">
                    <label class="form-label">Mata Pelajaran <span class="text-danger">*</span></label>
                    <select name="subject_id" class="form-select" id="subjectSelect" required>
                        <option value="">-- Pilih Mata Pelajaran --</option>
                        @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}" data-name="{{ $subject->name }}">{{ $subject->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 col-md-6">
                    <label class="form-label">Kelas <span class="text-danger">*</span></label>
                    <select name="class_id" class="form-select" required>
                        <option value="">-- Pilih Kelas --</option>
                        @foreach($classes as $class)
                            <option value="{{ $class->id }}">{{ $class->display_name_without_level }}</option>
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
                    <div id="selectedInfo" class="alert alert-info d-none">
                        <div><strong>Siswa:</strong> <span id="studentName"></span></div>
                        <div><strong>Mata Pelajaran:</strong> <span id="subjectName"></span></div>
                    </div>
                </div>

                <div class="col-12">
                    <label class="form-label">Nilai <span class="text-danger">*</span></label>
                    <input type="number" name="nilai" class="form-control" step="0.01" min="0" max="100" placeholder="0-100" value="{{ old('nilai') }}" required>
                    <small class="text-secondary">Masukkan nilai mata pelajaran (0-100)</small>
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
    // Update selected info display
    function updateSelectedInfo() {
        const studentSelect = document.getElementById('studentSelect');
        const subjectSelect = document.getElementById('subjectSelect');
        const selectedInfo = document.getElementById('selectedInfo');
        
        const studentOption = studentSelect.options[studentSelect.selectedIndex];
        const subjectOption = subjectSelect.options[subjectSelect.selectedIndex];
        
        const studentName = studentOption.getAttribute('data-name');
        const subjectName = subjectOption.getAttribute('data-name');
        
        if (studentName && subjectName) {
            document.getElementById('studentName').textContent = studentName;
            document.getElementById('subjectName').textContent = subjectName;
            selectedInfo.classList.remove('d-none');
        } else {
            selectedInfo.classList.add('d-none');
        }
    }
    
    document.getElementById('studentSelect').addEventListener('change', updateSelectedInfo);
    document.getElementById('subjectSelect').addEventListener('change', updateSelectedInfo);
</script>
@endsection
