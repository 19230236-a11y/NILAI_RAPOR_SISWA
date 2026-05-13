@extends('layouts.app')

@section('title', 'Tambah Siswa')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="h4 mb-1">Tambah Siswa Baru</h2>
        <p class="text-muted mb-0">Isi formulir di bawah untuk menambahkan siswa</p>
    </div>
    <a href="{{ route('students.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-2"></i>Kembali
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form method="POST" action="{{ route('students.store') }}">
            @csrf
            <input type="hidden" name="program_id" value="{{ $programId ?? '' }}">
            
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="nis" class="form-label">NIS <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('nis') is-invalid @enderror" id="nis" name="nis" value="{{ old('nis') }}" required>
                    @error('nis')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6">
                    <label for="nisn" class="form-label">NISN</label>
                    <input type="text" class="form-control @error('nisn') is-invalid @enderror" id="nisn" name="nisn" value="{{ old('nisn') }}">
                    @error('nisn')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-12">
                    <label for="name" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6">
                    <label for="gender" class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                    <select class="form-select @error('gender') is-invalid @enderror" id="gender" name="gender" required>
                        <option value="">Pilih...</option>
                        <option value="L" {{ old('gender') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ old('gender') == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    @error('gender')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6">
                    <label for="birth_date" class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                    <input type="date" class="form-control @error('birth_date') is-invalid @enderror" id="birth_date" name="birth_date" value="{{ old('birth_date') }}" required>
                    @error('birth_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-12">
                    <label for="birth_place" class="form-label">Tempat Lahir <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('birth_place') is-invalid @enderror" id="birth_place" name="birth_place" value="{{ old('birth_place') }}" required>
                    @error('birth_place')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-12">
                    <label for="address" class="form-label">Alamat</label>
                    <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="3">{{ old('address') }}</textarea>
                    @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6">
                    <label for="phone" class="form-label">No. Telepon</label>
                    <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}">
                    @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6">
                    <label for="parent_name" class="form-label">Nama Orang Tua</label>
                    <input type="text" class="form-control @error('parent_name') is-invalid @enderror" id="parent_name" name="parent_name" value="{{ old('parent_name') }}">
                    @error('parent_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-12 mt-4">
                    <button type="submit" class="btn btn-brand">
                        <i class="bi bi-check-lg me-2"></i>Simpan
                    </button>
                    <a href="{{ route('students.index') }}" class="btn btn-outline-secondary ms-2">
                        Batal
                    </a>
                </div>
            </div>

            <hr class="my-4">
            <h5>Input Nilai (opsional)</h5>
            <p class="text-muted">Tambahkan nilai untuk satu atau lebih mata pelajaran. Kosongkan jika tidak perlu.</p>

            <div id="grades-wrapper">
                <div class="grade-row row g-3 mb-2">
                    <div class="col-md-3">
                        <select name="grades[0][subject_id]" class="form-select">
                            <option value="">Pilih Mata Pelajaran</option>
                            @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select name="grades[0][class_id]" class="form-select">
                            <option value="">Pilih Kelas</option>
                            @foreach($classes as $class)
                            <option value="{{ $class->id }}">{{ $class->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select name="grades[0][teacher_id]" class="form-select">
                            <option value="">Guru</option>
                            @foreach($teachers as $teacher)
                            <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-1">
                        <input type="number" step="0.01" name="grades[0][nilai_tugas]" class="form-control" placeholder="Tgs">
                    </div>
                    <div class="col-md-1">
                        <input type="number" step="0.01" name="grades[0][nilai_uts]" class="form-control" placeholder="UTS">
                    </div>
                    <div class="col-md-1">
                        <input type="number" step="0.01" name="grades[0][nilai_uas]" class="form-control" placeholder="UAS">
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-outline-secondary btn-sm remove-grade">Hapus</button>
                    </div>
                </div>
            </div>

            <div class="mt-2">
                <button type="button" id="add-grade" class="btn btn-sm btn-outline-primary">Tambah Baris Nilai</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    (function(){
        let idx = 1;
        document.getElementById('add-grade').addEventListener('click', function(){
            const wrapper = document.getElementById('grades-wrapper');
            const template = wrapper.querySelector('.grade-row').cloneNode(true);
            // update inputs names
            template.querySelectorAll('select, input').forEach(function(el){
                const name = el.getAttribute('name');
                if (!name) return;
                const newName = name.replace(/grades\[\d+\]/, 'grades['+idx+']');
                el.setAttribute('name', newName);
                if (el.tagName === 'INPUT') el.value = '';
                if (el.tagName === 'SELECT') el.selectedIndex = 0;
            });
            wrapper.appendChild(template);
            idx++;
        });

        document.getElementById('grades-wrapper').addEventListener('click', function(e){
            if (e.target.classList.contains('remove-grade')){
                const rows = document.querySelectorAll('#grades-wrapper .grade-row');
                if (rows.length === 1) {
                    // clear fields instead of removing last
                    rows[0].querySelectorAll('select, input').forEach(el => { if (el.tagName === 'INPUT') el.value = ''; else el.selectedIndex = 0; });
                } else {
                    e.target.closest('.grade-row').remove();
                }
            }
        });
    })();
</script>
@endsection