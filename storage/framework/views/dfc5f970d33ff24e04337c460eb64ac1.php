

<?php $__env->startSection('title', 'Detail Siswa - ' . $student->name); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="h4 mb-1"><i class="bi bi-person me-2"></i>Informasi Siswa</h2>
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
    <!-- Student Info - Left -->
    <div class="col-lg-6 col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <td class="text-muted">NIS</td>
                        <td><strong><?php echo e($student->nis); ?></strong></td>
                    </tr>
                    <tr>
                        <td class="text-muted">Nama</td>
                        <td><?php echo e($student->name); ?></td>
                    </tr>
                    <tr>
                        <td class="text-muted">Jenis Kelamin</td>
                        <td><?php echo e($student->gender == 'L' ? 'Laki-laki' : 'Perempuan'); ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <!-- Student Info - Right -->
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <td class="text-muted">Kelas</td>
                        <td><?php echo e($student->getClassDisplayName()); ?></td>
                    </tr>
                    <tr>
                        <td class="text-muted">Tahun Lulus</td>
                        <td><?php echo e($student->graduation_year ?? '-'); ?></td>
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
</div>

<!-- Input Nilai Actions -->
<div class="row g-3 mb-4 mt-3">
    <!-- Input Nilai Bulk (Semua Pelajaran Sekaligus) -->
    <div class="col-12">
        <div class="card border-0 shadow-sm bg-success bg-opacity-10 h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="flex-shrink-0">
                    <div class="bg-success bg-opacity-25 rounded-circle p-3">
                        <i class="bi bi-check2-square fs-2 text-success"></i>
                    </div>
                </div>
                <div class="flex-grow-1">
                    <h5 class="card-title mb-2">Input Semua Nilai Pelajaran</h5>
                    <p class="card-text mb-0 small">Input nilai untuk semua mata pelajaran sekaligus dalam satu form</p>
                    <a href="<?php echo e(route('students.grades.bulk-create', $student)); ?>" class="btn btn-success btn-sm mt-2">
                        <i class="bi bi-plus-circle me-1"></i>Input Semua Pelajaran
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Nilai Rapor Table -->
<div class="row g-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="bi bi-clipboard-data me-2"></i>Nilai Rapor</h5>
                <a href="<?php echo e(route('reports.transcript', $student)); ?>" class="btn btn-sm btn-outline-primary">
                    <i class="bi bi-file-earmark-text me-1"></i>Lihat Transkrip
                </a>
            </div>
            <div class="card-body">
                <?php
                    // Group grades by level and year
                    $gradesByLevelAndYear = collect();
                    foreach($student->grades as $grade) {
                        $className = $grade->schoolClass->name ?? '';
                        // Extract class level (X, XI, XII)
                        preg_match('/\b(X|XI|XII)\b/', $className, $matches);
                        $level = $matches[1] ?? 'Lainnya';
                        
                        // Get school year - try multiple ways
                        $schoolYear = 'Tahun Tidak Diketahui';
                        if ($grade->school_year_id) {
                            // Try to get from loaded relation
                            if ($grade->schoolYear && $grade->schoolYear->name) {
                                $schoolYear = $grade->schoolYear->name;
                            } else {
                                // Fallback: query fresh
                                $sy = \App\Models\SchoolYear::find($grade->school_year_id);
                                $schoolYear = $sy->name ?? 'Tahun Tidak Diketahui';
                            }
                        }
                        
                        $key = $level . ' | ' . $schoolYear;
                        
                        if (!$gradesByLevelAndYear->has($key)) {
                            $gradesByLevelAndYear->put($key, collect());
                        }
                        
                        $gradesByLevelAndYear->get($key)->push($grade);
                    }
                    
                    // Sort by level first
                    $levelOrder = ['X', 'XI', 'XII', 'Lainnya'];
                    $gradesByLevelAndYear = collect($gradesByLevelAndYear)->sortBy(function($value, $key) use ($levelOrder) {
                        $level = explode(' | ', $key)[0];
                        return array_search($level, $levelOrder);
                    });
                ?>

                <?php if($gradesByLevelAndYear->isEmpty()): ?>
                    <div class="text-center text-muted py-4">
                        <p class="mb-0">Belum ada nilai rapor</p>
                    </div>
                <?php else: ?>
                    <div class="row g-3">
                        <?php $__currentLoopData = $gradesByLevelAndYear; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $levelAndYear => $levelGrades): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                // Parse level and year from key
                                $parts = explode(' | ', $levelAndYear);
                                $level = $parts[0] ?? 'Lainnya';
                                $schoolYear = $parts[1] ?? 'Tahun Tidak Diketahui';
                                
                                // Group by semester within each level
                                $gradesBySemester = $levelGrades->groupBy(function($grade) {
                                    return $grade->semester->name ?? 'Semester Tidak Diketahui';
                                });
                            ?>
                            
                            <div class="col-12 mb-4">
                                <div class="d-flex align-items-center mb-4 pb-3" style="border-bottom: 3px solid #e9ecef;">
                                    <div class="p-3 rounded-circle" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                        <i class="bi bi-book text-white fs-5"></i>
                                    </div>
                                    <div class="ms-3">
                                        <h5 class="mb-1 fw-700" style="color: #2c3e50;">Kelas <?php echo e($level); ?></h5>
                                        <span class="badge" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); font-size: 0.8rem; padding: 0.4rem 0.8rem;">
                                            <i class="bi bi-calendar2 me-1"></i><?php echo e($schoolYear); ?>

                                        </span>
                                    </div>
                                </div>

                                <div class="row g-4">
                                    <?php $__currentLoopData = $gradesBySemester; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $semester => $semesterGrades): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-lg-6">
                                        <div class="card border-0 shadow-sm" style="border-radius: 12px; overflow: hidden;">
                                            <div class="card-header bg-light d-flex justify-content-between align-items-center" style="border-bottom: 2px solid #e9ecef; padding: 0.75rem 1rem;">
                                                <h6 class="mb-0" style="color: #2c3e50; font-weight: 600;">
                                                    <span style="background: linear-gradient(135deg, <?php echo e(strpos($semester, '1') !== false ? '#667eea' : '#f093fb'); ?> 0%, <?php echo e(strpos($semester, '1') !== false ? '#764ba2' : '#4facfe'); ?> 100%); color: white; padding: 0.3rem 0.6rem; border-radius: 6px; font-size: 0.85rem;">
                                                        <i class="bi bi-calendar3 me-1"></i><?php echo e($semester); ?>

                                                    </span>
                                                </h6>
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <?php
                                                        $firstGrade = $semesterGrades->first();
                                                        $semesterId = $firstGrade->semester_id ?? null;
                                                        $schoolYearId = $firstGrade->school_year_id ?? null;
                                                    ?>
                                                    <button type="button" class="btn btn-outline-primary btn-edit-semester" 
                                                            data-semester="<?php echo e($semester); ?>" 
                                                            data-student-id="<?php echo e($student->id); ?>"
                                                            data-semester-id="<?php echo e($semesterId); ?>"
                                                            data-year-id="<?php echo e($schoolYearId); ?>"
                                                            title="Edit semua nilai semester ini">
                                                        <i class="bi bi-pencil"></i>
                                                    </button>
                                                    <form method="POST" action="<?php echo e(route('grades.semester-destroy', ['student' => $student->id, 'semesterId' => $semesterId, 'yearId' => $schoolYearId])); ?>" style="display:inline;" onsubmit="return confirm('Hapus semua nilai semester ini?');">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('DELETE'); ?>
                                                        <button type="submit" class="btn btn-outline-danger" title="Hapus semua nilai semester">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="card-body p-0">
                                                <div class="table-responsive">
                                                    <table class="table table-hover mb-0" style="border-collapse: separate; border-spacing: 0;">
                                                        <thead>
                                                            <tr style="background-color: #f8f9fa; border-bottom: 2px solid #e9ecef;">
                                                                <th class="px-3 py-3" style="color: #2c3e50; font-weight: 600; font-size: 0.9rem;">Mata Pelajaran</th>
                                                                <th class="px-3 py-3 text-center" style="color: #2c3e50; font-weight: 600; font-size: 0.9rem;">Nilai</th>
                                                                <th class="px-3 py-3 text-center" style="color: #2c3e50; font-weight: 600; font-size: 0.9rem;">Predikat</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $__currentLoopData = $semesterGrades->sortBy(function($grade) { return $grade->subject->name; }); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $grade): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <tr style="border-bottom: 1px solid #f1f3f5; transition: all 0.3s ease;">
                                                                    <td class="px-3 py-3" style="color: #495057;"><?php echo e($grade->subject->name ?? '-'); ?></td>
                                                                    <td class="px-3 py-3 text-center">
                                                                        <span style="display: inline-block; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 0.35rem 0.85rem; border-radius: 20px; font-weight: 600; font-size: 0.95rem;">
                                                                            <?php echo e(number_format($grade->nilai, 2)); ?>

                                                                        </span>
                                                                    </td>
                                                                    <td class="px-3 py-3 text-center">
                                                                        <?php
                                                                            $nilaiGrade = $grade->nilai;
                                                                            if ($nilaiGrade >= 85) {
                                                                                $bgColor = '#28a745';
                                                                                $icon = 'bi-check-circle';
                                                                            } elseif ($nilaiGrade >= 75) {
                                                                                $bgColor = '#007bff';
                                                                                $icon = 'bi-check';
                                                                            } elseif ($nilaiGrade >= 65) {
                                                                                $bgColor = '#ffc107';
                                                                                $icon = 'bi-exclamation';
                                                                            } else {
                                                                                $bgColor = '#dc3545';
                                                                                $icon = 'bi-x-circle';
                                                                            }
                                                                        ?>
                                                                        <span style="display: inline-block; background-color: <?php echo e($bgColor); ?>; color: white; padding: 0.4rem 0.65rem; border-radius: 20px; font-weight: 600; font-size: 0.85rem;">
                                                                            <i class="bi <?php echo e($icon); ?> me-1"></i><?php echo e($grade->predicate); ?>

                                                                        </span>
                                                                    </td>
                                                                </tr>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            
                                                            <!-- Mata Pelajaran Jurusan untuk semester ini -->
                                                            <?php
                                                                $gradeWithJurusan = $semesterGrades->first();
                                                                $hasJurusanData = false;
                                                                if ($gradeWithJurusan) {
                                                                    for ($i = 1; $i <= 6; $i++) {
                                                                        if ($gradeWithJurusan->{'jurusan_subject_'.$i}) {
                                                                            $hasJurusanData = true;
                                                                            break;
                                                                        }
                                                                    }
                                                                }
                                                            ?>
                                                            
                                                            <?php if($hasJurusanData && $gradeWithJurusan): ?>
                                                                <?php for($i = 1; $i <= 6; $i++): ?>
                                                                    <?php if($gradeWithJurusan->{'jurusan_subject_'.$i}): ?>
                                                                        <tr style="border-bottom: 1px solid #f1f3f5; transition: all 0.3s ease; background-color: #fff9f0;">
                                                                            <td class="px-3 py-3" style="color: #495057;"><i class="bi bi-mortarboard me-2" style="color: #ff9800;"></i><?php echo e($gradeWithJurusan->{'jurusan_subject_'.$i} ?? '-'); ?></td>
                                                                            <td class="px-3 py-3 text-center">
                                                                                <?php if($gradeWithJurusan->{'jurusan_nilai_'.$i}): ?>
                                                                                    <span style="display: inline-block; background: linear-gradient(135deg, #ff9800 0%, #f57c00 100%); color: white; padding: 0.35rem 0.85rem; border-radius: 20px; font-weight: 600; font-size: 0.95rem;">
                                                                                        <?php echo e(number_format($gradeWithJurusan->{'jurusan_nilai_'.$i}, 2)); ?>

                                                                                    </span>
                                                                                <?php else: ?>
                                                                                    <span style="color: #999;">-</span>
                                                                                <?php endif; ?>
                                                                            </td>
                                                                            <td class="px-3 py-3 text-center">
                                                                                <?php
                                                                                    $nilaiJurusan = $gradeWithJurusan->{'jurusan_nilai_'.$i};
                                                                                    if ($nilaiJurusan !== null) {
                                                                                        if ($nilaiJurusan >= 85) {
                                                                                            $bgColorJ = '#28a745';
                                                                                            $iconJ = 'bi-check-circle';
                                                                                            $predikatJ = 'A';
                                                                                        } elseif ($nilaiJurusan >= 75) {
                                                                                            $bgColorJ = '#007bff';
                                                                                            $iconJ = 'bi-check';
                                                                                            $predikatJ = 'B';
                                                                                        } elseif ($nilaiJurusan >= 65) {
                                                                                            $bgColorJ = '#ffc107';
                                                                                            $iconJ = 'bi-exclamation';
                                                                                            $predikatJ = 'C';
                                                                                        } else {
                                                                                            $bgColorJ = '#dc3545';
                                                                                            $iconJ = 'bi-x-circle';
                                                                                            $predikatJ = 'D';
                                                                                        }
                                                                                    }
                                                                                ?>
                                                                                <?php if($nilaiJurusan !== null): ?>
                                                                                    <span style="display: inline-block; background-color: <?php echo e($bgColorJ); ?>; color: white; padding: 0.4rem 0.65rem; border-radius: 20px; font-weight: 600; font-size: 0.85rem;">
                                                                                        <i class="bi <?php echo e($iconJ); ?> me-1"></i><?php echo e($predikatJ); ?>

                                                                                    </span>
                                                                                <?php else: ?>
                                                                                    <span style="color: #999;">-</span>
                                                                                <?php endif; ?>
                                                                            </td>
                                                                        </tr>
                                                                    <?php endif; ?>
                                                                <?php endfor; ?>
                                                            <?php endif; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
</div>
</div>

<!-- Edit Grade Modal -->
<div class="modal fade" id="editGradeModal" tabindex="-1" aria-labelledby="editGradeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title" id="editGradeModalLabel">Edit Nilai Rapor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editGradeForm" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PATCH'); ?>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Mata Pelajaran</label>
                        <input type="text" class="form-control" id="subjectName" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nilai <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="nilaiInput" name="nilai" step="0.01" min="0" max="100" required>
                        <small class="text-muted">Masukkan nilai 0-100</small>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Handle edit semester button click
    document.querySelectorAll('.btn-edit-semester').forEach(button => {
        button.addEventListener('click', function() {
            const studentId = this.getAttribute('data-student-id');
            const semesterId = this.getAttribute('data-semester-id');
            const yearId = this.getAttribute('data-year-id');
            
            // Navigate to edit semester page
            window.location.href = `/students/${studentId}/semester/${semesterId}/year/${yearId}/edit`;
        });
    });

    // Handle edit button click
    document.querySelectorAll('.btn-edit-grade').forEach(button => {
        button.addEventListener('click', function() {
            const gradeId = this.getAttribute('data-grade-id');
            const subject = this.getAttribute('data-subject');
            const nilai = this.getAttribute('data-nilai');
            
            // Set modal values
            document.getElementById('subjectName').value = subject;
            document.getElementById('nilaiInput').value = nilai;
            
            // Set form action
            const form = document.getElementById('editGradeForm');
            form.action = `/grades/${gradeId}`;
            
            // Show modal
            const modal = new bootstrap.Modal(document.getElementById('editGradeModal'));
            modal.show();
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Project TA\NILAI_RAPOR_SISWA\resources\views/students/show.blade.php ENDPATH**/ ?>