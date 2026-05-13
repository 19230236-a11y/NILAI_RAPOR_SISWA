

<?php $__env->startSection('title', 'Edit Nilai Semester - ' . $student->name); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
        <h2 class="mb-1">Edit Nilai Semester</h2>
        <p class="text-secondary mb-0">Siswa: <strong><?php echo e($student->name); ?></strong> (<?php echo e($student->nis); ?>)</p>
        <p class="text-secondary mb-0"><?php echo e($semester->name); ?> - <?php echo e($schoolYear->year); ?></p>
    </div>
    <a href="<?php echo e(route('students.show', $student)); ?>" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-2"></i>Kembali
    </a>
</div>

<?php echo $__env->make('components.form-errors', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form action="<?php echo e(route('grades.semester-update', ['student' => $student, 'semesterId' => $semester->id, 'yearId' => $schoolYear->id])); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PATCH'); ?>

            <?php if($grades->isEmpty()): ?>
                <div class="alert alert-warning">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    Belum ada nilai untuk semester ini
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>Mata Pelajaran</th>
                                <th style="width: 150px">Nilai (0-100)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $grades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $grade): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($grade->subject->name ?? '-'); ?></td>
                                    <td>
                                        <input type="number" 
                                               name="grades[<?php echo e($grade->id); ?>]" 
                                               class="form-control form-control-sm" 
                                               step="0.01" 
                                               min="0" 
                                               max="100" 
                                               value="<?php echo e($grade->nilai); ?>"
                                               placeholder="0-100">
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-brand">
                    <i class="bi bi-check-circle me-2"></i>Simpan Perubahan
                </button>
                <a href="<?php echo e(route('students.show', $student)); ?>" class="btn btn-outline-secondary">
                    <i class="bi bi-x-circle me-2"></i>Batal
                </a>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Project TA\NILAI_RAPOR_SISWA\resources\views/grades/edit-semester.blade.php ENDPATH**/ ?>