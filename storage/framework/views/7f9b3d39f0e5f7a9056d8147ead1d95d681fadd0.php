<?php $__env->startSection('template_title'); ?>
    500 | Error interno del servidor
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="card">
                    <div class="card-header bg-danger text-white">
                        <strong>Error interno del servidor</strong>
                    </div>

                    <div class="card-body text-center">
                        <div class="row">
                            <div class="col-12">
                                <img src="<?php echo e(asset('images/error.jpg')); ?>" style="width: 60%;">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <hr/>
                                <h5>Se produjo un error en el servidor procesando su solicitud. Inténtelo de
                                    nuevo o contacte con el administrador. Disculpe las molestias.</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/atmdeveqadoor/resources/views/errors/500.blade.php ENDPATH**/ ?>