<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Rapor Siswa')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;700&family=Source+Sans+3:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --brand-ink: #14213d;
            --brand-sky: #4f7cff;
            --brand-mint: #2ccfb0;
            --surface-soft: #f3f7ff;
            --text-main: #1a2238;
        }

        body {
            font-family: "Source Sans 3", sans-serif;
            color: var(--text-main);
            background:
                radial-gradient(circle at 15% 10%, rgba(79, 124, 255, 0.20), transparent 30%),
                radial-gradient(circle at 85% 20%, rgba(44, 207, 176, 0.20), transparent 28%),
                linear-gradient(180deg, #eef4ff 0%, #f9fbff 50%, #ffffff 100%);
            min-height: 100vh;
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

        .top-nav {
            backdrop-filter: blur(8px);
            background-color: rgba(255, 255, 255, 0.88);
            border-bottom: 1px solid rgba(20, 33, 61, 0.08);
        }

        .glass-panel {
            background-color: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(20, 33, 61, 0.08);
            border-radius: 16px;
            box-shadow: 0 14px 30px rgba(20, 33, 61, 0.08);
        }

        .hero-strip {
            border-radius: 18px;
            background: linear-gradient(120deg, var(--brand-ink), #223e70 58%, #32508c 100%);
            color: #f4f8ff;
            padding: 1.25rem 1.5rem;
            margin-bottom: 1.25rem;
            animation: riseIn 0.45s ease-out;
        }

        .nav-pills .nav-link {
            border-radius: 999px;
            font-weight: 600;
            color: #24365d;
        }

        .nav-pills .nav-link.active {
            background: linear-gradient(90deg, var(--brand-sky), #5f8cff);
            color: #ffffff;
        }

        .btn-brand {
            background: linear-gradient(90deg, var(--brand-sky), #6a91ff);
            border: 0;
            color: #fff;
            font-weight: 600;
        }

        .btn-brand:hover,
        .btn-brand:focus {
            color: #fff;
            filter: brightness(0.95);
        }

        .table thead th {
            background-color: #edf3ff;
            color: #1d3157;
            border-bottom-width: 0;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(79, 124, 255, 0.08);
        }

        .form-control,
        .form-select,
        textarea {
            border-radius: 12px;
            border: 1px solid #c8d5f5;
        }

        .form-control:focus,
        .form-select:focus,
        textarea:focus,
        .btn:focus,
        .nav-link:focus {
            box-shadow: 0 0 0 0.2rem rgba(79, 124, 255, 0.25);
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
    </style>
    @stack('style')
</head>
<body>
    <a href="#main-content" class="skip-link">Lewati ke konten utama</a>

    <nav class="navbar navbar-expand-lg top-nav sticky-top" aria-label="Navigasi utama aplikasi">
        <div class="container py-2">
            <a class="navbar-brand fw-bold" href="{{ route('home') }}">Sistem Rapor</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Buka menu navigasi">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav ms-lg-4 me-auto mb-2 mb-lg-0 nav nav-pills gap-1">
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('students.*') ? 'active' : '' }}" href="{{ route('students.index') }}">Siswa</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('subjects.*') ? 'active' : '' }}" href="{{ route('subjects.index') }}">Mapel</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('teachers.*') ? 'active' : '' }}" href="{{ route('teachers.index') }}">Guru</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <main id="main-content" class="container py-4 py-lg-5">
        <section class="hero-strip">
            <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3">
                <div>
                    <h1 class="h4 mb-1">Panel Akademik Sekolah</h1>
                    <p class="mb-0 opacity-75">Kelola data siswa, guru, dan mata pelajaran dalam satu alur kerja.</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('students.create') }}" class="btn btn-light btn-sm">Tambah Siswa</a>
                    <a href="{{ route('teachers.create') }}" class="btn btn-light btn-sm">Tambah Guru</a>
                </div>
            </div>
        </section>

        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm" role="status" aria-live="polite">
                {{ session('success') }}
            </div>
        @endif

        <section class="glass-panel p-3 p-lg-4">
            @if(View::hasSection('content'))
                @yield('content')
            @else
                @yield('main')
            @endif
        </section>
    </main>

    @if(session('success'))
        <div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div id="successToast" class="toast text-bg-success border-0" role="status" aria-live="polite" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('success') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var toastEl = document.getElementById('successToast');
                if (toastEl) {
                    var toast = new bootstrap.Toast(toastEl, { delay: 2600 });
                    toast.show();
                }
            });
        </script>
    @endif
    @stack('scripts')
</body>
</html>
