<?php $__env->startSection('title', 'Detail Kelas - ' . $class->name); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="h4 mb-1"><?php echo e($class->name); ?></h2>
        <p class="text-muted mb-0">Kelas <?php echo e($class->level ?? '-'); ?> <?php echo e($class->jurusan ? '- ' . $class->jurusan : ''); ?></p>
    </div>
    <div>
        <a href="<?php echo e(route('classes.edit', $class)); ?>" class="btn btn-outline-warning"><i class="bi bi-pencil me-2"></i>Edit</a>
        <a href="<?php echo e(route('classes.index')); ?>" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-2"></i>Kembali</a>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0"><h5 class="mb-0">Informasi Kelas</h5></div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr><td class="text-muted">Nama</td><td><strong><?php echo e($class->name); ?></strong></td></tr>
                    <tr><td class="text-muted">Tingkat</td><td><?php echo e($class->level ?? '-'); ?></td></tr>
                    <tr><td class="text-muted">Jurusan</td><td><?php echo e($class->jurusan ?? '-'); ?></td></tr>
                    <tr><td class="text-muted">Wali Kelas</td><td><?php echo e($class->wali_kelas ?? '-'); ?></td></tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0"><h5 class="mb-0"><i class="bi bi-clipboard-data me-2"></i>Nilai Kelas</h5></div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead><tr><th>Siswa</th><th>Mata Pelajaran</th><th>Semester</th><th>Nilai Akhir</th></tr></thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $class->grades->take(10); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $grade): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($grade->student->name ?? '-'); ?></td>
                            <td><?php echo e($grade->subject->name ?? '-'); ?></td>
                            <td><?php echo e($grade->semester->name ?? '-'); ?></td>
                            <td><strong><?php echo e(number_format($grade->nilai_akhir, 2)); ?></strong></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="4" class="text-center text-muted py-3">Belum ada nilai</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\NILAI_RAPOR_SISWA\resources\views\classes\show.blade.php ENDPATH**/ ?>