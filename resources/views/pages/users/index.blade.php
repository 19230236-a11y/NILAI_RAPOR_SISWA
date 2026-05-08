@extends('layouts.app')

@section('title', 'Manajemen Staff TU')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="h4 mb-1">Manajemen Staff TU</h2>
        <p class="text-muted mb-0">Kelola akun Staff Tata Usaha</p>
    </div>
    <a href="{{ route('users.create') }}" class="btn btn-brand">
        <i class="bi bi-plus-lg me-2"></i>Tambah Staff TU
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <!-- Search Form -->
        <form method="GET" action="{{ route('users.index') }}" class="mb-4">
            <div class="row g-3">
                <div class="col-md-4">
                    <input type="text" name="name" class="form-control" placeholder="Cari nama..." value="{{ request('name') }}">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-outline-primary w-100">
                        <i class="bi bi-search me-1"></i>Cari
                    </button>
                </div>
                @if(request('name'))
                <div class="col-md-2">
                    <a href="{{ route('users.index') }}" class="btn btn-outline-secondary w-100">
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
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Posisi</th>
                        <th>Departemen</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->position ?? '-' }}</td>
                        <td>{{ $user->department ?? '-' }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-outline-warning" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <a href="{{ route('users.reset-password', $user) }}" class="btn btn-sm btn-outline-info" title="Reset Password">
                                    <i class="bi bi-key"></i>
                                </a>
                                <form method="POST" action="{{ route('users.destroy', $user) }}" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus" onclick="return confirm('Yakin hapus akun ini?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">
                            @if(request('name'))
                            Data Staff TU tidak ditemukan
                            @else
                            Belum ada data Staff TU
                            @endif
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection
