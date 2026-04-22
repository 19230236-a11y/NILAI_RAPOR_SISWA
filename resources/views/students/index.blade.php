@extends('layouts.app')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
    <div>
        <h2 class="mb-1">Data Siswa</h2>
        <p class="text-secondary mb-0">Daftar lengkap siswa untuk kebutuhan administrasi akademik.</p>
    </div>
    <a href="{{ route('students.create') }}" class="btn btn-brand">+ Tambah Siswa</a>
</div>

<div class="row g-3 mb-3">
    <div class="col-12">
        <form method="GET" action="{{ route('students.index') }}" class="d-flex gap-2 flex-wrap">
            <input type="text" name="search" placeholder="Cari nama atau NIS..." class="form-control" value="{{ $search ?? '' }}" style="min-width: 250px;">
            <button type="submit" class="btn btn-outline-primary">Cari</button>
            @if($search)
                <a href="{{ route('students.index') }}" class="btn btn-outline-secondary">Reset</a>
            @endif
        </form>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-hover align-middle">
        <thead>
            <tr>
                <th style="cursor: pointer;">
                    <a href="{{ route('students.index', array_merge(request()->query(), ['sort' => 'nis', 'direction' => $sort === 'nis' && $direction === 'asc' ? 'desc' : 'asc'])) }}" class="text-dark text-decoration-none">
                        NIS
                        @if($sort === 'nis')
                            <i class="fas fa-arrow-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                        @endif
                    </a>
                </th>
                <th style="cursor: pointer;">
                    <a href="{{ route('students.index', array_merge(request()->query(), ['sort' => 'name', 'direction' => $sort === 'name' && $direction === 'asc' ? 'desc' : 'asc'])) }}" class="text-dark text-decoration-none">
                        Nama
                        @if($sort === 'name')
                            <i class="fas fa-arrow-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                        @endif
                    </a>
                </th>
                <th>Gender</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($students as $student)
                <tr>
                    <td>{{ $student->nis }}</td>
                    <td class="fw-semibold">{{ $student->name }}</td>
                    <td>{{ $student->gender === 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                    <td class="text-center">
                        <div class="d-flex flex-wrap justify-content-center gap-2">
                            <a href="{{ route('students.show', $student) }}" class="btn btn-sm btn-outline-primary">Detail</a>
                            <a href="{{ route('students.edit', $student) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                            <form action="{{ route('students.destroy', $student) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus siswa ini?')">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center text-secondary py-4">Belum ada data siswa.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-3">
    {{ $students->links() }}
</div>
@endsection
