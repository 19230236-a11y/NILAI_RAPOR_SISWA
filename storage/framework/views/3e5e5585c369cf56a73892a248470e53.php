<?php $__env->startSection('title', 'Data Siswa'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="h4 mb-1">Data Siswa</h2>
        <p class="text-muted mb-0">Kelola data siswa sekolah</p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?php echo e(route('students.create', ['program' => $programId])); ?>" class="btn btn-brand">
            <i class="bi bi-plus-lg me-2"></i>Tambah Siswa
        </a>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <!-- Search Form -->
        <form method="GET" action="<?php echo e(route('students.index')); ?>" class="mb-4">
            <div class="row g-3">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Cari NIS atau nama..." value="<?php echo e($search); ?>">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-outline-primary w-100">
                        <i class="bi bi-search me-1"></i>Cari
                    </button>
                </div>
                <?php if($search): ?>
                <div class="col-md-2">
                    <a href="<?php echo e(route('students.index')); ?>" class="btn btn-outline-secondary w-100">
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
                        <th><a href="<?php echo e(route('students.index', ['sort' => 'nis', 'direction' => $sort === 'nis' && $direction === 'asc' ? 'desc' : 'asc'] + Request::except(['sort', 'direction']))); ?>" class="text-decoration-none text-dark">NIS <?php echo e($sort === 'nis' ? ($direction === 'asc' ? '↑' : '↓') : ''); ?></a></th>
                        <th><a href="<?php echo e(route('students.index', ['sort' => 'name', 'direction' => $sort === 'name' && $direction === 'asc' ? 'desc' : 'asc'] + Request::except(['sort', 'direction']))); ?>" class="text-decoration-none text-dark">Nama <?php echo e($sort === 'name' ? ($direction === 'asc' ? '↑' : '↓') : ''); ?></a></th>
                        <th>Jenis Kelamin</th>
                        <th>Kelas</th>
                        <th>Tahun Lulus</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($student->nis); ?></td>
                        <td><?php echo e($student->name); ?></td>
                        <td><?php echo e($student->gender == 'L' ? 'Laki-laki' : 'Perempuan'); ?></td>
                        <td><?php echo e($student->getClassDisplayName()); ?></td>
                        <td><?php echo e($student->graduation_year ?? '-'); ?></td>
                        <td>
                            <a href="<?php echo e(route('students.show', $student)); ?>" class="btn btn-sm btn-outline-primary" title="Lihat">
                                <i class="bi bi-eye"></i>
                            </a>
                            <form method="POST" action="<?php echo e(route('students.destroy', $student)); ?>" class="d-inline">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus" onclick="return confirm('Yakin hapus data siswa ini?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">
                            <?php if($search): ?>
                            Data siswa tidak ditemukan
                            <?php else: ?>
                            Belum ada data siswa
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            <?php echo e($students->links()); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Project TA\NILAI_RAPOR_SISWA\resources\views/students/index.blade.php ENDPATH**/ ?>