@extends('layouts.app')

@section('title', 'Input Nilai - ' . $program->name)

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
        <h2 class="mb-1">Input Nilai Siswa - Semua Pelajaran</h2>
        <p class="text-secondary mb-0">Jurusan: <strong>{{ $program->name }}</strong></p>
    </div>
    <a href="{{ route('programs.show', $program) }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-2"></i>Kembali
    </a>
</div>

@include('components.form-errors')

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form action="{{ route('programs.grades.bulk-store', $program) }}" method="POST" id="bulkGradesForm">
            @csrf
            
            <!-- Filter Section -->
            <div class="row g-3 mb-4">
                <div class="col-12 col-md-3">
                    <label class="form-label">Siswa <span class="text-danger">*</span></label>
                    <select name="student_id" class="form-select" id="studentSelect" required>
                        <option value="">-- Pilih Siswa --</option>
                        @foreach($students as $student)
                            <option value="{{ $student->id }}">{{ $student->nis }} - {{ $student->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 col-md-3">
                    <label class="form-label">Kelas <span class="text-danger">*</span></label>
                    <select name="class_id" class="form-select" id="classSelect" required>
                        <option value="">-- Pilih Kelas --</option>
                        @foreach($classes as $class)
                            <option value="{{ $class->id }}">{{ $class->display_name_without_level }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 col-md-3">
                    <label class="form-label">Tahun Ajaran <span class="text-danger">*</span></label>
                    <select name="school_year_id" class="form-select" id="yearSelect" required>
                        <option value="">-- Pilih Tahun --</option>
                        @foreach($years as $year)
                            <option value="{{ $year->id }}">{{ $year->year }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 col-md-3">
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
                <div class="alert alert-info">
                    <i class="bi bi-info-circle me-2"></i>
                    Pilih siswa terlebih dahulu untuk menampilkan daftar pelajaran
                </div>

                <div id="subjectsContainer" class="d-none">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>Mata Pelajaran</th>
                                    <th style="width: 150px">Nilai (0-100)</th>
                                </tr>
                            </thead>
                            <tbody id="subjectsTableBody">
                                <!-- Populated by JavaScript -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-brand">
                    <i class="bi bi-check-circle me-2"></i>Simpan Semua Nilai
                </button>
                <a href="{{ route('programs.show', $program) }}" class="btn btn-outline-secondary">
                    <i class="bi bi-x-circle me-2"></i>Batal
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    const subjects = @json($subjects);

    // Handle student selection
    document.getElementById('studentSelect').addEventListener('change', function() {
        const studentId = this.value;
        if (!studentId) {
            document.getElementById('subjectsContainer').classList.add('d-none');
            return;
        }

        // Show container
        document.getElementById('subjectsContainer').classList.remove('d-none');

        // Populate subjects table
        const tbody = document.getElementById('subjectsTableBody');
        tbody.innerHTML = '';

        subjects.forEach((subject, index) => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>
                    <input type="hidden" name="grades[${index}][subject_id]" value="${subject.id}">
                    ${subject.name}
                </td>
                <td>
                    <input type="number" name="grades[${index}][nilai]" class="form-control form-control-sm nilai-input" 
                           step="0.01" min="0" max="100" placeholder="0-100">
                </td>
            `;
            tbody.appendChild(row);
        });
    });

    // Form submission
    document.getElementById('bulkGradesForm').addEventListener('submit', function(e) {
        e.preventDefault();

        // Validate required fields
        if (!document.getElementById('studentSelect').value) {
            alert('Pilih siswa terlebih dahulu');
            return;
        }
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
