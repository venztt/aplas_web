<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>APLAS - Administrator Site</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?php echo e(asset('lte/plugins/fontawesome-free/css/all.min.css')); ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo e(asset('lte/dist/css/adminlte.min.css')); ?>">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo e(asset('lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')); ?>"/>

    <link rel="stylesheet" href="<?php echo e(asset('lte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')); ?>"/>

    <link rel="stylesheet" href="<?php echo e(asset('lte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')); ?>"/>

    <link rel="stylesheet" href="<?php echo e(asset('lte/plugins/datatables-select/css/select.bootstrap4.min.css')); ?>"/>

    <?php echo $__env->yieldContent('style'); ?>

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <!-- Navbar -->
<?php echo $__env->make('teacher/header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- /.navbar -->

    <!-- Main Sidebar Container -->
<?php echo $__env->make('teacher/sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        <!-- /.content-header -->

        <!-- Main content -->
    <?php echo $__env->yieldContent('content'); ?>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
        <div class="p-3">
            <h5>Title</h5>
            <p>Sidebar content</p>
        </div>
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <?php echo $__env->make('teacher/footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="<?php echo e(asset('lte/plugins/jquery/jquery.min.js')); ?>"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo e(asset('lte/plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo e(asset('lte/plugins/datatables/jquery.dataTables.min.js')); ?>"></script>

<script src="<?php echo e(asset('lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')); ?>"></script>

<script src="<?php echo e(asset('lte/plugins/datatables-responsive/js/dataTables.responsive.min.js')); ?>"></script>

<script src="<?php echo e(asset('lte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')); ?>"></script>

<script src="<?php echo e(asset('lte/plugins/datatables-buttons/js/dataTables.buttons.min.js')); ?>"></script>

<script src="<?php echo e(asset('lte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')); ?>"></script>

<script src="<?php echo e(asset('lte/dist/js/adminlte.min.js')); ?>"></script>

<?php echo $__env->yieldContent('scripts'); ?>
</body>
</html>
<?php /**PATH D:\Kuliah\Skripsi\code\resources\views/teacher/home.blade.php ENDPATH**/ ?>