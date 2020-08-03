<?php $__env->startSection('template_title'); ?>
    <?php echo trans('traffic-tensors.showing-all-traffic-tensors'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('template_linked_css'); ?>
    <?php if(config('atm_app.enabledDatatablesJs')): ?>
        <link rel="stylesheet" type="text/css" href="<?php echo e(config('atm_app.datatablesCssCDN')); ?>">
    <?php endif; ?>
    <style type="text/css" media="screen">
        .traffic-tensors-table {
            border: 0;
        }

        .traffic-tensors-table tr td:first-child {
            padding-left: 15px;
        }

        .traffic-tensors-table tr td:last-child {
            padding-right: 15px;
        }

        .traffic-tensors-table.table-responsive,
        .traffic-tensors-table.table-responsive table {
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
                                <?php echo trans('traffic-tensors.showing-all-traffic-tensors'); ?>

                            </span>

                            <?php if (Auth::check() && Auth::user()->hasRole('atmadmin|atmcollector')): ?>
                            <div class="btn-group pull-right btn-group-xs">
                                <a class="btn btn-primary btn-sm" href="/traffic-tensors/create">
                                    <i class="fa fa-fw fa-plus" aria-hidden="true"></i>
                                    <span class="hidden-xs"><?php echo trans('traffic-tensors.buttons.create-new'); ?></span>
                                </a>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="card-body">
                        <?php if(config('atm_app.enableSearch')): ?>
                            <?php echo $__env->make('partials.search-traffic-tensors-form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endif; ?>

                        <div class="table-responsive traffic-tensors-table">
                            <table class="table table-striped table-sm data-table">
                                <caption id="traffic_tensors_count">
                                    <?php echo e(trans('traffic-tensors.traffic-tensors-table.caption', ['tensorscount' => $tensors->count(), 'tensorstotal' => $tensorstotal])); ?>

                                </caption>
                                <thead class="thead">
                                <tr>
                                    <th><?php echo trans('traffic-tensors.traffic-tensors-table.state'); ?></th>
                                    <th><?php echo trans('traffic-tensors.traffic-tensors-table.height'); ?></th>
                                    <th class="hidden-xs"><?php echo trans('traffic-tensors.traffic-tensors-table.material'); ?></th>
                                    <th class="hidden-xs"><?php echo trans('traffic-tensors.traffic-tensors-table.comment'); ?></th>
                                    <th><?php echo trans('traffic-tensors.traffic-tensors-table.actions'); ?></th>
                                    <th class="no-search no-sort"></th>
                                    <th class="no-search no-sort"></th>
                                </tr>
                                </thead>
                                <tbody id="traffic_tensors_table">
                                <?php $__currentLoopData = $tensors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tensor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($tensor->state); ?></td>
                                        <td><?php echo e($tensor->height); ?>m</td>
                                        <td class="hidden-xs"><?php echo e($tensor->material); ?></td>
                                        <td class="hidden-xs"><?php echo e($tensor->comment); ?></td>
                                        <td>
                                            <a class="btn btn-sm btn-success btn-block"
                                               href="<?php echo e(URL::to('traffic-tensors/' . $tensor->id)); ?>"
                                               data-toggle="tooltip" title="Mostrar">
                                                <?php echo trans('traffic-tensors.buttons.show'); ?>

                                            </a>
                                        </td>
                                        <?php if (Auth::check() && Auth::user()->hasRole('atmadmin|atmcollector')): ?>
                                        <td>
                                            <a class="btn btn-sm btn-info btn-block"
                                               href="<?php echo e(URL::to('traffic-tensors/' . $tensor->id . '/edit')); ?>"
                                               data-toggle="tooltip" title="Editar">
                                                <?php echo trans('traffic-tensors.buttons.edit'); ?>

                                            </a>
                                        </td>
                                        <?php endif; ?>
                                        <?php if (Auth::check() && Auth::user()->hasRole('atmadmin')): ?>
                                        <td>
                                            <?php echo Form::open(array('url' => 'traffic-tensors/' . $tensor->id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Eliminar')); ?>

                                            <?php echo Form::hidden('_method', 'DELETE'); ?>

                                            <?php echo Form::button(trans('traffic-tensors.buttons.delete'), array('class' => 'btn btn-danger btn-sm','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Eliminar tensor', 'data-message' => '¿Está seguro que desea eliminar el tensor? ¡Eliminará con el todas sus dependencias!')); ?>

                                            <?php echo Form::close(); ?>

                                        </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>

                                <?php if(config('atm_app.enableSearch')): ?>
                                    <tbody id="search_results"></tbody>
                                <?php endif; ?>
                            </table>

                            <?php if(config('atm_app.enablePagination')): ?>
                                <?php echo e($tensors->links()); ?>

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
    <?php if((count($tensors) > config('atm_app.datatablesJsStartCount')) && config('atm_app.enabledDatatablesJs')): ?>
        <?php echo $__env->make('scripts.datatables', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

    <?php echo $__env->make('scripts.delete-modal-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('scripts.save-modal-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php if(config('atm_app.tooltipsEnabled')): ?>
        <?php echo $__env->make('scripts.tooltips', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

    <?php if(config('atm_app.enableSearch')): ?>
        <?php echo $__env->make('scripts.search-traffic-tensors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/atmdeveqadoor/resources/views/traffic-tensors/show-traffic-tensors.blade.php ENDPATH**/ ?>