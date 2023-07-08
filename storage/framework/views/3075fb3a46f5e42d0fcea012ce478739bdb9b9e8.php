<?php $__env->startSection('style'); ?>
    <style>
        pre {
            font-family: "Courier New", Courier, monospace;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Riwayat TopiK </h1>
                    Riwayat Topik <?php echo e($javaExerciseTopic->name); ?>

                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            <?php if(Session::has('message')): ?>
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">�</button>
                            <?php echo e(Session::get('message')); ?>

                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        
                        <div class="card-body">
                            <table class="table table-bordered table-hover dataTable dtr-inline">
                                <thead>
                                <tr class="text-center">
                                    <th style="width: 5%">#</th>
                                    <th>Nama Siswa</th>
                                    <th style="width: 20%">Jumlah Percobaan</th>
                                    <th style="width: 20%">Passed</th>
                                    <th style="width: 10%">Aksi</th>
                                </tr>
                                </thead>

                                <tbody>
                                <tr>
                                    <?php $__currentLoopData = $userTopics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <td><?php echo e($index); ?></td>
                                        <td><?php echo e($item['user']->name); ?></td>
                                        <td><?php echo e(count($item['itemOk']) + count($item['itemFail'])); ?></td>
                                        <td><?php echo e(count($item['itemOk'])); ?></td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-warning" data-toggle="modal"
                                                    data-target="#modal-users-index--<?php echo e($index); ?>">
                                                Detail
                                            </button>
                                        </td>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            <a href="<?php echo e(route('teacher.java.exerciseTopicUsers.index')); ?>" class="btn btn-outline-info">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php $__currentLoopData = $userTopics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="modal fade" id="modal-users-index--<?php echo e($index); ?>">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title"><?php echo e($item['user']->name); ?> Riwayat Detail</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p class="mb-1"><b>Riwayat Topik <?php echo e($javaExerciseTopic->name); ?></b></p>
                            <p class="mb-3"><?php echo e($javaExerciseTopic->description); ?></p>

                            <div class="row">
                                <div class="col-6">
                                    <p class="mb-1"><b>Eksekusi Kode Terakhir</b></p>
                                </div>
                                <div class="col-6">
                                    <p class="mb-1 float-right"><?php echo e($item['itemLast'] !== null ? $item['itemLast']->created_at->diffForHumans() : ''); ?></p>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-12">
                                    <pre>
                                        <code>
                                            <?php echo e($item['itemLast'] ? $item['itemLast']->raw : ''); ?>

                                        </code>
                                    </pre>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <p class="mb-1"><b>Hasil Koreksi JUnit4</b></p>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-12">
                                    <p class="mb-1"><?php echo e($item['itemLast'] ? $item['itemLast']->report : ''); ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </section>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('scripts'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('teacher/home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Kuliah\Skripsi\code\resources\views/teacher/java/exerciseTopicResult/show.blade.php ENDPATH**/ ?>