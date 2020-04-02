<?php $__env->startSection('content'); ?>
<div class=" h-spacer"></div>
<div class="container">
    <div class="row  auth-box d-flex justify-content-center align-items-center">
        <div class="col-md-12">
            <div class="">
                <h2 class="text-center"><?php echo e(__('Admin Login')); ?></h2>
                <div class="card-body">
                    <form method="POST" action="<?php echo e(route('admin.login')); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <input placeholder="<?php echo e(__('E-Mail Address')); ?>" id="email" type="email" class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" name="email" value="<?php echo e(old('email')); ?>" required autofocus>
                                <?php if($errors->has('email')): ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($errors->first('email')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <input placeholder="<?php echo e(__('Password')); ?>" id="password" type="password" class="form-control<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>" name="password" required>
                                <?php if($errors->has('password')): ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($errors->first('password')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="form-check">
                                    <input class="form-check-input " type="checkbox" name="remember" id="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>
                                           <label class="form-check-label" style="color:white;" for="remember">
                                        <?php echo e(__('Remember Me')); ?>

                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div  class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary red-button round-button">
                                    <?php echo e(__('Login')); ?>

                                </button>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div  class="col-md-12 text-center">
                                <?php if(Route::has('password.request')): ?>
                                <a class="btn btn-link" style="color:white;" href="<?php echo e(route('admin.password.request')); ?>">
                                    <?php echo e(__('Forgot Your Password?')); ?>

                                </a>
                                <?php endif; ?>
                            </div>
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