<?php if($errors->any()): ?>
    <div class="alert alert-danger border-0 shadow-sm" role="alert" aria-live="assertive">
        <h2 class="h6 mb-2">Periksa kembali input berikut:</h2>
        <ul class="mb-0 ps-3">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>
<?php /**PATH C:\Project TA\NILAI_RAPOR_SISWA\resources\views/components/form-errors.blade.php ENDPATH**/ ?>