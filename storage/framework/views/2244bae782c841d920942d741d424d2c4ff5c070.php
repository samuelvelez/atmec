<?php $__env->startSection('template_title'); ?>
    <?php echo trans('traffic-poles.showing-all-traffic-poles'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('template_linked_css'); ?>
    <?php if(config('atm_app.enabledDatatablesJs')): ?>
        <link rel="stylesheet" type="text/css" href="<?php echo e(config('atm_app.datatablesCssCDN')); ?>">
    <?php endif; ?>
    <style type="text/css" media="screen">
        .traffic-poles-table {
            border: 0;
        }

        .traffic-poles-table tr td:first-child {
            padding-left: 15px;
        }

        .traffic-poles-table tr td:last-child {
            padding-right: 15px;
        }

        .traffic-poles-table.table-responsive,
        .traffic-poles-table.table-responsive table {
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
                                <?php echo trans('traffic-poles.showing-all-traffic-poles'); ?>

                            </span>

                            <?php if (Auth::check() && Auth::user()->hasRole('atmadmin|atmcollector')): ?>
                            <div class="btn-group pull-right btn-group-xs">
                                <a class="btn btn-primary btn-sm" href="/traffic-poles/create">
                                    <i class="fa fa-fw fa-plus" aria-hidden="true"></i>
                                    <span class="hidden-xs"><?php echo trans('traffic-poles.buttons.create-new'); ?></span>
                                </a>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="card-body">
                        <?php if(config('atm_app.enableSearch')): ?>
                            <?php echo $__env->make('partials.search-traffic-poles-form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endif; ?>

                        <div class="table-responsive traffic-poles-table">
                            <?php echo $__env->make('traffic-poles.traffic-poles-table', [
                                'poles' => $poles,
                                'polestotal' => $polestotal,
                                'actions' => true
                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                            <?php if(config('atm_app.enablePagination')): ?>
                                <?php echo e($poles->links()); ?>

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
    <?php if((count($poles) > config('atm_app.datatablesJsStartCount')) && config('atm_app.enabledDatatablesJs')): ?>
        <?php echo $__env->make('scripts.datatables', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

    <?php echo $__env->make('scripts.delete-modal-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('scripts.save-modal-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php if(config('atm_app.tooltipsEnabled')): ?>
        <?php echo $__env->make('scripts.tooltips', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

    <?php if(config('atm_app.enableSearch')): ?>
        <?php echo $__env->make('scripts.search-traffic-poles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/atmdeveqadoor/resources/views/traffic-poles/show-traffic-poles.blade.php ENDPATH**/ ?>