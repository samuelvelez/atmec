<?php $__env->startSection('template_title'); ?>
    <?php echo trans('verticalsignals.showing-all-vsignals'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('template_linked_css'); ?>
    <?php if(config('atm_app.enabledDatatablesJs')): ?>
        <link rel="stylesheet" type="text/css" href="<?php echo e(config('atm_app.datatablesCssCDN')); ?>">
    <?php endif; ?>
    <style type="text/css" media="screen">
        .vsignals-table {
            border: 0;
        }

        .vsignals-table tr td:first-child {
            padding-left: 15px;
        }

        .vsignals-table tr td:last-child {
            padding-right: 15px;
        }

        .vsignals-table.table-responsive,
        .vsignals-table.table-responsive table {
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
                                <?php echo trans('verticalsignals.showing-all-vsignals'); ?>

                            </span>

                            <?php if (Auth::check() && Auth::user()->hasRole('atmadmin|atmcollector')): ?>
                            <div class="btn-group pull-right btn-group-xs">
                                <a class="btn btn-primary btn-sm" href="/vertical-signals/create">
                                    <i class="fa fa-fw fa-plus" aria-hidden="true"></i>
                                    <span class="hidden-xs"><?php echo trans('verticalsignals.buttons.create-new'); ?></span>
                                </a>

                                <a href="<?php echo e(URL::to('vertical-signals/export/xlsx')); ?>" class="btn btn-success btn-sm float-right ml-2"
                                   data-toggle="tooltip" data-placement="left"
                                   title="<?php echo e(trans('verticalsignals.buttons.xlsx')); ?>">
                                    <i class="fa fa-fw fa-file-excel-o" aria-hidden="true"></i>
                                    <span class="hidden-xs"><?php echo trans('verticalsignals.buttons.xlsx'); ?></span>
                                </a>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="card-body">

                        <?php if(config('atm_app.enableSearch')): ?>
                            <?php echo $__env->make('partials.search-vsignals-form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endif; ?>

                        <div class="table-responsive vsignals-table">
                            <table class="table table-striped table-sm data-table">
                                <caption id="vsignal_count">
                                    <?php echo e(trans('verticalsignals.vsignals-table.caption', ['vsignalscount' => $vsignals->count(), 'vsignalstotal' => $vsignalstotal])); ?>

                                </caption>
                                <thead class="thead">
                                <tr>
                                    <th><?php echo trans('verticalsignals.vsignals-table.code'); ?></th>
                                    <th><?php echo trans('verticalsignals.vsignals-table.creator'); ?></th>
                                    <th><?php echo trans('verticalsignals.vsignals-table.state'); ?></th>
                                    <th><?php echo trans('verticalsignals.vsignals-table.fastener'); ?></th>
                                    <th><?php echo trans('verticalsignals.vsignals-table.material'); ?></th>
                                    <th><?php echo trans('verticalsignals.vsignals-table.normative'); ?></th>
                                    <th><?php echo trans('verticalsignals.vsignals-table.google_address'); ?></th>
                                    <th><?php echo trans('verticalsignals.vsignals-table.actions'); ?></th>
                                    <th class="no-search no-sort"></th>
                                    <th class="no-search no-sort"></th>
                                </tr>
                                </thead>
                                <tbody id="vsignals_table">
                                <?php $__currentLoopData = $vsignals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vsignal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($vsignal->code); ?></td>
                                        <td><?php echo e($vsignal->user->full_name()); ?></td>
                                        <td><?php echo e($vsignal->state); ?></td>
                                        <td><?php echo e($vsignal->fastener); ?></td>
                                        <td><?php echo e($vsignal->material); ?></td>
                                        <td><?php echo e($vsignal->normative); ?></td>
                                        <td><?php echo e($vsignal->google_address); ?></td>
                                        <td>
                                            <a class="btn btn-sm btn-success btn-block"
                                               href="<?php echo e(URL::to('vertical-signals/' . $vsignal->id)); ?>"
                                               data-toggle="tooltip" title="Show">
                                                <?php echo trans('verticalsignals.buttons.show'); ?>

                                            </a>
                                        </td>
                                        <?php if (Auth::check() && Auth::user()->hasRole('atmadmin|atmcollector')): ?>
                                        <td>
                                            <a class="btn btn-sm btn-info btn-block"
                                               href="<?php echo e(URL::to('vertical-signals/' . $vsignal->id . '/edit')); ?>"
                                               data-toggle="tooltip" title="Edit">
                                                <?php echo trans('verticalsignals.buttons.edit'); ?>

                                            </a>
                                        </td>
                                        <?php endif; ?>
                                        <?php if (Auth::check() && Auth::user()->hasRole('atmadmin')): ?>
                                        <td>
                                            <?php echo Form::open(array('url' => 'vertical-signals/' . $vsignal->id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Delete')); ?>

                                            <?php echo Form::hidden('_method', 'DELETE'); ?>

                                            <?php echo Form::button(trans('verticalsignals.buttons.delete'), array('class' => 'btn btn-danger btn-sm','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Eliminar señal vertical', 'data-message' => '¿Está seguro que desea eliminar esta señal? ¡Eliminará con ella todas sus dependencias!')); ?>

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
                                <?php echo e($vsignals->links()); ?>

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
    <?php if((count($vsignals) > config('atm_app.datatablesJsStartCount')) && config('atm_app.enabledDatatablesJs')): ?>
        <?php echo $__env->make('scripts.datatables', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
    <?php echo $__env->make('scripts.delete-modal-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('scripts.save-modal-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php if(config('atm_app.tooltipsEnabled')): ?>
        <?php echo $__env->make('scripts.tooltips', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
    <?php if(config('atm_app.enableSearch')): ?>
        <?php echo $__env->make('scripts.search-vsignals', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/samuel/Documents/proyectos/Saveme/atm2/nuevo/resources/views/verticalsignals/show-vertical-signals.blade.php ENDPATH**/ ?>