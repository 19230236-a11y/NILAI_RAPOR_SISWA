<?php $__env->startSection('title', 'Edit Kelas'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div><h2 class="h4 mb-1">Edit Kelas</h2></div>
    <a href="<?php echo e(route('classes.index')); ?>" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-2"></i>Kembali</a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form method="POST" action="<?php echo e(route('classes.update', $class)); ?>">
            <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="name" class="form-label">Nama Kelas <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo e(old('name', $class->name)); ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="level" class="form-label">Tingkat</label>
                    <input type="number" class="form-control" id="level" name="level" value="<?php echo e(old('level', $class->level)); ?>" min="1" max="12">
                </div>
                <div class="col-md-6">
                    <label for="jurusan" class="form-label">Jurusan</label>
                    <input type="text" class="form-control" id="jurusan" name="jurusan" value="<?php echo e(old('jurusan', $class->jurusan)); ?>">
                </div>
                <div class="col-md-6">
                    <label for="wali_kelas" class="form-label">Wali Kelas</label>
                    <input type="text" class="form-control" id="wali_kelas" name="wali_kelas" value="<?php echo e(old('wali_kelas', $class->wali_kelas)); ?>">
                </div>
                <div class="col-12 mt-4">
                    <button type="submit" class="btn btn-brand"><i class="bi bi-check-lg me-2"></i>Simpan</button>
                    <a href="<?php echo e(route('classes.index')); ?>" class="btn btn-outline-secondary ms-2">Batal</a>
                </div>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\NILAI_RAPOR_SISWA\resources\views\classes\edit.blade.php ENDPATH**/ ?>