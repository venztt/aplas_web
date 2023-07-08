<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">A Learning Topic Detail</h3>
                </div>
                <div class="card-body">
                    <?php if(Session::has('message')): ?>
                        <div id="alert-msg" class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">�</button>
                            <?php echo e(Session::get('message')); ?>

                        </div>
                    <?php endif; ?>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Student Name</th>
                                    <th>Email</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $entities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $entity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="text-center"><?php echo e($index +1); ?></td>
                                        <td><?php echo e($entity['name']); ?></td>
                                        <td><?php echo e($entity['email']); ?></td>

                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>


                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <input type="button" value="Back" onclick="history.back()" class="btn btn-outline-info">
                <!--
                    <a href="<?php echo e(URL::to('admin/topic')); ?>" class="btn btn-outline-info">Back</a>
                  -->
                </div>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('teacher/home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Kuliah\Skripsi\code\resources\views/teacher/crooms/show.blade.php ENDPATH**/ ?>