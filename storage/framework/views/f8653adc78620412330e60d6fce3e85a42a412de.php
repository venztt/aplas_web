<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('codemirror/lib/codemirror.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('codemirror/theme/duotone-dark.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1><?php echo e($javaExerciseTopic->name); ?></h1>
                    <?php echo e($javaExerciseTopic->description); ?>.
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
                    <div class="callout callout-info">
                        <h5><i class="fas fa-info"></i> Note:</h5>
                        Sebelum mengerjakan task ini, pastikanlah sudah membaca modul dan dokumentasi yang sudah di
                        berikan.
                        Kerjakan sesuai dengan arahan
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-6 mt-2">
                                    <div class="btn-right">
                                        <a href="<?php echo e(route('student.java.exercise.show', $javaExercise->id)); ?>"
                                           class="btn btn-outline-primary">List Percobaan</a>
                                        <?php if($previousTopic): ?>
                                            <a href="<?php echo e(route('student.java.exercise.doTask', ['javaExercise' => $javaExercise->id, 'javaExerciseTopic' => $previousTopic->id])); ?>"
                                               class="btn btn-outline-primary ml-2">Sebelumnya</a>
                                        <?php else: ?>
                                            <button type="button" disabled
                                                    class="btn btn-outline-primary ml-2">Sebelumnya
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <div class="btn-right float-right">
                                        <?php if(!$nextTopic): ?>
                                            <a href="<?php echo e(route('student.java.learning-result.feedback', ['javaExercise' => $javaExercise->id])); ?>"
                                               class="btn btn-primary">Feedback</a>
                                        <?php endif; ?>
                                        <button type="button"
                                                class="btn btn-success btn-validate ml-2" <?php echo e($validationHistoryPass ? 'disabled' : ''); ?>><?php echo e($validationHistoryPass ? 'Passed': 'Koreksi'); ?></button>
                                        <?php if($nextTopic): ?>
                                            <a href="<?php echo e(route('student.java.exercise.doTask', ['javaExercise' => $javaExercise->id, 'javaExerciseTopic' => $nextTopic->id])); ?>"
                                               class="btn btn-outline-primary ml-2">Selanjutnya</a>
                                        <?php else: ?>
                                            <button type="button" disabled
                                                    class="btn btn-outline-primary ml-2">Selanjutnya
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <iframe
                                        src="<?php echo e(asset('pdfjs/web/viewer.html')); ?>?file=<?php echo e(url('storage' . DIRECTORY_SEPARATOR . strstr($javaExercise->module_path, 'java'))); ?>"
                                        width="100%"
                                        height="700px"
                                        style="border: none;"></iframe>
                                </div>
                                <div class="col-md-6 editor-container">
                                    <textarea id="editor" style="visibility: hidden"><?php echo e($codeTemplate ?? ''); ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="text-dark">
                                Riwayat Validasi
                            </div>
                        </div>

                        <div class="card-body">
                            <table class="table table-bordered table-hover datatable-taskHistory">
                                <thead>
                                <tr class="text-center">
                                    <th style="width: 4%">ID</th>
                                    <th>Code</th>
                                    <th>Status</th>
                                    <th>Keterangan</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if($validationHistory->count() > 0): ?>
                                    <?php $__currentLoopData = $validationHistory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($items->id ?? ''); ?></td>
                                            <td><?php echo e($items->raw ?? ''); ?></td>
                                            <td>
                                                <?php if($items->status == 'FAILURE'): ?>
                                                    <span class="right badge badge-danger"><?php echo e($items->status); ?></span>
                                                <?php else: ?>
                                                    <span class="right badge badge-success"><?php echo e($items->status); ?></span>
                                                <?php endif; ?>
                                            </td>
                                            <td><?php echo e($items->report ?? ''); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <tr>
                                        <td class="text-center no-history" colspan="5">No history to show</td>
                                    </tr>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script>
        const global = {
            doTask: '<?php echo e(route('student.java.exercise.execute', ['javaExercise' => $javaExercise->id, 'javaExerciseTopic' => $javaExerciseTopic->id])); ?>'
        };
    </script>
    <script src="<?php echo e(asset('codemirror/lib/codemirror.js')); ?>"></script>
    <script src="<?php echo e(asset('codemirror/mode/clike/clike.js')); ?>"></script>
    <script src="<?php echo e(asset('js/blockui/jquery.blockUI.js')); ?>"></script>
    <script src="<?php echo e(asset('js/task.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('student/home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\code\resources\views/student/java/task/index.blade.php ENDPATH**/ ?>