

<?php $__env->startSection('template_title'); ?>
    <?php echo trans('intersections.showing-intersection', ['id' => $intersection->id]); ?>

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
                            <?php echo trans('intersections.showing-intersection-title', ['id' => $intersection->id]); ?>

                            <div class="float-right">
                                <a href="<?php echo e(route('intersections.index')); ?>" class="btn btn-light btn-sm float-right"
                                   data-toggle="tooltip" data-placement="left"
                                   title="<?php echo e(trans('intersections.tooltips.back-intersections')); ?>">
                                    <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
                                    <?php echo trans('intersections.buttons.back-to-intersections'); ?>

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
                            <?php if($intersection->latitude): ?>

                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo e(trans('intersections.labelLatitude')); ?>

                                    </strong>
                                    <?php echo e($intersection->latitude); ?>

                                </div>
                            <?php endif; ?>

                            <?php if($intersection->longitude): ?>
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo e(trans('intersections.labelLongitude')); ?>

                                    </strong>
                                    <?php echo e($intersection->longitude); ?>

                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="row">
                            <?php if($intersection->main_st): ?>

                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo e(trans('intersections.labelMainStreet')); ?>

                                    </strong>
                                    <?php echo e($intersection->main_st); ?>

                                </div>
                            <?php endif; ?>

                            <?php if($intersection->cross_st): ?>
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo e(trans('intersections.labelCrossStreet')); ?>

                                    </strong>
                                    <?php echo e($intersection->cross_st); ?>

                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="row">
                            <?php if($intersection->google_address): ?>
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo e(trans('intersections.labelGoogleAddress')); ?>

                                    </strong>
                                    <?php echo e($intersection->google_address); ?>

                                </div>
                            <?php endif; ?>
                            <?php if($intersection->comment): ?>
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo e(trans('intersections.labelComment')); ?>

                                    </strong>
                                    <?php echo e($intersection->comment); ?>

                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="row">
                            <?php if($intersection->created_at): ?>

                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo e(trans('verticalsignals.labelCreatedAt')); ?>

                                    </strong>
                                    <?php echo e($intersection->created_at); ?>

                                </div>

                            <?php endif; ?>

                            <?php if($intersection->updated_at): ?>

                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo e(trans('verticalsignals.labelUpdatedAt')); ?>

                                    </strong>
                                    <?php echo e($intersection->updated_at); ?>

                                </div>

                            <?php endif; ?>
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <br/>
                        <div class="row">
                            <div class="col-4">
                                <a class="btn btn-sm btn-success btn-block"
                                   href="<?php echo e(URL::to('/intersections/create')); ?>"><i
                                            class="fa fa-plus-square"></i><span
                                            class="hidden-xs"> Nueva intersección</span></a>
                            </div>
                            <div class="col-4">
                                <a class="btn btn-sm btn-info btn-block"
                                   href="<?php echo e(URL::to('intersections/' . $intersection->id . '/edit')); ?>"><i
                                            class="fa fa-edit"></i> <span class="hidden-xs">Editar</span></a>
                            </div>
                            <div class="col-4">
                                <div class="btn-group float-right btn-block" role="group">
                                    <button id="btnGroupDrop1" type="button"
                                            class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                        <span class="hidden-xs">Continuar a...</span>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                        <a class="dropdown-item btn btn-sm"
                                           href="<?php echo e(URL::to('/regulator-boxes/create')); ?>"><i
                                                    class="fa fa-plus-square"></i> Nueva reguladora</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item btn btn-sm"
                                           href="<?php echo e(URL::to('/traffic-tensors/create')); ?>"><i
                                                    class="fa fa-plus-square"></i> Nuevo tensor</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item btn btn-sm"
                                           href="<?php echo e(URL::to('/traffic-poles/create')); ?>"><i
                                                    class="fa fa-plus-square"></i> Nuevo poste</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php if($intersection->regulators): ?>
            <div class="row mt-4">
                <div class="col-lg-10 offset-lg-1">
                    <div class="card">
                        <div class="card-header">
                            <span style="display: flex; justify-content: space-between; align-items: center;">
                                Cajas reguladoras
                            </span>
                        </div>

                        <div class="card-body">
                            <?php echo $__env->make('regulator-boxes.regulators-table', [
                                'regulator_boxes' => $intersection->regulators()->orderBy('updated_at', 'desc')->get(),
                                'actions' => false
                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if($intersection->poles): ?>
            <div class="row mt-4">
                <div class="col-lg-10 offset-lg-1">
                    <div class="card">
                        <div class="card-header">
                            <span style="display: flex; justify-content: space-between; align-items: center;">
                                Postes de tráfico
                            </span>
                        </div>

                        <div class="card-body">
                            <?php echo $__env->make('traffic-poles.traffic-poles-table', [
                                'poles' => $intersection->poles()->orderBy('updated_at', 'desc')->get(),
                                'actions' => false
                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if($intersection->lights): ?>
            <div class="row mt-4">
                <div class="col-lg-10 offset-lg-1">
                    <div class="card">
                        <div class="card-header">
                            <span style="display: flex; justify-content: space-between; align-items: center;">
                                Semáforos
                            </span>
                        </div>

                        <div class="card-body">
                            <?php echo $__env->make('traffic-lights.traffic-lights-table', [
                                'lights' => $intersection->lights()->orderBy('updated_at', 'desc')->get(),
                                'actions' => false
                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
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
            'latitude' => $intersection->latitude,
            'longitude' => $intersection->longitude,
            'code' => $intersection->id,
        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/atmeccom/resources/views/intersections/show-intersection.blade.php ENDPATH**/ ?>