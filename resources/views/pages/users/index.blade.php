@extends('layouts.app')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
    <div>
        <h2 class="mb-1">Manajemen Pengguna</h2>
        <p class="text-secondary mb-0">Kelola akun pengguna sistem akademik.</p>
    </div>
    <a href="{{ route('users.create') }}" class="btn btn-brand">+ Tambah Pengguna</a>
</div>

<div class="row g-3 mb-3">
    <div class="col-12 col-md-6">
        <form method="GET" action="{{ route('users.index') }}" class="d-flex gap-2">
            <input type="text" name="name" placeholder="Cari nama pengguna..." class="form-control" value="{{ request('name') }}">
            <button type="submit" class="btn btn-outline-primary">Cari</button>
            @if(request('name'))
                <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">Reset</a>
            @endif
        </form>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-hover align-middle">
        <thead>
            <tr>
                <th>Email</th>
                <th>Nama</th>
                <th>Role</th>
                <th>Posisi</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
                <tr>
                    <td>{{ $user->email }}</td>
                    <td class="fw-semibold">{{ $user->name }}</td>
                    <td>{{ $user->role ?? '-' }}</td>
                    <td>{{ $user->position ?? '-' }}</td>
                    <td class="text-center">
                        <div class="d-flex flex-wrap justify-content-center gap-2">
                            <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                            <form action="{{ route('users.destroy', $user) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus pengguna ini?')">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-secondary py-4">Tidak ada pengguna ditemukan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-3">
    {{ $users->links() }}
</div>

@endsection
