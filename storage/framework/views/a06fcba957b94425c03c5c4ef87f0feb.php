<?php $__env->startSection('title', 'Input Nilai - ' . $program->name); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
        <h2 class="mb-1">Input Nilai Per Jurusan</h2>
        <p class="text-secondary mb-0">Jurusan: <strong><?php echo e($program->name); ?></strong></p>
    </div>
    <a href="<?php echo e(route('programs.show', $program)); ?>" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-2"></i>Kembali
    </a>
</div>

<?php echo $__env->make('components.form-errors', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form action="<?php echo e(route('grades.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            
            <div class="row g-3">
                <div class="col-12 col-md-6">
                    <label class="form-label">Siswa <span class="text-danger">*</span></label>
                    <select name="student_id" class="form-select" id="studentSelect" required>
                        <option value="">-- Pilih Siswa --</option>
                        <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($student->id); ?>" data-nis="<?php echo e($student->nis); ?>"><?php echo e($student->nis); ?> - <?php echo e($student->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div class="col-12 col-md-6">
                    <label class="form-label">Mata Pelajaran <span class="text-danger">*</span></label>
                    <select name="subject_id" class="form-select" required>
                        <option value="">-- Pilih Mata Pelajaran --</option>
                        <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($subject->id); ?>"><?php echo e($subject->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div class="col-12 col-md-6">
                    <label class="form-label">Guru <span class="text-danger">*</span></label>
                    <select name="teacher_id" class="form-select" required>
                        <option value="">-- Pilih Guru --</option>
                        <?php $__currentLoopData = $teachers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teacher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($teacher->id); ?>"><?php echo e($teacher->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div class="col-12 col-md-6">
                    <label class="form-label">Kelas <span class="text-danger">*</span></label>
                    <select name="class_id" class="form-select" required>
                        <option value="">-- Pilih Kelas --</option>
                        <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($class->id); ?>"><?php echo e($class->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div class="col-12 col-md-6">
                    <label class="form-label">Tahun Ajaran <span class="text-danger">*</span></label>
                    <select name="school_year_id" class="form-select" required>
                        <option value="">-- Pilih Tahun Ajaran --</option>
                        <?php $__currentLoopData = $years; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $year): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($year->id); ?>"><?php echo e($year->year); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div class="col-12 col-md-6">
                    <label class="form-label">Semester <span class="text-danger">*</span></label>
                    <select name="semester_id" class="form-select" required>
                        <option value="">-- Pilih Semester --</option>
                        <?php $__currentLoopData = $semesters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $semester): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($semester->id); ?>"><?php echo e($semester->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div class="col-12">
                    <hr class="my-3">
                    <h5>Nilai Siswa</h5>
                </div>

                <div class="col-12 col-md-4">
                    <label class="form-label">Nilai Tugas (30%) <span class="text-danger">*</span></label>
                    <input type="number" name="nilai_tugas" class="form-control nilai-input" step="0.01" min="0" max="100" placeholder="0-100" value="<?php echo e(old('nilai_tugas')); ?>" required>
                    <small class="text-secondary">Bobot: 30% dari nilai akhir</small>
                </div>

                <div class="col-12 col-md-4">
                    <label class="form-label">Nilai UTS (30%) <span class="text-danger">*</span></label>
                    <input type="number" name="nilai_uts" class="form-control nilai-input" step="0.01" min="0" max="100" placeholder="0-100" value="<?php echo e(old('nilai_uts')); ?>" required>
                    <small class="text-secondary">Bobot: 30% dari nilai akhir</small>
                </div>

                <div class="col-12 col-md-4">
                    <label class="form-label">Nilai UAS (40%) <span class="text-danger">*</span></label>
                    <input type="number" name="nilai_uas" class="form-control nilai-input" step="0.01" min="0" max="100" placeholder="0-100" value="<?php echo e(old('nilai_uas')); ?>" required>
                    <small class="text-secondary">Bobot: 40% dari nilai akhir</small>
                </div>

                <div class="col-12 col-md-12">
                    <label class="form-label">Nilai Akhir (Otomatis)</label>
                    <input type="text" class="form-control" id="nilaiAkhir" disabled placeholder="Nilai akhir akan dihitung otomatis">
                </div>
            </div>

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-brand">
                    <i class="bi bi-check-circle me-2"></i>Simpan Nilai
                </button>
                <a href="<?php echo e(route('programs.show', $program)); ?>" class="btn btn-outline-secondary">
                    <i class="bi bi-x-circle me-2"></i>Batal
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    // Calculate final grade
    document.querySelectorAll('.nilai-input').forEach(input => {
        input.addEventListener('input', function() {
            const tugas = parseFloat(document.querySelector('input[name="nilai_tugas"]').value) || 0;
            const uts = parseFloat(document.querySelector('input[name="nilai_uts"]').value) || 0;
            const uas = parseFloat(document.querySelector('input[name="nilai_uas"]').value) || 0;

            const akhir = (tugas * 0.3) + (uts * 0.3) + (uas * 0.4);
            document.getElementById('nilaiAkhir').value = akhir.toFixed(2);
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\NILAI_RAPOR_SISWA\resources\views\grades\create-by-program.blade.php ENDPATH**/ ?>