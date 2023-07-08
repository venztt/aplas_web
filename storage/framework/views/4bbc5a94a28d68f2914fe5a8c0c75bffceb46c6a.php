<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>"/>

    <title>APLAS - Administrator Site</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?php echo e(asset('lte/plugins/fontawesome-free/css/all.min.css')); ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo e(asset('lte/dist/css/adminlte.min.css')); ?>">
    <!-- Google Font: Source Sans Pro -->

    <link rel="stylesheet" href="<?php echo e(asset('lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')); ?>"/>

    <link rel="stylesheet" href="<?php echo e(asset('lte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')); ?>"/>

    <link rel="stylesheet" href="<?php echo e(asset('lte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')); ?>"/>

    <link rel="stylesheet" href="<?php echo e(asset('lte/plugins/datatables-select/css/select.bootstrap4.min.css')); ?>"/>

    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- yield for script -->
    <?php echo $__env->yieldContent('style'); ?>

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <!-- Navbar -->
    <?php echo $__env->make('student/header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?php echo $__env->make('student/sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <?php echo $__env->yieldContent('content'); ?>
        <!-- /.content -->
        <?php if(isset($status)): ?>
            <?php if($status!='active'): ?>
                <div class="content">
                    <center>
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                        <h1>Sorry, you can not use this features yet!!</h1>
                        <h2>Your account need to be validated by the teacher, please kindly wait to be validated.</h2>
                        <p>&nbsp;</p>
                        <img src="<?php echo e(asset('lte/dist/img/logo-aplas.png')); ?>" alt="APLAS logo"
                             class="brand-image elevation-3"
                             style="opacity: .8">
                    </center>
                </div>
            <?php endif; ?>
        <?php endif; ?>
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
    <?php echo $__env->make('student/footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

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
<?php /**PATH C:\Belajar java\code\resources\views/student/home.blade.php ENDPATH**/ ?>