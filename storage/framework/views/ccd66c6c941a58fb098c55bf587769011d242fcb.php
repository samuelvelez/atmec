

<?php $__env->startSection('template_title'); ?>
    <?php echo trans('intersections.showing-all-intersections'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('template_linked_css'); ?>
    <?php if(config('atm_app.enabledDatatablesJs')): ?>
        <link rel="stylesheet" type="text/css" href="<?php echo e(config('atm_app.datatablesCssCDN')); ?>">
    <?php endif; ?>
    <style type="text/css" media="screen">
        .intersections-table {
            border: 0;
        }

        .intersections-table tr td:first-child {
            padding-left: 15px;
        }

        .intersections-table tr td:last-child {
            padding-right: 15px;
        }

        .intersections-table.table-responsive,
        .intersections-table.table-responsive table {
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
                                <?php echo trans('intersections.showing-all-intersections'); ?>

                            </span>

                            <?php if (Auth::check() && Auth::user()->hasRole('atmadmin|atmcollector')): ?>
                            <div class="btn-group pull-right btn-group-xs">
                                <a class="btn btn-primary btn-sm" href="/intersections/create">
                                    <i class="fa fa-fw fa-plus" aria-hidden="true"></i>
                                    <span class="hidden-xs"><?php echo trans('intersections.buttons.create-new'); ?></span>
                                </a>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="card-body">
                        <?php if(config('atm_app.enableSearch')): ?>
                            <?php echo $__env->make('partials.search-intersections-form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endif; ?>

                        <div class="table-responsive intersections-table">
                            <table class="table table-striped table-sm data-table">
                                <caption id="intersection_count">
                                    <?php echo e(trans_choice('intersections.intersections-table.caption', 1, ['intersectionscount' => $intersections->count(), 'intersectionstotal' => $intersectionstotal])); ?>

                                </caption>
                                <thead class="thead">
                                <tr>
                                    <th><?php echo trans('intersections.intersections-table.id'); ?></th>
                                    <th><?php echo trans('intersections.intersections-table.main_st'); ?></th>
                                    <th><?php echo trans('intersections.intersections-table.cross_st'); ?></th>
                                    <th class="hidden-xs"><?php echo trans('intersections.intersections-table.latitude'); ?></th>
                                    <th class="hidden-xs"><?php echo trans('intersections.intersections-table.longitude'); ?></th>
                                    <th><?php echo trans('intersections.intersections-table.actions'); ?></th>
                                    <th class="no-search no-sort"></th>
                                    <th class="no-search no-sort"></th>
                                </tr>
                                </thead>
                                <tbody id="intersections_table">
                                <?php $__currentLoopData = $intersections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $intersection): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($intersection->id); ?></td>
                                        <td><?php echo e($intersection->main_st); ?></td>
                                        <td><?php echo e($intersection->cross_st); ?></td>
                                        <td class="hidden-xs"><?php echo e($intersection->latitude); ?></td>
                                        <td class="hidden-xs"><?php echo e($intersection->longitude); ?></td>
                                        <td>
                                            <a class="btn btn-sm btn-success btn-block"
                                               href="<?php echo e(URL::to('intersections/' . $intersection->id)); ?>"
                                               data-toggle="tooltip" title="Mostrar">
                                                <?php echo trans('intersections.buttons.show'); ?>

                                            </a>
                                        </td>
                                        <?php if (Auth::check() && Auth::user()->hasRole('atmadmin|atmcollector')): ?>
                                        <td>
                                            <a class="btn btn-sm btn-info btn-block"
                                               href="<?php echo e(URL::to('intersections/' . $intersection->id . '/edit')); ?>"
                                               data-toggle="tooltip" title="Editar">
                                                <?php echo trans('intersections.buttons.edit'); ?>

                                            </a>
                                        </td>
                                        <?php endif; ?>
                                        <?php if (Auth::check() && Auth::user()->hasRole('atmadmin')): ?>
                                        <td>
                                            <?php echo Form::open(array('url' => 'intersections/' . $intersection->id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Eliminar')); ?>

                                            <?php echo Form::hidden('_method', 'DELETE'); ?>

                                            <?php echo Form::close(); ?>

                                            <?php echo Form::button(trans('intersections.buttons.delete'), array('class' => 'btn btn-danger btn-sm','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Eliminar Intersección', 'data-message' => '¿Está seguro que desea eliminar la intersección? ¡Eliminará con ella todas sus dependencias!')); ?>

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
                                <?php echo e($intersections->links()); ?>

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
    <?php if((count($intersections) > config('atm_app.datatablesJsStartCount')) && config('atm_app.enabledDatatablesJs')): ?>
        <?php echo $__env->make('scripts.datatables', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

    <?php echo $__env->make('scripts.delete-modal-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('scripts.save-modal-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php if(config('atm_app.tooltipsEnabled')): ?>
        <?php echo $__env->make('scripts.tooltips', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

    <?php if(config('atm_app.enableSearch')): ?>
        <?php echo $__env->make('scripts.search-intersections', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/atmeccom/resources/views/intersections/show-intersections.blade.php ENDPATH**/ ?>