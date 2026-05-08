<!DOCTYPE html>
<html lang="id">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title><?php echo $__env->yieldContent('title', 'Login'); ?></title>

        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Bootstrap Icons -->
        <link rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

        <?php echo $__env->yieldPushContent('style'); ?>

    </head>

    <body>

        <?php echo $__env->yieldContent('main'); ?>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

        <?php echo $__env->yieldPushContent('scripts'); ?>

    </body>

</html><?php /**PATH D:\NILAI_RAPOR_SISWA\resources\views\layouts\auth.blade.php ENDPATH**/ ?>