@extends('layouts.auth')

@section('title', 'Register')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/bootstrap-social/bootstrap-social.css') }}">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px 0;
        }

        .register-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            max-width: 900px;
            width: 100%;
        }

        .register-wrapper {
            display: flex;
            min-height: auto;
        }

        .register-left {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 50px 30px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .register-left::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(102, 126, 234, 0.85);
            z-index: 1;
        }

        .register-left > * {
            position: relative;
            z-index: 2;
        }

        .school-logo {
            width: 80px;
            height: 80px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            font-size: 40px;
            font-weight: bold;
            color: #667eea;
        }

        .school-name {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
            letter-spacing: 0.5px;
        }

        .school-subtitle {
            font-size: 14px;
            opacity: 0.95;
            margin-bottom: 30px;
            line-height: 1.6;
        }

        .register-benefits {
            text-align: left;
            font-size: 13px;
            opacity: 0.9;
        }

        .register-benefits li {
            margin-bottom: 12px;
            list-style: none;
            padding-left: 25px;
            position: relative;
        }

        .register-benefits li::before {
            content: '✓';
            position: absolute;
            left: 0;
            font-weight: bold;
            font-size: 16px;
        }

        .register-right {
            padding: 50px;
            flex: 1;
            background: white;
            overflow-y: auto;
            max-height: 90vh;
        }

        .register-form h1 {
            font-size: 28px;
            color: #333;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .register-form .subtitle {
            color: #999;
            margin-bottom: 30px;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .form-group label {
            color: #555;
            font-weight: 600;
            font-size: 14px;
            margin-bottom: 8px;
            display: block;
        }

        .form-group input,
        .form-group select {
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            padding: 12px 15px;
            font-size: 14px;
            transition: all 0.3s ease;
            width: 100%;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            outline: none;
        }

        .form-group input.is-invalid,
        .form-group select.is-invalid {
            border-color: #dc3545;
        }

        .btn-register {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 8px;
            padding: 12px;
            font-weight: 600;
            color: white;
            font-size: 16px;
            transition: all 0.3s ease;
            cursor: pointer;
            margin-top: 10px;
            width: 100%;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
        }

        .btn-register:active {
            transform: translateY(0);
        }

        .register-footer {
            text-align: center;
            margin-top: 25px;
            color: #999;
            font-size: 14px;
        }

        .register-footer a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .register-footer a:hover {
            color: #764ba2;
            text-decoration: underline;
        }

        .alert {
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 13px;
        }

        .alert-danger {
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
        }

        @media (max-width: 768px) {
            .register-wrapper {
                flex-direction: column;
            }

            .register-left {
                padding: 30px;
                min-height: 200px;
            }

            .register-right {
                padding: 30px;
                max-height: none;
            }

            .register-form h1 {
                font-size: 24px;
            }

            .school-name {
                font-size: 20px;
            }

            .form-row {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endpush

@section('main')
    <div class="register-container">
        <div class="register-wrapper">
            <!-- Left Side - Branding -->
            <div class="register-left" style="background-image: url('{{ asset('img/smk-building.jpg') }}');">
                <div class="school-logo">📚</div>
                <div class="school-name">SMK BERSAMA</div>
                <div class="school-subtitle">
                    Sistem Informasi Penilaian Rapor Siswa<br>
                    Menuju Pendidikan Berkualitas
                </div>
                <ul class="register-benefits">
                    <li>Daftar akun dalam waktu singkat</li>
                    <li>Akses ke sistem nilai real-time</li>
                    <li>Laporan progress learning terperinci</li>
                    <li>Notifikasi update nilai otomatis</li>
                </ul>
            </div>

            <!-- Right Side - Register Form -->
            <div class="register-right">
                <div class="register-form">
                    <h1>Buat Akun Baru</h1>
                    <p class="subtitle">Daftarkan diri Anda untuk mengakses sistem</p>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Oops!</strong>
                            <ul style="margin: 5px 0 0 0; padding-left: 20px;">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register') }}" class="needs-validation" novalidate="">
                        @csrf

                        <div class="form-row">
                            <div class="form-group">
                                <label for="name">Nama Lengkap</label>
                                <input id="name" type="text" 
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name') }}" name="name" tabindex="1"
                                    placeholder="Masukkan nama lengkap Anda" required>
                                @error('name')
                                    <div class="invalid-feedback" style="display: block;">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="phone">No. Telepon</label>
                                <input id="phone" type="tel" 
                                    class="form-control @error('phone') is-invalid @enderror"
                                    value="{{ old('phone') }}" name="phone" tabindex="2"
                                    placeholder="08xxxxxxxxxx" required>
                                @error('phone')
                                    <div class="invalid-feedback" style="display: block;">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" type="email" 
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email') }}" name="email" tabindex="3"
                                placeholder="Masukkan alamat email Anda" required>
                            @error('email')
                                <div class="invalid-feedback" style="display: block;">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input id="password" type="password" 
                                    class="form-control @error('password') is-invalid @enderror"
                                    name="password" tabindex="4"
                                    placeholder="Minimal 8 karakter" required>
                                @error('password')
                                    <div class="invalid-feedback" style="display: block;">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation">Konfirmasi Password</label>
                                <input id="password_confirmation" type="password" 
                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                    name="password_confirmation" tabindex="5"
                                    placeholder="Ulangi password Anda" required>
                                @error('password_confirmation')
                                    <div class="invalid-feedback" style="display: block;">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-register" tabindex="6">
                            Daftar Sekarang
                        </button>
                    </form>

                    <div class="register-footer">
                        Sudah memiliki akun? <a href="{{ route('login') }}">Masuk di sini</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
@endpush
