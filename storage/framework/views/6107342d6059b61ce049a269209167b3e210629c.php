<?php $__env->startSection('content'); ?>

<div class=" h-spacer"></div>
<div class="container">
    <div class="row  auth-box d-flex justify-content-center align-items-center">
        <div class="col-md-8">
            <div class="">
                <h2 class="text-center"><?php echo e(__('Change password')); ?></h2>
                <div class="card-body">
                    <?php if(session('error')): ?>
                    <div class="alert alert-danger">
                        <?php echo e(session('error')); ?>

                    </div>
                    <?php endif; ?>
                    <?php if(session('success')): ?>
                    <div class="alert alert-success">
                        <?php echo e(session('success')); ?>

                    </div>
                    <?php endif; ?>
                    <form class="form-horizontal" method="POST" action="<?php echo e(route('admin.changePassword')); ?>">
                        <?php echo e(csrf_field()); ?>

                        <div class="form-group<?php echo e($errors->has('current-password') ? ' has-error' : ''); ?>">
                            <input id="current-password" type="password" class="form-control" name="current-password" required placeholder="Current Password">
                            <?php if($errors->has('current-password')): ?>
                            <span class="help-block">
                                <strong><?php echo e($errors->first('current-password')); ?></strong>
                            </span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group<?php echo e($errors->has('new-password') ? ' has-error' : ''); ?>">
                            <input id="new-password" type="password" class="form-control" name="new-password" required placeholder="New Password">
                            <?php if($errors->has('new-password')): ?>
                            <span class="help-block">
                                <strong><?php echo e($errors->first('new-password')); ?></strong>
                            </span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <input id="new-password-confirm" type="password" class="form-control" name="new-password_confirmation" required placeholder="Confirm New Password">
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary red-button round-button">
                                Change Password
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<div class=" h-spacer"></div>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>