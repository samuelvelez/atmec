<?php $__env->startSection('template_title'); ?>
    <?php echo trans('signalsinventory.showing-all-signals-inventories'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('template_linked_css'); ?>
    <?php if(config('atm_app.enabledDatatablesJs')): ?>
        <link rel="stylesheet" type="text/css" href="<?php echo e(config('atm_app.datatablesCssCDN')); ?>">
    <?php endif; ?>
    <style type="text/css" media="screen">
        .signals-inventories-table {
            border: 0;
        }

        .signals-inventories-table tr td:first-child {
            padding-left: 15px;
        }

        .signals-inventories-table tr td:last-child {
            padding-right: 15px;
        }

        .signals-inventories-table.table-responsive,
        .signals-inventories-table.table-responsive table {
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
                                <?php echo trans('signalsinventory.showing-all-signals-inventories'); ?>

                            </span>

                            <div class="btn-group pull-right btn-group-xs">
                                <a class="btn btn-primary btn-sm" href="/signals-inventory/create">
                                    <i class="fa fa-fw fa-plus" aria-hidden="true"></i>
                                    <span class="hidden-xs"><?php echo trans('signalsinventory.buttons.create-new'); ?></span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">

                        <?php if(config('atm_app.enableSearch')): ?>
                            <?php echo $__env->make('partials.search-signals-inventory-form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endif; ?>

                        <div class="table-responsive signals-inventories-table">
                            <table class="table table-striped table-sm data-table">
                                <caption id="inventory_count">
                                    <?php echo e(trans('signalsinventory.signals-inventories-table.caption', ['signals-inventoriescount' => $inventories->count(), 'inventoriestotal' => $inventoriestotal])); ?>

                                </caption>
                                <thead class="thead">
                                <tr>
                                    <th><?php echo trans('signalsinventory.signals-inventories-table.code'); ?></th>
                                    <th><?php echo trans('signalsinventory.signals-inventories-table.name'); ?></th>
                                    <th><?php echo trans('signalsinventory.signals-inventories-table.group'); ?></th>
                                    <th><?php echo trans('signalsinventory.signals-inventories-table.subgroup'); ?></th>
                                    <th><?php echo trans('signalsinventory.signals-inventories-table.variations'); ?></th>
                                    <th><?php echo trans('signalsinventory.signals-inventories-table.actions'); ?></th>
                                    <th class="no-search no-sort"></th>
                                    <th class="no-search no-sort"></th>
                                </tr>
                                </thead>
                                <tbody id="inventory_table">
                                <?php $__currentLoopData = $inventories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inventory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($inventory->code); ?></td>
                                        <td><?php echo e($inventory->name); ?></td>
                                        <td><?php echo e($inventory->subgroup->group->name); ?> (<?php echo e($inventory->subgroup->group->code); ?>)
                                        </td>
                                        <td><?php echo e($inventory->subgroup->name); ?> (<?php echo e($inventory->subgroup->code); ?>)</td>
                                        <td><?php if($inventory->variations): ?> <?php echo e(count($inventory->variations)); ?> <?php else: ?> 0 <?php endif; ?></td>
                                        <td>
                                            <a class="btn btn-sm btn-success btn-block"
                                               href="<?php echo e(URL::to('signals-inventory/' . $inventory->id)); ?>"
                                               data-toggle="tooltip" title="Show">
                                                <?php echo trans('signalsinventory.buttons.show'); ?>

                                            </a>
                                        </td>
                                        <td>
                                            <a class="btn btn-sm btn-info btn-block"
                                               href="<?php echo e(URL::to('signals-inventory/' . $inventory->id . '/edit')); ?>"
                                               data-toggle="tooltip" title="Edit">
                                                <?php echo trans('signalsinventory.buttons.edit'); ?>

                                            </a>
                                        </td>
                                        <?php if (Auth::check() && Auth::user()->hasRole('atmadmin|atmoperator')): ?>
                                        <td>
                                            <?php echo Form::open(array('url' => 'signals-inventory/' . $inventory->id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Eliminar')); ?>

                                            <?php echo Form::hidden('_method', 'DELETE'); ?>

                                            <?php echo Form::button(trans('signalsinventory.buttons.delete'), array('class' => 'btn btn-danger btn-sm','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Eliminar tipo de señal', 'data-message' => '¿Está seguro que desea eliminar esta señal? ¡Eliminará con ella todas sus dependencias!')); ?>

                                            <?php echo Form::close(); ?>

                                        </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                                <tbody id="search_results"></tbody>
                                <?php if(config('atm_app.enableSearch')): ?>
                                    <tbody id="search_results"></tbody>
                                <?php endif; ?>

                            </table>

                            <?php if(config('atm_app.enablePagination')): ?>
                                <?php echo e($inventories->links()); ?>

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
    <?php if((count($inventories) > config('atm_app.datatablesJsStartCount')) && config('atm_app.enabledDatatablesJs')): ?>
        <?php echo $__env->make('scripts.datatables', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
    <?php echo $__env->make('scripts.delete-modal-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('scripts.save-modal-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php if(config('atm_app.tooltipsEnabled')): ?>
        <?php echo $__env->make('scripts.tooltips', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
    <?php if(config('atm_app.enableSearch')): ?>
        <?php echo $__env->make('scripts.search-signals-inventory', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/samuel/Documents/proyectos/Saveme/atm2/nuevo/resources/views/signalsinventory/show-signal-inventories.blade.php ENDPATH**/ ?>