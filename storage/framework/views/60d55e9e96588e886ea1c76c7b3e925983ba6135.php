<?php $__env->startSection('content'); ?>

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>A Exercise Detail</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th style="width: 40%">ID Modul</th>
                                    <td style="width: 60%"><?php echo e($exercise->id ?? ''); ?></td>
                                </tr>
                                <tr>
                                    <th style="width: 40%">Nama Modul</th>
                                    <td style="width: 60%"><?php echo e($exercise->name ?? ''); ?></td>
                                </tr>
                                <tr>
                                    <th style="width: 40%">Tingkatan</th>
                                    <td style="width: 60%"><?php echo e($exercise->grade ?? ''); ?></td>
                                </tr>

                                <tr>
                                    <th style="width: 40%">Path Modul</th>
                                    <td style="width: 60%">
                                        <?php if($exercise->module_path): ?>
                                            <a class="btn btn-success form-control"
                                               href="<?php echo e(url('storage' . DIRECTORY_SEPARATOR . strstr($exercise->module_path, 'java'))); ?>">Download</a>
                                        <?php else: ?>
                                            <p class="form-control">No file found</p>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin/admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Belajar java\code\resources\views/admin/java/exercises/show.blade.php ENDPATH**/ ?>