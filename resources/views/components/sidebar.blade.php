<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">BAHRI HR</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">

            <li class="nav-item  ">
                <a href="{{ route('home') }}" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>

            <li class="nav-item {{ request()->is('jurusan/teknik-otomotif*') ? 'active' : '' }}">
                <a href="{{ Route::has('jurusan.teknik-otomotif') ? route('jurusan.teknik-otomotif') : url('jurusan/teknik-otomotif') }}" class="nav-link">
                    <i class="fas fa-cogs"></i>
                    <span>Teknik Otomotif</span>
                </a>
            </li>

            <li class="nav-item {{ request()->is('jurusan/teknik-komputer-jaringan*') ? 'active' : '' }}">
                <a href="{{ Route::has('jurusan.teknik-komputer-jaringan') ? route('jurusan.teknik-komputer-jaringan') : url('jurusan/teknik-komputer-jaringan') }}" class="nav-link">
                    <i class="fas fa-network-wired"></i>
                    <span>Teknik Komputer Jaringan</span>
                </a>
            </li>

            <li class="nav-item {{ request()->is('jurusan/keperawatan*') ? 'active' : '' }}">
                <a href="{{ Route::has('jurusan.keperawatan') ? route('jurusan.keperawatan') : url('jurusan/keperawatan') }}" class="nav-link">
                    <i class="fas fa-heartbeat"></i>
                    <span>Keperawatan</span>
                </a>
            </li>

            <li class="nav-item {{ request()->is('jurusan/farmasi*') ? 'active' : '' }}">
                <a href="{{ Route::has('jurusan.farmasi') ? route('jurusan.farmasi') : url('jurusan/farmasi') }}" class="nav-link">
                    <i class="fas fa-pills"></i>
                    <span>Farmasi</span>
                </a>
            </li>

            <li class="nav-item {{ request()->is('jurusan/teknik-kendaraan-ringan*') ? 'active' : '' }}">
                <a href="{{ Route::has('jurusan.teknik-kendaraan-ringan') ? route('jurusan.teknik-kendaraan-ringan') : url('jurusan/teknik-kendaraan-ringan') }}" class="nav-link">
                    <i class="fas fa-car"></i>
                    <span>Teknik Kendaraan Ringan</span>
                </a>
            </li>

            <li class="nav-item {{ request()->is('permissions*') ? 'active' : '' }}">
                <a href="{{ Route::has('permissions.index') ? route('permissions.index') : url('permissions') }}" class="nav-link">
                    <i class="fas fa-columns"></i>
                    <span>User</span>
                </a>
            </li>

    </aside>
</div>
