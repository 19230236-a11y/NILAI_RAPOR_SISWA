<?php $__env->startSection('title', 'Tahun Ajaran'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="h4 mb-1">Tahun Ajaran</h2>
        <p class="text-muted mb-0">Kelola tahun ajaran sekolah</p>
    </div>
    <a href="<?php echo e(route('school-years.create')); ?>" class="btn btn-brand">
        <i class="bi bi-plus-lg me-2"></i>Tambah Tahun Ajaran
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Tahun Ajaran</th>
                        <th>Status</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $years; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $year): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><strong><?php echo e($year->year); ?></strong></td>
                        <td>
                            <?php if($year->is_active): ?>
                            <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>Aktif</span>
                            <?php else: ?>
                            <span class="badge bg-secondary">Nonaktif</span>
                            <?php endif; ?>
                        </td>
                        <td><?php echo e($year->start_date ? \Carbon\Carbon::parse($year->start_date)->format('d/m/Y') : '-'); ?></td>
                        <td><?php echo e($year->end_date ? \Carbon\Carbon::parse($year->end_date)->format('d/m/Y') : '-'); ?></td>
                        <td>
                            <div class="btn-group">
                                <a href="<?php echo e(route('school-years.show', $year)); ?>" class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></a>
                                <a href="<?php echo e(route('school-years.edit', $year)); ?>" class="btn btn-sm btn-outline-warning"><i class="bi bi-pencil"></i></a>
                                <?php if(!$year->is_active): ?>
                                <form method="POST" action="<?php echo e(route('school-years.setActive', $year)); ?>" class="d-inline">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="btn btn-sm btn-outline-success" title="Jadikan Aktif">
                                        <i class="bi bi-check2"></i>
                                    </button>
                                </form>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="5" class="text-center py-4 text-muted">Belum ada tahun ajaran</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mt-4"><?php echo e($years->links()); ?></div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\NILAI_RAPOR_SISWA\resources\views\school-years\index.blade.php ENDPATH**/ ?>