<?php $__env->startSection('content'); ?>

<div class="container">
    <div id="" name="" class="auth-box d-flex justify-content-center align-items-center">
        <div class="box">
            <h1 class="text-center h0 mb-4"><?php echo __(' Welcome to ACCA Finhack 2019'); ?></h1>
            <h2 class="text-center mb-4"><?php echo e(__('Please enter the login details.')); ?></h2>
            <form method="POST" action="<?php echo e(route('login')); ?>" class="form-element">
                <?php echo csrf_field(); ?>
                <div class="form-group text-center mb-4">
                    <input placeholder="Username" id="email" type="email" class=" form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" name="email" value="<?php echo e(old('email')); ?>" required autofocus>
                    <?php if($errors->has('email')): ?>
                    <span class="invalid-feedback" role="alert">
                        <strong><?php echo e($errors->first('email')); ?></strong>
                    </span>
                    <?php endif; ?>
                </div>
                <div class="form-group mb-4">
                    <input placeholder="Password" id="password" type="password" class=" form-control<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>" name="password" required>
                    <?php if($errors->has('password')): ?>
                    <span class="invalid-feedback" role="alert">
                        <strong><?php echo e($errors->first('password')); ?></strong>
                    </span>
                    <?php endif; ?>
                </div>
                <div class="form-actions">
                    <div class="text-right">
                        <button type="submit" class="btn  acca-btn">
                           <span> <?php echo e(__('Login')); ?> </span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>