<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">List of Member Student</h3>
                    <div class="card-tools">

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
                                    <th>No</th>
                                    <th>User Name</th>
                                    <th>Email</th>
                                    <th>Topic Submitted</th>
                                    <th>Topic Name(s)</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $entities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $entity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="text-center"><?php echo e($i+1); ?></td>
                                        <td><?php echo e($entity['name']); ?></td>
                                        <td><?php echo e($entity['email']); ?></td>
                                        <td><?php echo e(($entity['count']=='')?0:$entity['count']); ?> topic(s)</td>
                                        <td><?php echo e(($entity['topicname']=='')?'-':$entity['topicname']); ?></td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <?php if($entity['count']==''): ?>
                                                    <form method="POST"
                                                          action="<?php echo e(URL::to('/teacher/member/'.$entity['id'])); ?>">
                                                        <?php echo e(csrf_field()); ?>

                                                        <input type="hidden" name="_method" value="DELETE"/>
                                                        <div class="btn-group">
                                                            <button type="submit" class="btn btn-danger"><i
                                                                    class="fa fa-trash">&nbsp;</i>Delete this Student
                                                            </button>
                                                        </div>
                                                    </form>
                                                <?php else: ?>
                                                    <a class="btn btn-success"
                                                       href="<?php echo e(URL::to('/teacher/member/'.$entity['id'].'/edit')); ?>"><i
                                                            class="fa fa-check-circle"></i>&nbsp;Show Student Result</a>
                                                <?php endif; ?>
                                            </div>
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

<?php echo $__env->make('teacher/home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Belajar java\code\resources\views/teacher/member/index.blade.php ENDPATH**/ ?>