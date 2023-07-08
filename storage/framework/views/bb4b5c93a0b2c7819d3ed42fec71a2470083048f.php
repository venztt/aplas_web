<?php $__env->startSection('content'); ?>

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Update Topics</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <form method="post" action="<?php echo e(route('admin.java.topic.update', $exerciseTopic->id)); ?>"
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
                                            <label for="name">Topic Name</label>
                                            <input type="text" class="form-control" name="name"
                                                   value="<?php echo e(old('name', $exerciseTopic->name)); ?>"
                                                   placeholder="Enter exercise name"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Topic Description</label>
                                            <textarea class="form-control" name="description"><?php echo e(old('description', $exerciseTopic->description)); ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="file_path">Java File</label>
                                            <input type="file" class="form-control" name="file_path"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="test_path">JUnit File</label>
                                            <input type="file" class="form-control" name="test_path"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="java_class_name">ClassName</label>
                                            <input type="text" class="form-control" name="java_class_name"
                                                   value="<?php echo e(old('java_class_name', $exerciseTopic->java_class_name)); ?>"
                                                   placeholder="Classname name"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="test_path">JUnit File</label>
                                            <select name="java_exercise_id" class="form-control">
                                                <?php $__currentLoopData = $javaExercise; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $exercise): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option
                                                        value="<?php echo e($id); ?>" <?php echo e((old('java_exercise_id') ?
                                                 old('java_exercise_id') : $id ?? '') == $id ?
                                                 'selected' : ''); ?>><?php echo e($exercise); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="<?php echo e(route('admin.java.topic.index')); ?>" class="btn btn-outline-info">Back</a>
                                <button type="submit" class="btn btn-primary pull-right">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin/admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Belajar java\code\resources\views/admin/java/exerciseTopics/edit.blade.php ENDPATH**/ ?>