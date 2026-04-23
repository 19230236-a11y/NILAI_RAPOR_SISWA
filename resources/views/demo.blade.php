@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Contoh Penginputan Nilai Siswa</div>
                <div class="card-body">
                    <form action="{{ route('grades.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="student_name">Nama Siswa</label>
                            <input type="text" name="student_name" id="student_name" class="form-control" placeholder="Masukkan nama siswa" required>
                        </div>
                        <div class="form-group">
                            <label for="teacher_name">Nama Guru</label>
                            <input type="text" name="teacher_name" id="teacher_name" class="form-control" placeholder="Masukkan nama guru" required>
                        </div>
                        <div class="form-group">
                            <label for="class_name">Nama Kelas</label>
                            <input type="text" name="class_name" id="class_name" class="form-control" placeholder="Masukkan nama kelas" required>
                        </div>
                        <div class="form-group">
                            <label for="score">Nilai</label>
                            <input type="number" name="score" id="score" class="form-control" min="0" max="100" required>
                        </div>
                        <div class="form-group">
                            <label for="semester">Semester</label>
                            <input type="text" name="semester" id="semester" class="form-control" placeholder="Masukkan semester (e.g., Semester 1)" required>
                        </div>
                        <div class="form-group">
                            <label for="school_year_id">Tahun Ajaran</label>
                            <select name="school_year_id" id="school_year_id" class="form-control" required>
                                <option value="">-- Pilih Tahun Ajaran --</option>
                                @foreach(\App\Models\SchoolYear::all() as $year)
                                    <option value="{{ $year->id }}">{{ $year->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan Nilai Siswa</label>
                            <textarea name="keterangan" id="keterangan" class="form-control" rows="3" placeholder="Masukkan keterangan atau catatan untuk nilai siswa ini"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan Nilai</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection