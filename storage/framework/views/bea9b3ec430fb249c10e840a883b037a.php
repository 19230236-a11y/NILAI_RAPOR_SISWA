<?php $__env->startSection('content'); ?>
<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
    <div>
        <h2 class="mb-1">Input Nilai Rapor</h2>
        <p class="text-secondary mb-0">Masukkan nilai tugas, UTS, dan UAS untuk siswa.</p>
    </div>
</div>

<?php echo $__env->make('components.form-errors', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form action="<?php echo e(route('grades.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            
            <div class="row g-3">
                <div class="col-12 col-md-6">
                    <label class="form-label">Nama Siswa <span class="text-danger">*</span></label>
                    <input type="text" name="student_name" class="form-control" placeholder="Masukkan nama siswa" value="<?php echo e(old('student_name')); ?>" required>
                    <small class="text-secondary">Ketik nama siswa secara manual, contoh: Ahmad Fauzi</small>
                </div>
                
                <div class="col-12 col-md-6">
                    <label class="form-label">Mata Pelajaran <span class="text-danger">*</span></label>
                    <input type="text" name="subject_name" class="form-control" placeholder="Masukkan nama mapel" value="<?php echo e(old('subject_name')); ?>" required>
                    <small class="text-secondary">Ketik nama mata pelajaran secara manual, contoh: Matematika</small>
                </div>
                
                <div class="col-12 col-md-6">
                    <label class="form-label">Nama Guru <span class="text-danger">*</span></label>
                    <input type="text" name="teacher_name" class="form-control" placeholder="Masukkan nama guru" value="<?php echo e(old('teacher_name')); ?>" required>
                    <small class="text-secondary">Ketik nama guru secara manual, contoh: Budi Santoso</small>
                </div>
                
                <div class="col-12 col-md-6">
                    <label class="form-label">Kelas <span class="text-danger">*</span></label>
                    <input type="text" name="class_name" class="form-control" placeholder="Masukkan nama kelas" value="<?php echo e(old('class_name')); ?>" required>
                    <small class="text-secondary">Ketik nama kelas secara manual, contoh: X IPA 1</small>
                </div>
                
                <div class="col-12 col-md-6">
                    <label class="form-label">Tahun Ajaran <span class="text-danger">*</span></label>
                    <input type="text" name="school_year" class="form-control" placeholder="Masukkan tahun ajaran" value="<?php echo e(old('school_year')); ?>" required>
                    <small class="text-secondary">Ketik tahun ajaran manual, contoh: 2025/2026</small>
                </div>
                
                <div class="col-12 col-md-6">
                    <label class="form-label">Semester <span class="text-danger">*</span></label>
                    <input type="text" name="semester_name" class="form-control" placeholder="Masukkan semester" value="<?php echo e(old('semester_name')); ?>" required>
                    <small class="text-secondary">Ketik semester manual, contoh: Semester 1</small>
                </div>
                
                <div class="col-12">
                    <hr class="my-3">
                    <h5>Nilai Siswa</h5>
                </div>
                
                <div class="col-12 col-md-4">
                    <label class="form-label">Nilai Tugas (30%) <span class="text-danger">*</span></label>
                    <input type="number" name="nilai_tugas" class="form-control" step="0.01" min="0" max="100" placeholder="0-100" value="<?php echo e(old('nilai_tugas')); ?>" required>
                    <small class="text-secondary">Bobot: 30% dari nilai akhir</small>
                </div>
                
                <div class="col-12 col-md-4">
                    <label class="form-label">Nilai UTS (30%) <span class="text-danger">*</span></label>
                    <input type="number" name="nilai_uts" class="form-control" step="0.01" min="0" max="100" placeholder="0-100" value="<?php echo e(old('nilai_uts')); ?>" required>
                    <small class="text-secondary">Bobot: 30% dari nilai akhir</small>
                </div>
                
                <div class="col-12 col-md-4">
                    <label class="form-label">Nilai UAS (40%) <span class="text-danger">*</span></label>
                    <input type="number" name="nilai_uas" class="form-control" step="0.01" min="0" max="100" placeholder="0-100" value="<?php echo e(old('nilai_uas')); ?>" required>
                    <small class="text-secondary">Bobot: 40% dari nilai akhir</small>
                </div>
            </div>
            
            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-brand">Simpan Nilai</button>
                <a href="<?php echo e(route('grades.index')); ?>" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Project TA\NILAI_RAPOR_SISWA\resources\views/grades/create.blade.php ENDPATH**/ ?>