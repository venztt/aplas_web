<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <?php echo e(Form::model($classroom,['route'=>['crooms.update',$classroom['id']], 'files'=>true,'method'=>'PUT'])); ?>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Change Data of A Classroom</h3>
                </div>
                <div class="card-body">
                    <?php if(!empty($errors->all())): ?>
                        <div class="alert alert-danger">
                            <?php echo e(Html::ul($errors->all())); ?>

                        </div>
                    <?php endif; ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Class Id</label>
                                <input id="classid" type="text" value="<?php echo e($classroom['id']); ?>" class="form-control"
                                       disabled/>
                            </div>
                            <div class="form-group">
                                <?php echo e(Form::label('name', 'Name')); ?>

                                <?php echo e(Form::text('name', $classroom['name'], ['class'=>'form-control', 'placeholder'=>'Enter Topic Name'])); ?>

                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <?php echo e(Form::label('desc', 'Description')); ?>

                            <?php echo e(Form::textarea('desc', $classroom['desc'], ['class'=>'form-control', 'placeholder'=>'Enter description', 'rows'=>5])); ?>

                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <input type="button" value="Back" onclick="history.back()" class="btn btn-outline-info">
                    <?php echo e(Form::submit('Save', ['class' => 'btn btn-primary pull-right'])); ?>

                </div>
            </div>
            <!-- </form> -->
            <?php echo e(Form::close()); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin/admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Kuliah\Skripsi\code\resources\views/teacher/crooms/edit.blade.php ENDPATH**/ ?>