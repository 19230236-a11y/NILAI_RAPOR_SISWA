<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Contoh Penginputan Nilai Siswa</div>
                <div class="card-body">
                    <form action="<?php echo e(route('grades.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <label for="student_name">Nama Siswa</label>
                            <input type="text" name="student_name" id="student_name" class="form-control" placeholder="Masukkan nama siswa" required>
                        </div>
                        <div class="form-group">
                            <label for="teacher_name">Nama Guru</label>
                            <input type="text" name="teacher_name" id="teacher_name" class="form-control" placeholder="Masukkan nama guru" required>
                        </div>
                        <div class="form-group">
                            <label for="class_name">Nama Kelas</label>
                            <input type="text" name="class_name" id="class_name" class="form-control" placeholder="Masukkan nama kelas" required>
                        </div>
                        <div class="form-group">
                            <label for="score">Nilai</label>
                            <input type="number" name="score" id="score" class="form-control" min="0" max="100" required>
                        </div>
                        <div class="form-group">
                            <label for="semester">Semester</label>
                            <input type="text" name="semester" id="semester" class="form-control" placeholder="Masukkan semester (e.g., Semester 1)" required>
                        </div>
                        <div class="form-group">
                            <label for="school_year_id">Tahun Ajaran</label>
                            <select name="school_year_id" id="school_year_id" class="form-control" required>
                                <option value="">-- Pilih Tahun Ajaran --</option>
                                <?php $__currentLoopData = \App\Models\SchoolYear::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $year): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($year->id); ?>"><?php echo e($year->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan Nilai Siswa</label>
                            <textarea name="keterangan" id="keterangan" class="form-control" rows="3" placeholder="Masukkan keterangan atau catatan untuk nilai siswa ini"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan Nilai</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\NILAI_RAPOR_SISWA\resources\views\demo.blade.php ENDPATH**/ ?>