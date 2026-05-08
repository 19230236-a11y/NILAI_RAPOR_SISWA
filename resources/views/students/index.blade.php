@extends('layouts.app')

@section('title', 'Data Siswa')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="h4 mb-1">Data Siswa</h2>
        <p class="text-muted mb-0">Kelola data siswa sekolah</p>
    </div>
    <a href="{{ route('students.create') }}" class="btn btn-brand">
        <i class="bi bi-plus-lg me-2"></i>Tambah Siswa
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <!-- Search Form -->
        <form method="GET" action="{{ route('students.index') }}" class="mb-4">
            <div class="row g-3">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Cari NIS atau nama..." value="{{ $search }}">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-outline-primary w-100">
                        <i class="bi bi-search me-1"></i>Cari
                    </button>
                </div>
                @if($search)
                <div class="col-md-2">
                    <a href="{{ route('students.index') }}" class="btn btn-outline-secondary w-100">
                        <i class="bi bi-x-circle me-1"></i>Reset
                    </a>
                </div>
                @endif
            </div>
        </form>

        <!-- Table -->
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th><a href="{{ route('students.index', ['sort' => 'nis', 'direction' => $sort === 'nis' && $direction === 'asc' ? 'desc' : 'asc'] + Request::except(['sort', 'direction'])) }}" class="text-decoration-none text-dark">NIS {{ $sort === 'nis' ? ($direction === 'asc' ? '↑' : '↓') : '' }}</a></th>
                        <th><a href="{{ route('students.index', ['sort' => 'name', 'direction' => $sort === 'name' && $direction === 'asc' ? 'desc' : 'asc'] + Request::except(['sort', 'direction'])) }}" class="text-decoration-none text-dark">Nama {{ $sort === 'name' ? ($direction === 'asc' ? '↑' : '↓') : '' }}</a></th>
                        <th>Jenis Kelamin</th>
                        <th>Tanggal Lahir</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($students as $student)
                    <tr>
                        <td>{{ $student->nis }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                        <td>{{ \Carbon\Carbon::parse($student->birth_date)->format('d/m/Y') }}</td>
                        <td>{{ Str::limit($student->address, 30) ?? '-' }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('students.show', $student) }}" class="btn btn-sm btn-outline-primary" title="Lihat">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('students.edit', $student) }}" class="btn btn-sm btn-outline-warning" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form method="POST" action="{{ route('students.destroy', $student) }}" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus" onclick="return confirm('Yakin hapus data siswa ini?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">
                            @if($search)
                            Data siswa tidak ditemukan
                            @else
                            Belum ada data siswa
                            @endif
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $students->links() }}
        </div>
    </div>
</div>
@endsection