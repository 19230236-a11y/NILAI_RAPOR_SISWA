<?php $__env->startSection('title', 'Forgot Password'); ?>

<?php $__env->startPush('style'); ?>
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="<?php echo e(asset('library/bootstrap-social/bootstrap-social.css')); ?>">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .password-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            max-width: 900px;
            width: 100%;
        }

        .password-wrapper {
            display: flex;
            min-height: 600px;
        }

        .password-left {
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

        .password-left::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(102, 126, 234, 0.85);
            z-index: 1;
        }

        .password-left > * {
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

        .password-icon {
            font-size: 50px;
            margin-bottom: 20px;
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
        }

        .password-right {
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            flex: 1;
            background: white;
        }

        .password-form h1 {
            font-size: 28px;
            color: #333;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .password-form .subtitle {
            color: #999;
            margin-bottom: 30px;
            font-size: 14px;
            line-height: 1.6;
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
        }

        .form-group input:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            outline: none;
        }

        .form-group input.is-invalid {
            border-color: #dc3545;
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
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        .password-footer {
            text-align: center;
            margin-top: 25px;
            color: #999;
            font-size: 14px;
        }

        .password-footer a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .password-footer a:hover {
            color: #764ba2;
            text-decoration: underline;
        }

        .alert {
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 13px;
        }

        .alert-success {
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
        }

        .alert-danger {
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
        }

        @media (max-width: 768px) {
            .password-wrapper {
                flex-direction: column;
                min-height: auto;
            }

            .password-left {
                padding: 30px;
                min-height: 200px;
            }

            .password-right {
                padding: 30px;
            }

            .password-form h1 {
                font-size: 24px;
            }

            .school-name {
                font-size: 20px;
            }
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('main'); ?>
    <div class="password-container">
        <div class="password-wrapper">
            <!-- Left Side - Branding -->
            <div class="password-left" style="background-image: url('<?php echo e(asset('img/smk-building.jpg')); ?>');">
                <div class="school-logo">🔐</div>
                <div class="school-name">SMK BERSAMA</div>
                <div class="school-subtitle">
                    Sistem Informasi Penilaian Rapor Siswa<br>
                    Menuju Pendidikan Berkualitas
                </div>
                <div class="password-icon">🔑</div>
                <p style="font-size: 13px; opacity: 0.95;">
                    Kami akan membantu Anda mengatur ulang password dengan mudah dan aman
                </p>
            </div>

            <!-- Right Side - Form -->
            <div class="password-right">
                <div class="password-form">
                    <h1>Lupa Password?</h1>
                    <p class="subtitle">
                        Masukkan alamat email Anda dan kami akan mengirimkan link untuk mengatur ulang password ke email Anda.
                    </p>

                    <?php if($errors->any()): ?>
                        <div class="alert alert-danger">
                            <?php echo e($errors->first()); ?>

                        </div>
                    <?php endif; ?>

                    <?php if(session('status')): ?>
                        <div class="alert alert-success">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>

                    <form method="POST" action="<?php echo e(route('password.email')); ?>" class="needs-validation" novalidate="">
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
                                value="<?php echo e(old('email')); ?>" name="email" tabindex="1" 
                                placeholder="Masukkan alamat email Anda" required>
                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback" style="display: block;">
                                    <?php echo e($message); ?>

                                </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <button type="submit" class="btn btn-submit" tabindex="2">
                            Kirim Link Reset Password
                        </button>
                    </form>

                    <div class="password-footer">
                        Ingat password Anda? <a href="<?php echo e(route('login')); ?>">Kembali ke Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.auth', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\NILAI_RAPOR_SISWA\resources\views\pages\auth\auth-forgot-password.blade.php ENDPATH**/ ?>