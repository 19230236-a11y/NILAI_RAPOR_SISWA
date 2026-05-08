<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">BAHRI HR</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">

            <li class="nav-item  ">
                <a href="<?php echo e(route('home')); ?>" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>

            <!-- Program Items from Database -->
            <?php $__empty_1 = true; $__currentLoopData = \App\Models\Program::orderBy('name')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $program): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <li class="nav-item <?php echo e(request()->is('programs/' . $program->id . '*') ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('programs.show', $program)); ?>" class="nav-link">
                        <i class="fas fa-graduation-cap"></i>
                        <span><?php echo e($program->name); ?></span>
                    </a>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <li class="nav-item">
                    <a href="#" class="nav-link disabled">
                        <i class="fas fa-graduation-cap"></i>
                        <span>Tidak ada program</span>
                    </a>
                </li>
            <?php endif; ?>

            <li class="nav-item <?php echo e(request()->is('permissions*') ? 'active' : ''); ?>">
                <a href="<?php echo e(Route::has('permissions.index') ? route('permissions.index') : url('permissions')); ?>" class="nav-link">
                    <i class="fas fa-columns"></i>
                    <span>User</span>
                </a>
            </li>

    </aside>
</div>
<?php /**PATH D:\NILAI_RAPOR_SISWA\resources\views\components\sidebar.blade.php ENDPATH**/ ?>