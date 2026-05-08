

<?php $__env->startSection('title', 'Detail Siswa - ' . $student->name); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="h4 mb-1"><?php echo e($student->name); ?></h2>
        <p class="text-muted mb-0">NIS: <?php echo e($student->nis); ?></p>
    </div>
    <div>
        <a href="<?php echo e(route('students.edit', $student)); ?>" class="btn btn-outline-warning">
            <i class="bi bi-pencil me-2"></i>Edit
        </a>
        <a href="<?php echo e(route('students.index')); ?>" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-2"></i>Kembali
        </a>
    </div>
</div>

<div class="row g-4">
    <!-- Student Info -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0">
                <h5 class="mb-0"><i class="bi bi-person me-2"></i>Informasi Siswa</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <td class="text-muted">NIS</td>
                        <td><strong><?php echo e($student->nis); ?></strong></td>
                    </tr>
                    <tr>
                        <td class="text-muted">NISN</td>
                        <td><?php echo e($student->nisn ?? '-'); ?></td>
                    </tr>
                    <tr>
                        <td class="text-muted">Nama</td>
                        <td><?php echo e($student->name); ?></td>
                    </tr>
                    <tr>
                        <td class="text-muted">Jenis Kelamin</td>
                        <td><?php echo e($student->gender == 'L' ? 'Laki-laki' : 'Perempuan'); ?></td>
                    </tr>
                    <tr>
                        <td class="text-muted">Tempat Lahir</td>
                        <td><?php echo e($student->birth_place); ?></td>
                    </tr>
                    <tr>
                        <td class="text-muted">Tanggal Lahir</td>
                        <td><?php echo e(\Carbon\Carbon::parse($student->birth_date)->format('d F Y')); ?></td>
                    </tr>
                    <tr>
                        <td class="text-muted">Alamat</td>
                        <td><?php echo e($student->address ?? '-'); ?></td>
                    </tr>
                    <tr>
                        <td class="text-muted">No. Telepon</td>
                        <td><?php echo e($student->phone ?? '-'); ?></td>
                    </tr>
                    <tr>
                        <td class="text-muted">Orang Tua</td>
                        <td><?php echo e($student->parent_name ?? '-'); ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <!-- Grades -->
    <div class="col-lg-8">
        <!-- Input Nilai Actions -->
        <div class="row g-3 mb-4">
            <!-- Input Nilai Semua Pelajaran -->
            <div class="col-12">
                <div class="card border-0 shadow-sm bg-success bg-opacity-10 h-100">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="flex-shrink-0">
                            <div class="bg-success bg-opacity-25 rounded-circle p-3">
                                <i class="bi bi-stack fs-2 text-success"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="card-title mb-2">Input Nilai Semua Pelajaran</h5>
                            <p class="card-text mb-0 small">Input nilai untuk semua pelajaran dalam satu halaman</p>
                            <a href="<?php echo e(route('students.grades.bulk-create', $student)); ?>" class="btn btn-success btn-sm mt-2">
                                <i class="bi bi-plus-circle me-1"></i>Mulai Input
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Input Nilai Per Pelajaran -->
            <div class="col-12">
                <div class="card border-0 shadow-sm bg-primary bg-opacity-10 h-100">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="flex-shrink-0">
                            <div class="bg-primary bg-opacity-25 rounded-circle p-3">
                                <i class="bi bi-pencil-square fs-2 text-primary"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="card-title mb-2">Input Nilai Per Pelajaran</h5>
                            <p class="card-text mb-0 small">Input nilai satu pelajaran untuk siswa ini</p>
                            <a href="<?php echo e(route('students.grades.create', $student)); ?>" class="btn btn-primary btn-sm mt-2">
                                <i class="bi bi-plus-circle me-1"></i>Mulai Input
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Nilai Rapor Table -->
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="bi bi-clipboard-data me-2"></i>Nilai Rapor</h5>
                <a href="<?php echo e(route('reports.transcript', $student)); ?>" class="btn btn-sm btn-outline-primary">
                    <i class="bi bi-file-earmark-text me-1"></i>Lihat Transkrip
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Mata Pelajaran</th>
                                <th>Kelas</th>
                                <th>Semester</th>
                                <th>Tugas</th>
                                <th>UTS</th>
                                <th>UAS</th>
                                <th>Akhir</th>
                                <th>Predikat</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $student->grades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $grade): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($grade->subject->name ?? '-'); ?></td>
                                <td><?php echo e($grade->schoolClass->name ?? '-'); ?></td>
                                <td><?php echo e($grade->semester->name ?? '-'); ?></td>
                                <td><?php echo e($grade->nilai_tugas ?? '-'); ?></td>
                                <td><?php echo e($grade->nilai_uts ?? '-'); ?></td>
                                <td><?php echo e($grade->nilai_uas ?? '-'); ?></td>
                                <td><strong><?php echo e(number_format($grade->nilai_akhir, 2)); ?></strong></td>
                                <td>
                                    <span class="badge bg-<?php echo e($grade->nilai_akhir >= 85 ? 'success' : ($grade->nilai_akhir >= 75 ? 'primary' : ($grade->nilai_akhir >= 65 ? 'warning' : 'danger'))); ?>">
                                        <?php echo e($grade->predicate); ?>

                                    </span>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">Belum ada nilai rapor</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Project TA\NILAI_RAPOR_SISWA\resources\views/students/show.blade.php ENDPATH**/ ?>