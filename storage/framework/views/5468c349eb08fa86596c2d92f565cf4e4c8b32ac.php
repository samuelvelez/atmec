<?php $__env->startSection('template_title'); ?>
    <?php echo trans('alerts.showing-all-alerts'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('template_linked_css'); ?>
    <?php if(config('atm_app.enabledDatatablesJs')): ?>
        <link rel="stylesheet" type="text/css" href="<?php echo e(config('atm_app.datatablesCssCDN')); ?>">
    <?php endif; ?>
    <style type="text/css" media="screen">
        .alerts-table {
            border: 0;
        }

        .alerts-table tr td:first-child {
            padding-left: 15px;
        }

        .alerts-table tr td:last-child {
            padding-right: 15px;
        }

        .alerts-table.table-responsive,
        .alerts-table.table-responsive table {
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
                                <?php echo trans('alerts.showing-all-alerts'); ?>

                            </span>

                            <?php if (Auth::check() && Auth::user()->hasRole('atmoperator|atmcollector')): ?>
                            <div class="btn-group pull-right btn-group-xs">
                                <a class="btn btn-primary btn-sm" href="/alerts/create">
                                    <?php echo trans('alerts.buttons.create'); ?>

                                </a>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive alerts-table">
                            <table class="table table-striped table-hover table-sm data-table">
                                <caption id="alerts_count">
                                    <?php echo e(trans_choice('alerts.alerts-table.caption', $alerts->count(), ['alertstotal' => $alertstotal])); ?>

                                </caption>
                                <thead class="thead">
                                <tr>
                                    <th><?php echo trans('alerts.alerts-table.id'); ?></th>
                                    <th><?php echo trans('alerts.alerts-table.collector'); ?></th>
                                    <th><?php echo trans('alerts.alerts-table.creator'); ?></th>
                                    <th><?php echo trans('alerts.alerts-table.status'); ?></th>
                                    <th class="hidden-xs"><?php echo trans('alerts.alerts-table.address'); ?></th>
                                    <th class="hidden-xs"><?php echo trans('alerts.alerts-table.readed'); ?></th>
                                    <th class="hidden-xs"><?php echo trans('alerts.alerts-table.description'); ?></th>

                                    <th><?php echo trans('alerts.alerts-table.actions'); ?></th>
                                    <th class="no-search no-sort"></th>
                                    <th class="no-search no-sort"></th>
                                    <th class="no-search no-sort"></th>
                                </tr>
                                </thead>
                                <tbody id="alerts_table">
                                <?php $__currentLoopData = $alerts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $alert): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($alert->id); ?></td>
                                        <td><?php echo e($alert->collector->full_name()); ?></td>
                                        <td><?php echo e($alert->owner->full_name()); ?></td>
                                        <td><?php echo e($alert->status->name); ?></td>
                                        <td class="hidden-xs"><?php echo e($alert->google_address); ?></td>
                                        <td class="hidden-xs">
                                            <?php if($alert->readed_on): ?>
                                                <?php echo e($alert->readed_on); ?>

                                            <?php else: ?>
                                                No leida
                                            <?php endif; ?>
                                        </td>
                                        <td class="hidden-xs"><?php echo e($alert->description); ?></td>

                                        <td>
                                            <?php if(!$alert->report && Auth::user()->hasRole('atmcollector')): ?>
                                                <a class="btn btn-sm btn-danger btn-block"
                                                   href="<?php echo e(URL::to('reports/' . $alert->id . '/create/')); ?>"
                                                   data-toggle="tooltip" title="Crear reporte">
                                                    <?php echo trans('alerts.buttons.create_report'); ?>

                                                </a>
                                            <?php endif; ?>
                                        </td>

                                        <td>
                                            <a class="btn btn-sm btn-success btn-block"
                                               href="<?php echo e(URL::to('alerts/' . $alert->id)); ?>"
                                               data-toggle="tooltip" title="Mostrar la alerta">
                                                <?php echo trans('alerts.buttons.show'); ?>

                                            </a>
                                        </td>

                                        <?php if(Auth::user()->hasRole('atmoperator') && !$alert->report): ?>
                                        <td>
                                            <a class="btn btn-sm btn-info btn-block"
                                               href="<?php echo e(URL::to('alerts/' . $alert->id . '/edit')); ?>"
                                               data-toggle="tooltip" title="Editar">
                                                <?php echo trans('alerts.buttons.edit'); ?>

                                            </a>
                                        </td>

                                        <td>
                                            <?php echo Form::open(array('url' => 'alerts/' . $alert->id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Eliminar')); ?>

                                            <?php echo Form::hidden('_method', 'DELETE'); ?>

                                            <?php echo Form::button(trans('alerts.buttons.delete'), array('class' => 'btn btn-danger btn-sm','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => trans('alerts.modals.delete_alert_title'), 'data-message' => trans('alerts.modals.delete_alert_message', ['id' => $alert->id]))); ?>

                                            <?php echo Form::close(); ?>

                                        </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>

                            <?php if(config('atm_app.enablePagination')): ?>
                                <?php echo e($alerts->links()); ?>

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
    <?php if((count($alerts) > config('atm_app.datatablesJsStartCount')) && config('atm_app.enabledDatatablesJs')): ?>
        <?php echo $__env->make('scripts.datatables', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

    <?php echo $__env->make('scripts.delete-modal-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('scripts.save-modal-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php if(config('atm_app.tooltipsEnabled')): ?>
        <?php echo $__env->make('scripts.tooltips', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/atmdeveqadoor/resources/views/alerts/index.blade.php ENDPATH**/ ?>