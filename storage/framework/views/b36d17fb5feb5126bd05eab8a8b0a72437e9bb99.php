

<?php $__env->startSection('template_title'); ?>
    <?php echo trans('regulator-devices.create-new-regulator-device'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('template_linked_css'); ?>
    <?php if(config('atm_app.enabledSelectizeJs')): ?>
        <link rel="stylesheet" type="text/css" href="<?php echo e(config('atm_app.selectizeCssCDN')); ?>">
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <?php echo trans('regulator-devices.create-new-regulator-device'); ?>

                            <div class="pull-right">
                                <a href="<?php echo e(route('regulator-devices.index')); ?>"
                                   class="btn btn-light btn-sm float-right"
                                   data-toggle="tooltip" data-placement="left"
                                   title="<?php echo e(trans('regulator-devices.tooltips.back-regulator-devices')); ?>">
                                    <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                    <?php echo trans('regulator-devices.buttons.back-to-regulator-devices'); ?>

                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <?php echo Form::open(array('route' => 'regulator-devices.store', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation')); ?>


                        <?php echo csrf_field(); ?>


                        <div class="form-group has-feedback row <?php echo e($errors->has('code') ? ' has-error ' : ''); ?>">
                            <?php echo Form::label('code', trans('forms.create_regulator_device_label_code'), array('class' => 'col-md-3 control-label'));; ?>

                            <div class="col-md-9">
                                <div class="input-group">
                                    <?php echo Form::text('code', NULL, array('id' => 'code', 'class' => 'form-control', 'placeholder' => trans('forms.create_regulator_device_ph_code'))); ?>

                                    <div class="input-group-append">
                                        <label for="code" class="input-group-text">
                                            <i class="fa fa-fw <?php echo e(trans('forms.create_regulator_device_icon_code')); ?>"
                                               aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                <?php if($errors->has('code')): ?>
                                    <span class="help-block">
                                            <strong><?php echo e($errors->first('code')); ?></strong>
                                        </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group has-feedback row <?php echo e($errors->has('erp_code') ? ' has-error ' : ''); ?>">
                            <?php echo Form::label('erp_code', trans('forms.create_regulator_device_label_erp_code'), array('class' => 'col-md-3 control-label'));; ?>

                            <div class="col-md-9">
                                <div class="input-group">
                                    <?php echo Form::text('erp_code', NULL, array('id' => 'erp_code', 'class' => 'form-control', 'placeholder' => trans('forms.create_regulator_device_ph_erp_code'))); ?>

                                    <div class="input-group-append">
                                        <label for="erp_code" class="input-group-text">
                                            <i class="fa fa-fw <?php echo e(trans('forms.create_regulator_device_icon_erp_code')); ?>"
                                               aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                <?php if($errors->has('erp_code')): ?>
                                    <span class="help-block">
                                            <strong><?php echo e($errors->first('erp_code')); ?></strong>
                                        </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group has-feedback row <?php echo e($errors->has('regulator') ? ' has-error ' : ''); ?>">
                            <?php echo Form::label('regulator', trans('forms.create_regulator_device_label_regulator'), array('class' => 'col-md-3 control-label'));; ?>

                            <div class="col-md-9">
                                <div class="form-group">
                                    <select name="regulator" id="regulator">
                                        <option value=""><?php echo e(trans('forms.create_regulator_device_ph_regulator')); ?></option>
                                        <?php if($regulators): ?>
                                            <?php $__currentLoopData = $regulators; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $regulator): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($regulator->id); ?>" <?php echo e(old('regulator') == $regulator->id ? 'selected' : ''); ?>><?php echo e($regulator->id); ?>

                                                    | <?php echo e($regulator->brand); ?> | <?php echo e($regulator->intersection->main_st); ?>

                                                    y <?php echo e($regulator->intersection->cross_st); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group has-feedback row <?php echo e($errors->has('type') ? ' has-error ' : ''); ?>">
                            <?php echo Form::label('type', trans('forms.create_regulator_device_label_type'), array('class' => 'col-md-3 control-label'));; ?>

                            <div class="col-md-9">
                                <div class="form-group">
                                    <select name="type" id="type">
                                        <option value=""><?php echo e(trans('forms.create_regulator_device_ph_type')); ?></option>
                                        <option value="ups_brands">UPS</option>
                                        <option value="travel_brands">Tiempo de viaje</option>
                                        <option value="energy_brands">Fuente de poder</option>
                                        <option value="mmu_brands">MMU</option>
                                        <option value="controller_brands">Controlador (cerebro)</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group has-feedback row <?php echo e($errors->has('brand') ? ' has-error ' : ''); ?>">
                            <?php echo Form::label('brand', trans('forms.create_regulator_device_label_brand'), array('class' => 'col-md-3 control-label'));; ?>

                            <div class="col-md-9">
                                <div class="form-group">
                                    <select name="brand" id="brand">
                                        <option value=""><?php echo e(trans('forms.create_regulator_device_ph_brand')); ?></option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group has-feedback row <?php echo e($errors->has('model') ? ' has-error ' : ''); ?>">
                            <?php echo Form::label('model', trans('forms.create_regulator_device_label_model'), array('class' => 'col-md-3 control-label'));; ?>

                            <div class="col-md-9">
                                <div class="input-group">
                                    <?php echo Form::text('model', NULL, array('id' => 'model', 'class' => 'form-control', 'placeholder' => trans('forms.create_regulator_device_ph_model'))); ?>

                                    <div class="input-group-append">
                                        <label for="model" class="input-group-text">
                                            <i class="fa fa-fw <?php echo e(trans('forms.create_regulator_device_icon_model')); ?>"
                                               aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                <?php if($errors->has('model')): ?>
                                    <span class="help-block">
                                            <strong><?php echo e($errors->first('model')); ?></strong>
                                        </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group has-feedback row <?php echo e($errors->has('state') ? ' has-error ' : ''); ?>">
                            <?php echo Form::label('state', trans('forms.create_regulator_device_label_state'), array('class' => 'col-md-3 control-label'));; ?>

                            <div class="col-md-9">
                                <div class="form-group">
                                    <select name="state" id="state">
                                        <option value=""><?php echo e(trans('forms.create_regulator_device_ph_state')); ?></option>
                                        <?php if($states): ?>
                                            <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($value); ?>" <?php echo e(old('state') == $value ? 'selected' : ''); ?>><?php echo e($value); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group has-feedback row <?php echo e($errors->has('comment') ? ' has-error ' : ''); ?>">
                            <?php echo Form::label('comment', trans('forms.create_regulator_device_label_comment'), array('class' => 'col-md-3 control-label'));; ?>

                            <div class="col-md-9">
                                <div class="input-group">
                                    <?php echo Form::textarea('comment', NULL, array('id' => 'comment', 'rows' => '3', 'class' => 'form-control', 'placeholder' => trans('forms.create_regulator_device_ph_comment'))); ?>

                                    <div class="input-group-append">
                                        <label class="input-group-text" for="comment">
                                            <i class="fa fa-fw <?php echo e(trans('forms.create_regulator_device_icon_comment')); ?>"
                                               aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                <?php if($errors->has('comment')): ?>
                                    <span class="help-block">
                                            <strong><?php echo e($errors->first('comment')); ?></strong>
                                        </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <?php echo Form::button(trans('forms.create_regulator_device_button_text'), array('class' => 'btn btn-success margin-bottom-1 mb-1 float-right','type' => 'submit' )); ?>

                        <?php echo Form::close(); ?>

                    </div>

                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
    <script type="text/javascript" src="<?php echo e(config('atm_app.selectizeJsCDN')); ?>"></script>

    <script type="text/javascript">
        $(function () {
            set_selectize_options = function (selectize, options) {
                selectize.disable();
                selectize.clear();
                selectize.clearOptions();
                selectize.renderCache['option'] = {};
                selectize.renderCache['item'] = {};
                selectize.addOption(options);
                selectize.enable();
            };

            $("#type").selectize({
                allowClear: true,
                create: false,
                highlight: true,
                diacritics: true,
                onChange: function (value) {
                    if (!value.length) return;
                    let brands = $("#brand")[0].selectize;
                    brands.disable();
                    brands.clearOptions();
                    brands.load(function(query, callback) {
                        var xhr;
                        xhr && xhr.abort();
                        xhr = $.ajax({
                            url: '<?php echo e(route('brands-by-type')); ?>',
                            data: {type: value},
                            dataType: "json",
                            success: function(results) {
                                brands.addOption(results);
                                brands.enable();
                                callback(results);
                            },
                            error: function() {
                                callback();
                            }
                        })
                    });
                },
            });

            $("#brand").selectize({
                allowClear: true,
                create: false,
                highlight: true,
                selectOnTab: true,
                valueField: 'brand',
                labelField: 'brand',
                searchField: ['brand'],
                render: {
                    option: function (item, escape) {
                        return '<div>'
                            + '<span>' + escape(item.brand) + '</span>'
                            + '</div>';
                    },
                    item: function (item, escape) {
                        return '<div>'
                            + '<span>' + escape(item.brand) + '</span>'
                            + '</div>';
                    }
                }
            });

            $("#regulator").selectize({
                allowClear: true,
                create: false,
                highlight: true,
                diacritics: true
            });

            $("#state").selectize({
                allowClear: true,
                create: false,
                highlight: true,
                diacritics: true
            });

            $("#brand")[0].selectize.disable();
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/atmeccom/resources/views/regulator-devices/create-regulator-device.blade.php ENDPATH**/ ?>