@extends('layouts.app')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
    <div>
        <h2 class="mb-1">Data Mapel</h2>
        <p class="text-secondary mb-0">Daftar mata pelajaran yang tersedia dalam kurikulum.</p>
    </div>
    <a href="{{ route('subjects.create') }}" class="btn btn-brand">+ Tambah Mapel</a>
</div>

<div class="row g-3 mb-3">
    <div class="col-12">
        <form method="GET" action="{{ route('subjects.index') }}" class="d-flex gap-2 flex-wrap">
            <input type="text" name="search" placeholder="Cari nama mapel..." class="form-control" value="{{ $search ?? '' }}" style="min-width: 250px;">
            <button type="submit" class="btn btn-outline-primary">Cari</button>
            @if($search)
                <a href="{{ route('subjects.index') }}" class="btn btn-outline-secondary">Reset</a>
            @endif
        </form>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-hover align-middle">
        <thead>
            <tr>
                <th style="cursor: pointer;">
                    <a href="{{ route('subjects.index', array_merge(request()->query(), ['sort' => 'name', 'direction' => $sort === 'name' && $direction === 'asc' ? 'desc' : 'asc'])) }}" class="text-dark text-decoration-none">
                        Nama Mapel
                        @if($sort === 'name')
                            <i class="fas fa-arrow-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                        @endif
                    </a>
                </th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($subjects as $subject)
                <tr>
                    <td class="fw-semibold">{{ $subject->name }}</td>
                    <td class="text-center">
                        <div class="d-flex flex-wrap justify-content-center gap-2">
                            <a href="{{ route('subjects.show', $subject) }}" class="btn btn-sm btn-outline-primary">Detail</a>
                            <a href="{{ route('subjects.edit', $subject) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                            <form action="{{ route('subjects.destroy', $subject) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus mapel ini?')">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="2" class="text-center text-secondary py-4">Belum ada data mapel.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-3">
    {{ $subjects->links() }}
</div>
@endsection
