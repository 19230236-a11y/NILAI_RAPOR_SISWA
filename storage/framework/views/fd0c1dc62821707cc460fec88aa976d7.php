<?php $__env->startSection('title', 'Login - Sistem Informasi Rapor'); ?>

<?php $__env->startPush('style'); ?>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            overflow: hidden;
        }
        
        /* Animated Background Elements */
        .bg-circles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 0;
        }
        
        .circle {
            position: absolute;
            display: block;
            list-style: none;
            width: 20px;
            height: 20px;
            background: rgba(255, 255, 255, 0.2);
            animation: animate 25s linear infinite;
            bottom: -150px;
            border-radius: 50%;
        }

        .circle:nth-child(1) { left: 25%; width: 80px; height: 80px; animation-delay: 0s; }
        .circle:nth-child(2) { left: 10%; width: 20px; height: 20px; animation-delay: 2s; animation-duration: 12s; }
        .circle:nth-child(3) { left: 70%; width: 20px; height: 20px; animation-delay: 4s; }
        .circle:nth-child(4) { left: 40%; width: 60px; height: 60px; animation-delay: 0s; animation-duration: 18s; }
        .circle:nth-child(5) { left: 65%; width: 20px; height: 20px; animation-delay: 0s; }
        .circle:nth-child(6) { left: 75%; width: 110px; height: 110px; animation-delay: 3s; }
        .circle:nth-child(7) { left: 35%; width: 150px; height: 150px; animation-delay: 7s; }
        .circle:nth-child(8) { left: 50%; width: 25px; height: 25px; animation-delay: 15s; animation-duration: 45s; }
        .circle:nth-child(9) { left: 20%; width: 15px; height: 15px; animation-delay: 2s; animation-duration: 35s; }
        .circle:nth-child(10) { left: 85%; width: 150px; height: 150px; animation-delay: 0s; animation-duration: 11s; }

        @keyframes animate {
            0% { transform: translateY(0) rotate(0deg); opacity: 1; border-radius: 0; }
            100% { transform: translateY(-1000px) rotate(720deg); opacity: 0; border-radius: 50%; }
        }

        .login-container {
            width: 100%;
            max-width: 450px;
            z-index: 1;
            padding: 20px;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            color: #fff;
        }

        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-header h3 {
            font-weight: 700;
            letter-spacing: 1px;
            margin-bottom: 5px;
            font-size: 1.3rem;
            line-height: 1.4;
        }

        .login-header p {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.9rem;
        }

        .form-floating > label {
            color: #6c757d;
        }

        .form-floating > .form-control {
            background: rgba(255, 255, 255, 0.9);
            border: none;
            border-radius: 10px;
            padding-left: 20px;
        }

        .form-floating > .form-control:focus {
            background: #fff;
            box-shadow: 0 0 0 0.25rem rgba(255, 255, 255, 0.25);
        }

        .form-floating > .form-control.is-invalid {
            border: 2px solid #ff6b6b;
            background-image: none;
        }

        .invalid-feedback {
            color: #ffb8b8;
            font-size: 0.85rem;
            margin-top: 5px;
            padding-left: 10px;
        }

        .btn-login {
            background: linear-gradient(to right, #f83600 0%, #f9d423 100%);
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            font-size: 1.1rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #fff;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(248, 54, 0, 0.4);
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(248, 54, 0, 0.6);
            color: #fff;
        }

        .login-footer {
            text-align: center;
            margin-top: 25px;
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.8);
        }

        .login-footer a {
            color: #fff;
            font-weight: 600;
            text-decoration: none;
            transition: opacity 0.3s ease;
        }

        .login-footer a:hover {
            opacity: 0.8;
            text-decoration: underline;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('main'); ?>
    <div class="bg-circles">
        <div class="circle"></div>
        <div class="circle"></div>
        <div class="circle"></div>
        <div class="circle"></div>
        <div class="circle"></div>
        <div class="circle"></div>
        <div class="circle"></div>
        <div class="circle"></div>
        <div class="circle"></div>
        <div class="circle"></div>
    </div>

    <div class="login-container">
        <div class="glass-card">
            <div class="login-header">
                <h3>SELAMAT DATANG DI BUKU INDUK REGISTER PESERTA DIDIK</h3>
                <p>Silakan login untuk melanjutkan</p>
            </div>

            <form method="POST" action="<?php echo e(route('login')); ?>" class="needs-validation" novalidate="">
                <?php echo csrf_field(); ?>
                <div class="form-floating mb-4">
                    <input type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="email" name="email" value="<?php echo e(old('email')); ?>" placeholder="name@example.com" required tabindex="1">
                    <label for="email"><i class="bi bi-envelope-fill me-2"></i>Email Address</label>
                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback">
                            <?php echo e($message); ?>

                        </div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="form-floating mb-4">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required tabindex="2">
                    <label for="password"><i class="bi bi-lock-fill me-2"></i>Password</label>
                    <div class="invalid-feedback">
                        Tolong masukkan password Anda
                    </div>
                </div>

                <div class="d-grid mt-5">
                    <button type="submit" class="btn btn-login btn-block" tabindex="4">
                        Login <i class="bi bi-box-arrow-in-right ms-2"></i>
                    </button>
                </div>
            </form>

            <div class="login-footer">
                Belum punya akun? <a href="auth-register.html">Daftar sekarang</a>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.auth', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\NILAI_RAPOR_SISWA\resources\views\pages\auth\auth-login.blade.php ENDPATH**/ ?>