<?php $__env->startSection('template_title'); ?>
    <?php echo trans('traffic-poles.showing-traffic-pole', ['id' => $traffic_pole->id]); ?>

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
                            <?php echo trans('traffic-poles.showing-traffic-pole-title', ['id' => $traffic_pole->id]); ?>

                            <div class="float-right">
                                <a href="<?php echo e(route('traffic-poles.index')); ?>" class="btn btn-light btn-sm float-right"
                                   data-toggle="tooltip" data-placement="left"
                                   title="<?php echo e(trans('traffic-poles.tooltips.back-traffic-poles')); ?>">
                                    <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
                                    <?php echo trans('traffic-poles.buttons.back-to-traffic-poles'); ?>

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
                            <?php if($traffic_pole->latitude): ?>
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo e(trans('traffic-poles.labelLatitude')); ?>

                                    </strong>
                                    <?php echo e($traffic_pole->latitude); ?>

                                </div>
                            <?php endif; ?>

                            <?php if($traffic_pole->longitude): ?>
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo e(trans('traffic-poles.labelLongitude')); ?>

                                    </strong>
                                    <?php echo e($traffic_pole->longitude); ?>

                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="row">
                            <?php if($traffic_pole->id): ?>
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo e(trans('traffic-poles.labelID')); ?>

                                    </strong>
                                    <?php echo e($traffic_pole->id); ?>

                                </div>
                            <?php endif; ?>

                            <?php if($traffic_pole->erp_code): ?>
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo e(trans('traffic-poles.labelErpCode')); ?>

                                    </strong>
                                    <?php echo e($traffic_pole->erp_code); ?>

                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="row">
                            <?php if($traffic_pole->google_address): ?>
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo e(trans('traffic-poles.labelGoogleAddress')); ?>

                                    </strong>
                                    <?php echo e($traffic_pole->google_address); ?>

                                </div>
                            <?php endif; ?>

                            <?php if($traffic_pole->intersection_id): ?>
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo e(trans('traffic-poles.labelIntersection')); ?>

                                    </strong>
                                    <?php echo e($traffic_pole->intersection->main_st); ?>

                                    y <?php echo e($traffic_pole->intersection->cross_st); ?>

                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <div class="row">
                            <?php if($traffic_pole->height): ?>
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo e(trans('traffic-poles.labelHeight')); ?>

                                    </strong>
                                    <?php echo e($traffic_pole->height); ?>m
                                </div>
                            <?php endif; ?>

                            <?php if($traffic_pole->state): ?>
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo e(trans('traffic-poles.labelState')); ?>

                                    </strong>
                                    <?php echo e($traffic_pole->state); ?>

                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="row">
                            <?php if($traffic_pole->material): ?>
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo e(trans('traffic-poles.labelMaterial')); ?>

                                    </strong>
                                    <?php echo e($traffic_pole->material); ?>

                                </div>
                            <?php endif; ?>

                            <div class="col-sm-6 col-6">
                                <strong class="text-larger">
                                    <?php echo e(trans('traffic-poles.labelAtmOwn')); ?>

                                </strong>
                                <?php if($traffic_pole->atm_own == 0): ?> <?php echo e('No'); ?> <?php else: ?> <?php echo e('Si'); ?> <?php endif; ?>
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <div class="row">
                            <?php if($traffic_pole->user): ?>
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo e(trans('traffic-poles.labelUser')); ?>

                                    </strong>
                                    <?php echo e($traffic_pole->user->full_name()); ?>

                                </div>
                            <?php endif; ?>

                            <?php if($traffic_pole->comment): ?>
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo e(trans('traffic-poles.labelComment')); ?>

                                    </strong>
                                    <?php echo e($traffic_pole->comment); ?>

                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="row">
                            <?php if($traffic_pole->created_at): ?>
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo e(trans('traffic-poles.labelCreatedAt')); ?>

                                    </strong>
                                    <?php echo e($traffic_pole->created_at); ?>

                                </div>
                            <?php endif; ?>

                            <?php if($traffic_pole->updated_at): ?>
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo e(trans('traffic-poles.labelUpdatedAt')); ?>

                                    </strong>
                                    <?php echo e($traffic_pole->updated_at); ?>

                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <br/>
                        <div class="row">
                            <div class="col-4">
                                <a class="btn btn-sm btn-success btn-block" href="<?php echo e(URL::to('/traffic-poles/create')); ?>"><i
                                            class="fa fa-plus-square"></i><span class="hidden-xs"> Nuevo poste</span></a>
                            </div>
                            <div class="col-4"><a class="btn btn-sm btn-info btn-block"
                                                  href="<?php echo e(URL::to('traffic-poles/' . $traffic_pole->id . '/edit')); ?>"><i
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
                                           href="<?php echo e(URL::to('/traffic-lights/create')); ?>"><i
                                                    class="fa fa-plus-square"></i> Nuevo semáforo</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php if($traffic_pole->reports): ?>
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
                                <?php $__currentLoopData = $traffic_pole->reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
            'latitude' => $traffic_pole->latitude,
            'longitude' => $traffic_pole->longitude,
            'code' => $traffic_pole->code,
        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/atmdeveqadoor/resources/views/traffic-poles/show-traffic-pole.blade.php ENDPATH**/ ?>