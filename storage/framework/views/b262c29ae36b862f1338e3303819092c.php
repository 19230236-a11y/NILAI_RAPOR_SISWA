<?php $__env->startSection('title', 'Data Kelas'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="h4 mb-1">Data Kelas</h2>
        <p class="text-muted mb-0">Kelola data kelas sekolah</p>
    </div>
    <a href="<?php echo e(route('classes.create')); ?>" class="btn btn-brand">
        <i class="bi bi-plus-lg me-2"></i>Tambah Kelas
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form method="GET" action="<?php echo e(route('classes.index')); ?>" class="mb-4">
            <div class="row g-3">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Cari kelas..." value="<?php echo e($search); ?>">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-outline-primary w-100">
                        <i class="bi bi-search me-1"></i>Cari
                    </button>
                </div>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nama Kelas</th>
                        <th>Tingkat</th>
                        <th>Jurusan</th>
                        <th>Wali Kelas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><strong><?php echo e($class->name); ?></strong></td>
                        <td><?php echo e($class->level ?? '-'); ?></td>
                        <td><?php echo e($class->jurusan ?? '-'); ?></td>
                        <td><?php echo e($class->wali_kelas ?? '-'); ?></td>
                        <td>
                            <div class="btn-group">
                                <a href="<?php echo e(route('classes.show', $class)); ?>" class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></a>
                                <a href="<?php echo e(route('classes.edit', $class)); ?>" class="btn btn-sm btn-outline-warning"><i class="bi bi-pencil"></i></a>
                                <form method="POST" action="<?php echo e(route('classes.destroy', $class)); ?>" class="d-inline">
                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin hapus?')"><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="5" class="text-center py-4 text-muted">Belum ada kelas</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mt-4"><?php echo e($classes->links()); ?></div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\NILAI_RAPOR_SISWA\resources\views\classes\index.blade.php ENDPATH**/ ?>