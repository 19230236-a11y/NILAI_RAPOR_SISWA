<?php if($message = Session::get('success')): ?>
    <div class="alert alert-success alert-dismissible show fade">
        <div class="alert-body">
            <button class="close" data-dismiss="alert">
                <span>×</span>
            </button>
            <p><?php echo e($message); ?></p>
        </div>
    </div>
<?php endif; ?>

<?php if($message = Session::get('error')): ?>
    <div class="alert alert-danger alert-dismissible show fade">
        <div class="alert-body">
            <button class="close" data-dismiss="alert">
                <span>×</span>
            </button>
            <p><?php echo e($message); ?></p>
        </div>
    </div>
<?php endif; ?>

<?php if($message = Session::get('warning')): ?>
    <div class="alert alert-warning alert-dismissible show fade">
        <div class="alert-body">
            <button class="close" data-dismiss="alert">
                <span>×</span>
            </button>
            <p><?php echo e($message); ?></p>
        </div>
    </div>
<?php endif; ?>

<?php if($message = Session::get('info')): ?>
    <div class="alert alert-info alert-dismissible show fade">
        <div class="alert-body">
            <button class="close" data-dismiss="alert">
                <span>×</span>
            </button>
            <p><?php echo e($message); ?></p>
        </div>
    </div>
<?php endif; ?>
<?php /**PATH D:\NILAI_RAPOR_SISWA\resources\views\layouts\alert.blade.php ENDPATH**/ ?>