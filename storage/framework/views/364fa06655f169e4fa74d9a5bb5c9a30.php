<?php $__env->startSection('title', 'Input Nilai - ' . $student->name); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
        <h2 class="mb-1">Input Nilai - Semua Pelajaran</h2>
        <p class="text-secondary mb-0">Siswa: <strong><?php echo e($student->name); ?></strong> (<?php echo e($student->nis); ?>)</p>
    </div>
    <a href="<?php echo e(route('students.show', $student)); ?>" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-2"></i>Kembali
    </a>
</div>

<?php echo $__env->make('components.form-errors', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form action="<?php echo e(route('students.grades.bulk-store', $student)); ?>" method="POST" id="bulkGradesForm">
            <?php echo csrf_field(); ?>
            
            <!-- Filter Section -->
            <div class="row g-3 mb-4">
                <div class="col-12 col-md-4">
                    <label class="form-label">Kelas <span class="text-danger">*</span></label>
                    <select name="class_id" class="form-select" id="classSelect" required>
                        <option value="">-- Pilih Kelas --</option>
                        <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($class->id); ?>"><?php echo e($class->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div class="col-12 col-md-4">
                    <label class="form-label">Tahun Ajaran <span class="text-danger">*</span></label>
                    <select name="school_year_id" class="form-select" id="yearSelect" required>
                        <option value="">-- Pilih Tahun --</option>
                        <?php $__currentLoopData = $years; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $year): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($year->id); ?>"><?php echo e($year->year); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div class="col-12 col-md-4">
                    <label class="form-label">Semester <span class="text-danger">*</span></label>
                    <select name="semester_id" class="form-select" id="semesterSelect" required>
                        <option value="">-- Pilih Semester --</option>
                        <?php $__currentLoopData = $semesters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $semester): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($semester->id); ?>"><?php echo e($semester->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>

            <hr class="my-4">

            <!-- Subjects and Grades Section -->
            <div class="mb-4">
                <h5 class="mb-3">Nilai Pelajaran</h5>

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>Mata Pelajaran</th>
                                <th>Guru</th>
                                <th style="width: 120px">Tugas (30%)</th>
                                <th style="width: 120px">UTS (30%)</th>
                                <th style="width: 120px">UAS (40%)</th>
                                <th style="width: 120px">Nilai Akhir</th>
                            </tr>
                        </thead>
                        <tbody id="subjectsTableBody">
                            <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <input type="hidden" name="grades[<?php echo e($loop->index); ?>][subject_id]" value="<?php echo e($subject->id); ?>">
                                        <?php echo e($subject->name); ?>

                                    </td>
                                    <td>
                                        <select name="grades[<?php echo e($loop->index); ?>][teacher_id]" class="form-select form-select-sm">
                                            <option value="">-- Pilih Guru --</option>
                                            <?php $__currentLoopData = $teachers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teacher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($teacher->id); ?>"><?php echo e($teacher->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" name="grades[<?php echo e($loop->index); ?>][nilai_tugas]" class="form-control form-control-sm nilai-input" 
                                               step="0.01" min="0" max="100" placeholder="0-100">
                                    </td>
                                    <td>
                                        <input type="number" name="grades[<?php echo e($loop->index); ?>][nilai_uts]" class="form-control form-control-sm nilai-input" 
                                               step="0.01" min="0" max="100" placeholder="0-100">
                                    </td>
                                    <td>
                                        <input type="number" name="grades[<?php echo e($loop->index); ?>][nilai_uas]" class="form-control form-control-sm nilai-input" 
                                               step="0.01" min="0" max="100" placeholder="0-100">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control form-control-sm nilai-akhir" disabled placeholder="Otomatis">
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-brand">
                    <i class="bi bi-check-circle me-2"></i>Simpan Semua Nilai
                </button>
                <a href="<?php echo e(route('students.show', $student)); ?>" class="btn btn-outline-secondary">
                    <i class="bi bi-x-circle me-2"></i>Batal
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    // Calculate final grade on input change
    document.querySelectorAll('.nilai-input').forEach(input => {
        input.addEventListener('input', function() {
            calculateFinalGrade(this);
        });
    });

    function calculateFinalGrade(element) {
        const row = element.closest('tr');
        const tugas = parseFloat(row.querySelector('input[name*="nilai_tugas"]').value) || 0;
        const uts = parseFloat(row.querySelector('input[name*="nilai_uts"]').value) || 0;
        const uas = parseFloat(row.querySelector('input[name*="nilai_uas"]').value) || 0;

        const akhir = (tugas * 0.3) + (uts * 0.3) + (uas * 0.4);
        row.querySelector('.nilai-akhir').value = akhir.toFixed(2);
    }

    // Form submission
    document.getElementById('bulkGradesForm').addEventListener('submit', function(e) {
        e.preventDefault();

        // Validate required fields
        if (!document.getElementById('classSelect').value) {
            alert('Pilih kelas terlebih dahulu');
            return;
        }
        if (!document.getElementById('yearSelect').value) {
            alert('Pilih tahun ajaran terlebih dahulu');
            return;
        }
        if (!document.getElementById('semesterSelect').value) {
            alert('Pilih semester terlebih dahulu');
            return;
        }

        // Check if any grades are filled
        const nilaiInputs = document.querySelectorAll('.nilai-input');
        const hasAnyValue = Array.from(nilaiInputs).some(input => input.value);
        
        if (!hasAnyValue) {
            alert('Masukkan minimal satu nilai');
            return;
        }

        this.submit();
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\NILAI_RAPOR_SISWA\resources\views\grades\bulk-create-by-student.blade.php ENDPATH**/ ?>