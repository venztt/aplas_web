<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Validation of Student

                    </div>

                    <div class="card-tools">

                    </div>
                </div>
                <?php echo e(Form::open(['route'=>'assignstudent.store', 'files'=>true])); ?>

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
                                    <th></th>
                                    <th>User Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $entities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $entity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e(Form::checkbox('students[]',$entity['id'],null, array('id'=>'asap', 'class'=>'f'))); ?></td>
                                        <td><?php echo e($entity['name']); ?></td>
                                        <td><?php echo e($entity['email']); ?></td>
                                        <td><?php echo e($entity['roleid']); ?></td>

                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>


                        </div>
                    </div>

                    <div class="form-row">
                        <div class="input-group">
                            <div class="form-group">
                                <button type="submit" class="btn btn-danger"><i class="fa fa-check"></i>Validate as
                                    Member of
                                </button>
                            </div>
                            <div class="form-group">
                                <div class="input-group-text">Class</div>
                            </div>
                            <div class="form-group">
                                <?php echo Form::select('classroom', $classroom, null, ['class' => 'form-control']); ?>

                            </div>
                        </div>
                    </div>
                </div>
                <?php echo e(Form::close()); ?>

            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('teacher/home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Belajar java\code\resources\views/teacher/assignstudent/index.blade.php ENDPATH**/ ?>