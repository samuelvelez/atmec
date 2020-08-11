<?php $__env->startSection('template_title'); ?>
    <?php echo trans('ito-templates.showing-all-templates'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('template_linked_css'); ?>
    <?php if(config('atm_app.enabledDatatablesJs')): ?>
        <link rel="stylesheet" type="text/css" href="<?php echo e(config('atm_app.datatablesCssCDN')); ?>">
    <?php endif; ?>
    <style type="text/css" media="screen">
        .templates-table {
            border: 0;
        }

        .templates-table tr td:first-child {
            padding-left: 15px;
        }

        .templates-table tr td:last-child {
            padding-right: 15px;
        }

        .templates-table.table-responsive,
        .templates-table.table-responsive table {
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
                                <?php echo trans('ito-templates.showing-all-templates'); ?>

                            </span>

                            <?php if (Auth::check() && Auth::user()->hasRole('atmadmin|atmstockkeeper')): ?>
                            <div class="btn-group pull-right btn-group-xs">
                                <a class="btn btn-primary btn-sm" href="/ito-templates/create">
                                    <?php echo trans('ito-templates.buttons.create'); ?>

                                </a>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive templates-table">
                            <table class="table table-striped table-hover table-sm data-table">
                                <caption id="templates_count">
                                    <?php echo e(trans_choice('ito-templates.templates-table.caption', $templates->count(), ['templatestotal' => $templatestotal])); ?>

                                </caption>
                                <thead class="thead">
                                <tr>
                                    <th><?php echo trans('ito-templates.templates-table.id'); ?></th>
                                    <th><?php echo trans('ito-templates.templates-table.name'); ?></th>
                                    <th><?php echo trans('ito-templates.templates-table.materials'); ?></th>
                                    <th class="hidden-xs"><?php echo trans('ito-templates.templates-table.description'); ?></th>

                                    <th><?php echo trans('ito-templates.templates-table.actions'); ?></th>
                                    <th class="no-search no-sort"></th>
                                    <th class="no-search no-sort"></th>
                                </tr>
                                </thead>
                                <tbody id="templates_table">
                                <?php $__currentLoopData = $templates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><a href="<?php echo e(URL::to('ito-templates/' . $template->id)); ?>"><?php echo e($template->id); ?></a></td>
                                        <td><?php echo e($template->name); ?></td>
                                        <td><?php echo e($template->materials()->count()); ?></td>
                                        <td class="hidden-xs"><?php echo e($template->description); ?></td>

                                        <?php if (Auth::check() && Auth::user()->hasRole('atmadmin|atmstockkeeper')): ?>
                                        <td>
                                            <a class="btn btn-sm btn-success btn-block"
                                               href="<?php echo e(URL::to('ito-templates/' . $template->id)); ?>"
                                               data-toggle="tooltip" title="Ver">
                                                <?php echo trans('ito-templates.buttons.show'); ?>

                                            </a>
                                        </td>

                                        <td>
                                            <a class="btn btn-sm btn-info btn-block"
                                               href="<?php echo e(URL::to('ito-templates/' . $template->id . '/edit')); ?>"
                                               data-toggle="tooltip" title="Editar">
                                                <?php echo trans('ito-templates.buttons.edit'); ?>

                                            </a>
                                        </td>

                                        <td>
                                            <?php echo Form::open(array('url' => 'ito-templates/' . $template->id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Eliminar')); ?>

                                            <?php echo Form::hidden('_method', 'DELETE'); ?>

                                            <?php echo Form::button(trans('ito-templates.buttons.delete'), array('class' => 'btn btn-danger btn-sm','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => trans('ito-templates.modals.delete_template_title'), 'data-message' => trans('ito-templates.modals.delete_template_message', ['id' => $template->id]))); ?>

                                            <?php echo Form::close(); ?>

                                        </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>

                            <?php if(config('atm_app.enablePagination')): ?>
                                <?php echo e($templates->links()); ?>

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
    <?php if((count($templates) > config('atm_app.datatablesJsStartCount')) && config('atm_app.enabledDatatablesJs')): ?>
        <?php echo $__env->make('scripts.datatables', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

    <?php echo $__env->make('scripts.delete-modal-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('scripts.save-modal-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php if(config('atm_app.tooltipsEnabled')): ?>
        <?php echo $__env->make('scripts.tooltips', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/samuel/Documents/proyectos/Saveme/atm2/nuevo/resources/views/ito-templates/index.blade.php ENDPATH**/ ?>