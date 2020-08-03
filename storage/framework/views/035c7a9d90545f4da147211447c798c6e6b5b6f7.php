<?php $__env->startSection('template_title'); ?>
    <?php echo trans('georeports.geolocation.title'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('template_linked_css'); ?>
    <?php if(config('atm_app.enabledSelectizeJs')): ?>
        <link rel="stylesheet" type="text/css" href="<?php echo e(config('atm_app.selectizeCssCDN')); ?>">
    <?php endif; ?>

    <?php if(config('atm_app.enabledDatatablesJs')): ?>
        <link rel="stylesheet" type="text/css" href="<?php echo e(config('atm_app.datatablesCssCDN')); ?>">
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('template_fastload_css'); ?>
    #map-canvas{
    min-height: 700px;
    height: 100%;
    width: 100%;
    }

    .picture-preview {
    height: 200px;
    width: auto;
    }

    .gm-style-iw {
    width: 600px;
    }

    .card-horizontal {
    display: flex;
    flex: 1 1 auto;
    }

    .result-table {
    border: 0;
    }

    .result-table tr td:first-child {
    padding-left: 15px;
    }

    .result-table tr td:last-child {
    padding-right: 15px;
    }

    .result-table caption {
        caption-side: top;
        font-size: 20px;
        line-height: 26px;
        color: #007ab0;
        text-transform: uppercase;
    }

    .result-table.table-responsive,
    .result-table.table-responsive table {
    margin-bottom: 0;
    }

    .modal-picture{
        background-repeat: no-repeat;
        background-position: center center;
        background-size: cover;
        min-height: 300px;
    }

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                <strong><?php echo trans('georeports.geolocation.filters'); ?></strong>
                            </span>
                        </div>
                    </div>

                    <div class="card-body">
                        <?php echo $__env->make('georeports.filters.geo-filter', [
                            'inventories' => $sinventories,
                            'states' => $states,
                            'materials' => $materials,
                            'l_fasteners' => $l_fasteners,
                            's_fasteners' => $s_fasteners,
                            'all_st' => $all_vst,
                            'ligth_brands' => $ligth_brands
                        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">

                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                <strong>Georeferenciación</strong>
                            </span>

                            <div class="btn-group pull-right btn-group-xs">
                                <?php echo Form::open(array('id' => 'excel-form', 'url' => '/georeports/signals-excel/')); ?>

                                <?php echo Form::hidden('excel_criteria', null, array('id' => 'excel_criteria')); ?>

                                <?php echo Form::hidden("_method", "POST"); ?>

                                <?php echo Form::button('<i class="fa fa-fw fa-file-excel-o"></i> <span class="hidden-xs">Exportar tabla a Excel</span>', array('disabled' => true, 'id' => 'excel-export', 'class' => 'btn btn-success btn-sm float-right mr-2','type' => 'submit')); ?>

                                <?php echo Form::close(); ?>

                                <button disabled  title="Guarda PDF" id="save-image-btn" class="btn btn-sm btn-danger float-right"><i class="fa fa-fw fa-file-pdf-o"></i> <span class="hidden-xs" id="pdf_label">Exportar mapa a PDF</span></button>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div id="map-canvas">
                                Sin acceso al servicio de mapas de Google.
                            </div>
                        </div>
                        <hr/>

                        <div class="row">
                            <div class="table-responsive result-table">
                                <?php echo $__env->make('georeports.tables.geo-table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php echo $__env->make('modals.modal-vsignal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>;
    <?php echo $__env->make('modals.modal-light', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>;
    <?php echo $__env->make('modals.modal-regulator', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>;

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
    <script type="text/javascript" src="<?php echo e(config('atm_app.selectizeJsCDN')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(config('atm_app.html2canvasJsCdn')); ?>"></script>

    <script type="text/javascript">
        $(function() {
            $("#l_street").selectize({
                allowClear: true,
                create: false,
                highlight: true,
                diacritics: true
            });

            $("#s_street").selectize({
                allowClear: true,
                create: false,
                highlight: true,
                diacritics: true
            });

            $("#r_street").selectize({
                allowClear: true,
                create: false,
                highlight: true,
                diacritics: true
            });

            $("#l_type").selectize({
                allowClear: true,
                create: false,
                highlight: true,
                diacritics: true
            });

            $("#s_type").selectize({
                allowClear: true,
                create: false,
                highlight: true,
                diacritics: true
            });

            $("#l_state").selectize({
                allowClear: true,
                create: false,
                highlight: true,
                diacritics: true
            });

            $("#s_state").selectize({
                allowClear: true,
                create: false,
                highlight: true,
                diacritics: true
            });

            $("#r_state").selectize({
                allowClear: true,
                create: false,
                highlight: true,
                diacritics: true
            });

            $("#s_material").selectize({
                allowClear: true,
                create: false,
                highlight: true,
                diacritics: true
            });

            $("#l_fastener").selectize({
                allowClear: true,
                create: false,
                highlight: true,
                diacritics: true
            });

            $("#s_fastener").selectize({
                allowClear: true,
                create: false,
                highlight: true,
                diacritics: true
            });

            $("#l_brand").selectize({
                allowClear: true,
                create: false,
                highlight: true,
                diacritics: true
            });

            $("#r_brand").selectize({
                allowClear: true,
                create: false,
                highlight: true,
                diacritics: true
            });
        });
    </script>

    <?php echo $__env->make('scripts.google-maps-signal-reports', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('scripts.filter-geolocation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('scripts.google-maps-save-pdf', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/atmdeveqadoor/resources/views/georeports/geolocation.blade.php ENDPATH**/ ?>