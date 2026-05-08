

<?php $__env->startSection('title', 'Dashboard - Staff TU'); ?>

<?php $__env->startSection('content'); ?>
<div class="row g-4 mb-4">
    <div class="col-12">
        <h2 class="h4">Selamat Datang, <?php echo e(Auth::user()->name); ?>!</h2>
        <p class="text-muted">Panel Staff Tata Usaha - Kelola data siswa, kelas, dan laporan nilai.</p>
    </div>
</div>

<div class="row g-4">
    <!-- Total Siswa -->
    <div class="col-6 col-lg-3">
        <div class="card stat-card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                            <i class="bi bi-people fs-4 text-primary"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <p class="text-muted mb-0 small">Total Siswa</p>
                        <h3 class="mb-0"><?php echo e($stats['total_siswa']); ?></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Jurusan -->
    <div class="col-6 col-lg-3">
        <div class="card stat-card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="bg-success bg-opacity-10 rounded-circle p-3">
                            <i class="bi bi-bookmark fs-4 text-success"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <p class="text-muted mb-0 small">Total Jurusan</p>
                        <h3 class="mb-0"><?php echo e($stats['total_jurusan']); ?></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mt-4 mb-4">
    <!-- Input Nilai via Siswa -->
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm bg-info bg-opacity-10 h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="flex-shrink-0">
                    <div class="bg-info bg-opacity-25 rounded-circle p-3">
                        <i class="bi bi-person-check fs-2 text-info"></i>
                    </div>
                </div>
                <div class="flex-grow-1">
                    <h5 class="card-title mb-2">Input Nilai - Per Siswa</h5>
                    <p class="card-text mb-0 small">Buka halaman siswa untuk input nilai semua pelajaran atau per pelajaran</p>
                    <a href="<?php echo e(route('students.index')); ?>" class="btn btn-info btn-sm mt-2">
                        <i class="bi bi-arrow-right me-1"></i>Ke Data Siswa
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Input Nilai via Jurusan -->
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm bg-warning bg-opacity-10 h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="flex-shrink-0">
                    <div class="bg-warning bg-opacity-25 rounded-circle p-3">
                        <i class="bi bi-building fs-2 text-warning"></i>
                    </div>
                </div>
                <div class="flex-grow-1">
                    <h5 class="card-title mb-2">Input Nilai - Per Jurusan</h5>
                    <p class="card-text mb-0 small">Masuk ke halaman jurusan untuk input nilai semua pelajaran atau per pelajaran</p>
                    <a href="<?php echo e(route('programs.index')); ?>" class="btn btn-warning btn-sm mt-2">
                        <i class="bi bi-arrow-right me-1"></i>Ke Data Jurusan
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Recent Students -->
    <div class="col-lg-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="bi bi-people me-2"></i>Siswa Terbaru</h5>
                <a href="<?php echo e(route('students.index')); ?>" class="btn btn-sm btn-outline-secondary">Lihat Semua</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>NIS</th>
                                <th>Nama</th>
                                <th>Jurusan</th>
                                <th>Jenis Kelamin</th>
                                <th>Tanggal Lahir</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $recentStudents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($student->nis); ?></td>
                                <td><?php echo e($student->name); ?></td>
                                <td><?php echo e($student->program?->name ?? '-'); ?></td>
                                <td><?php echo e($student->gender == 'L' ? 'Laki-laki' : 'Perempuan'); ?></td>
                                <td><?php echo e(\Carbon\Carbon::parse($student->birth_date)->format('d/m/Y')); ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">Belum ada data siswa</td>
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
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Project TA\NILAI_RAPOR_SISWA\resources\views/dashboard/staff_tu.blade.php ENDPATH**/ ?>