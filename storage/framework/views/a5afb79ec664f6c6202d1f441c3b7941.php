<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Sistem Rapor Siswa'); ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;700&family=Source+Sans+3:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        :root {
            --brand-ink: #14213d;
            --brand-sky: #4f7cff;
            --brand-mint: #2ccfb0;
            --surface-soft: #f3f7ff;
            --text-main: #1a2238;
            --sidebar-width: 280px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Source Sans 3", sans-serif;
            color: var(--text-main);
            background:
                radial-gradient(circle at 15% 10%, rgba(93, 173, 226, 0.08), transparent 30%),
                radial-gradient(circle at 85% 20%, rgba(52, 152, 219, 0.06), transparent 28%),
                linear-gradient(180deg, #f0f7fb 0%, #f5f9fc 50%, #fafbfc 100%);
            min-height: 100vh;
            margin-left: var(--sidebar-width);
        }

        h1, h2, h3, h4, h5, .navbar-brand {
            font-family: "Space Grotesk", sans-serif;
        }

        .skip-link {
            position: absolute;
            left: 0;
            top: -48px;
            z-index: 2000;
            background: #0b1736;
            color: #ffffff;
            padding: 0.5rem 0.75rem;
            transition: top 0.2s ease;
        }

        .skip-link:focus {
            top: 0;
        }

        /* SIDEBAR STYLING */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: linear-gradient(135deg, #5DADE2 0%, #2980B9 100%);
            box-shadow: 4px 0 20px rgba(45, 128, 185, 0.25);
            padding: 2rem 0;
            overflow-y: auto;
            z-index: 1000;
            display: flex;
            flex-direction: column;
        }

        .sidebar-brand {
            padding: 0.5rem 1rem 1rem;
            border-bottom: 2px solid rgba(255, 255, 255, 0.2);
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .sidebar-brand a {
            color: #ffffff;
            text-decoration: none;
            font-weight: 700;
            font-size: 1.4rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            transition: all 0.3s ease;
        }

        .sidebar-brand a:hover {
            opacity: 0.9;
            transform: scale(1.02);
        }

        .sidebar-brand img {
            width: 50px !important;
            height: 50px !important;
            object-fit: contain;
            font-size: 1.8rem;
        }

        .sidebar-brand div {
            font-size: 0.95rem;
            font-weight: 700;
            line-height: 1.2;
        }

        .sidebar-menu {
            flex: 1;
            padding: 0 1rem;
            overflow-y: auto;
        }

        .sidebar-menu .menu-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.9rem 1.2rem;
            color: #ffffff;
            text-decoration: none;
            border-radius: 10px;
            transition: all 0.25s ease;
            margin-bottom: 0.6rem;
            font-weight: 600;
            cursor: pointer;
            position: relative;
            font-size: 0.95rem;
            letter-spacing: 0.3px;
        }

        .sidebar-menu .menu-item span {
            color: #ffffff;
            font-weight: 600;
        }

        .sidebar-menu .menu-item:hover {
            background-color: rgba(255, 255, 255, 0.15);
            color: #ffffff;
            transform: translateX(4px);
        }

        .sidebar-menu .menu-item.active {
            background-color: rgba(255, 255, 255, 0.2);
            color: #ffffff;
            box-shadow: inset 3px 0 0 #ffffff;
        }

        .sidebar-menu .menu-item i {
            font-size: 1.3rem;
            flex-shrink: 0;
        }

        .sidebar-menu .menu-item.dropdown-toggle {
            background-color: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.15);
            font-weight: 700;
            padding: 1rem 1.2rem;
        }

        .sidebar-menu .menu-item.dropdown-toggle:hover {
            background-color: rgba(255, 255, 255, 0.15);
        }

        .sidebar-menu .menu-item.dropdown-toggle span {
            font-weight: 700;
            font-size: 0.98rem;
        }

        /* Dropdown Menu in Sidebar */
        .sidebar-menu .menu-item.dropdown-toggle::after {
            content: '';
            margin-left: auto;
            width: 0.4rem;
            height: 0.4rem;
            border-right: 2px solid currentColor;
            border-bottom: 2px solid currentColor;
            transform: rotate(-45deg) translateY(-0.2rem);
            transition: transform 0.3s ease;
        }

        .sidebar-menu .menu-item[data-bs-toggle="collapse"][aria-expanded="true"]::after {
            transform: rotate(45deg) translateY(0.2rem);
        }

        .sidebar-menu .collapse {
            padding-left: 0;
            margin-top: 0.3rem;
        }

        .sidebar-menu .collapse .menu-item {
            padding-left: 3.2rem;
            font-size: 0.9rem;
            color: #ffffff;
            margin-bottom: 0.4rem;
            font-weight: 500;
        }

        .sidebar-menu .collapse .menu-item span {
            color: #ffffff;
        }

        .sidebar-menu .collapse .menu-item:hover {
            color: #ffffff;
        }

        /* Sidebar Dropdown Menu */
        .sidebar-menu .dropdown {
            position: relative;
        }

        .sidebar-menu .dropdown-toggle {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .sidebar-menu .dropdown-toggle::after {
            display: inline-block;
            margin-left: auto;
            vertical-align: 0.255em;
            content: "";
            border-top: 0.3em solid currentColor;
            border-right: 0.3em solid transparent;
            border-bottom: 0;
            border-left: 0.3em solid transparent;
            transition: transform 0.3s ease;
        }

        .sidebar-menu .dropdown-toggle[aria-expanded="true"]::after {
            transform: rotate(180deg);
        }

        .sidebar-menu .dropdown-menu {
            position: static;
            float: none;
            width: 100%;
            margin: 0.3rem 0 0 0;
            padding: 0.4rem 0 0 1.5rem;
            border: none;
            background-color: transparent;
            box-shadow: none;
        }

        .sidebar-menu .dropdown-menu .dropdown-item {
            padding: 0.5rem 0.8rem;
            color: rgba(255, 255, 255, 0.85);
            font-size: 0.9rem;
            font-weight: 500;
            border-radius: 6px;
            transition: all 0.25s ease;
            margin-bottom: 0.3rem;
        }

        .sidebar-menu .dropdown-menu .dropdown-item:hover {
            background-color: rgba(255, 255, 255, 0.15);
            color: #ffffff;
            transform: translateX(4px);
        }

        .sidebar-menu .dropdown-menu .dropdown-item.active {
            background-color: rgba(255, 255, 255, 0.2);
            color: #ffffff;
        }

        .sidebar-menu .dropdown-menu .dropdown-item.disabled {
            cursor: not-allowed;
            opacity: 0.6;
        }

        .sidebar-footer {
            padding: 0.8rem 0.6rem 1rem;
            border-top: 2px solid rgba(255, 255, 255, 0.2);
            margin-top: auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.6rem;
        }

        .user-profile {
            background-color: rgba(255, 255, 255, 0.12);
            border-radius: 50%;
            width: 45px;
            height: 45px;
            color: rgba(255, 255, 255, 0.95);
            font-size: 1rem;
            text-align: center;
            margin: 0;
            border: 2px solid rgba(255, 255, 255, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            position: relative;
            cursor: pointer;
            transition: all 0.3s ease;
            flex-shrink: 0;
        }

        .user-profile:hover {
            background-color: rgba(255, 255, 255, 0.2);
            transform: scale(1.05);
        }

        .user-profile[title]::before {
            content: attr(title);
            position: absolute;
            bottom: -80px;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(0, 0, 0, 0.8);
            color: #ffffff;
            padding: 0.5rem 0.75rem;
            border-radius: 6px;
            font-size: 0.75rem;
            white-space: nowrap;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease;
            z-index: 1001;
        }

        .user-profile:hover[title]::before {
            opacity: 1;
        }

        .user-profile .user-name {
            display: none;
        }

        .user-profile .user-role {
            display: none;
        }

        .sidebar-logout {
            flex: 1;
            text-align: left;
            border: none;
            background: rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.9);
            padding: 0.6rem 0.8rem;
            border-radius: 8px;
            transition: all 0.25s ease;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            font-weight: 600;
            font-size: 0.85rem;
        }

        .sidebar-logout:hover {
            background-color: rgba(255, 255, 255, 0.2);
            color: #ffffff;
            transform: translateX(4px);
        }

        .glass-panel {
            background-color: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(20, 33, 61, 0.08);
            border-radius: 16px;
            box-shadow: 0 14px 30px rgba(20, 33, 61, 0.08);
        }

        .hero-strip {
            border-radius: 18px;
            background: linear-gradient(135deg, #5DADE2 0%, #2980B9 100%);
            color: #f4f8ff;
            padding: 2.5rem 2rem;
            margin-bottom: 1.5rem;
            animation: riseIn 0.45s ease-out;
            position: relative;
            overflow: hidden;
            box-shadow: 0 8px 32px rgba(45, 128, 185, 0.25);
        }
        
        .hero-strip::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            z-index: 0;
        }
        
        .hero-strip::after {
            content: '';
            position: absolute;
            bottom: -20%;
            left: -5%;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.08);
            border-radius: 50%;
            z-index: 0;
        }
        
        .hero-strip > * {
            position: relative;
            z-index: 1;
        }
        
        .hero-strip h1 {
            font-weight: 700;
            letter-spacing: 0.5px;
        }
        
        .hero-strip p {
            font-size: 0.95rem;
            font-weight: 500;
        }

        .btn-brand {
            background: linear-gradient(90deg, var(--brand-sky), #6a91ff);
            border: 0;
            color: #fff;
            font-weight: 600;
        }

        @keyframes riseIn {
            from {
                opacity: 0;
                transform: translateY(8px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .stat-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(20, 33, 61, 0.12);
        }

        /* Scrollbar Styling */
        .sidebar-menu::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar-menu::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.05);
        }

        .sidebar-menu::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 3px;
        }

        .sidebar-menu::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.5);
        }

        @media (max-width: 768px) {
            body {
                margin-left: 0;
            }

            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
                width: 250px;
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .sidebar-toggle {
                display: block !important;
                position: fixed;
                top: 1rem;
                left: 1rem;
                z-index: 999;
            }
        }

        @media (min-width: 769px) {
            .sidebar-toggle {
                display: none !important;
            }
        }
    </style>
    <?php echo $__env->yieldPushContent('style'); ?>
</head>
<body>
    <a href="#main-content" class="skip-link">Lewati ke konten utama</a>

    <!-- SIDEBAR -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <a href="<?php echo e(route('dashboard')); ?>" title="Kembali ke Dashboard">
                <img src="/img/logo.png" alt="Logo SMK SEHATI" style="width: 50px; height: 50px; object-fit: contain;">
                <div style="display: flex; flex-direction: column; align-items: center; gap: 0.25rem; font-size: 0.95rem; font-weight: 700; line-height: 1.2;">
                    <span>SMK SEHATI<br>KARAWANG</span>
                </div>
            </a>
        </div>

        <nav class="sidebar-menu">
            <!-- Dashboard -->
            <a href="<?php echo e(route('dashboard')); ?>" class="menu-item <?php echo e(request()->routeIs('dashboard') ? 'active' : ''); ?>">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>

            <?php if(auth()->guard()->check()): ?>
                <?php if(Auth::user()->role === 'staff_tu'): ?>
                    <?php
                        $programs = \App\Models\Program::all();
                    ?>

                    <!-- Data Master -->
                    <div style="border-top: 1px solid rgba(255,255,255,0.2); margin: 1rem 0; padding: 0.5rem 1rem; font-size: 0.75rem; text-transform: uppercase; color: rgba(255,255,255,0.6);">Data Master</div>

                    <!-- Program Links -->
                    <?php $__currentLoopData = $programs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $program): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('students.index', ['program' => $program->id])); ?>" class="menu-item <?php echo e(request()->input('program') == $program->id ? 'active' : ''); ?>">
                        <i class="bi bi-mortarboard"></i>
                        <span><?php echo e($program->name); ?></span>
                    </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <!-- NOTE: Removed global Input Nilai menu items; input/laporan nilai available per-program -->
                <?php elseif(Auth::user()->role === 'kepala_sekolah'): ?>
                    <a href="<?php echo e(route('users.index')); ?>" class="menu-item <?php echo e(request()->routeIs('users.*') ? 'active' : ''); ?>">
                        <i class="bi bi-people-fill"></i>
                        <span>Kelola Akun</span>
                    </a>
                <?php endif; ?>

                <?php if(Auth::user()->role === 'admin'): ?>
                    <a href="<?php echo e(route('users.index')); ?>" class="menu-item <?php echo e(request()->routeIs('users.*') ? 'active' : ''); ?>">
                        <i class="bi bi-people-fill"></i>
                        <span>Pengguna</span>
                    </a>
                <?php endif; ?>
            <?php endif; ?>
        </nav>

        <?php if(auth()->guard()->check()): ?>
        <div class="sidebar-footer">
            <div class="user-profile" title="<?php echo e(Auth::user()->name); ?> - <?php echo e(Auth::user()->role_label); ?>">
                <?php
                    $names = explode(' ', Auth::user()->name);
                    $initials = strtoupper(substr($names[0], 0, 1)) . (isset($names[1]) ? strtoupper(substr($names[1], 0, 1)) : '');
                ?>
                <?php echo e($initials); ?>

                <span class="user-name"><?php echo e(Auth::user()->name); ?></span>
                <span class="user-role"><?php echo e(Auth::user()->role_label); ?></span>
            </div>
            <form method="POST" action="<?php echo e(route('logout')); ?>" style="margin: 0;">
                <?php echo csrf_field(); ?>
                <button type="submit" class="sidebar-logout">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>
        <?php endif; ?>
    </aside>

    <button class="btn btn-dark sidebar-toggle d-lg-none" type="button" id="sidebarToggle" aria-label="Toggle sidebar">
        <i class="bi bi-list"></i>
    </button>

    <main id="main-content" style="padding: 2rem 1.5rem;">
        <section class="hero-strip">
            <div>
                <h1 class="h4 mb-2">BUKU INDUK REGISTER PESERTA DIDIK</h1>
                <p class="mb-0 opacity-75">Fokus pada pengarsipan nilai rapor siswa per jurusan, semester, dan kelas.</p>
            </div>
        </section>

        <?php if(session('success')): ?>
            <div class="alert alert-success border-0 shadow-sm" role="status" aria-live="polite">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <section class="glass-panel p-3 p-lg-4">
            <?php if(View::hasSection('content')): ?>
                <?php echo $__env->yieldContent('content'); ?>
            <?php else: ?>
                <?php echo $__env->yieldContent('main'); ?>
            <?php endif; ?>
        </section>
    </main>

    <?php if(session('success')): ?>
        <div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div id="successToast" class="toast text-bg-success border-0" role="status" aria-live="polite" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        <?php echo e(session('success')); ?>

                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Sidebar Toggle for Mobile
        document.addEventListener('DOMContentLoaded', function () {
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebar = document.getElementById('sidebar');

            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', function () {
                    sidebar.classList.toggle('show');
                });
            }

            // Close sidebar when a menu item is clicked
            const menuItems = sidebar.querySelectorAll('.menu-item:not(.dropdown-toggle)');
            menuItems.forEach(item => {
                item.addEventListener('click', function () {
                    sidebar.classList.remove('show');
                });
            });

            // Success Toast
            var toastEl = document.getElementById('successToast');
            if (toastEl) {
                var toast = new bootstrap.Toast(toastEl, { delay: 2600 });
                toast.show();
            }
        });
    </script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html><?php /**PATH D:\NILAI_RAPOR_SISWA\resources\views\layouts\app.blade.php ENDPATH**/ ?>