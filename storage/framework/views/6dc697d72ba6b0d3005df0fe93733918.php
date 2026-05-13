<?php $__env->startSection('title', 'Dashboard - Staff TU'); ?>

<?php $__env->startSection('content'); ?>
<div class="row g-4 mb-4">
    <div class="col-12">
        <h2 class="h4">Selamat Datang, <?php echo e(Auth::user()->name); ?>!</h2>
        <p class="text-muted">Panel Staff Tata Usaha - Kelola data siswa, kelas, dan nilai per jurusan.</p>
    </div>
</div>

<div class="row g-4">
    <!-- Total Siswa -->
    <div class="col-12 col-sm-6 col-lg-3">
        <div class="card stat-card border-0 shadow-lg h-100 position-relative overflow-hidden" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); transition: all 0.3s ease;">
            <div class="card-body position-relative z-1">
                <div class="d-flex align-items-end justify-content-between">
                    <div>
                        <p class="text-white mb-2 small fw-semibold" style="opacity: 0.9;">Total Siswa</p>
                        <h2 class="text-white mb-0 fw-bold" style="font-size: 2.5rem; text-shadow: 0 2px 4px rgba(0,0,0,0.2);"><?php echo e($stats['total_siswa']); ?></h2>
                    </div>
                    <div class="text-white" style="opacity: 0.15; font-size: 4rem; line-height: 1;">
                        <i class="bi bi-people"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Jurusan -->
    <div class="col-12 col-sm-6 col-lg-3">
        <div class="card stat-card border-0 shadow-lg h-100 position-relative overflow-hidden" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); transition: all 0.3s ease;">
            <div class="card-body position-relative z-1">
                <div class="d-flex align-items-end justify-content-between">
                    <div>
                        <p class="text-white mb-2 small fw-semibold" style="opacity: 0.9;">Total Jurusan</p>
                        <h2 class="text-white mb-0 fw-bold" style="font-size: 2.5rem; text-shadow: 0 2px 4px rgba(0,0,0,0.2);"><?php echo e($stats['total_jurusan']); ?></h2>
                    </div>
                    <div class="text-white" style="opacity: 0.15; font-size: 4rem; line-height: 1;">
                        <i class="bi bi-bookmark"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Mata Pelajaran -->
    <div class="col-12 col-sm-6 col-lg-3">
        <div class="card stat-card border-0 shadow-lg h-100 position-relative overflow-hidden" style="background: linear-gradient(135deg, #2d5016 0%, #4a7023 100%); transition: all 0.3s ease;">
            <div class="card-body position-relative z-1">
                <div class="d-flex align-items-end justify-content-between">
                    <div>
                        <p class="text-white mb-2 small fw-semibold" style="opacity: 0.9;">Mata Pelajaran</p>
                        <h2 class="text-white mb-0 fw-bold" style="font-size: 2.5rem; text-shadow: 0 2px 4px rgba(0,0,0,0.2);"><?php echo e($stats['total_mapel'] ?? 0); ?></h2>
                    </div>
                    <div class="text-white" style="opacity: 0.15; font-size: 4rem; line-height: 1;">
                        <i class="bi bi-book"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Kelas -->
    <div class="col-12 col-sm-6 col-lg-3">
        <div class="card stat-card border-0 shadow-lg h-100 position-relative overflow-hidden" style="background: linear-gradient(135deg, #1e3799 0%, #0984e3 100%); transition: all 0.3s ease;">
            <div class="card-body position-relative z-1">
                <div class="d-flex align-items-end justify-content-between">
                    <div>
                        <p class="text-white mb-2 small fw-semibold" style="opacity: 0.9;">Total Kelas</p>
                        <h2 class="text-white mb-0 fw-bold" style="font-size: 2.5rem; text-shadow: 0 2px 4px rgba(0,0,0,0.2);"><?php echo e($stats['total_kelas'] ?? 0); ?></h2>
                    </div>
                    <div class="text-white" style="opacity: 0.15; font-size: 4rem; line-height: 1;">
                        <i class="bi bi-door-open"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.stat-card:hover {
    transform: translateY(-8px) !important;
    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.2) !important;
}
</style>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Project TA\NILAI_RAPOR_SISWA\resources\views/dashboard/staff_tu.blade.php ENDPATH**/ ?>