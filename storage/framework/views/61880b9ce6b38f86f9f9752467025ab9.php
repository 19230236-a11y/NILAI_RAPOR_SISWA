<?php $__env->startSection('title', 'Detail Tahun Ajaran'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="h4 mb-1"><?php echo e($schoolYear->year); ?></h2>
        <p class="text-muted mb-0">
            <?php if($schoolYear->is_active): ?>
            <span class="badge bg-success">Aktif</span>
            <?php else: ?>
            <span class="badge bg-secondary">Nonaktif</span>
            <?php endif; ?>
        </p>
    </div>
    <div>
        <a href="<?php echo e(route('school-years.edit', $schoolYear)); ?>" class="btn btn-outline-warning"><i class="bi bi-pencil me-2"></i>Edit</a>
        <a href="<?php echo e(route('school-years.index')); ?>" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-2"></i>Kembali</a>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0"><h5 class="mb-0">Informasi</h5></div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr><td class="text-muted">Tahun Ajaran</td><td><strong><?php echo e($schoolYear->year); ?></strong></td></tr>
                    <tr><td class="text-muted">Status</td>
                        <td><?php if($schoolYear->is_active): ?><span class="badge bg-success">Aktif</span><?php else: ?><span class="badge bg-secondary">Nonaktif</span><?php endif; ?></td></tr>
                    <tr><td class="text-muted">Mulai</td><td><?php echo e($schoolYear->start_date ? \Carbon\Carbon::parse($schoolYear->start_date)->format('d F Y') : '-'); ?></td></tr>
                    <tr><td class="text-muted">Selesai</td><td><?php echo e($schoolYear->end_date ? \Carbon\Carbon::parse($schoolYear->end_date)->format('d F Y') : '-'); ?></td></tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0"><h5 class="mb-0"><i class="bi bi-calendar3 me-2"></i>Semester</h5></div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead><tr><th>Nama</th><th>Jenis</th><th>Jumlah Nilai</th></tr></thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $schoolYear->semesters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $semester): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($semester->name); ?></td>
                            <td><?php echo e($semester->type ?? '-'); ?></td>
                            <td><span class="badge bg-info"><?php echo e($semester->grades->count()); ?></span></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="3" class="text-center text-muted py-3">Belum ada semester</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\NILAI_RAPOR_SISWA\resources\views\school-years\show.blade.php ENDPATH**/ ?>