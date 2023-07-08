<?php $__env->startSection('content'); ?>

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1><?php echo e($javaExercise->name); ?> Result </h1>
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
                <div class="col-lg-6 col-12">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?php echo e($javaExercise->topicWorkedOn()); ?></h3>
                            <p>Keseluruhan Topic</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?php echo e($javaExercise->topicPassedTeacher()); ?></h3>
                            <p>Siswa Berhasil Mengerjakan</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th style="width: 40%">Name</th>
                                    <td style="width: 60%"><?php echo e($javaExercise->name ?? ''); ?></td>
                                </tr>
                                <tr>
                                    <th style="width: 40%">Grade</th>
                                    <td style="width: 60%"><?php echo e($javaExercise->grade ?? ''); ?></td>
                                </tr>
                                <tr>
                                    <th style="width: 40%">Module</th>
                                    <td style="width: 60%">
                                        <?php if($javaExercise->module_path): ?>
                                            <a class="btn btn-success "
                                               href="<?php echo e(url('storage' . DIRECTORY_SEPARATOR . strstr($javaExercise->module_path, 'java'))); ?>">Download</a>
                                        <?php else: ?>
                                            <p>No file found</p>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="text-dark">
                                Daftar Topic
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-hover dataTable dtr-inline datatable-javaTopics">
                                <thead>
                                <tr class="text-center">
                                    <th style="width: 4%">#</th>
                                    <th>Nama Topik</th>
                                    <th style="width: 10%">File Path</th>
                                    <th style="width: 10%">Test Path</th>
                                    <th style="width: 10%">Modul</th>
                                    <th style="width: 10%">Aksi</th>
                                </tr>
                                </thead>

                                <tbody>
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
    <?php echo \Illuminate\View\Factory::parentPlaceholder('scripts'); ?>
    <script>
        $(function () {
            let dtOverrideGlobals = {
                processing: true,
                serverSide: true,
                retrieve: true,
                paging: false,
                searching: false,
                aaSorting: [],
                ajax: "<?php echo e(route('teacher.java.exerciseTopicUsers.topicAdapter', $javaExercise->id)); ?>",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'file_path', name: 'file_path'},
                    {data: 'test_path', name: 'test_path'},
                    {data: 'java_exercise_id', name: 'java_exercise_id'},
                    {data: 'actions', name: '<?php echo e(trans('global.actions')); ?>', orderable: false, searchable:false}
                ],
                orderCellsTop: true,
                order: [[1, 'desc']],
                pageLength: 10,
            };
            let table = $('.datatable-javaTopics').DataTable(dtOverrideGlobals);

            $('a[data-toggle="tab"]').on('shown.bs.tab click', function (e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('teacher/home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Belajar java\code\resources\views/teacher/java/exerciseTopicUser/show.blade.php ENDPATH**/ ?>