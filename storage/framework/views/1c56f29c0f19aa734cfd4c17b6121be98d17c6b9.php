<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <?php echo e(Form::open(['route'=>'resetpassword.store', 'files'=>true])); ?>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Reset User Password</h3>
                </div>
                <div class="card-body">
                    <?php if(Session::has('message')): ?>
                        <div id="alert-msg" class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">�</button>
                            <?php echo e(Session::get('message')); ?>

                        </div>
                    <?php endif; ?>

                    <?php if(!empty($errors->all())): ?>
                        <div class="alert alert-danger">
                            <?php echo e(Html::ul($errors->all())); ?>

                        </div>
                    <?php endif; ?>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo e(Form::label('email', 'Email')); ?>

                                <?php echo e(Form::email('email', '', ['class'=>'form-control', 'placeholder'=>'Enter Email'])); ?>

                            </div>
                            <div class="form-group">
                                <?php echo e(Form::label('newpassword', 'New Password')); ?>

                                <?php echo e(Form::text('newpassword', '', ['class'=>'form-control', 'placeholder'=>'Enter New Password'])); ?>

                            </div>
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

<?php echo $__env->make('admin/admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Kuliah\Skripsi\code\resources\views/admin/resetpassword/index.blade.php ENDPATH**/ ?>