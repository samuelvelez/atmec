<?php $__env->startSection('template_title'); ?>
    <?php echo trans('itorders.showing-all-itorders'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('template_linked_css'); ?>
    <?php if(config('atm_app.enabledDatatablesJs')): ?>
        <link rel="stylesheet" type="text/css" href="<?php echo e(config('atm_app.datatablesCssCDN')); ?>">
    <?php endif; ?>
    <style type="text/css" media="screen">
        .itorders-table {
            border: 0;
        }

        .itorders-table tr td:first-child {
            padding-left: 15px;
        }

        .itorders-table tr td:last-child {
            padding-right: 15px;
        }

        .itorders-table.table-responsive,
        .itorders-table.table-responsive table {
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
                                <?php echo trans('itorders.showing-all-itorders'); ?>

                            </span>

                            <?php if (Auth::check() && Auth::user()->hasRole('atmadmin|atmstockkeeper')): ?>
                            <div class="btn-group pull-right btn-group-xs">
                                <a class="btn btn-primary btn-sm" href="/itorders/create">
                                    <?php echo trans('itorders.buttons.create'); ?>

                                </a>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive itorders-table">
                            <table class="table table-striped table-hover table-sm data-table">
                                <caption id="itorders_count">
                                    <?php echo e(trans_choice('itorders.itorders-table.caption', $itorders->count(), ['itorderstotal' => $itorderstotal])); ?>

                                </caption>
                                <thead class="thead">
                                <tr>
                                    <th><?php echo trans('itorders.itorders-table.id'); ?></th>
                                    <th><?php echo trans('itorders.itorders-table.collector'); ?></th>
                                    <th><?php echo trans('itorders.itorders-table.materials'); ?></th>
                                    <th><?php echo trans('itorders.itorders-table.created'); ?></th>
                                    <th><?php echo trans('itorders.itorders-table.actions'); ?></th>
                                    <th class="no-search no-sort"></th>
                                    <th class="no-search no-sort"></th>
                                </tr>
                                </thead>
                                <tbody id="itorders_table">
                                <?php $__currentLoopData = $itorders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $itorder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><a href="<?php echo e(URL::to('itorders/' . $itorder->id)); ?>"><?php echo e($itorder->id); ?></a></td>
                                        <td><?php echo e($itorder->collector->full_name()); ?></td>
                                        <td><?php echo e($itorder->materials()->count()); ?></td>
                                        <td><?php echo e($itorder->created_at); ?></td>

                                        <?php if (Auth::check() && Auth::user()->hasRole('atmadmin|atmstockkeeper')): ?>
                                        <td>
                                            <a class="btn btn-sm btn-success btn-block"
                                               href="<?php echo e(URL::to('itorders/' . $itorder->id)); ?>"
                                               data-toggle="tooltip" title="Ver">
                                                <?php echo trans('itorders.buttons.show'); ?>

                                            </a>
                                        </td>

                                        <td>
                                            <a class="btn btn-sm btn-info btn-block"
                                               href="<?php echo e(URL::to('itorders/' . $itorder->id . '/edit')); ?>"
                                               data-toggle="tooltip" title="Editar">
                                                <?php echo trans('itorders.buttons.edit'); ?>

                                            </a>
                                        </td>

                                        <td>
                                            <?php echo Form::open(array('url' => 'itorders/' . $itorder->id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Eliminar')); ?>

                                            <?php echo Form::hidden('_method', 'DELETE'); ?>

                                            <?php echo Form::button(trans('itorders.buttons.delete'), array('class' => 'btn btn-danger btn-sm','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => trans('itorders.modals.delete_itorder_title'), 'data-message' => trans('itorders.modals.delete_itorder_message', ['id' => $itorder->id]))); ?>

                                            <?php echo Form::close(); ?>

                                        </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>

                            <?php if(config('atm_app.enablePagination')): ?>
                                <?php echo e($itorders->links()); ?>

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
    <?php if((count($itorders) > config('atm_app.datatablesJsStartCount')) && config('atm_app.enabledDatatablesJs')): ?>
        <?php echo $__env->make('scripts.datatables', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

    <?php echo $__env->make('scripts.delete-modal-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('scripts.save-modal-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php if(config('atm_app.tooltipsEnabled')): ?>
        <?php echo $__env->make('scripts.tooltips', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/atmdeveqadoor/resources/views/itorders/index.blade.php ENDPATH**/ ?>