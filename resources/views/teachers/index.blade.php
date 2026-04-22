@extends('layouts.app')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
    <div>
        <h2 class="mb-1">Data Guru</h2>
        <p class="text-secondary mb-0">Daftar pendidik yang mengajar di sekolah.</p>
    </div>
    <a href="{{ route('teachers.create') }}" class="btn btn-brand">+ Tambah Guru</a>
</div>

<div class="row g-3 mb-3">
    <div class="col-12">
        <form method="GET" action="{{ route('teachers.index') }}" class="d-flex gap-2 flex-wrap">
            <input type="text" name="search" placeholder="Cari nama atau NIP..." class="form-control" value="{{ $search ?? '' }}" style="min-width: 250px;">
            <button type="submit" class="btn btn-outline-primary">Cari</button>
            @if($search)
                <a href="{{ route('teachers.index') }}" class="btn btn-outline-secondary">Reset</a>
            @endif
        </form>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-hover align-middle">
        <thead>
            <tr>
                <th style="cursor: pointer;">
                    <a href="{{ route('teachers.index', array_merge(request()->query(), ['sort' => 'nip', 'direction' => $sort === 'nip' && $direction === 'asc' ? 'desc' : 'asc'])) }}" class="text-dark text-decoration-none">
                        NIP
                        @if($sort === 'nip')
                            <i class="fas fa-arrow-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                        @endif
                    </a>
                </th>
                <th style="cursor: pointer;">
                    <a href="{{ route('teachers.index', array_merge(request()->query(), ['sort' => 'name', 'direction' => $sort === 'name' && $direction === 'asc' ? 'desc' : 'asc'])) }}" class="text-dark text-decoration-none">
                        Nama
                        @if($sort === 'name')
                            <i class="fas fa-arrow-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                        @endif
                    </a>
                </th>
                <th>Mapel</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($teachers as $teacher)
                <tr>
                    <td>{{ $teacher->nip }}</td>
                    <td class="fw-semibold">{{ $teacher->name }}</td>
                    <td>{{ $teacher->subject->name ?? '-' }}</td>
                    <td class="text-center">
                        <div class="d-flex flex-wrap justify-content-center gap-2">
                            <a href="{{ route('teachers.show', $teacher) }}" class="btn btn-sm btn-outline-primary">Detail</a>
                            <a href="{{ route('teachers.edit', $teacher) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                            <form action="{{ route('teachers.destroy', $teacher) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus guru ini?')">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center text-secondary py-4">Belum ada data guru.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-3">
    {{ $teachers->links() }}
</div>
@endsection
