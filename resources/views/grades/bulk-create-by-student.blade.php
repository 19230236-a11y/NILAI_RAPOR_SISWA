@extends('layouts.app')

@section('title', 'Input Nilai - ' . $student->name)

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
        <h2 class="mb-1">Input Nilai - Semua Pelajaran</h2>
        <p class="text-secondary mb-0">Siswa: <strong>{{ $student->name }}</strong> ({{ $student->nis }})</p>
    </div>
    <a href="{{ route('students.show', $student) }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-2"></i>Kembali
    </a>
</div>

@include('components.form-errors')

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form action="{{ route('students.grades.bulk-store', $student) }}" method="POST" id="bulkGradesForm">
            @csrf
            
            <!-- Filter Section -->
            <div class="row g-3 mb-4">
                <div class="col-12">
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
                    <select name="school_year_id" class="form-select" id="yearSelect" required>
                        <option value="">-- Pilih Tahun --</option>
                        @foreach($years as $year)
                            <option value="{{ $year->id }}">{{ $year->year }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 col-md-6">
                    <label class="form-label">Semester <span class="text-danger">*</span></label>
                    <select name="semester_id" class="form-select" id="semesterSelect" required>
                        <option value="">-- Pilih Semester --</option>
                        @foreach($semesters as $semester)
                            <option value="{{ $semester->id }}">{{ $semester->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <hr class="my-4">

            <!-- Combined Subjects and Grades Table -->
            <div class="mb-4">
                <h5 class="mb-3">Input Nilai Semua Pelajaran</h5>

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>Mata Pelajaran Umum</th>
                                <th style="width: 150px">Nilai (0-100)</th>
                            </tr>
                        </thead>
                        <tbody id="subjectsTableBody">
                            <!-- Mata Pelajaran Umum -->
                            @foreach($subjects as $subject)
                                <tr>
                                    <td>
                                        <input type="hidden" name="grades[{{ $loop->index }}][subject_id]" value="{{ $subject->id }}">
                                        {{ $subject->name }}
                                    </td>
                                    <td>
                                        <input type="number" name="grades[{{ $loop->index }}][nilai]" class="form-control form-control-sm nilai-input" 
                                               step="0.01" min="0" max="100" placeholder="0-100">
                                    </td>
                                </tr>
                            @endforeach

                            <!-- Divider untuk Mata Pelajaran Jurusan -->
                            <tr class="table-secondary">
                                <td colspan="2" class="fw-bold text-muted">Mata Pelajaran Jurusan</td>
                            </tr>

                            <!-- Mata Pelajaran Jurusan -->
                            @for($i = 1; $i <= 6; $i++)
                                <tr>
                                    <td>
                                        <input type="text" name="jurusan_subject_{{ $i }}" class="form-control form-control-sm" 
                                               placeholder="Nama mata pelajaran jurusan...">
                                    </td>
                                    <td>
                                        <input type="number" name="jurusan_nilai_{{ $i }}" class="form-control form-control-sm nilai-input" 
                                               step="0.01" min="0" max="100" placeholder="0-100">
                                    </td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-brand">
                    <i class="bi bi-check-circle me-2"></i>Simpan Semua Nilai
                </button>
                <a href="{{ route('students.show', $student) }}" class="btn btn-outline-secondary">
                    <i class="bi bi-x-circle me-2"></i>Batal
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    // Form submission
    document.getElementById('bulkGradesForm').addEventListener('submit', function(e) {
        e.preventDefault();

        // Validate required fields
        if (!document.getElementById('yearSelect').value) {
            alert('Pilih tahun ajaran terlebih dahulu');
            return;
        }
        if (!document.getElementById('semesterSelect').value) {
            alert('Pilih semester terlebih dahulu');
            return;
        }

        // Check if any grades are filled
        const nilaiInputs = document.querySelectorAll('.nilai-input');
        const hasAnyValue = Array.from(nilaiInputs).some(input => input.value);
        
        if (!hasAnyValue) {
            alert('Masukkan minimal satu nilai');
            return;
        }

        this.submit();
    });
</script>
@endsection
