<?php $__env->startSection('content'); ?>
<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
    <div>
        <h2 class="mb-1">Manajemen Nilai Rapor</h2>
        <p class="text-secondary mb-0">Input dan arsip nilai rapor siswa per mapel per semester.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?php echo e(route('grades.bulk-create')); ?>" class="btn btn-success">
            <i class="bi bi-stack me-2"></i>Bulk Input Nilai
        </a>
        <a href="<?php echo e(route('grades.create')); ?>" class="btn btn-brand">
            <i class="bi bi-plus-lg me-2"></i>Input Nilai
        </a>
    </div>
</div>

<div class="row g-3 mb-3">
    <div class="col-12">
        <form method="GET" action="<?php echo e(route('grades.index')); ?>" class="row g-2 align-items-end">
            <div class="col-12 col-md-6 col-lg-3">
                <label class="form-label">Cari Siswa</label>
                <input type="text" name="search" placeholder="Nama atau NIS..." class="form-control" value="<?php echo e($search ?? ''); ?>">
            </div>
            
            <div class="col-12 col-md-6 col-lg-2">
                <label class="form-label">Kelas</label>
                <select name="class" class="form-select">
                    <option value="">Semua Kelas</option>
                    <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($class->id); ?>" <?php echo e($classFilter == $class->id ? 'selected' : ''); ?>><?php echo e($class->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            
            <div class="col-12 col-md-6 col-lg-2">
                <label class="form-label">Tahun Ajaran</label>
                <select name="year" class="form-select">
                    <option value="">Semua Tahun</option>
                    <?php $__currentLoopData = $years; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $year): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($year->id); ?>" <?php echo e($yearFilter == $year->id ? 'selected' : ''); ?>><?php echo e($year->year); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            
            <div class="col-12 col-md-6 col-lg-2">
                <label class="form-label">Semester</label>
                <select name="semester" class="form-select">
                    <option value="">Semua Semester</option>
                    <?php $__currentLoopData = $semesters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $semester): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($semester->id); ?>" <?php echo e($semesterFilter == $semester->id ? 'selected' : ''); ?>><?php echo e($semester->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            
            <div class="col-12 col-lg-1">
                <button type="submit" class="btn btn-outline-primary w-100">Filter</button>
            </div>
            
            <?php if($search || $classFilter || $yearFilter || $semesterFilter): ?>
                <div class="col-12 col-lg-1">
                    <a href="<?php echo e(route('grades.index')); ?>" class="btn btn-outline-secondary w-100">Reset</a>
                </div>
            <?php endif; ?>
        </form>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-hover align-middle">
        <thead>
            <tr>
                <th>Siswa</th>
                <th>Mapel</th>
                <th>Kelas</th>
                <th>Tahun Ajaran</th>
                <th>Semester</th>
                <th>Nilai Akhir</th>
                <th>Grade</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $grades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $grade): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td class="fw-semibold"><?php echo e($grade->student->name); ?></td>
                    <td><?php echo e($grade->subject->name); ?></td>
                    <td><?php echo e($grade->schoolClass->name); ?></td>
                    <td><?php echo e($grade->schoolYear->year); ?></td>
                    <td><?php echo e($grade->semester->name); ?></td>
                    <td>
                        <span class="badge bg-primary"><?php echo e(number_format($grade->nilai_akhir, 2)); ?></span>
                    </td>
                    <td>
                        <?php
                            $grade_letter = 'E';
                            if ($grade->nilai_akhir >= 85) $grade_letter = 'A';
                            elseif ($grade->nilai_akhir >= 75) $grade_letter = 'B';
                            elseif ($grade->nilai_akhir >= 65) $grade_letter = 'C';
                            elseif ($grade->nilai_akhir >= 55) $grade_letter = 'D';
                        ?>
                        <span class="badge bg-<?php echo e($grade_letter == 'A' ? 'success' : ($grade_letter == 'B' ? 'info' : ($grade_letter == 'C' ? 'warning' : 'danger'))); ?>"><?php echo e($grade_letter); ?></span>
                    </td>
                    <td class="text-center">
                        <div class="d-flex flex-wrap justify-content-center gap-2">
                            <a href="<?php echo e(route('students.transcript', $grade->student)); ?>" class="btn btn-sm btn-outline-primary">Transcript</a>
                            <a href="<?php echo e(route('students.transcript.pdf', $grade->student)); ?>" class="btn btn-sm btn-outline-success">PDF</a>
                            <a href="<?php echo e(route('grades.edit', $grade)); ?>" class="btn btn-sm btn-outline-warning">Edit</a>
                            <form action="<?php echo e(route('grades.destroy', $grade)); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus nilai ini?')">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="8" class="text-center text-secondary py-4">Belum ada data nilai.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<div class="mt-3">
    <?php echo e($grades->links()); ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Project TA\NILAI_RAPOR_SISWA\resources\views/grades/index.blade.php ENDPATH**/ ?>