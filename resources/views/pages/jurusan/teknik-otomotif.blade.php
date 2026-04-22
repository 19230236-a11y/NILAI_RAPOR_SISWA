@extends('layouts.app')

@section('title', 'Teknik Otomotif')

@push('style')
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Teknik Otomotif</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">Teknik Otomotif</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        @include('layouts.alert')
                    </div>
                </div>
                <h2 class="section-title">Data Siswa - Teknik Otomotif</h2>
                <p class="section-lead">Kelola data absensi siswa jurusan Teknik Otomotif.</p>

                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Daftar Siswa</h4>
                                <div class="card-header-action">
                                    <a href="#" class="btn btn-primary">
                                        <i class="fas fa-plus"></i> Tambah Siswa
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="float-right">
                                    <form method="GET" action="{{ route('jurusan.teknik-otomotif') }}">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Cari nama siswa..." name="name" value="{{ request('name') }}">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="clearfix mb-3"></div>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>NISN</th>
                                                <th>Nama</th>
                                                <th>Kelas</th>
                                                <th>Tahun Lulus</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($siswa as $index => $s)
                                                <tr>
                                                    <td>{{ $siswa->firstItem() + $index }}</td>
                                                    <td>{{ $s->nisn ?? '-' }}</td>
                                                    <td>{{ $s->name }}</td>
                                                    <td>{{ $s->kelas ?? '-' }}</td>
                                                    <td>{{ $s->tahun_lulus ?? '-' }}</td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <a href="{{ route('users.edit', $s->id) }}" class="btn btn-sm btn-info btn-icon mr-1">
                                                                <i class="fas fa-edit"></i> Edit
                                                            </a>
                                                            <form action="{{ route('users.destroy', $s->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn btn-sm btn-danger btn-icon confirm-delete">
                                                                    <i class="fas fa-times"></i> Hapus
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6" class="text-center text-muted">Belum ada data siswa.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <div class="float-right">
                                    {{ $siswa->withQueryString()->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('js/page/features-posts.js') }}"></script>
@endpush
