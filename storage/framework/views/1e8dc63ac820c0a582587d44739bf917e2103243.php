

<?php $__env->startSection('template_title'); ?>
    <?php echo trans('traffic-lights.showing-traffic-light', ['id' => $traffic_light->id]); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('template_fastload_css'); ?>
    #map-canvas{
    min-height: 300px;
    height: 100%;
    width: 100%;
    }

    .pictureBg{
    background-image: url("<?php echo e(asset($traffic_light->get_picture_path())); ?>");
    background-repeat: no-repeat;
    background-position: center center;
    background-size: cover;
    min-height: 300px;
    }
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="card">
                    <div class="card-header text-white bg-success">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <?php echo trans('traffic-lights.showing-traffic-light-title', ['id' => $traffic_light->id]); ?>

                            <div class="float-right">
                                <a href="<?php echo e(route('traffic-lights.index')); ?>" class="btn btn-light btn-sm float-right"
                                   data-toggle="tooltip" data-placement="left"
                                   title="<?php echo e(trans('traffic-lights.tooltips.back-traffic-lights')); ?>">
                                    <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
                                    <?php echo trans('traffic-lights.buttons.back-to-traffic-lights'); ?>

                                </a>

                                <a href="<?php echo e(URL::to('traffic-lights/' . $traffic_light->id . '/audit')); ?>" class="btn btn-danger btn-sm float-right mr-3"
                                   data-toggle="tooltip" data-placement="left"
                                   title="<?php echo e(trans('traffic-lights.audit.button')); ?>">
                                    <i class="fa fa-fw fa-balance-scale" aria-hidden="true"></i>
                                    <span class="hidden-xs"><?php echo trans('traffic-lights.audit.button'); ?></span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4 col-md-6 pictureBg">
                            </div>
                            <div class="col-sm-4 col-md-6" id="map-canvas">
                                <?php if($traffic_light->intersection->latitude == null || $traffic_light->intersection->longitude == null): ?>
                                    <strong>Las coordenadas de la intersección seleccionada son incorrectas</strong>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <div class="row">
                            <?php if($traffic_light->code): ?>
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo e(trans('traffic-lights.labelCode')); ?>

                                    </strong>
                                    <?php echo e($traffic_light->code); ?>

                                </div>
                            <?php endif; ?>

                            <?php if($traffic_light->erp_code): ?>
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo e(trans('traffic-lights.labelErpCode')); ?>

                                    </strong>
                                    <?php echo e($traffic_light->erp_code); ?>

                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <div class="row">
                            <?php if($traffic_light->brand): ?>
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo e(trans('traffic-lights.labelBrand')); ?>

                                    </strong>
                                    <?php echo e($traffic_light->brand); ?>

                                </div>
                            <?php endif; ?>

                            <?php if($traffic_light->model): ?>
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo e(trans('traffic-lights.labelModel')); ?>

                                    </strong>
                                    <?php echo e($traffic_light->model); ?>

                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="row">
                            <?php if($traffic_light->orientation): ?>
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo e(trans('traffic-lights.labelOrientation')); ?>

                                    </strong>
                                    <?php echo e($traffic_light->orientation); ?>

                                </div>
                            <?php endif; ?>

                            <?php if($traffic_light->state): ?>
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo e(trans('traffic-lights.labelState')); ?>

                                    </strong>
                                    <?php echo e($traffic_light->state); ?>

                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="row">
                            <?php if($traffic_light->regulator): ?>
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo e(trans('traffic-lights.labelRegulator')); ?>

                                    </strong>
                                    <?php echo e($traffic_light->regulator->code); ?>

                                    | <?php echo e($traffic_light->regulator->intersection->main_st); ?>

                                    y <?php echo e($traffic_light->regulator->intersection->cross_st); ?>

                                </div>
                            <?php endif; ?>

                            <?php if($traffic_light->light_type): ?>
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo e(trans('traffic-lights.labelType')); ?>

                                    </strong>
                                    <?php echo e($traffic_light->light_type->name); ?>

                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="row">
                            <?php if($traffic_light->intersection): ?>
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo e(trans('traffic-lights.labelIntersection')); ?>

                                    </strong>
                                    <?php echo e($traffic_light->intersection->main_st); ?>

                                    y <?php echo e($traffic_light->intersection->cross_st); ?>

                                </div>
                            <?php endif; ?>

                            <?php if($traffic_light->traffic_pole): ?>
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo e(trans('traffic-lights.labelPole')); ?>

                                    </strong>
                                    <?php echo e($traffic_light->traffic_pole->id); ?>

                                </div>
                            <?php elseif($traffic_light->traffic_tensor): ?>
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo e(trans('traffic-lights.labelTensor')); ?>

                                    </strong>
                                    <?php echo e($traffic_light->traffic_tensor->id); ?>

                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <div class="row">
                            <?php if($traffic_light->user): ?>
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo e(trans('traffic-lights.labelUser')); ?>

                                    </strong>
                                    <?php echo e($traffic_light->user->full_name()); ?>

                                </div>
                            <?php endif; ?>

                            <div class="col-sm-6 col-6">
                                <strong class="text-larger">
                                    <?php echo e(trans('traffic-lights.labelComment')); ?>

                                </strong>
                                <?php if($traffic_light->comment): ?><?php echo e($traffic_light->comment); ?> <?php else: ?> <?php echo e('Sin comentarios'); ?> <?php endif; ?>
                            </div>
                        </div>

                        <div class="row">
                            <?php if($traffic_light->created_at): ?>
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo e(trans('traffic-lights.labelCreatedAt')); ?>

                                    </strong>
                                    <?php echo e($traffic_light->created_at); ?>

                                </div>
                            <?php endif; ?>

                            <?php if($traffic_light->updated_at): ?>
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo e(trans('traffic-lights.labelUpdatedAt')); ?>

                                    </strong>
                                    <?php echo e($traffic_light->updated_at); ?>

                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <br/>
                        <div class="row">
                            <div class="col-4">
                                <a class="btn btn-sm btn-success btn-block" href="<?php echo e(URL::to('/traffic-lights/create')); ?>"><i class="fa fa-plus-square"></i> Nuevo semáforo</a>
                            </div>
                            <div class="col-4"><a class="btn btn-sm btn-info btn-block"
                                                  href="<?php echo e(URL::to('traffic-lights/' . $traffic_light->id . '/edit')); ?>"><i
                                            class="fa fa-edit"></i> <span class="hidden-xs">Editar</span></a>
                            </div>
                            <div class="col-4">
                                <div class="btn-group float-right btn-block" role="group">
                                    <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Continuar a...
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                        <a class="dropdown-item btn btn-sm" href="<?php echo e(URL::to('/traffic-lights/create')); ?>"><i class="fa fa-plus-square"></i> Nueva reguladora</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item btn btn-sm" href="<?php echo e(URL::to('/traffic-tensors/create')); ?>"><i class="fa fa-plus-square"></i> Nuevo tensor</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item btn btn-sm" href="<?php echo e(URL::to('/traffic-poles/create')); ?>"><i class="fa fa-plus-square"></i> Nuevo poste</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php if($traffic_light->reports): ?>
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
                                <?php $__currentLoopData = $traffic_light->reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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

    <?php if(config('settings.googleMapsAPIStatus') && $traffic_light->intersection->latitude && $traffic_light->intersection->longitude): ?>
        <?php echo $__env->make('scripts.google-maps-atm-show', [
            'latitude' => $traffic_light->intersection->latitude,
            'longitude' => $traffic_light->intersection->longitude,
            'code' => $traffic_light->code,
        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/atmeccom/resources/views/traffic-lights/show-traffic-light.blade.php ENDPATH**/ ?>