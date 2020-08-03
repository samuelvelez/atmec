

<?php $__env->startSection('template_title'); ?>
    <?php echo trans('regulator-boxes.showing-regulator-box', ['code' => $regulator->code]); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('template_fastload_css'); ?>
    .picture {
    height: 200px;
    width: auto;
    border: 2px solid #8eb4cb;
    }

    .pictureBg-in{
    background-image: url("<?php if($regulator->picture_in): ?> <?php echo e(asset('storage/regulators/' . $regulator->picture_in)); ?> <?php else: ?> <?php echo e(asset('storage/signals/no-picture.png')); ?> <?php endif; ?>");
    background-repeat: no-repeat;
    background-position: center center;
    background-size: cover;
    min-height: 300px;
    }

    .pictureBg-out{
    background-image: url("<?php if($regulator->picture_out): ?> <?php echo e(asset('storage/regulators/' . $regulator->picture_out)); ?> <?php else: ?> <?php echo e(asset('storage/signals/no-picture.png')); ?> <?php endif; ?>");
    background-repeat: no-repeat;
    background-position: center center;
    background-size: cover;
    min-height: 300px;
    }

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
                            <?php echo trans('regulator-boxes.showing-regulator-box-title', ['code' => $regulator->code]); ?>

                            <div class="float-right">
                                <a href="<?php echo e(URL::to('regulator-boxes/')); ?>" class="btn btn-light btn-sm float-right"
                                   data-toggle="tooltip" data-placement="left"
                                   title="<?php echo e(trans('regulator-boxes.tooltips.back-regulator-boxes')); ?>">
                                    <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
                                    <span class="hidden-xs"><?php echo trans('regulator-boxes.buttons.back-to-regulator-box'); ?></span>
                                </a>

                                <a href="<?php echo e(URL::to('regulator-boxes/' . $regulator->id . '/audit')); ?>" class="btn btn-danger btn-sm float-right mr-3"
                                   data-toggle="tooltip" data-placement="left"
                                   title="<?php echo e(trans('regulator-boxes.audit.button')); ?>">
                                    <i class="fa fa-fw fa-balance-scale" aria-hidden="true"></i>
                                    <span class="hidden-xs"><?php echo trans('regulator-boxes.audit.button'); ?></span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-10 col-md-12" id="map-canvas">
                                map
                            </div>
                        </div>
                        <br/>

                        <div class="row">
                            <div class="col-sm-4 col-md-6">
                                <strong class="text-larger">
                                    <?php echo e(trans('regulator-boxes.labelPicuteIn')); ?>

                                </strong>
                                <div class="pictureBg-in"></div>
                            </div>
                            <div class="col-sm-4 col-md-6">
                                <strong class="text-larger">
                                    <?php echo e(trans('regulator-boxes.labelPicuteOut')); ?>

                                </strong>
                                <div class="pictureBg-out"></div>
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <div class="row">
                            <div class="col-sm-6 col-6">
                                <strong class="text-larger">
                                    <?php echo e(trans('regulator-boxes.labelCode')); ?>

                                </strong>
                                <?php echo e($regulator->code); ?>

                            </div>
                            <div class="col-sm-6 col-6">
                                <strong class="text-larger">
                                    <?php echo e(trans('regulator-boxes.labelErpCode')); ?>

                                </strong>
                                <?php echo e($regulator->erp_code); ?>

                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <div class="row">
                            <?php if($regulator->latitude): ?>

                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo e(trans('regulator-boxes.labelLatitude')); ?>

                                    </strong>
                                    <?php echo e($regulator->latitude); ?>

                                </div>
                            <?php endif; ?>

                            <?php if($regulator->longitude): ?>
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo e(trans('regulator-boxes.labelLongitude')); ?>

                                    </strong>
                                    <?php echo e($regulator->longitude); ?>

                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="row">
                            <?php if($regulator->intersection_id): ?>
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo e(trans('regulator-boxes.labelIntersection')); ?>

                                    </strong>
                                    <?php echo e($regulator->intersection->main_st); ?> y <?php echo e($regulator->intersection->cross_st); ?>

                                </div>
                            <?php endif; ?>

                            <?php if($regulator->google_address): ?>
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo e(trans('regulator-boxes.labelGoogleAddress')); ?>

                                    </strong>
                                    <?php echo e($regulator->google_address); ?>

                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="row">
                            <?php if($regulator->brand): ?>
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo e(trans('regulator-boxes.labelBrand')); ?>

                                    </strong>
                                    <?php echo e($regulator->brand); ?>

                                </div>
                            <?php endif; ?>

                            <?php if($regulator->state): ?>
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo e(trans('regulator-boxes.labelState')); ?>

                                    </strong>
                                    <?php echo e($regulator->state); ?>

                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="row">
                            <?php if($regulator->comment): ?>
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo e(trans('regulator-boxes.labelComment')); ?>

                                    </strong>
                                    <?php echo e($regulator->comment); ?>

                                </div>
                            <?php endif; ?>
                            <?php if($regulator->user): ?>
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo e(trans('regulator-boxes.labelUser')); ?>

                                    </strong>
                                    <?php echo e($regulator->user->full_name()); ?>

                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <div class="row">
                            <?php if($regulator->created_at): ?>

                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo e(trans('regulator-boxes.labelCreatedAt')); ?>

                                    </strong>
                                    <?php echo e($regulator->created_at); ?>

                                </div>

                            <?php endif; ?>

                            <?php if($regulator->updated_at): ?>

                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo e(trans('regulator-boxes.labelUpdatedAt')); ?>

                                    </strong>
                                    <?php echo e($regulator->updated_at); ?>

                                </div>

                            <?php endif; ?>
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <br/>
                        <div class="row">
                            <div class="col-4">
                                <a class="btn btn-sm btn-success btn-block"
                                   href="<?php echo e(URL::to('/regulator-boxes/create')); ?>"><i
                                            class="fa fa-plus-square"></i><span
                                            class="hidden-xs"> Nueva reguladora</span></a>
                            </div>
                            <div class="col-4">
                                <a class="btn btn-sm btn-info btn-block"
                                   href="<?php echo e(URL::to('regulator-boxes/' . $regulator->id . '/edit')); ?>"
                                   data-toggle="tooltip" title="Edit">
                                    <?php echo trans('regulator-boxes.buttons.edit'); ?>

                                </a>
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
                                           href="<?php echo e(URL::to('/traffic-poles/create')); ?>"><i
                                                    class="fa fa-plus-square"></i> Nuevo poste</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item btn btn-sm"
                                           href="<?php echo e(URL::to('/traffic-tensors/create')); ?>"><i
                                                    class="fa fa-plus-square"></i> Nuevo tensor</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item btn btn-sm"
                                           href="<?php echo e(URL::to('/regulator-devices/create')); ?>"><i
                                                    class="fa fa-plus-square"></i> Nuevo dispositivo</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-lg-10 offset-lg-1">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                Dispositivos
                            </span>
                        </div>
                    </div>

                    <div class="card-body">
                        <?php echo $__env->make('regulator-devices.regulator-devices-table', [
                                'devices' => $regulator->traffic_devices()->orderBy('updated_at', 'desc')->get(),
                                'actions' => false
                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-lg-10 offset-lg-1">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                Semáforos
                            </span>
                        </div>
                    </div>

                    <div class="card-body">
                        <?php echo $__env->make('traffic-lights.traffic-lights-table', [
                                'lights' => $regulator->traffic_lights()->orderBy('updated_at', 'desc')->get(),
                                'actions' => false
                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
            </div>
        </div>

        <?php if($regulator->reports): ?>
            <div class="row mt-4">
                <div class="col-lg-10 offset-lg-1">
                    <div class="card">
                        <div class="card-header">
                            <span style="display: flex; justify-content: space-between; align-items: center;">
                                Reportes
                            </span>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-hover table-sm data-table">
                                <thead class="thead">
                                <tr>
                                    <th><?php echo trans('reports.reports-table.id'); ?></th>
                                    <th><?php echo trans('reports.reports-table.alert'); ?></th>
                                    <th><?php echo trans('reports.reports-table.order'); ?></th>
                                    <th><?php echo trans('reports.reports-table.status'); ?></th>
                                </tr>
                                </thead>
                                <tbody id="reports_table">
                                <?php $__currentLoopData = $regulator->reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><a href="<?php echo e(URL::to('reports/' . $report->id)); ?>" data-toggle="tooltip"
                                               title="Mostrar reporte"><?php echo e($report->id); ?></a></td>
                                        <td><a href="<?php echo e(URL::to('alerts/' . $report->alert_id)); ?>" data-toggle="tooltip"
                                               title="Mostrar alerta"><?php echo e($report->alert_id); ?></a></td>
                                        <td>
                                            <?php if($report->workorder): ?>
                                                <a href="<?php echo e(URL::to('workorders/' . $report->workorder->id)); ?>"
                                                   data-toggle="tooltip"
                                                   title="Mostrar orden de trabajo"><?php echo e($report->workorder->id); ?></a>
                                            <?php else: ?>
                                                -
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo e($report->status->name); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
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
            'latitude' => $regulator->latitude,
            'longitude' => $regulator->longitude,
            'code' => $regulator->code,
        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/atmeccom/resources/views/regulator-boxes/show-regulator-box.blade.php ENDPATH**/ ?>