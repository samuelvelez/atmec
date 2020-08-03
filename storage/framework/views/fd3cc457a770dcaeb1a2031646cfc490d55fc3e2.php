

<?php $__env->startSection('template_title'); ?>
    <?php echo trans('traffic-lights.editing-traffic-light', ['id' => $traffic_light->id]); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('template_linked_css'); ?>
    <?php if(config('atm_app.enabledSelectizeJs')): ?>
        <link rel="stylesheet" type="text/css" href="<?php echo e(config('atm_app.selectizeCssCDN')); ?>">
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('template_fastload_css'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <?php echo trans('traffic-lights.editing-traffic-light', ['id' => $traffic_light->id]); ?>

                            <div class="pull-right">
                                <a href="<?php echo e(route('traffic-lights.index')); ?>"
                                   class="btn btn-light btn-sm float-right"
                                   data-toggle="tooltip" data-placement="top"
                                   title="<?php echo e(trans('traffic-lights.tooltips.back-to-traffic-lights')); ?>">
                                    <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                    <?php echo trans('traffic-lights.buttons.back-to-traffic-lights'); ?>

                                </a>
                                <a href="<?php echo e(url('/traffic-lights/' . $traffic_light->id)); ?>"
                                   class="btn btn-light btn-sm float-right"
                                   data-toggle="tooltip" data-placement="left"
                                   title="<?php echo e(trans('traffic-lights.tooltips.back-to-traffic-lights')); ?>">
                                    <i class="fa fa-fw fa-reply" aria-hidden="true"></i>
                                    <?php echo trans('traffic-lights.buttons.back-to-traffic-lights'); ?>

                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <?php echo Form::open(array('route' => ['traffic-lights.update', $traffic_light->id], 'method' => 'PUT', 'role' => 'form', 'class' => 'needs-validation', 'files' => true)); ?>


                        <?php echo csrf_field(); ?>


                        <div class="form-group has-feedback row <?php echo e($errors->has('code') ? ' has-error ' : ''); ?>">
                            <?php echo Form::label('code', trans('forms.create_traffic_light_label_code'), array('class' => 'col-md-3 control-label'));; ?>

                            <div class="col-md-9">
                                <div class="input-group">
                                    <?php echo Form::text('code', $traffic_light->code, array('id' => 'code', 'readonly' => true, 'class' => 'form-control', 'placeholder' => trans('forms.create_traffic_light_ph_code'))); ?>

                                    <div class="input-group-append">
                                        <label for="code" class="input-group-text">
                                            <i class="fa fa-fw <?php echo e(trans('forms.create_traffic_light_icon_code')); ?>"
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
                            <?php echo Form::label('erp_code', trans('forms.create_traffic_light_label_erp_code'), array('class' => 'col-md-3 control-label'));; ?>

                            <div class="col-md-9">
                                <div class="input-group">
                                    <?php echo Form::text('erp_code', $traffic_light->erp_code, array('id' => 'erp_code', 'class' => 'form-control', 'placeholder' => trans('forms.create_traffic_light_ph_erp_code'))); ?>

                                    <div class="input-group-append">
                                        <label for="erp_code" class="input-group-text">
                                            <i class="fa fa-fw <?php echo e(trans('forms.create_traffic_light_icon_erp_code')); ?>"
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

                        <div class="form-group has-feedback row <?php echo e($errors->has('light_type') ? ' has-error ' : ''); ?>">
                            <?php echo Form::label('light_type', trans('forms.create_traffic_light_label_light_type'), array('class' => 'col-md-3 control-label'));; ?>

                            <div class="col-md-9">
                                <div class="form-group">
                                    <select name="light_type" id="light_type">
                                        <option value=""><?php echo e(trans('forms.create_traffic_light_ph_light_type')); ?></option>
                                        <?php if($light_types): ?>
                                            <?php $__currentLoopData = $light_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($type->id); ?>" <?php echo e($traffic_light->type_id == $type->id ? 'selected' : ''); ?>><?php echo e($type->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group has-feedback row <?php echo e($errors->has('fastener') ? ' has-error ' : ''); ?>">
                            <?php echo Form::label('fastener', trans('forms.create_traffic_light_label_fastener'), array('class' => 'col-md-3 control-label'));; ?>

                            <div class="col-md-9">
                                <div class="form-group">
                                    <select name="fastener" id="fastener">
                                        <option value=""><?php echo e(trans('forms.create_traffic_light_ph_fastener')); ?></option>
                                        <?php if($fasteners): ?>
                                            <?php $__currentLoopData = $fasteners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($value); ?>" <?php echo e(old('fastener') == $value ? 'selected' : ''); ?>><?php echo e($value); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group has-feedback row <?php echo e($errors->has('state') ? ' has-error ' : ''); ?>">
                            <?php echo Form::label('state', trans('forms.create_traffic_light_label_state'), array('class' => 'col-md-3 control-label'));; ?>

                            <div class="col-md-9">
                                <div class="form-group">
                                    <select name="state" id="state">
                                        <option value=""><?php echo e(trans('forms.create_traffic_light_ph_state')); ?></option>
                                        <?php if($states): ?>
                                            <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($value); ?>" <?php echo e($traffic_light->state == $value ? 'selected' : ''); ?>><?php echo e($value); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group has-feedback row <?php echo e($errors->has('brand') ? ' has-error ' : ''); ?>">
                            <?php echo Form::label('brand', trans('forms.create_traffic_light_label_brand'), array('class' => 'col-md-3 control-label'));; ?>

                            <div class="col-md-9">
                                <div class="form-group">
                                    <select name="brand" id="brand">
                                        <option value=""><?php echo e(trans('forms.create_traffic_light_ph_brand')); ?></option>
                                        <?php if($brands): ?>
                                            <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($value); ?>" <?php echo e($traffic_light->brand == $value ? 'selected' : ''); ?>><?php echo e($value); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group has-feedback row <?php echo e($errors->has('model') ? ' has-error ' : ''); ?>">
                            <?php echo Form::label('model', trans('forms.create_traffic_light_label_model'), array('class' => 'col-md-3 control-label'));; ?>

                            <div class="col-md-9">
                                <div class="input-group">
                                    <?php echo Form::text('model', $traffic_light->model, array('id' => 'model', 'class' => 'form-control', 'placeholder' => trans('forms.create_traffic_light_ph_model'))); ?>

                                    <div class="input-group-append">
                                        <label for="model" class="input-group-text">
                                            <i class="fa fa-fw <?php echo e(trans('forms.create_traffic_light_icon_model')); ?>"
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

                        <div class="form-group has-feedback row <?php echo e($errors->has('orientation') ? ' has-error ' : ''); ?>">
                            <?php echo Form::label('orientation', trans('forms.create_traffic_light_label_orientation'), array('class' => 'col-md-3 control-label'));; ?>

                            <div class="col-md-9">
                                <div class="form-group">
                                    <select name="orientation" id="orientation">
                                        <option value=""><?php echo e(trans('forms.create_traffic_light_ph_orientation')); ?></option>
                                        <?php if($orientations): ?>
                                            <?php $__currentLoopData = $orientations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($value); ?>" <?php echo e($traffic_light->orientation == $value ? 'selected' : ''); ?>><?php echo e($value); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group has-feedback row <?php echo e($errors->has('intersection') ? ' has-error ' : ''); ?>">
                            <?php echo Form::label('intersection', trans('forms.create_traffic_light_label_intersection'), array('class' => 'col-md-3 control-label'));; ?>

                            <div class="col-md-9">
                                <div class="form-group">
                                    <select name="intersection" id="intersection">
                                        <option value=""><?php echo e(trans('forms.create_traffic_light_ph_intersection')); ?></option>
                                        <?php if($intersections): ?>
                                            <?php $__currentLoopData = $intersections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $intersection): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($intersection->id); ?>" <?php echo e($traffic_light->intersection_id == $intersection->id ? 'selected' : ''); ?>><?php echo e($intersection->main_st); ?> y <?php echo e($intersection->cross_st); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group has-feedback row <?php echo e($errors->has('regulator') ? ' has-error ' : ''); ?>">
                            <?php echo Form::label('regulator', trans('forms.create_traffic_light_label_regulator'), array('class' => 'col-md-3 control-label'));; ?>

                            <div class="col-md-9">
                                <div class="form-group">
                                    <select name="regulator" id="regulator">
                                        <option value=""><?php echo e(trans('forms.create_traffic_light_ph_regulator')); ?></option>
                                        <?php if($traffic_regulators): ?>
                                            <?php $__currentLoopData = $traffic_regulators; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $traffic_regulator): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($traffic_regulator->id); ?>" <?php echo e($traffic_light->regulator_id == $traffic_regulator->id ? 'selected' : ''); ?>><?php echo e($traffic_regulator->code); ?> - <?php echo e($traffic_regulator->brand); ?> | <?php echo e($traffic_regulator->intersection->main_st); ?> y <?php echo e($traffic_regulator->intersection->cross_st); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group has-feedback row <?php echo e($errors->has('pole') ? ' has-error ' : ''); ?>">
                            <?php echo Form::label('pole', trans('forms.create_traffic_light_label_pole'), array('class' => 'col-md-3 control-label'));; ?>

                            <div class="col-md-9">
                                <div class="form-group">
                                    <select name="pole" id="pole">
                                        <option value=""><?php echo e(trans('forms.create_traffic_light_ph_pole')); ?></option>
                                        <?php if($traffic_poles): ?>
                                            <?php $__currentLoopData = $traffic_poles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $traffic_pole): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($traffic_pole->id); ?>" <?php echo e($traffic_light->pole_id == $traffic_pole->id ? 'selected' : ''); ?>><?php echo e($traffic_pole->code); ?> | <?php echo e($traffic_pole->intersection->main_st); ?> y <?php echo e($traffic_pole->intersection->cross_st); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group has-feedback row <?php echo e($errors->has('tensor') ? ' has-error ' : ''); ?>">
                            <?php echo Form::label('tensor', trans('forms.create_traffic_light_label_tensor'), array('class' => 'col-md-3 control-label'));; ?>

                            <div class="col-md-9">
                                <div class="form-group">
                                    <select name="tensor" id="tensor">
                                        <option value=""><?php echo e(trans('forms.create_traffic_light_ph_tensor')); ?></option>
                                        <?php if($traffic_tensors): ?>
                                            <?php $__currentLoopData = $traffic_tensors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tensor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($tensor->id); ?>" <?php echo e($traffic_light->tensor_id == $tensor->id ? 'selected' : ''); ?>><?php echo e($tensor->id); ?> | <?php echo e($tensor->intersection()->main_st); ?> y <?php echo e($tensor->intersection()->cross_st); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group has-feedback row <?php echo e($errors->has('picture_data') ? ' has-error ' : ''); ?>">
                            <?php echo Form::label('picture', trans('forms.create_vsignal_label_picture'), array('class' => 'col-md-3 control-label'));; ?>

                            <div class="col-md-9">
                                <div class="input-group">
                                    <?php echo Form::file('picture', array('id' => 'picture', 'placeholder' => trans('forms.create_vsignal_ph_picture'))); ?>

                                    <?php echo Form::hidden("picture_data", null, array('id' => 'picture_data')); ?>

                                    <div class="input-group-append">
                                        <label class="input-group-text" for="picture">
                                            <i class="fa fa-fw <?php echo e(trans('forms.create_vsignal_icon_picture')); ?>"
                                               aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                <?php if($errors->has('picture_data')): ?>
                                    <span class="help-block">
                                            <strong><?php echo e($errors->first('picture_data')); ?></strong>
                                        </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group has-feedback row <?php echo e($errors->has('comment') ? ' has-error ' : ''); ?>">
                            <?php echo Form::label('comment', trans('forms.create_traffic_light_label_comment'), array('class' => 'col-md-3 control-label'));; ?>

                            <div class="col-md-9">
                                <div class="input-group">
                                    <?php echo Form::textarea('comment', $traffic_light->comment, array('id' => 'comment', 'rows' => '3', 'class' => 'form-control', 'placeholder' => trans('forms.create_traffic_light_ph_comment'))); ?>

                                    <div class="input-group-append">
                                        <label class="input-group-text" for="comment">
                                            <i class="fa fa-fw <?php echo e(trans('forms.create_traffic_light_icon_comment')); ?>"
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

                        <?php echo Form::button(trans('forms.save-changes'), array('class' => 'btn btn-success margin-bottom-1 mb-1 float-right','type' => 'submit' )); ?>

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
            $("#pole").selectize({
                allowClear: true,
                create: false,
                selectOnTab: true,
                highlight: true,
                diacritics: true
            });

            $("#light_type").selectize({
                allowClear: true,
                create: false,
                selectOnTab: true,
                highlight: true,
                diacritics: true
            });

            $("#intersection").selectize({
                allowClear: true,
                create: false,
                selectOnTab: true,
                highlight: true,
                diacritics: true
            });

            $("#regulator").selectize({
                allowClear: true,
                create: false,
                selectOnTab: true,
                highlight: true,
                diacritics: true
            });

            $("#tensor").selectize({
                allowClear: true,
                create: false,
                selectOnTab: true,
                highlight: true,
                diacritics: true
            });

            $("#fastener").selectize({
                create: false,
                selectOnTab: true,
                highlight: true,
                selectOnTab: true
            });

            $("#state").selectize({
                allowClear: true,
                create: false,
                selectOnTab: true,
                highlight: true,
                diacritics: true
            });

            $("#brand").selectize({
                allowClear: true,
                create: false,
                selectOnTab: true,
                highlight: true,
                diacritics: true
            });

            $("#orientation").selectize({
                allowClear: true,
                create: false,
                selectOnTab: true,
                highlight: true,
                diacritics: true
            });
        });
    </script>

    <?php echo $__env->make('scripts.resize-image-before-upload', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php if(config('settings.googleMapsAPIStatus')): ?>
        <?php echo $__env->make('scripts.google-maps-atm-show', [
            'latitude' => $traffic_light->intersection->latitude,
            'longitude' => $traffic_light->intersection->longitude,
            'code' => $traffic_light->code,
        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/atmeccom/resources/views/traffic-lights/edit-traffic-light.blade.php ENDPATH**/ ?>