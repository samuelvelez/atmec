<?php $__env->startSection('template_title'); ?>
    <?php echo trans('motives.showing-all-motives'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('template_linked_css'); ?>
    <?php if(config('atm_app.enabledDatatablesJs')): ?>
        <link rel="stylesheet" type="text/css" href="<?php echo e(config('atm_app.datatablesCssCDN')); ?>">
    <?php endif; ?>
    <style type="text/css" media="screen">
        .motives-table {
            border: 0;
        }

        .motives-table tr td:first-child {
            padding-left: 15px;
        }

        .motives-table tr td:last-child {
            padding-right: 15px;
        }

        .motives-table.table-responsive,
        .motives-table.table-responsive table {
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
                                <?php echo trans('motives.showing-all-motives'); ?>

                            </span>

                            <?php if (Auth::check() && Auth::user()->hasRole('atmadmin')): ?>
                            <div class="btn-group pull-right btn-group-xs">
                                <a class="btn btn-primary btn-sm" href="/motives/create">
                                    <?php echo trans('motives.buttons.create'); ?>

                                </a>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive motives-table">
                            <table class="table table-striped table-hover table-sm data-table">
                                <caption id="motives_count">
                                    <?php echo e(trans_choice('motives.motives-table.caption', $motives->count(), ['motivestotal' => $motivesstotal])); ?>

                                </caption>
                                <thead class="thead">
                                <tr>
                                    <th><?php echo trans('motives.motives-table.id'); ?></th>
                                    <th><?php echo trans('motives.motives-table.name'); ?></th>
                                    <th class="hidden-xs"><?php echo trans('motives.motives-table.description'); ?></th>

                                    <th><?php echo trans('motives.motives-table.actions'); ?></th>
                                    <th class="no-search no-sort"></th>
                                </tr>
                                </thead>
                                <tbody id="motives_table">
                                <?php $__currentLoopData = $motives; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $motive): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($motive->id); ?></td>
                                        <td><?php echo e($motive->name); ?></td>
                                        <td class="hidden-xs"><?php echo e($motive->description); ?></td>

                                        <?php if (Auth::check() && Auth::user()->hasRole('atmadmin')): ?>
                                        <td>
                                            <a class="btn btn-sm btn-info btn-block"
                                               href="<?php echo e(URL::to('motives/' . $motive->id . '/edit')); ?>"
                                               data-toggle="tooltip" title="Editar">
                                                <?php echo trans('motives.buttons.edit'); ?>

                                            </a>
                                        </td>
                                        <?php endif; ?>
                                        <?php if (Auth::check() && Auth::user()->hasRole('atmadmin')): ?>
                                        <td>
                                            <?php echo Form::open(array('url' => 'motives/' . $motive->id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Eliminar')); ?>

                                            <?php echo Form::hidden('_method', 'DELETE'); ?>

                                            <?php echo Form::button(trans('motives.buttons.delete'), array('class' => 'btn btn-danger btn-sm','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => trans('motives.modals.delete_motive_title'), 'data-message' => trans('motives.modals.delete_motive_message', ['id' => $motive->id]))); ?>

                                            <?php echo Form::close(); ?>

                                        </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>

                            <?php if(config('atm_app.enablePagination')): ?>
                                <?php echo e($motives->links()); ?>

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
    <?php if((count($motives) > config('atm_app.datatablesJsStartCount')) && config('atm_app.enabledDatatablesJs')): ?>
        <?php echo $__env->make('scripts.datatables', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

    <?php echo $__env->make('scripts.delete-modal-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('scripts.save-modal-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php if(config('atm_app.tooltipsEnabled')): ?>
        <?php echo $__env->make('scripts.tooltips', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/atmdeveqadoor/resources/views/motives/index.blade.php ENDPATH**/ ?>