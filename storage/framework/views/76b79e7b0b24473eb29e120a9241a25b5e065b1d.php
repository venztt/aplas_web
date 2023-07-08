<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Teacher's Classrooms</h3>
                    <div class="card-tools">
                        <a href="<?php echo e(URL::to('/teacher/crooms/create')); ?>" class="btn btn-tool">
                            <i class="fa fa-plus"></i>
                            &nbsp; Add
                        </a>
                    </div>
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
                                    <th>ID</th>
                                    <th>Class Name</th>
                                    <th>Description</th>
                                    <th colspan="2">#Member</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $entities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $entity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="text-center"><?php echo e($entity['id']); ?></td>
                                        <td><?php echo e($entity['name']); ?></td>
                                        <td><?php echo e($entity['desc']); ?></td>
                                        <td class="text-center"><?php echo e(($entity['count']=='')?0:$entity['count']); ?>

                                            student(s)
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <a class="btn  btn-info "
                                                   href="<?php echo e(URL::to('/teacher/crooms/'.$entity['id'])); ?>"><i
                                                        class="fa fa-eye"></i>&nbsp;Show Members</a>
                                            </div>
                                        </td>
                                        <td><?php echo e($entity['status']); ?></td>
                                        <td class="text-center">
                                            <form method="POST"
                                                  action="<?php echo e(URL::to('/teacher/crooms/'.$entity['id'])); ?>">
                                                <?php echo e(csrf_field()); ?>

                                                <input type="hidden" name="_method" value="DELETE"/>
                                                <div class="btn-group">
                                                    <a class="btn btn-success"
                                                       href="<?php echo e(URL::to('/teacher/crooms/'.$entity['id'].'/edit')); ?>"><i
                                                            class="fa fa-pencil-alt"></i></a>
                                                    <button type="submit" class="btn btn-danger"><i
                                                            class="fa fa-trash"></i></button>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('teacher/home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Belajar java\code\resources\views/teacher/crooms/index.blade.php ENDPATH**/ ?>