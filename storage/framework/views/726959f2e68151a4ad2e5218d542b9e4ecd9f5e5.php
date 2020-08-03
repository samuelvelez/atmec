<?php $__env->startSection('template_title'); ?>
    <?php echo trans('alerts.showing-alert-title', ['id' => $alert->id]); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('template_fastload_css'); ?>
    #map-canvas{
    min-height: 300px;
    height: 100%;
    width: 100%;
    }
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">

                <div class="card">

                    <div class="card-header text-white bg-success">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <?php echo trans('alerts.showing-alert-title', ['id' => $alert->id]); ?>

                            <div class="float-right">
                                <a href="<?php echo e(route('alerts.index')); ?>" class="btn btn-light btn-sm float-right"
                                   data-toggle="tooltip" data-placement="left"
                                   title="<?php echo e(trans('alerts.tooltips.back-alerts')); ?>">
                                    <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
                                    <?php echo trans('alerts.buttons.back-to-alerts'); ?>

                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12" id="map-canvas">
                                map
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>
                        <div class="row">
                            <?php if($alert->collector): ?>
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo e(trans('alerts.labelCollector')); ?>

                                    </strong>
                                    <?php echo e($alert->collector->full_name()); ?>

                                </div>
                            <?php endif; ?>
                            <?php if($alert->operator): ?>
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo e(trans('alerts.labelOperator')); ?>

                                    </strong>
                                    <?php echo e($alert->operator->full_name()); ?>

                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="row">
                            <?php if($alert->status): ?>
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo e(trans('alerts.labelStatus')); ?>

                                    </strong>
                                    <?php echo e($alert->status->name); ?>

                                </div>
                            <?php endif; ?>
                            <?php if($alert->description): ?>
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo e(trans('alerts.labelDescription')); ?>

                                    </strong>
                                    <?php echo e($alert->description); ?>

                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <div class="row">
                            <?php if($alert->created_at): ?>
                                <div class="col-sm-4 col-4">
                                    <strong class="text-larger">
                                        <?php echo e(trans('alerts.labelCreated')); ?>

                                    </strong>
                                    <?php echo e($alert->created_at); ?>

                                </div>
                            <?php endif; ?>
                            <?php if($alert->updated_at): ?>
                                <div class="col-sm-4 col-4">
                                    <strong class="text-larger">
                                        <?php echo e(trans('alerts.labelUpdated')); ?>

                                    </strong>
                                    <?php echo e($alert->updated_at); ?>

                                </div>
                            <?php endif; ?>
                            <div class="col-sm-4 col-4">
                                <strong class="text-larger">
                                    <?php echo e(trans('alerts.labelReaded')); ?>

                                </strong>
                                <?php if($alert->readed_on): ?>
                                    <?php echo e($alert->readed_on); ?>

                                <?php else: ?>
                                    No leida
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <br/>
                        <div class="row">
                            <div class="col-4">
                                <a class="btn btn-sm btn-success btn-block"
                                   href="<?php echo e(URL::to('/alerts/create')); ?>"><i
                                            class="fa fa-plus-square"></i><span
                                            class="hidden-xs"> Nueva alerta</span></a>
                            </div>
                            <div class="col-4">
                            </div>
                            <div class="col-4">
                                <?php if (Auth::check() && Auth::user()->hasRole('atmoperator')): ?>
                                <a class="btn btn-sm btn-info btn-block"
                                   href="<?php echo e(URL::to('alerts/' . $alert->id . '/edit')); ?>"><i
                                            class="fa fa-edit"></i> <span class="hidden-xs">Editar</span></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php echo $__env->make('modals.modal-delete', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
    <?php echo $__env->make('scripts.delete-modal-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php if(config('atm_app.tooltipsEnabled')): ?>
        <?php echo $__env->make('scripts.tooltips', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

    <?php if(config('settings.googleMapsAPIStatus')): ?>
        <?php echo $__env->make('scripts.google-maps-atm-show', [
            'latitude' => $alert->latitude,
            'longitude' => $alert->longitude,
            'code' => $alert->id,
        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/atmdeveqadoor/resources/views/alerts/show.blade.php ENDPATH**/ ?>