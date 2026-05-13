<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SMK SEHATI KARAWANG</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #5DADE2 0%, #2980B9 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins', sans-serif;
        }

        .login-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            max-width: 900px;
            width: 100%;
            padding: 0;
            position: relative;
            z-index: 1;
        }

        .login-wrapper {
            display: flex;
            min-height: 600px;
        }

        .login-left {
            background: linear-gradient(135deg, #5DADE2 0%, #2980B9 100%);
            color: white;
            padding: 50px 30px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            width: 40%;
            position: relative;
        }

        .login-left::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: transparent;
            z-index: 1;
        }

        .login-left > * {
            position: relative;
            z-index: 2;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-20px);
            }
        }

        .school-logo {
            width: 220px;
            height: 220px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 30px;
            overflow: hidden;
            animation: float 3s ease-in-out infinite;
        }
        
        .school-logo img {
            width: 200px;
            height: 200px;
            object-fit: contain;
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

        .login-features {
            text-align: left;
            font-size: 13px;
            opacity: 0.9;
            list-style: none;
            padding: 0;
        }

        .login-features li {
            margin-bottom: 12px;
            padding-left: 25px;
            position: relative;
        }

        .login-features li::before {
            content: '✓';
            position: absolute;
            left: 0;
            font-weight: bold;
        }

        .login-right {
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            width: 60%;
            background: white;
        }

        .login-form h1 {
            font-size: 28px;
            color: #333;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .login-form .subtitle {
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
            border-color: #5DADE2;
            box-shadow: 0 0 0 3px rgba(93, 173, 226, 0.1);
            outline: none;
        }

        .btn-login {
            background: linear-gradient(135deg, #5DADE2 0%, #2980B9 100%);
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

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(93, 173, 226, 0.3);
            color: white;
        }

        .login-footer {
            text-align: center;
            margin-top: 25px;
            color: #999;
            font-size: 14px;
        }

        .login-footer a {
            color: #5DADE2;
            text-decoration: none;
            font-weight: 600;
        }

        .login-footer a:hover {
            color: #2980B9;
            text-decoration: underline;
        }

        .password-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .forgot-pwd-link {
            font-size: 13px;
            color: #5DADE2;
            text-decoration: none;
            font-weight: 500;
        }

        .forgot-pwd-link:hover {
            text-decoration: underline;
            color: #764ba2;
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
            .login-wrapper {
                flex-direction: column;
                min-height: auto;
            }

            .login-left, .login-right {
                width: 100%;
            }

            .login-left {
                min-height: 250px;
            }

            .login-form h1 {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-wrapper">
            <div class="login-left">
                <div class="school-logo">
                    <img src="/img/logo.png" alt="Logo Sekolah">
                </div>
                <div class="school-name">SMK SEHATI KARAWANG</div>
                <div class="school-subtitle">
                    Jl. Raya Kosambi – Telagasari, Desa Pancawati<br>
                    Kec. Klari, Kab. Karawang, Provinsi Jawa Barat (41371)
                </div>
                <ul class="login-features">
                    <li>Kelola nilai siswa dengan mudah</li>
                    <li>Pantau perkembangan pembelajaran</li>
                    <li>Laporan real-time yang akurat</li>
                    <li>Akses dari mana saja, kapan saja</li>
                </ul>
            </div>

            <div class="login-right">
                <div class="login-form">
                    <h1>Buku Induk Register</h1>
                    <p class="subtitle">Silakan masuk dengan akun Anda</p>

                    <?php if($errors->any()): ?>
                        <div class="alert alert-danger">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo e($error); ?><br>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="<?php echo e(route('login.store')); ?>">
                        <?php echo csrf_field(); ?>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" type="email" 
                                class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                value="<?php echo e(old('email')); ?>" name="email" 
                                placeholder="Masukkan alamat email Anda" required>
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input id="password" type="password" 
                                class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                name="password" placeholder="Masukkan password Anda" required>
                        </div>

                        <button type="submit" class="btn btn-login">
                            Masuk
                        </button>
                    </form>

                    <div class="login-footer">
                        Hubungi <strong>Kepala Sekolah</strong> untuk membuat akun baru
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php /**PATH D:\project laravel\NILAI_RAPOR_SISWA\resources\views/pages/auth/auth-login.blade.php ENDPATH**/ ?>