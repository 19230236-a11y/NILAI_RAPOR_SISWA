<?php $__env->startSection('title', 'Manajemen Staff TU'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="h4 mb-1">Manajemen Staff TU</h2>
        <p class="text-muted mb-0">Kelola akun Staff Tata Usaha</p>
    </div>
    <a href="<?php echo e(route('users.create')); ?>" class="btn btn-brand">
        <i class="bi bi-plus-lg me-2"></i>Tambah Staff TU
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <!-- Search Form -->
        <form method="GET" action="<?php echo e(route('users.index')); ?>" class="mb-4">
            <div class="row g-3">
                <div class="col-md-4">
                    <input type="text" name="name" class="form-control" placeholder="Cari nama..." value="<?php echo e(request('name')); ?>">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-outline-primary w-100">
                        <i class="bi bi-search me-1"></i>Cari
                    </button>
                </div>
                <?php if(request('name')): ?>
                <div class="col-md-2">
                    <a href="<?php echo e(route('users.index')); ?>" class="btn btn-outline-secondary w-100">
                        <i class="bi bi-x-circle me-1"></i>Reset
                    </a>
                </div>
                <?php endif; ?>
            </div>
        </form>

        <!-- Table -->
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Posisi</th>
                        <th>Departemen</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($user->name); ?></td>
                        <td><?php echo e($user->email); ?></td>
                        <td><?php echo e($user->position ?? '-'); ?></td>
                        <td><?php echo e($user->department ?? '-'); ?></td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="<?php echo e(route('users.edit', $user)); ?>" class="btn btn-sm btn-outline-warning" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <a href="<?php echo e(route('users.reset-password', $user)); ?>" class="btn btn-sm btn-outline-info" title="Reset Password">
                                    <i class="bi bi-key"></i>
                                </a>
                                <form method="POST" action="<?php echo e(route('users.destroy', $user)); ?>" class="d-inline">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus" onclick="return confirm('Yakin hapus akun ini?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">
                            <?php if(request('name')): ?>
                            Data Staff TU tidak ditemukan
                            <?php else: ?>
                            Belum ada data Staff TU
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            <?php echo e($users->links()); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\NILAI_RAPOR_SISWA\resources\views\pages\users\index.blade.php ENDPATH**/ ?>