<?php $__env->startSection('template_title'); ?>
    <?php echo trans('traffic-lights.showing-all-traffic-lights'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('template_linked_css'); ?>
    <?php if(config('atm_app.enabledDatatablesJs')): ?>
        <link rel="stylesheet" type="text/css" href="<?php echo e(config('atm_app.datatablesCssCDN')); ?>">
    <?php endif; ?>
    <style type="text/css" media="screen">
        .traffic-lights-table {
            border: 0;
        }

        .traffic-lights-table tr td:first-child {
            padding-left: 15px;
        }

        .traffic-lights-table tr td:last-child {
            padding-right: 15px;
        }

        .traffic-lights-table.table-responsive,
        .traffic-lights-table.table-responsive table {
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
                                <?php echo trans('traffic-lights.showing-all-traffic-lights'); ?>

                            </span>

                            <?php if (Auth::check() && Auth::user()->hasRole('atmadmin|atmcollector')): ?>
                            <div class="btn-group pull-right btn-group-xs">
                                <a class="btn btn-primary btn-sm" href="/traffic-lights/create">
                                    <i class="fa fa-fw fa-plus" aria-hidden="true"></i>
                                    <span class="hidden-xs"><?php echo trans('traffic-lights.buttons.create-new'); ?></span>
                                </a>

                                <a href="<?php echo e(URL::to('traffic-lights/export/xlsx')); ?>" class="btn btn-success btn-sm float-right ml-2"
                                   data-toggle="tooltip" data-placement="left"
                                   title="<?php echo e(trans('traffic-lights.buttons.xlsx')); ?>">
                                    <i class="fa fa-fw fa-file-excel-o" aria-hidden="true"></i>
                                    <span class="hidden-xs"><?php echo trans('traffic-lights.buttons.xlsx'); ?></span>
                                </a>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="card-body">
                        <?php if(config('atm_app.enableSearch')): ?>
                            <?php echo $__env->make('partials.search-traffic-lights-form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endif; ?>

                        <div class="table-responsive traffic-lights-table">
                            <?php echo $__env->make('traffic-lights.traffic-lights-table', [
                                'lights' => $lights,
                                'lightstotal' => $lightstotal,
                                'actions' => true
                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                            <?php if(config('atm_app.enablePagination')): ?>
                                <?php echo e($lights->links()); ?>

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
    <?php if((count($lights) > config('atm_app.datatablesJsStartCount')) && config('atm_app.enabledDatatablesJs')): ?>
        <?php echo $__env->make('scripts.datatables', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

    <?php echo $__env->make('scripts.delete-modal-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('scripts.save-modal-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php if(config('atm_app.tooltipsEnabled')): ?>
        <?php echo $__env->make('scripts.tooltips', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

    <?php if(config('atm_app.enableSearch')): ?>
        <?php echo $__env->make('scripts.search-traffic-lights', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/atmdeveqadoor/resources/views/traffic-lights/show-traffic-lights.blade.php ENDPATH**/ ?>