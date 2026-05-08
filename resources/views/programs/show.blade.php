@extends('layouts.app')

@section('title', $program->name)

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
        <h2 class="mb-1">{{ $program->name }}</h2>
        @if($program->code)
            <p class="text-secondary mb-0">Kode: {{ $program->code }}</p>
        @endif
    </div>
    <a href="{{ route('programs.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-2"></i>Kembali
    </a>
</div>

<!-- Success Message -->
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
        <i class="bi bi-check-circle me-2"></i>
        <strong>Berhasil!</strong> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<!-- Error Messages -->
@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
        <strong>Error:</strong>
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<!-- Quick Actions for Grade Input -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-header bg-white border-0">
        <h5 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Input Nilai Siswa</h5>
    </div>
    <div class="card-body">
        @include('components.form-errors')

        @if(!isset($subjects) || !isset($teachers) || !isset($classes) || !isset($years) || !isset($semesters))
            <div class="alert alert-danger mb-4">
                <strong>Error:</strong> Data form tidak lengkap. Hubungi administrator.
                <br><small>
                    subjects: {{ isset($subjects) ? 'OK (' . count($subjects) . ')' : 'MISSING' }} |
                    teachers: {{ isset($teachers) ? 'OK (' . count($teachers) . ')' : 'MISSING' }} |
                    classes: {{ isset($classes) ? 'OK (' . count($classes) . ')' : 'MISSING' }} |
                    years: {{ isset($years) ? 'OK (' . count($years) . ')' : 'MISSING' }} |
                    semesters: {{ isset($semesters) ? 'OK (' . count($semesters) . ')' : 'MISSING' }}
                </small>
            </div>
        @else
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
                            <option value="{{ $class->id }}">{{ $class->name }}</option>
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
                                    <th>Guru</th>
                                    <th style="width: 120px">Tugas (30%)</th>
                                    <th style="width: 120px">UTS (30%)</th>
                                    <th style="width: 120px">UAS (40%)</th>
                                    <th style="width: 120px">Nilai Akhir</th>
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
                <button type="reset" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-clockwise me-2"></i>Reset Form
                </button>
            </div>
        </form>
        @endif
    </div>
</div>

<!-- Program Statistics -->
<div class="row g-3 mb-4">
    <div class="col-6 col-lg-3">
        <div class="card stat-card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                            <i class="bi bi-people fs-4 text-primary"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <p class="text-muted mb-0 small">Total Siswa</p>
                        <h3 class="mb-0">{{ $students->total() }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-6 col-lg-3">
        <div class="card stat-card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="bg-success bg-opacity-10 rounded-circle p-3">
                            <i class="bi bi-bookmark fs-4 text-success"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <p class="text-muted mb-0 small">Total Kelas</p>
                        <h3 class="mb-0">{{ $program->classes->count() }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Students List -->
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white border-0">
        <h5 class="mb-0"><i class="bi bi-people me-2"></i>Daftar Siswa</h5>
    </div>
    <div class="card-body">
        @if($students->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Nama Siswa</th>
                            <th>NIS</th>
                            <th>Jenis Kelamin</th>
                            <th>Tanggal Lahir</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $student)
                            <tr>
                                <td>
                                    <strong>{{ $student->name }}</strong>
                                </td>
                                <td>{{ $student->nis ?? '-' }}</td>
                                <td>
                                    @if($student->gender === 'L')
                                        <span class="badge bg-info">Laki-laki</span>
                                    @else
                                        <span class="badge bg-danger">Perempuan</span>
                                    @endif
                                </td>
                                <td>
                                    @if($student->birth_date)
                                        {{ \Carbon\Carbon::parse($student->birth_date)->format('d M Y') }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('students.show', $student) }}" class="btn btn-sm btn-outline-primary" title="Lihat Detail">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($students->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $students->links() }}
                </div>
            @endif
        @else
            <div class="alert alert-info text-center mb-0">
                <i class="bi bi-info-circle me-2"></i>Belum ada siswa di jurusan ini.
            </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
    // Data subjects dan teachers untuk diakses JavaScript
    const subjectsData = @json($subjects);
    const teachersData = @json($teachers);

    document.addEventListener('DOMContentLoaded', function() {
        const studentSelect = document.getElementById('studentSelect');
        const subjectsContainer = document.getElementById('subjectsContainer');
        const subjectsTableBody = document.getElementById('subjectsTableBody');

        // Event listener untuk student selection
        studentSelect.addEventListener('change', function() {
            if (this.value) {
                // Tampilkan tabel subjects
                subjectsContainer.classList.remove('d-none');
                populateSubjectsTable();
            } else {
                // Sembunyikan tabel subjects jika tidak ada student yang dipilih
                subjectsContainer.classList.add('d-none');
                subjectsTableBody.innerHTML = '';
            }
        });

        function populateSubjectsTable() {
            subjectsTableBody.innerHTML = '';

            subjectsData.forEach((subject, index) => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>
                        <strong>${subject.name}</strong>
                        <input type="hidden" name="grades[${index}][subject_id]" value="${subject.id}">
                    </td>
                    <td>
                        <select name="grades[${index}][teacher_id]" class="form-select form-select-sm">
                            <option value="">-- Pilih Guru --</option>
                            ${teachersData.map(teacher => `<option value="${teacher.id}">${teacher.name}</option>`).join('')}
                        </select>
                    </td>
                    <td>
                        <input type="number" name="grades[${index}][nilai_tugas]" class="form-control form-control-sm grade-input" 
                               min="0" max="100" step="0.01" placeholder="0">
                    </td>
                    <td>
                        <input type="number" name="grades[${index}][nilai_uts]" class="form-control form-control-sm grade-input" 
                               min="0" max="100" step="0.01" placeholder="0">
                    </td>
                    <td>
                        <input type="number" name="grades[${index}][nilai_uas]" class="form-control form-control-sm grade-input" 
                               min="0" max="100" step="0.01" placeholder="0">
                    </td>
                    <td>
                        <input type="text" class="form-control form-control-sm bg-light" readonly placeholder="0.00">
                    </td>
                `;
                subjectsTableBody.appendChild(row);

                // Add event listeners untuk calculating nilai_akhir
                row.querySelectorAll('.grade-input').forEach(input => {
                    input.addEventListener('input', function() {
                        calculateFinalGrade(row);
                    });
                });
            });
        }

        function calculateFinalGrade(row) {
            const nilai_tugas = parseFloat(row.querySelector('input[name*="nilai_tugas"]').value) || 0;
            const nilai_uts = parseFloat(row.querySelector('input[name*="nilai_uts"]').value) || 0;
            const nilai_uas = parseFloat(row.querySelector('input[name*="nilai_uas"]').value) || 0;

            const nilai_akhir = ((nilai_tugas * 30) + (nilai_uts * 30) + (nilai_uas * 40)) / 100;
            row.querySelector('input[readonly]').value = nilai_akhir.toFixed(2);
        }
    });
</script>
@endpush
@endsection
