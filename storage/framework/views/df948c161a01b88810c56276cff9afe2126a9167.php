<?php $__env->startSection('template_title'); ?>
    <?php echo trans('reports.showing-all-reports'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('template_linked_css'); ?>
    <?php if(config('atm_app.enabledDatatablesJs')): ?>
        <link rel="stylesheet" type="text/css" href="<?php echo e(config('atm_app.datatablesCssCDN')); ?>">
    <?php endif; ?>
    <style type="text/css" media="screen">
        .reports-table {
            border: 0;
        }

        .reports-table tr td:first-child {
            padding-left: 15px;
        }

        .reports-table tr td:last-child {
            padding-right: 15px;
        }

        .reports-table.table-responsive,
        .reports-table.table-responsive table {
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
                                <?php echo trans('reports.showing-all-reports'); ?>

                            </span>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive reports-table">
                            <table class="table table-striped table-hover table-sm data-table">
                                <caption id="reports_count">
                                    <?php echo e(trans_choice('reports.reports-table.caption', $reports->count(), ['reportstotal' => $reportstotal])); ?>

                                </caption>
                                <thead class="thead">
                                <tr>
                                    <th><?php echo trans('reports.reports-table.id'); ?></th>
                                    <th><?php echo trans('reports.reports-table.alert'); ?></th>
                                    <th><?php echo trans('reports.reports-table.status'); ?></th>
                                    <th><?php echo trans('reports.reports-table.novelty'); ?></th>
                                    <th><?php echo trans('reports.reports-table.subnovelty'); ?></th>
                                    <th><?php echo trans('reports.reports-table.worktype'); ?></th>
                                    <th class="hidden-xs"><?php echo trans('reports.reports-table.readed'); ?></th>
                                    <th class="hidden-xs"><?php echo trans('reports.reports-table.description'); ?></th>

                                    <th><?php echo trans('reports.reports-table.actions'); ?></th>
                                    <th class="no-search no-sort"></th>
                                    <th class="no-search no-sort"></th>
                                    <th class="no-search no-sort"></th>
                                </tr>
                                </thead>
                                <tbody id="reports_table">
                                <?php $__currentLoopData = $reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><a href="<?php echo e(URL::to('reports/' . $report->id)); ?>" data-toggle="tooltip"
                                               title="Mostrar reporte"><?php echo e($report->id); ?></a></td>
                                        <td><a href="<?php echo e(URL::to('alerts/' . $report->alert_id)); ?>" data-toggle="tooltip"
                                               title="Mostrar alerta"><?php echo e($report->alert_id); ?></a></td>
                                        <td><?php echo e($report->status->name); ?></td>
                                        <td><?php echo e($report->novelty->name); ?></td>
                                        <td><?php echo e($report->subnovelty->name); ?></td>
                                        <td><?php echo e($report->worktype->name); ?></td>
                                        <td class="hidden-xs">
                                            <?php if($report->readed_on): ?>
                                                <?php echo e($report->readed_on); ?>

                                            <?php else: ?>
                                                No leido
                                            <?php endif; ?>
                                        </td>
                                        <td class="hidden-xs"><?php echo e($report->description); ?></td>

                                        <td>
                                            <?php if( Auth::user()->hasRole('atmoperator') && !$report->workorder): ?>
                                                <a class="btn btn-sm btn-warning btn-block"
                                                   href="<?php echo e(URL::to('workorders/' . $report->id . '/create/')); ?>"
                                                   data-toggle="tooltip" title="Crear órden de trabajo">
                                                    <?php echo trans('reports.buttons.create_workorder'); ?>

                                                </a>
                                            <?php endif; ?>
                                        </td>

                                        <td>
                                            <a class="btn btn-sm btn-success btn-block"
                                               href="<?php echo e(URL::to('reports/' . $report->id)); ?>"
                                               data-toggle="tooltip" title="Mostrar el reporte">
                                                <?php echo trans('reports.buttons.show'); ?>

                                            </a>
                                        </td>

                                        <?php if (Auth::check() && Auth::user()->hasRole('atmoperator')): ?>
                                        <td>
                                            <a class="btn btn-sm btn-info btn-block"
                                               href="<?php echo e(URL::to('reports/' . $report->id . '/edit')); ?>"
                                               data-toggle="tooltip" title="Editar">
                                                <?php echo trans('reports.buttons.edit'); ?>

                                            </a>
                                        </td>
                                        <?php endif; ?>

                                        <?php if (Auth::check() && Auth::user()->hasRole('atmoperator|atmcollector')): ?>
                                        <td>
                                            <?php echo Form::open(array('url' => 'reports/' . $report->id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Eliminar')); ?>

                                            <?php echo Form::hidden('_method', 'DELETE'); ?>

                                            <?php echo Form::button(trans('reports.buttons.delete'), array('class' => 'btn btn-danger btn-sm','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => trans('reports.modals.delete_report_title'), 'data-message' => trans('reports.modals.delete_report_message', ['id' => $report->id]))); ?>

                                            <?php echo Form::close(); ?>

                                        </td>
                                        <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>

                            <?php if(config('atm_app.enablePagination')): ?>
                                <?php echo e($reports->links()); ?>

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
    <?php if((count($reports) > config('atm_app.datatablesJsStartCount')) && config('atm_app.enabledDatatablesJs')): ?>
        <?php echo $__env->make('scripts.datatables', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

    <?php echo $__env->make('scripts.delete-modal-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('scripts.save-modal-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php if(config('atm_app.tooltipsEnabled')): ?>
        <?php echo $__env->make('scripts.tooltips', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/atmdeveqadoor/resources/views/reports/index.blade.php ENDPATH**/ ?>