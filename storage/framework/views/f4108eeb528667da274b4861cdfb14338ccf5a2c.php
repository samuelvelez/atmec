<?php $__env->startSection('template_title'); ?>
    Bienvenido <?php echo e(Auth::user()->name); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('head'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('template_linked_css'); ?>
    <style type="text/css" media="screen">
        #audio{
            display: none
        }        
    </style>
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
        <div class="row">
            <div class="col-sm-4 col-xs-6 mb-4">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <div class="text-center">
                            <strong>Señales verticales</strong>
                        </div>
                    </div>
                    <div class="card-body text-center">
                        <div class="text-center">
                            <a href="<?php echo e(URL::to('/vertical-signals/')); ?>"><h4><strong><?php echo e($total_vsignals); ?> total</strong></h4></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-4 col-xs-6 mb-4">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <div class="text-center">
                            <strong>Intersecciones</strong>
                        </div>
                    </div>
                    <div class="card-body text-center">
                        <div class="text-center">
                            <a href="<?php echo e(URL::to('/intersections/')); ?>"><h4><strong><?php echo e($total_intersections); ?> total</strong></h4></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-4 col-xs-6">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <div class="text-center">
                            <strong>Cajas reguladoras</strong>
                        </div>
                    </div>
                    <div class="card-body text-center">
                        <div class="text-center">
                            <a href="<?php echo e(URL::to('/regulator-boxes/')); ?>"><h4><strong><?php echo e($total_rboxes); ?> total</strong></h4></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br/>
        <div class="row">
            <div class="col-sm-4 col-xs-6 mb-4">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <div class="text-center">
                            <strong>Postes de tráfico</strong>
                        </div>
                    </div>
                    <div class="card-body text-center">
                        <div class="text-center">
                            <a href="<?php echo e(URL::to('/traffic-poles/')); ?>"><h4><strong><?php echo e($total_poles); ?> total</strong></h4></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-4 col-xs-6 mb-4">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <div class="text-center">
                            <strong>Tensores</strong>
                        </div>
                    </div>
                    <div class="card-body text-center">
                        <div class="text-center">
                            <a href="<?php echo e(URL::to('/traffic-tensors/')); ?>"><h4><strong><?php echo e($total_tensors); ?> total</strong></h4></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-4 col-xs-6">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <div class="text-center">
                            <strong>Semáforos</strong>
                        </div>
                    </div>
                    <div class="card-body text-center">
                        <div class="text-center">
                            <a href="<?php echo e(URL::to('/traffic-lights/')); ?>"><h4><strong><?php echo e($total_lights); ?> total</strong></h4></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/samuel/Documents/proyectos/Saveme/atm2/nuevo/resources/views/pages/user/home.blade.php ENDPATH**/ ?>