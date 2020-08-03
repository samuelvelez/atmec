<?php $__env->startSection('template_title'); ?>
    <?php echo trans('metric-units.showing-all-metrics'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('template_linked_css'); ?>
    <?php if(config('atm_app.enabledDatatablesJs')): ?>
        <link rel="stylesheet" type="text/css" href="<?php echo e(config('atm_app.datatablesCssCDN')); ?>">
    <?php endif; ?>
    <style type="text/css" media="screen">
        .metric-units-table {
            border: 0;
        }

        .metric-units-table tr td:first-child {
            padding-left: 15px;
        }

        .metric-units-table tr td:last-child {
            padding-right: 15px;
        }

        .metric-units-table.table-responsive,
        .metric-units-table.table-responsive table {
            margin-bottom: 0;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                <?php echo trans('metric-units.showing-all-metrics'); ?>

                            </span>

                            <?php if (Auth::check() && Auth::user()->hasRole('atmadmin')): ?>
                            <div class="btn-group pull-right btn-group-xs">
                                <a class="btn btn-primary btn-sm" href="/metric-units/create">
                                    <?php echo trans('metric-units.buttons.create'); ?>

                                </a>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive metric-units-table">
                            <table class="table table-striped table-hover table-sm data-table">
                                <caption id="metric-units_count">
                                    <?php echo e(trans_choice('metric-units.metrics-table.caption', $metrics->count(), ['metricstotal' => $metricstotal])); ?>

                                </caption>
                                <thead class="thead">
                                <tr>
                                    <th><?php echo trans('metric-units.metrics-table.id'); ?></th>
                                    <th><?php echo trans('metric-units.metrics-table.name'); ?></th>
                                    <th><?php echo trans('metric-units.metrics-table.abbreviation'); ?></th>
                                    <th class="hidden-xs"><?php echo trans('metric-units.metrics-table.description'); ?></th>

                                    <th><?php echo trans('metric-units.metrics-table.actions'); ?></th>
                                    <th class="no-search no-sort"></th>
                                </tr>
                                </thead>
                                <tbody id="metric-units_table">
                                <?php $__currentLoopData = $metrics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $motive): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($motive->id); ?></td>
                                        <td><?php echo e($motive->name); ?></td>
                                        <td><?php echo e($motive->abbreviation); ?></td>
                                        <td class="hidden-xs"><?php echo e($motive->description); ?></td>

                                        <?php if (Auth::check() && Auth::user()->hasRole('atmadmin')): ?>
                                        <td>
                                            <a class="btn btn-sm btn-info btn-block"
                                               href="<?php echo e(URL::to('metric-units/' . $motive->id . '/edit')); ?>"
                                               data-toggle="tooltip" title="Editar">
                                                <?php echo trans('metric-units.buttons.edit'); ?>

                                            </a>
                                        </td>
                                        <?php endif; ?>
                                        <?php if (Auth::check() && Auth::user()->hasRole('atmadmin')): ?>
                                        <td>
                                            <?php echo Form::open(array('url' => 'metric-units/' . $motive->id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Eliminar')); ?>

                                            <?php echo Form::hidden('_method', 'DELETE'); ?>

                                            <?php echo Form::button(trans('metric-units.buttons.delete'), array('class' => 'btn btn-danger btn-sm','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => trans('metric-units.modals.delete_metric_title'), 'data-message' => trans('metric-units.modals.delete_metric_message', ['id' => $motive->id]))); ?>

                                            <?php echo Form::close(); ?>

                                        </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>

                            <?php if(config('atm_app.enablePagination')): ?>
                                <?php echo e($metrics->links()); ?>

                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php echo $__env->make('modals.modal-delete', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
    <?php if((count($metrics) > config('atm_app.datatablesJsStartCount')) && config('atm_app.enabledDatatablesJs')): ?>
        <?php echo $__env->make('scripts.datatables', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

    <?php echo $__env->make('scripts.delete-modal-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('scripts.save-modal-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php if(config('atm_app.tooltipsEnabled')): ?>
        <?php echo $__env->make('scripts.tooltips', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/atmdeveqadoor/resources/views/metric-units/index.blade.php ENDPATH**/ ?>