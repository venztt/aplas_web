<?php $__env->startSection('content'); ?>

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>A Topics Detail</h1>
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
                                    <th style="width: 40%">ID Topik</th>
                                    <td style="width: 60%"><?php echo e($exerciseTopic->id ?? ''); ?></td>
                                </tr>
                                <tr>
                                    <th style="width: 40%">Nama</th>
                                    <td style="width: 60%"><?php echo e($exerciseTopic->name ?? ''); ?></td>
                                </tr>
                                <tr>
                                    <th style="width: 40%">Tingkatan</th>
                                    <td style="width: 60%"><?php echo e($exerciseTopic->grade ?? ''); ?></td>
                                </tr>
                                <tr>
                                    <th style="width: 40%">Modul</th>
                                    <td style="width: 60%"><?php echo e($exerciseTopic->javaExercise->name ?? ''); ?></td>
                                </tr>
                                <tr>
                                    <th style="width: 40%">ClassName</th>
                                    <td style="width: 60%"><?php echo e($exerciseTopic->java_class_name ?? ''); ?></td>
                                </tr>
                                <tr>
                                    <th style="width: 40%">File Path</th>
                                    <td style="width: 60%">
                                        <?php if($exerciseTopic->file_path): ?>
                                            <a class="btn btn-success form-control"
                                               href="<?php echo e(url('storage' . DIRECTORY_SEPARATOR . strstr($exerciseTopic->file_path, 'java'))); ?>">Download</a>
                                        <?php else: ?>
                                            <p class="form-control">No file found</p>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width: 40%">Test Path</th>
                                    <td style="width: 60%">
                                        <?php if($exerciseTopic->test_path): ?>
                                            <a class="btn btn-success form-control"
                                               href="<?php echo e(url('storage' . DIRECTORY_SEPARATOR . strstr($exerciseTopic->test_path, 'java'))); ?>">Download</a>
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

<?php echo $__env->make('admin/admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Kuliah\Skripsi\code\resources\views/admin/java/exerciseTopics/show.blade.php ENDPATH**/ ?>