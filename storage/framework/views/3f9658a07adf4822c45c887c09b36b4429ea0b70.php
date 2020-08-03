<?php $__env->startSection('template_title'); ?>
    <?php echo trans('alerts.create-new-alert'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('template_linked_css'); ?>
    <?php if(config('atm_app.enabledSelectizeJs')): ?>
        <link rel="stylesheet" type="text/css" href="<?php echo e(config('atm_app.selectizeCssCDN')); ?>">
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('template_fastload_css'); ?>
    #map-canvas{
    min-height: 300px;
    height: 100%;
    width: 100%;
    }
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <?php echo trans('alerts.create-new-alert'); ?>

                            <div class="pull-right">
                                <a href="<?php echo e(route('alerts.index')); ?>" class="btn btn-light btn-sm float-right"
                                   data-toggle="tooltip" data-placement="left"
                                   title="<?php echo e(trans('alerts.tooltips.back-alerts')); ?>">
                                    <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                    <?php echo trans('alerts.buttons.back-to-alerts'); ?>

                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <?php echo Form::open(array('route' => 'alerts.store', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation')); ?>


                        <?php echo csrf_field(); ?>


                        <div class="row">
                            <div class="col-md-12">
                                <div id="map-canvas"></div>
                            </div>
                        </div>

                        <br>

                        <div class="row">
                            <?php echo Form::label('Intersección', trans('alerts.create_label_intersection'), array('class' => 'col-md-3 control-label'));; ?>

                            <div class="col-md-9">
                                <div class="form-group">
                                    <select id="intersection" name="intersection">
                                        <option value="">Seleccione una intersección</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <div class="form-group has-feedback row <?php echo e($errors->has('latitude') ? ' has-error ' : ''); ?>">
                            <?php echo Form::label('latitude', trans('forms.create_vsignal_label_latitude'), array('class' => 'col-md-3 control-label'));; ?>

                            <div class="col-md-9">
                                <div class="input-group">
                                    <?php echo Form::text('latitude', NULL, array('id' => 'latitude', 'class' => 'form-control', 'readonly' => 'readonly', 'placeholder' => trans('forms.create_vsignal_ph_latitude'))); ?>

                                </div>
                                <?php if($errors->has('latitude')): ?>
                                    <span class="help-block">
                                            <strong><?php echo e($errors->first('latitude')); ?></strong>
                                        </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group has-feedback row <?php echo e($errors->has('longitude') ? ' has-error ' : ''); ?>">
                            <?php echo Form::label('longitude', trans('forms.create_vsignal_label_longitude'), array('class' => 'col-md-3 control-label'));; ?>

                            <div class="col-md-9">
                                <div class="input-group">
                                    <?php echo Form::text('longitude', NULL, array('id' => 'longitude', 'class' => 'form-control', 'readonly' => 'readonly', 'placeholder' => trans('forms.create_vsignal_ph_longitude'))); ?>

                                </div>
                                <?php if($errors->has('longitude')): ?>
                                    <span class="help-block">
                                            <strong><?php echo e($errors->first('longitude')); ?></strong>
                                        </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group has-feedback row <?php echo e($errors->has('google_address') ? ' has-error ' : ''); ?>">
                            <?php echo Form::label('google_address', trans('forms.create_vsignal_label_gaddress'), array('class' => 'col-md-3 control-label'));; ?>

                            <div class="col-md-9">
                                <div class="input-group">
                                    <?php echo Form::text('google_address', NULL, array('id' => 'google_address', 'class' => 'form-control', 'readonly' => 'readonly', 'placeholder' => trans('forms.create_vsignal_ph_gaddress'))); ?>

                                </div>
                                <?php if($errors->has('google_address')): ?>
                                    <span class="help-block">
                                            <strong><?php echo e($errors->first('google_address')); ?></strong>
                                        </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <?php if (Auth::check() && Auth::user()->hasRole('atmoperator')): ?>
                        <div class="form-group has-feedback row <?php echo e($errors->has('collector') ? ' has-error ' : ''); ?>">
                            <?php echo Form::label('collector', 'Escalera', array('class' => 'col-md-3 control-label'));; ?>

                            <div class="col-md-9">
                                <div class="form-group">
                                    <select name="collector" id="collector">
                                        <option value="">Seleccione una escalera</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>

                        <div class="form-group has-feedback row <?php echo e($errors->has('description') ? ' has-error ' : ''); ?>">
                            <?php echo Form::label('description', trans('alerts.create_label_description'), array('class' => 'col-md-3 control-label'));; ?>

                            <div class="col-md-9">
                                <div class="input-group">
                                    <?php echo Form::textarea('description', NULL, array('id' => 'description', 'rows' => '3', 'class' => 'form-control', 'placeholder' => trans('alerts.create_ph_description'))); ?>

                                </div>
                                <?php if($errors->has('description')): ?>
                                    <span class="help-block">
                                            <strong><?php echo e($errors->first('description')); ?></strong>
                                        </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <?php echo Form::button(trans('alerts.create_button_text'), array('class' => 'btn btn-success margin-bottom-1 mb-1 float-right','type' => 'submit' )); ?>

                        <?php echo Form::close(); ?>

                    </div>

                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
    <script type="text/javascript" src="<?php echo e(config('atm_app.selectizeJsCDN')); ?>"></script>

    <script>
        $(document).ready(function () {
        <?php if (Auth::check() && Auth::user()->hasRole('atmoperator')): ?>
            $("#collector").selectize({
                allowClear: true,
                create: false,
                highlight: true,
                diacritics: true,
                options: <?php echo json_encode($collectors); ?>,
                valueField: 'id',
                labelField: ['email'],
                searchField: ['id', 'name', 'email'],
                render: {
                    option: function (item, escape) {
                        return '<div>'
                            + '<span>' + escape(item.name) + ' (' + escape(item.email) + ')</span>'
                            + '</div>';
                    },
                    item: function (item, escape) {
                        return '<div>'
                            + '<span>' + escape(item.name) + ' (' + escape(item.email) + ')</span>'
                            + '</div>';
                    }
                },
            });
        <?php endif; ?>

            $("#intersection").selectize({
                allowClear: true,
                create: false,
                highlight: true,
                diacritics: true,
                onChange: function (value) {
                    if (value != '') {
                        lat = this.options[value].latitude;
                        lng = this.options[value].longitude;

                        if (lat == '' || lat == null) {
                            lat = <?php echo e(env('APP_DEFAULT_LAT')); ?>;
                            lng = <?php echo e(env('APP_DEFAULT_LNG')); ?>;
                        }

                        show_location(lat, lng);
                    }
                },
                options: <?php echo json_encode($intersections); ?>,
                valueField: 'id',
                labelField: ['main_st', 'cross_st'],
                searchField: ['main_st', 'cross_st'],
                render: {
                    option: function (item, escape) {
                        return '<div>'
                            + '<span>' + escape(item.main_st) + ' / ' + escape(item.cross_st) + '</span>'
                            + '</div>';
                    },
                    item: function (item, escape) {
                        return '<div>'
                            + '<span>' + escape(item.main_st) + ' / ' + escape(item.cross_st) + '</span>'
                            + '</div>';
                    }
                },
            });
        });
    </script>

    <?php if(config('settings.googleMapsAPIStatus')): ?>
        <?php echo $__env->make('scripts.show-alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/atmdeveqadoor/resources/views/alerts/create.blade.php ENDPATH**/ ?>