<?php $__env->startSection('template_title'); ?>
    Bienvenido <?php echo e(Auth::user()->name); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('head'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <img src="<?php echo e(asset('images/atm.png')); ?>">
            </div>
        </div>
        <br/>
        <br/>
        <br/>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/samuel/Documents/proyectos/Saveme/atm2/nuevo/resources/views/pages/admin/home.blade.php ENDPATH**/ ?>