@extends('layouts.app')

@section('title', 'Input Nilai Per Pelajaran - ' . $student->name)

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
        <h2 class="mb-1">Input Nilai Per Pelajaran</h2>
        <p class="text-secondary mb-0">Siswa: <strong>{{ $student->name }}</strong> ({{ $student->nis }})</p>
    </div>
    <a href="{{ route('students.show', $student) }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-2"></i>Kembali
    </a>
</div>

@include('components.form-errors')

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form action="{{ route('students.grades.store', $student) }}" method="POST">
            @csrf

            <div class="row g-3">
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
                    <select name="class_id" class="form-select" id="classSelect" required>
                        <option value="">-- Pilih Kelas --</option>
                        @php
                            // Group classes by level
                            $classesByLevel = $classes->groupBy('level');
                        @endphp
                        @foreach(['X' => 'X', 'XI' => 'XI', 'XII' => 'XII'] as $levelCode => $levelName)
                            @if($classesByLevel->has($levelCode))
                                <optgroup label="Jenjang {{ $levelName }}">
                                    @foreach($classesByLevel[$levelCode]->sortBy('class_code') as $class)
                                        <option value="{{ $class->id }}" {{ $student->class_id == $class->id ? 'selected' : '' }}>
                                            {{ $levelName }} {{ $class->program->name }} {{ $class->class_code }}
                                        </option>
                                    @endforeach
                                </optgroup>
                            @endif
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
                </div>

                <div class="col-12">
                    <div id="selectedSubject" class="alert alert-warning d-none" role="alert" style="border-left: 4px solid #ff6b6b;">
                        <h6 class="mb-2 text-dark">📚 Mata Pelajaran Terpilih</h6>
                        <h5 class="mb-0" id="subjectName" style="color: #2f3542; font-weight: 600;"></h5>
                    </div>
                    <div id="noSubjectAlert" class="alert alert-secondary">
                        <small class="text-secondary">👆 Silakan pilih mata pelajaran terlebih dahulu</small>
                    </div>
                </div>

                <div class="col-12">
                    <label class="form-label">Nilai <span class="text-danger">*</span></label>
                    <input type="number" name="nilai" class="form-control form-control-lg" step="0.01" min="0" max="100" placeholder="0-100" value="{{ old('nilai') }}" required style="font-size: 1.1rem;">
                    <small class="text-secondary">Masukkan nilai mata pelajaran (0-100)</small>
                </div>
            </div>

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-brand">
                    <i class="bi bi-check-circle me-2"></i>Simpan Nilai
                </button>
                <a href="{{ route('students.show', $student) }}" class="btn btn-outline-secondary">
                    <i class="bi bi-x-circle me-2"></i>Batal
                </a>
            </div>
        </form>
    </div>
</div>



<script>
    // Update subject display when subject is selected
    const subjectSelect = document.getElementById('subjectSelect');
    const selectedSubjectDiv = document.getElementById('selectedSubject');
    const noSubjectAlert = document.getElementById('noSubjectAlert');
    const subjectNameSpan = document.getElementById('subjectName');
    
    // Initial state
    updateSubjectDisplay();
    
    subjectSelect.addEventListener('change', function() {
        updateSubjectDisplay();
    });
    
    function updateSubjectDisplay() {
        const selectedOption = subjectSelect.options[subjectSelect.selectedIndex];
        const subjectName = selectedOption.getAttribute('data-name');
        
        if (subjectName) {
            subjectNameSpan.textContent = subjectName;
            selectedSubjectDiv.classList.remove('d-none');
            noSubjectAlert.classList.add('d-none');
        } else {
            selectedSubjectDiv.classList.add('d-none');
            noSubjectAlert.classList.remove('d-none');
        }
    }
</script>
@endsection
