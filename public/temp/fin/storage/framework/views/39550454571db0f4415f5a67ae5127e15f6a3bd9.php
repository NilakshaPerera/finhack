<?php $__env->startSection('content'); ?>

<div id="app" class="container">
    <transition name="fade">
        <router-view></router-view>
    </transition>
    
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>