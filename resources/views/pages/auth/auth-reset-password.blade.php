<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atur Ulang Password - SMK BERSAMA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins', sans-serif;
        }

        .reset-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            max-width: 900px;
            width: 100%;
            padding: 0;
        }

        .reset-wrapper {
            display: flex;
            min-height: 600px;
        }

        .reset-left {
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

        .progress-steps {
            margin-top: 30px;
            font-size: 13px;
        }

        .progress-steps div {
            margin-bottom: 12px;
            display: flex;
            align-items: center;
        }

        .step-number {
            width: 25px;
            height: 25px;
            background: white;
            color: #667eea;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-right: 10px;
        }

        .reset-right {
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            flex: 1;
            background: white;
            width: 60%;
        }

        .reset-form h1 {
            font-size: 28px;
            color: #333;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .reset-form .subtitle {
            color: #999;
            margin-bottom: 30px;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            color: #555;
            font-weight: 600;
            font-size: 14px;
            margin-bottom: 8px;
            display: block;
        }

        .form-group input {
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            padding: 12px 15px;
            font-size: 14px;
            transition: all 0.3s ease;
            width: 100%;
            box-sizing: border-box;
        }

        .form-group input:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            outline: none;
        }

        .password-strength {
            margin-top: 8px;
            padding: 8px 12px;
            background: #f5f5f5;
            border-radius: 6px;
            font-size: 12px;
            color: #666;
        }

        .strength-bar {
            height: 4px;
            background: #e0e0e0;
            border-radius: 2px;
            margin-top: 5px;
            overflow: hidden;
        }

        .strength-bar-fill {
            height: 100%;
            background: #dc3545;
            width: 0%;
            transition: all 0.3s ease;
        }

        .btn-submit {
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

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
            color: white;
        }

        .reset-footer {
            text-align: center;
            margin-top: 25px;
            color: #999;
            font-size: 14px;
        }

        .reset-footer a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
        }

        .reset-footer a:hover {
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
            .reset-wrapper {
                flex-direction: column;
                min-height: auto;
            }

            .reset-left, .reset-right {
                width: 100%;
            }

            .reset-left {
                min-height: 250px;
            }

            .reset-form h1 {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="reset-container">
        <div class="reset-wrapper">
            <div class="reset-left">
                <div class="school-logo">✓</div>
                <div class="school-name">SMK BERSAMA</div>
                <div class="school-subtitle">
                    Sistem Informasi Penilaian Rapor Siswa<br>
                    Menuju Pendidikan Berkualitas
                </div>
                <div class="progress-steps">
                    <div>
                        <div class="step-number">1</div>
                        <span>Verifikasi email Anda</span>
                    </div>
                    <div style="opacity: 0.8;">
                        <div class="step-number">2</div>
                        <span>Atur ulang password</span>
                    </div>
                    <div style="opacity: 0.8;">
                        <div class="step-number">3</div>
                        <span>Login dengan password baru</span>
                    </div>
                </div>
            </div>

            <div class="reset-right">
                <div class="reset-form">
                    <h1>Atur Ulang Password</h1>
                    <p class="subtitle">
                        Masukkan password baru yang kuat untuk mengamankan akun Anda
                    </p>

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

                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ request()->route('token') }}">

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" type="email" 
                                class="form-control"
                                value="{{ request()->query('email', old('email', '')) }}" name="email" 
                                placeholder="Masukkan email Anda" required readonly>
                        </div>

                        <div class="form-group">
                            <label for="password">Password Baru</label>
                            <input id="password" type="password" 
                                class="form-control @error('password') is-invalid @enderror"
                                name="password" placeholder="Minimal 8 karakter" 
                                required onkeyup="checkPasswordStrength()">
                            <div class="password-strength">
                                Kekuatan password: <strong id="strength">Lemah</strong>
                                <div class="strength-bar">
                                    <div class="strength-bar-fill" id="strengthBar"></div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">Konfirmasi Password</label>
                            <input id="password_confirmation" type="password" 
                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                name="password_confirmation" placeholder="Ulangi password baru Anda" required>
                        </div>

                        <button type="submit" class="btn btn-submit">
                            Atur Ulang Password
                        </button>
                    </form>

                    <div class="reset-footer">
                        <a href="{{ route('login') }}">Kembali ke Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function checkPasswordStrength() {
            const password = document.getElementById('password').value;
            const strength = document.getElementById('strength');
            const bar = document.getElementById('strengthBar');
            
            let strengthValue = 0;
            
            if (password.length >= 8) strengthValue += 25;
            if (password.length >= 12) strengthValue += 15;
            if (/[a-z]/.test(password)) strengthValue += 15;
            if (/[A-Z]/.test(password)) strengthValue += 15;
            if (/[0-9]/.test(password)) strengthValue += 15;
            if (/[^a-zA-Z0-9]/.test(password)) strengthValue += 10;
            
            bar.style.width = strengthValue + '%';
            
            if (strengthValue < 30) {
                strength.textContent = 'Lemah';
                bar.style.backgroundColor = '#dc3545';
            } else if (strengthValue < 60) {
                strength.textContent = 'Sedang';
                bar.style.backgroundColor = '#ffc107';
            } else if (strengthValue < 85) {
                strength.textContent = 'Kuat';
                bar.style.backgroundColor = '#17a2b8';
            } else {
                strength.textContent = 'Sangat Kuat';
                bar.style.backgroundColor = '#28a745';
            }
        }
    </script>
</body>
</html>
