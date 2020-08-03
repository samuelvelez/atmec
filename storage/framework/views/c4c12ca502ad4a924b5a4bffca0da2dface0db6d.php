

<?php $__env->startSection('template_title'); ?>
    <?php echo trans('verticalsignals.showing-vsignal', ['name' => $vsignal->id]); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('template_fastload_css'); ?>
    .picture {
    height: 200px;
    width: auto;
    border: 2px solid #8eb4cb;
    }

    .pictureBg{
    background-image: url("<?php echo e(asset($vsignal->get_picture_path())); ?>");
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
                            <?php echo trans('verticalsignals.showing-vsignal-title', ['name' => $vsignal->code]); ?>

                            <div class="float-right">
                                <a href="<?php echo e(URL::to('vertical-signals/')); ?>" class="btn btn-light btn-sm float-right"
                                   data-toggle="tooltip" data-placement="left"
                                   title="<?php echo e(trans('verticalsignals.tooltips.back-vsignals')); ?>">
                                    <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
                                    <?php echo trans('verticalsignals.buttons.back-to-vsignals'); ?>

                                </a>

                                <a href="<?php echo e(URL::to('vertical-signals/' . $vsignal->id . '/audit')); ?>"
                                   class="btn btn-danger btn-sm float-right mr-3"
                                   data-toggle="tooltip" data-placement="left"
                                   title="<?php echo e(trans('verticalsignals.audit.button')); ?>">
                                    <i class="fa fa-fw fa-balance-scale" aria-hidden="true"></i>
                                    <span class="hidden-xs"><?php echo trans('verticalsignals.audit.button'); ?></span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4 col-md-6 pictureBg">
                                <?php /*
                                <img src="@if ($vsignal->picture) {{asset('storage/signals/' . $vsignal->picture)}} @else {{asset('storage/signals/no-picture.png')}} @endif"
                                     class="center-block mb-3 mt-4 picture">
                                */ ?>
                            </div>
                            <div class="col-sm-4 col-md-6" id="map-canvas">
                                <span>Cargando mapa por favor espere.</span>
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>


                        <?php if($vsignal->signal_inventory): ?>
                            <div class="row">
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo e(trans('verticalsignals.labelName')); ?>

                                    </strong>
                                    <?php echo e($vsignal->signal_inventory->name); ?>

                                </div>
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo e(trans('verticalsignals.labelErpCode')); ?>

                                    </strong>
                                    <?php echo e($vsignal->erp_code); ?>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo e(trans('verticalsignals.labelGroup')); ?>

                                    </strong>
                                    <?php echo e($vsignal->signal_inventory->subgroup->group->name); ?>

                                    (<?php echo e($vsignal->signal_inventory->subgroup->group->code); ?>)
                                </div>
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo e(trans('verticalsignals.labelSubgroup')); ?>

                                    </strong>
                                    <?php echo e($vsignal->signal_inventory->subgroup->name); ?>

                                    (<?php echo e($vsignal->signal_inventory->subgroup->code); ?>)
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6 col-6">
                                    <?php if($vsignal->variation): ?>
                                        <strong class="text-larger">
                                            <?php echo e(trans('verticalsignals.labelVariation')); ?>

                                        </strong>
                                        <?php echo e($vsignal->variation->variation); ?>

                                        (<?php echo e($vsignal->variation->signal_dimension->value); ?>)
                                    <?php endif; ?>
                                </div>
                                <div class="col-sm-6 col-6">

                                </div>
                            </div>

                            <div class="clearfix"></div>
                            <div class="border-bottom"></div>

                        <?php endif; ?>

                        <div class="row">
                            <?php if($vsignal->latitude): ?>

                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo e(trans('verticalsignals.labelLatitude')); ?>

                                    </strong>
                                    <?php echo e($vsignal->latitude); ?>

                                </div>
                            <?php endif; ?>

                            <?php if($vsignal->longitude): ?>
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo e(trans('verticalsignals.labelLongitude')); ?>

                                    </strong>
                                    <?php echo e($vsignal->longitude); ?>

                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="row">
                            <?php if($vsignal->material): ?>
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo e(trans('verticalsignals.labelMaterial')); ?>

                                    </strong>
                                    <?php echo e($vsignal->material); ?>

                                </div>
                            <?php endif; ?>

                            <?php if($vsignal->google_address): ?>
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo e(trans('verticalsignals.labelGoogleAddress')); ?>

                                    </strong>
                                    <?php echo e($vsignal->google_address); ?>

                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="row">
                            <?php if($vsignal->orientation): ?>
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo e(trans('verticalsignals.labelOrientation')); ?>

                                    </strong>
                                    <?php echo e($vsignal->orientation); ?>

                                </div>
                            <?php endif; ?>

                            <?php if($vsignal->state): ?>
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo e(trans('verticalsignals.labelState')); ?>

                                    </strong>
                                    <?php echo e($vsignal->state); ?>

                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="row">
                            <?php if($vsignal->street1): ?>
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo e(trans('verticalsignals.labelStreet1')); ?>

                                    </strong>
                                    <?php echo e($vsignal->street1); ?>

                                </div>
                            <?php endif; ?>

                            <?php if($vsignal->street2): ?>
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo e(trans('verticalsignals.labelStreet2')); ?>

                                    </strong>
                                    <?php echo e($vsignal->street2); ?>

                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="row">
                            <?php if($vsignal->neighborhood): ?>
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo e(trans('verticalsignals.labelNeighborhood')); ?>

                                    </strong>
                                    <?php echo e($vsignal->neighborhood); ?>

                                </div>
                            <?php endif; ?>

                            <?php if($vsignal->parish): ?>
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo e(trans('verticalsignals.labelParish')); ?>

                                    </strong>
                                    <?php echo e($vsignal->parish); ?>

                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="row">
                            <?php if($vsignal->normative): ?>
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo e(trans('verticalsignals.labelNormative')); ?>

                                    </strong>
                                    <?php echo e($vsignal->normative); ?>

                                </div>
                            <?php endif; ?>

                            <?php if($vsignal->fastener): ?>
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo e(trans('verticalsignals.labelFastener')); ?>

                                    </strong>
                                    <?php echo e($vsignal->fastener); ?>

                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="row">
                            <?php if($vsignal->comment): ?>
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo e(trans('verticalsignals.labelComment')); ?>

                                    </strong>
                                    <?php echo e($vsignal->comment); ?>

                                </div>
                            <?php endif; ?>
                            <?php if($vsignal->user): ?>
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo e(trans('verticalsignals.labelCollector')); ?>

                                    </strong>
                                    <?php echo e($vsignal->user->full_name()); ?>

                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <div class="row">
                            <?php if($vsignal->created_at): ?>

                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo e(trans('verticalsignals.labelCreatedAt')); ?>

                                    </strong>
                                    <?php echo e($vsignal->created_at); ?>

                                </div>

                            <?php endif; ?>

                            <?php if($vsignal->updated_at): ?>

                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        <?php echo e(trans('verticalsignals.labelUpdatedAt')); ?>

                                    </strong>
                                    <?php echo e($vsignal->updated_at); ?>

                                </div>

                            <?php endif; ?>
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <br/>
                        <div class="row">
                            <div class="col-4">
                                <a class="btn btn-sm btn-success btn-block"
                                   href="<?php echo e(URL::to('/vertical-signals/create')); ?>"><i
                                            class="fa fa-plus-square"></i><span
                                            class="hidden-xs"> Nueva señal</span></a>
                            </div>
                            <div class="col-4">
                                <a class="btn btn-sm btn-info btn-block"
                                   href="<?php echo e(URL::to('vertical-signals/' . $vsignal->id . '/edit')); ?>"><i
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
                                           href="<?php echo e(URL::to('/intersections/create')); ?>"><i
                                                    class="fa fa-plus-square"></i> Nueva intersección</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item btn btn-sm"
                                           href="<?php echo e(URL::to('/regulator-boxes/create')); ?>"><i
                                                    class="fa fa-plus-square"></i> Nueva reguladora</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <?php if($vsignal->reports): ?>
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
                                <?php $__currentLoopData = $vsignal->reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
            'latitude' => $vsignal->latitude,
            'longitude' => $vsignal->longitude,
            'code' => $vsignal->code,
        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/atmeccom/resources/views/verticalsignals/show-vertical-signal.blade.php ENDPATH**/ ?>