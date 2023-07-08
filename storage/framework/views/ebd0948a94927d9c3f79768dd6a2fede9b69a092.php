<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Topik Java</h1>
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
                        <div class="card-header">
                            <h3 class="card-title">APLAS Java Programming Topic</h3>
                            <div class="card-tools">
                                <a href="<?php echo e(route('admin.java.topic.create')); ?>" class="btn btn-tool">
                                    <i class="fa fa-plus"></i>
                                    &nbsp; Add
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-hover dataTable dtr-inline datatable-javaTopics">
                                <thead>
                                <tr class="text-center">
                                    <th style="width: 4%">#</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>File Path</th>
                                    <th>Test Path</th>
                                    <th>ClassName</th>
                                    <th>Java Exercise</th>
                                    <th style="width: 15%">Actions</th>
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
                aaSorting: [],
                autoWidth: false,
                responsive: true,
                lengthChange: false,
                ajax: "<?php echo e(route('admin.java.topic.index')); ?>",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'description', name: 'description'},
                    {data: 'file_path', name: 'file_path'},
                    {data: 'test_path', name: 'test_path'},
                    {data: 'java_class_name', name: 'java_class_name'},
                    {data: 'java_exercise_id', name: 'java_exercise_id'},
                    {data: 'actions', name: '<?php echo e(trans('global.actions')); ?>', orderable: false, searchable: false}
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

<?php echo $__env->make('admin/admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Belajar java\code\resources\views/admin/java/exerciseTopics/index.blade.php ENDPATH**/ ?>