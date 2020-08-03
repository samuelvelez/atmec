

<?php $__env->startSection('template_title'); ?>
    <?php echo trans('georeports.signal-totals.title'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('template_linked_css'); ?>
    <?php if(config('atm_app.enabledDatatablesJs')): ?>
        <link rel="stylesheet" type="text/css" href="<?php echo e(config('atm_app.datatablesCssCDN')); ?>">
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('template_fastload_css'); ?>
    .totals-table {
    border: 0;
    }

    .totals-table tr td:first-child {
    padding-left: 15px;
    }

    .totals-table tr td:last-child {
    padding-right: 15px;
    }

    .totals-table.table-responsive,
    .totals-table.table-responsive table {
    margin-bottom: 0;
    }
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <strong><?php echo trans('georeports.signal-totals.title'); ?></strong>
                            <div class="float-right">
                                <?php echo Form::open(array('url' => '/georeports/signal-totals-excel/')); ?>

                                <?php echo Form::button('<i class="fa fa-fw fa-file-excel-o"></i> Exportar', array('id' => 'excel-export', 'class' => 'btn btn-success btn-sm float-right mr-1','type' => 'submit')); ?>

                                <?php echo Form::close(); ?>

                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="table-responsive totals-table">
                                <?php echo $__env->make('georeports.tables.signals-totals-table', [$state_totals, $material_totals, $type_totals, $signal_total, 'logo' => asset('/images/atm.png') ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/atmeccom/resources/views/georeports/signal-totals.blade.php ENDPATH**/ ?>