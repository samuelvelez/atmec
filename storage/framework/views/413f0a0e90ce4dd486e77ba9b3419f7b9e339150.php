<?php $__env->startSection('template_title'); ?>
    <?php echo trans('workorders.showing-all-workorders'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('template_linked_css'); ?>
    <?php if(config('atm_app.enabledDatatablesJs')): ?>
        <link rel="stylesheet" type="text/css" href="<?php echo e(config('atm_app.datatablesCssCDN')); ?>">
    <?php endif; ?>
    <style type="text/css" media="screen">
        .workorders-table {
            border: 0;
        }

        .workorders-table tr td:first-child {
            padding-left: 15px;
        }

        .workorders-table tr td:last-child {
            padding-right: 15px;
        }

        .workorders-table.table-responsive,
        .workorders-table.table-responsive table {
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
                                <?php echo trans('workorders.showing-all-workorders'); ?>

                            </span>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive workorders-table">
                            <table class="table table-striped table-hover table-sm data-table">
                                <caption id="workorders_count">
                                    <?php echo e(trans_choice('workorders.workorders-table.caption', $workorders->count(), ['workorderstotal' => $workorderstotal])); ?>

                                </caption>
                                <thead class="thead">
                                <tr>
                                    <th><?php echo trans('workorders.workorders-table.id'); ?></th>
                                    <th><?php echo trans('workorders.workorders-table.report'); ?></th>
                                    <th><?php echo trans('workorders.workorders-table.collector'); ?></th>
                                    <th><?php echo trans('workorders.workorders-table.status'); ?></th>
                                    <th><?php echo trans('workorders.workorders-table.priority'); ?></th>
                                    <th class="hidden-xs"><?php echo trans('workorders.workorders-table.description'); ?></th>
                                    <th class="hidden-xs"><?php echo trans('workorders.workorders-table.started'); ?></th>
                                    <th class="hidden-xs"><?php echo trans('workorders.workorders-table.completed'); ?></th>

                                    <th><?php echo trans('workorders.workorders-table.actions'); ?></th>
                                    <th class="no-search no-sort"></th>
                                    <th class="no-search no-sort"></th>
                                    <th class="no-search no-sort"></th>
                                </tr>
                                </thead>
                                <tbody id="workorders_table">
                                <?php $__currentLoopData = $workorders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $workorder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><a href="<?php echo e(URL::to('workorders/' . $workorder->id)); ?>"
                                               data-toggle="tooltip"
                                               title="Ver órden de trabajo"><?php echo e($workorder->id); ?></a></td>
                                        <td><a href="<?php echo e(URL::to('reports/' . $workorder->report->id)); ?>"
                                               data-toggle="tooltip"
                                               title="Ver reporte"><?php echo e($workorder->report->id); ?></a></td>
                                        <td><?php echo e($workorder->collector->full_name()); ?></td>
                                        <td><?php echo e($workorder->status->name); ?></td>
                                        <td><?php echo e($workorder->priority->name); ?></td>
                                        <td class="hidden-xs"><?php echo e($workorder->description); ?></td>
                                        <td class="hidden-xs">
                                            <?php if($workorder->started_on): ?>
                                                <?php echo e($workorder->started_on); ?>

                                            <?php else: ?>
                                                -
                                            <?php endif; ?>
                                        </td>
                                        <td class="hidden-xs">
                                            <?php if($workorder->completed_on): ?>
                                                <?php echo e($workorder->completed_on); ?>

                                            <?php else: ?>
                                                -
                                            <?php endif; ?>
                                        </td>

                                        <td>
                                            <?php if(Auth::user()->hasRole('atmcollector') && !$workorder->completed_on): ?>
                                                <a class="btn btn-sm btn-warning btn-block"
                                                   href="<?php echo e(URL::to('workorders/' . $workorder->id . '/close')); ?>"
                                                   data-toggle="tooltip" title="Cerrar órden de trabajo">
                                                    <?php echo trans('workorders.buttons.close_order'); ?>

                                                </a>
                                            <?php elseif(Auth::user()->hasRole('atmoperator') && $workorder->status->name == \App\Models\Workorder::STATUS_CLOSED): ?>
                                                <?php echo Form::open(array('url' => 'workorders/' . $workorder->id . '/complete', 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Finalizar orden')); ?>

                                                <?php echo Form::hidden('_method', 'POST'); ?>

                                                <?php echo Form::button(trans('workorders.buttons.complete_order'), array('class' => 'btn btn-warning btn-sm','type' => 'submit', 'style' =>'width: 100%;'), ['id' => $workorder->id]); ?>

                                                <?php echo Form::close(); ?>

                                            <?php endif; ?>
                                        </td>

                                        <td>
                                            <a class="btn btn-sm btn-success btn-block"
                                               href="<?php echo e(URL::to('workorders/' . $workorder->id)); ?>"
                                               data-toggle="tooltip" title="Mostrar la órden de trabajo">
                                                <?php echo trans('workorders.buttons.show'); ?>

                                            </a>
                                        </td>

                                        <?php if(Auth::user()->hasRole('atmoperator') && $workorder->status->name == \App\Models\Workorder::STATUS_OPEN): ?>
                                        <td>
                                            <a class="btn btn-sm btn-info btn-block"
                                               href="<?php echo e(URL::to('workorders/' . $workorder->id . '/edit')); ?>"
                                               data-toggle="tooltip" title="Editar">
                                                <?php echo trans('workorders.buttons.edit'); ?>

                                            </a>
                                        </td>

                                        <td>
                                            <?php echo Form::open(array('url' => 'workorders/' . $workorder->id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Eliminar')); ?>

                                            <?php echo Form::hidden('_method', 'DELETE'); ?>

                                            <?php echo Form::button(trans('workorders.buttons.delete'), array('class' => 'btn btn-danger btn-sm','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => trans('workorders.modals.delete_workorder_title'), 'data-message' => trans('workorders.modals.delete_workorder_message', ['id' => $workorder->id]))); ?>

                                            <?php echo Form::close(); ?>

                                        </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>

                            <?php if(config('atm_app.enablePagination')): ?>
                                <?php echo e($workorders->links()); ?>

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
    <?php if((count($workorders) > config('atm_app.datatablesJsStartCount')) && config('atm_app.enabledDatatablesJs')): ?>
        <?php echo $__env->make('scripts.datatables', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

    <?php echo $__env->make('scripts.delete-modal-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('scripts.save-modal-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php if(config('atm_app.tooltipsEnabled')): ?>
        <?php echo $__env->make('scripts.tooltips', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/atmdeveqadoor/resources/views/workorders/index.blade.php ENDPATH**/ ?>