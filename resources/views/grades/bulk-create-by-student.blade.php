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
                <div class="col-12 col-md-4">
                    <label class="form-label">Kelas <span class="text-danger">*</span></label>
                    <select name="class_id" class="form-select" id="classSelect" required>
                        <option value="">-- Pilih Kelas --</option>
                        @foreach($classes as $class)
                            <option value="{{ $class->id }}">{{ $class->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 col-md-4">
                    <label class="form-label">Tahun Ajaran <span class="text-danger">*</span></label>
                    <select name="school_year_id" class="form-select" id="yearSelect" required>
                        <option value="">-- Pilih Tahun --</option>
                        @foreach($years as $year)
                            <option value="{{ $year->id }}">{{ $year->year }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 col-md-4">
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

            <!-- Subjects and Grades Section -->
            <div class="mb-4">
                <h5 class="mb-3">Nilai Pelajaran</h5>

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>Mata Pelajaran</th>
                                <th>Guru</th>
                                <th style="width: 120px">Tugas (30%)</th>
                                <th style="width: 120px">UTS (30%)</th>
                                <th style="width: 120px">UAS (40%)</th>
                                <th style="width: 120px">Nilai Akhir</th>
                            </tr>
                        </thead>
                        <tbody id="subjectsTableBody">
                            @foreach($subjects as $subject)
                                <tr>
                                    <td>
                                        <input type="hidden" name="grades[{{ $loop->index }}][subject_id]" value="{{ $subject->id }}">
                                        {{ $subject->name }}
                                    </td>
                                    <td>
                                        <select name="grades[{{ $loop->index }}][teacher_id]" class="form-select form-select-sm">
                                            <option value="">-- Pilih Guru --</option>
                                            @foreach($teachers as $teacher)
                                                <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" name="grades[{{ $loop->index }}][nilai_tugas]" class="form-control form-control-sm nilai-input" 
                                               step="0.01" min="0" max="100" placeholder="0-100">
                                    </td>
                                    <td>
                                        <input type="number" name="grades[{{ $loop->index }}][nilai_uts]" class="form-control form-control-sm nilai-input" 
                                               step="0.01" min="0" max="100" placeholder="0-100">
                                    </td>
                                    <td>
                                        <input type="number" name="grades[{{ $loop->index }}][nilai_uas]" class="form-control form-control-sm nilai-input" 
                                               step="0.01" min="0" max="100" placeholder="0-100">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control form-control-sm nilai-akhir" disabled placeholder="Otomatis">
                                    </td>
                                </tr>
                            @endforeach
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
    // Calculate final grade on input change
    document.querySelectorAll('.nilai-input').forEach(input => {
        input.addEventListener('input', function() {
            calculateFinalGrade(this);
        });
    });

    function calculateFinalGrade(element) {
        const row = element.closest('tr');
        const tugas = parseFloat(row.querySelector('input[name*="nilai_tugas"]').value) || 0;
        const uts = parseFloat(row.querySelector('input[name*="nilai_uts"]').value) || 0;
        const uas = parseFloat(row.querySelector('input[name*="nilai_uas"]').value) || 0;

        const akhir = (tugas * 0.3) + (uts * 0.3) + (uas * 0.4);
        row.querySelector('.nilai-akhir').value = akhir.toFixed(2);
    }

    // Form submission
    document.getElementById('bulkGradesForm').addEventListener('submit', function(e) {
        e.preventDefault();

        // Validate required fields
        if (!document.getElementById('classSelect').value) {
            alert('Pilih kelas terlebih dahulu');
            return;
        }
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
