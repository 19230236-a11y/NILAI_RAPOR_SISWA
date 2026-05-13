<?php $__env->startSection('title', 'Dashboard - Siswa'); ?>

<?php $__env->startSection('content'); ?>
<div class="row g-4 mb-4">
    <div class="col-12">
        <h2 class="h4">Selamat Datang, <?php echo e(Auth::user()->name); ?>!</h2>
        <p class="text-muted">Panel Siswa - Lihat nilai rapor Anda.</p>
    </div>
</div>

<div class="row g-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0">
                <h5 class="mb-0"><i class="bi bi-person-badge me-2"></i>Profil Siswa</h5>
            </div>
            <div class="card-body">
                <?php if($student): ?>
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td class="text-muted">NIS</td>
                                <td>: <?php echo e($student->nis); ?></td>
                            </tr>
                            <tr>
                                <td class="text-muted">Nama</td>
                                <td>: <?php echo e($student->name); ?></td>
                            </tr>
                            <tr>
                                <td class="text-muted">Jenis Kelamin</td>
                                <td>: <?php echo e($student->gender == 'L' ? 'Laki-laki' : 'Perempuan'); ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td class="text-muted">Tempat, Tanggal Lahir</td>
                                <td>: <?php echo e($student->birth_place); ?>, <?php echo e(\Carbon\Carbon::parse($student->birth_date)->format('d F Y')); ?></td>
                            </tr>
                            <tr>
                                <td class="text-muted">Alamat</td>
                                <td>: <?php echo e($student->address ?? '-'); ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <?php else: ?>
                <div class="alert alert-warning">
                    Data siswa tidak ditemukan. Silakan hubungi administrator.
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mt-2">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0">
                <h5 class="mb-0"><i class="bi bi-clipboard-data me-2"></i>Nilai Rapor</h5>
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
                                <th>Nilai Akhir</th>
                                <th>Predikat</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $myGrades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $grade): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($grade->subject->name ?? '-'); ?></td>
                                <td><?php echo e($grade->schoolClass->name ?? '-'); ?></td>
                                <td><?php echo e($grade->semester->name ?? '-'); ?></td>
                                <td><?php echo e($grade->nilai_tugas ?? '-'); ?></td>
                                <td><?php echo e($grade->nilai_uts ?? '-'); ?></td>
                                <td><?php echo e($grade->nilai_uas ?? '-'); ?></td>
                                <td>
                                    <strong><?php echo e(number_format($grade->nilai_akhir, 2)); ?></strong>
                                </td>
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
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\NILAI_RAPOR_SISWA\resources\views\dashboard\siswa.blade.php ENDPATH**/ ?>