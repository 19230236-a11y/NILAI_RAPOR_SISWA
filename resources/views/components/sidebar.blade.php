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

            <!-- Program Items from Database -->
            @forelse($programs ?? [] as $program)
                <li class="nav-item {{ request()->is('programs/' . $program->id . '*') ? 'active' : '' }}">
                    <a href="{{ route('programs.show', $program) }}" class="nav-link">
                        @php
                            $logoName = match($program->code) {
                                'FK' => 'Logo-Farmasi.png',
                                'AK' => 'Logo-Keperawatan.png',
                                'TKJ' => 'Logo-TKJ.png',
                                'TSM' => 'Logo-TBSM.png',
                                'TKR' => 'Logo-TKRO.png',
                                default => 'logo.png'
                            };
                        @endphp
                        <img src="{{ asset('img/' . $logoName) }}" alt="{{ $program->name }}" class="program-logo">
                        <span>{{ $program->name }}</span>
                    </a>
                </li>
            @empty
                <li class="nav-item">
                    <a href="#" class="nav-link disabled">
                        <i class="fas fa-graduation-cap"></i>
                        <span>Tidak ada program</span>
                    </a>
                </li>
            @endforelse

            <li class="nav-item {{ request()->is('permissions*') ? 'active' : '' }}">
                <a href="{{ Route::has('permissions.index') ? route('permissions.index') : url('permissions') }}" class="nav-link">
                    <i class="fas fa-columns"></i>
                    <span>User</span>
                </a>
            </li>

    </aside>
</div>
