<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - SMK BERSAMA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins', sans-serif;
            padding: 20px 0;
        }

        .register-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            max-width: 900px;
            width: 100%;
            padding: 0;
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
            width: 40%;
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
            list-style: none;
            padding: 0;
        }

        .register-benefits li {
            margin-bottom: 12px;
            padding-left: 25px;
            position: relative;
        }

        .register-benefits li::before {
            content: '✓';
            position: absolute;
            left: 0;
            font-weight: bold;
        }

        .register-right {
            padding: 50px;
            flex: 1;
            background: white;
            overflow-y: auto;
            max-height: 90vh;
            width: 60%;
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
            box-sizing: border-box;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            outline: none;
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
            color: white;
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

            .register-left, .register-right {
                width: 100%;
            }

            .register-left {
                min-height: 200px;
            }

            .register-right {
                max-height: none;
            }

            .register-form h1 {
                font-size: 24px;
            }

            .form-row {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-wrapper">
            <div class="register-left">
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

            <div class="register-right">
                <div class="register-form">
                    <h1>Buat Akun Baru</h1>
                    <p class="subtitle">Buat akun pengguna untuk Staff TU</p>

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

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-row">
                            <div class="form-group">
                                <label for="name">Nama Lengkap</label>
                                <input id="name" type="text" 
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name') }}" name="name"
                                    placeholder="Masukkan nama lengkap Anda" required>
                            </div>

                            <div class="form-group">
                                <label for="phone">No. Telepon</label>
                                <input id="phone" type="tel" 
                                    class="form-control @error('phone') is-invalid @enderror"
                                    value="{{ old('phone') }}" name="phone"
                                    placeholder="08xxxxxxxxxx" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" type="email" 
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email') }}" name="email"
                                placeholder="Masukkan alamat email Anda" required>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input id="password" type="password" 
                                    class="form-control @error('password') is-invalid @enderror"
                                    name="password"
                                    placeholder="Minimal 8 karakter" required>
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation">Konfirmasi Password</label>
                                <input id="password_confirmation" type="password" 
                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                    name="password_confirmation"
                                    placeholder="Ulangi password Anda" required>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-register">
                            Daftar Sekarang
                        </button>
                    </form>

                    <div class="register-footer">
                        <a href="{{ route('dashboard') }}">← Kembali ke Dashboard</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
