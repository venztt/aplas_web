<?php $__env->startSection('content'); ?>

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Update Exercise Modul</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <form method="post" action="<?php echo e(route('admin.java.exercise.update', $exercise->id)); ?>"
                          enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="_method" value="PUT">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Change Data of Exercise</h3>
                            </div>
                            <div class="card-body">
                                <?php if(!empty($errors->all())): ?>
                                    <div class="alert alert-danger">
                                        <ul><?php echo e($errors->first()); ?></ul>
                                    </div>
                                <?php endif; ?>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="name">Exercise Name</label>
                                            <input type="text" class="form-control" name="name" placeholder="Enter Topic Name"
                                                   value="<?php echo e(old('name', $exercise->name)); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="grade">Grade</label>
                                            <input type="text" class="form-control" name="grade" placeholder="Enter Topic Grade"
                                                   value="<?php echo e(old('grade', $exercise->grade)); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="grade">Module</label>
                                            <input type="file" class="form-control" name="module_path" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="<?php echo e(route('admin.java.exercise.index')); ?>" class="btn btn-outline-info">Back</a>
                                <button type="submit" class="btn btn-primary pull-right">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin/admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Kuliah\Skripsi\code\resources\views/admin/java/exercises/edit.blade.php ENDPATH**/ ?>