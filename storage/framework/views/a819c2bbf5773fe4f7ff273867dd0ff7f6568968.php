<?php $__env->startSection('template_title'); ?>
    <?php echo trans('verticalsignals.editing-vsignal', ['code' => $vsignal->code]); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('template_linked_css'); ?>
    <?php if(config('atm_app.enabledSelectizeJs')): ?>
        <link rel="stylesheet" type="text/css" href="<?php echo e(config('atm_app.selectizeCssCDN')); ?>">
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('template_fastload_css'); ?>
    .picture {
    height: 200px;
    width: auto;
    border: 2px solid #8eb4cb;
    }

    .pictureBg{
    background-image: url("<?php echo e(asset($vsignal->get_picture_path())); ?>");
    background-repeat: no-repeat;
    background-position: center center;
    background-size: cover;
    min-height: 300px;
    }

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
                            <?php echo trans('verticalsignals.editing-vsignal', ['code' => $vsignal->code]); ?>

                            <div class="pull-right">
                                <a href="<?php echo e(URL::to('vertical-signals/')); ?>" class="btn btn-light btn-sm float-right"
                                   data-toggle="tooltip" data-placement="top"
                                   title="<?php echo e(trans('verticalsignals.tooltips.back-vsignals')); ?>">
                                    <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                    <?php echo trans('verticalsignals.buttons.back-to-vsignals'); ?>

                                </a>
                                <a href="<?php echo e(URL::to('vertical-signals/'. $vsignal->id)); ?>"
                                   class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="left"
                                   title="<?php echo e(trans('verticalsignals.tooltips.back-vsignal')); ?>">
                                    <i class="fa fa-fw fa-reply" aria-hidden="true"></i>
                                    <?php echo trans('verticalsignals.buttons.back-to-vsignal'); ?>

                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php echo Form::open(array('id' => 'vsignal_form', 'route' => ['vertical-signals.update', $vsignal->id], 'method' => 'PUT', 'role' => 'form', 'class' => 'needs-validation', 'files' => true)); ?>


                        <?php echo csrf_field(); ?>


                        <div class="row">
                            <div class="col-sm-4 col-md-6 pictureBg">
                            </div>
                            <div class="col-sm-4 col-md-6" id="map-canvas">
                                map
                            </div>
                        </div>

                        <br>
                        <div class="form-group has-feedback row <?php echo e($errors->has('latitude') ? ' has-error ' : ''); ?>">
                            <?php echo Form::label('latitude', trans('forms.create_vsignal_label_latitude'), array('class' => 'col-md-3 control-label'));; ?>

                            <div class="col-md-9">
                                <div class="input-group">
                                    <?php echo Form::text('latitude', $vsignal->latitude, array('id' => 'latitude', 'class' => 'form-control', 'readonly' => 'readonly', 'placeholder' => trans('forms.create_vsignal_ph_latitude'))); ?>

                                    <div class="input-group-append">
                                        <label for="latitude" class="input-group-text">
                                            <i class="fa fa-fw <?php echo e(trans('forms.create_vsignal_icon_latitude')); ?>"
                                               aria-hidden="true"></i>
                                        </label>
                                    </div>
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
                                    <?php echo Form::text('longitude', $vsignal->longitude, array('id' => 'longitude', 'class' => 'form-control', 'readonly' => 'readonly', 'placeholder' => trans('forms.create_vsignal_ph_longitude'))); ?>

                                    <div class="input-group-append">
                                        <label for="longitude" class="input-group-text">
                                            <i class="fa fa-fw <?php echo e(trans('forms.create_vsignal_icon_longitude')); ?>"
                                               aria-hidden="true"></i>
                                        </label>
                                    </div>
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
                                    <?php echo Form::text('google_address', $vsignal->google_address, array('id' => 'google_address', 'class' => 'form-control', 'readonly' => 'readonly', 'placeholder' => trans('forms.create_vsignal_ph_gaddress'))); ?>

                                    <div class="input-group-append">
                                        <label for="google_address" class="input-group-text">
                                            <i class="fa fa-fw <?php echo e(trans('forms.create_vsignal_icon_gaddress')); ?>"
                                               aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                <?php if($errors->has('google_address')): ?>
                                    <span class="help-block">
                                            <strong><?php echo e($errors->first('google_address')); ?></strong>
                                        </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group has-feedback row <?php echo e($errors->has('code') ? ' has-error ' : ''); ?>">
                            <?php echo Form::label('code', trans('forms.create_vsignal_label_code'), array('class' => 'col-md-3 control-label'));; ?>

                            <div class="col-md-9">
                                <div class="input-group">
                                    <?php echo Form::text('code', $vsignal->code, array('id' => 'code', 'class' => 'form-control', 'readonly' => 'readonly', 'placeholder' => trans('forms.create_vsignal_ph_code'))); ?>

                                    <div class="input-group-append">
                                        <label for="code" class="input-group-text">
                                            <i class="fa fa-fw <?php echo e(trans('forms.create_vsignal_icon_code')); ?>"
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
                            <?php echo Form::label('erp_code', trans('forms.create_vsignal_label_erp_code'), array('class' => 'col-md-3 control-label'));; ?>

                            <div class="col-md-9">
                                <div class="input-group">
                                    <?php echo Form::text('erp_code', $vsignal->erp_code, array('id' => 'erp_code', 'class' => 'form-control', 'placeholder' => trans('forms.create_vsignal_ph_erp_code'))); ?>

                                    <div class="input-group-append">
                                        <label for="erp_code" class="input-group-text">
                                            <i class="fa fa-fw <?php echo e(trans('forms.create_vsignal_icon_erp_code')); ?>"
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

                        <div class="form-group has-feedback row <?php echo e($errors->has('inventory') ? ' has-error ' : ''); ?>">
                            <?php echo Form::label('inventory', trans('forms.create_vsignal_label_inventory'), array('class' => 'col-md-3 control-label'));; ?>

                            <div class="col-md-9">
                                <div class="form-group">
                                    <select name="inventory" id="inventory">
                                        <option value=""><?php echo e(trans('forms.create_vsignal_ph_inventory')); ?></option>
                                        <?php if($sinventories): ?>
                                            <?php $__currentLoopData = $sinventories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sinventory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($sinventory->id); ?>" <?php echo e($vsignal->signal_id == $sinventory->id ? 'selected' : ''); ?>><?php echo e($sinventory->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <?php if($errors->has('inventory')): ?>
                                    <span class="help-block">
                                            <strong><?php echo e($errors->first('inventory')); ?></strong>
                                        </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group has-feedback row <?php echo e($errors->has('variation') ? ' has-error ' : ''); ?>">
                            <?php echo Form::label('variation', trans('forms.create_vsignal_label_variation'), array('class' => 'col-md-3 control-label'));; ?>

                            <div class="col-md-9">
                                <div class="form-group">
                                    <select name="variation" id="variation">
                                        <option value=""><?php echo e(trans('forms.create_vsignal_ph_variation')); ?></option>
                                        <?php if($sinventories): ?>
                                            <?php $__currentLoopData = $vsignal->signal_inventory->variations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($variation->id); ?>" <?php echo e($vsignal->variation_id == $variation->id ? 'selected' : ''); ?>><?php echo e($variation->variation . ' (' . $variation->signal_dimension->value . ')'); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <?php if($errors->has('variation')): ?>
                                    <span class="help-block">
                                            <strong><?php echo e($errors->first('variation')); ?></strong>
                                        </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group has-feedback row <?php echo e($errors->has('fastener') ? ' has-error ' : ''); ?>">
                            <?php echo Form::label('fastener', trans('forms.create_vsignal_label_fastener'), array('class' => 'col-md-3 control-label'));; ?>

                            <div class="col-md-9">
                                <div class="form-group">
                                    <select name="fastener" id="fastener">
                                        <option value=""><?php echo e(trans('forms.create_vsignal_ph_fastener')); ?></option>
                                        <?php if($fasteners): ?>
                                            <?php $__currentLoopData = $fasteners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($value); ?>" <?php echo e($vsignal->fastener == $value ? 'selected' : ''); ?>><?php echo e($value); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <?php if($errors->has('fastener')): ?>
                                    <span class="help-block">
                                            <strong><?php echo e($errors->first('fastener')); ?></strong>
                                        </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group has-feedback row <?php echo e($errors->has('material') ? ' has-error ' : ''); ?>">
                            <?php echo Form::label('material', trans('forms.create_vsignal_label_material'), array('class' => 'col-md-3 control-label'));; ?>

                            <div class="col-md-9">
                                <div class="form-group">
                                    <select name="material" id="material">
                                        <option value=""><?php echo e(trans('forms.create_vsignal_ph_material')); ?></option>
                                        <?php if($materials): ?>
                                            <?php $__currentLoopData = $materials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($value); ?>" <?php echo e($vsignal->material == $value ? 'selected' : ''); ?>><?php echo e($value); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <?php if($errors->has('material')): ?>
                                    <span class="help-block">
                                            <strong><?php echo e($errors->first('material')); ?></strong>
                                        </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group has-feedback row <?php echo e($errors->has('normative') ? ' has-error ' : ''); ?>">
                            <?php echo Form::label('normative', trans('forms.create_vsignal_label_normative'), array('class' => 'col-md-3 control-label'));; ?>

                            <div class="col-md-9">
                                <div class="form-group">
                                    <select name="normative" id="normative">
                                        <option value=""><?php echo e(trans('forms.create_vsignal_ph_normative')); ?></option>
                                        <?php if($normatives): ?>
                                            <?php $__currentLoopData = $normatives; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($value); ?>" <?php echo e($vsignal->normative == $value ? 'selected' : ''); ?>><?php echo e($value); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <?php if($errors->has('normative')): ?>
                                    <span class="help-block">
                                            <strong><?php echo e($errors->first('normative')); ?></strong>
                                        </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group has-feedback row <?php echo e($errors->has('state') ? ' has-error ' : ''); ?>">
                            <?php echo Form::label('state', trans('forms.create_vsignal_label_state'), array('class' => 'col-md-3 control-label'));; ?>

                            <div class="col-md-9">
                                <div class="form-group">
                                    <select name="state" id="state">
                                        <option value=""><?php echo e(trans('forms.create_vsignal_ph_state')); ?></option>
                                        <?php if($states): ?>
                                            <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($value); ?>" <?php echo e($vsignal->state == $value ? 'selected' : ''); ?>><?php echo e($value); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <?php if($errors->has('state')): ?>
                                    <span class="help-block">
                                            <strong><?php echo e($errors->first('state')); ?></strong>
                                        </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group has-feedback row <?php echo e($errors->has('orientation') ? ' has-error ' : ''); ?>">
                            <?php echo Form::label('orientation', trans('forms.create_vsignal_label_orientation'), array('class' => 'col-md-3 control-label'));; ?>

                            <div class="col-md-9">
                                <div class="form-group">
                                    <select name="orientation" id="orientation">
                                        <option value=""><?php echo e(trans('forms.create_vsignal_ph_orientation')); ?></option>
                                        <?php if($orientations): ?>
                                            <?php $__currentLoopData = $orientations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($value); ?>" <?php echo e($vsignal->orientation == $value ? 'selected' : ''); ?>><?php echo e($value); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <?php if($errors->has('orientation')): ?>
                                    <span class="help-block">
                                            <strong><?php echo e($errors->first('orientation')); ?></strong>
                                        </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group has-feedback row <?php echo e($errors->has('picture_data') ? ' has-error ' : ''); ?>">
                            <?php echo Form::label('picture', trans('forms.create_vsignal_label_picture'), array('class' => 'col-md-3 control-label'));; ?>

                            <div class="col-md-9">
                                <div class="input-group">
                                    <?php echo Form::file('picture', NULL, array('id' => 'picture', 'placeholder' => trans('forms.create_vsignal_ph_picture'))); ?>

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
                            <?php echo Form::label('comment', trans('forms.create_vsignal_label_comment'), array('class' => 'col-md-3 control-label'));; ?>

                            <div class="col-md-9">
                                <div class="input-group">
                                    <?php echo Form::textarea('comment', $vsignal->comment, array('id' => 'comment', 'rows' => '3', 'class' => 'form-control', 'placeholder' => trans('forms.create_vsignal_ph_comment'))); ?>

                                    <div class="input-group-append">
                                        <label class="input-group-text" for="comment">
                                            <i class="fa fa-fw <?php echo e(trans('forms.create_vsignal_icon_comment')); ?>"
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

                        <?php echo Form::button(trans('forms.save-changes'), array('class' => 'btn btn-success margin-bottom-1 mb-1 float-right','type' => 'button', 'data-toggle' => 'modal', 'data-target' => '#confirmSave', 'data-title' => trans('modals.edit_user__modal_text_confirm_title'), 'data-message' => trans('modals.edit_user__modal_text_confirm_message'))); ?>

                        <?php echo Form::close(); ?>

                    </div>

                </div>
            </div>
        </div>
    </div>

    <?php echo $__env->make('modals.modal-save', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('modals.modal-delete', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

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

            $("#inventory").selectize({
                allowClear: true,
                create: false,
                highlight: true,
                diacritics: true,
                onChange: function (value) {
                    if (!value.length) return;
                    let variation = $("#variation")[0].selectize;
                    variation.disable();
                    variation.clear();
                    variation.clearOptions();
                    variation.load(function(query, callback) {
                        var xhr;
                        xhr && xhr.abort();
                        xhr = $.ajax({
                            url: '<?php echo e(route('variations-by-signal')); ?>',
                            data: {id: value},
                            dataType: "json",
                            success: function(results) {
                                variation.addOption(results);
                                variation.enable();
                                callback(results);
                            },
                            error: function() {
                                callback();
                            }
                        })
                    });
                },
            });

            $("#variation").selectize({
                allowClear: true,
                create: false,
                highlight: true,
                diacritics: true,
                selectOnTab: true,
                valueField: 'id',
                labelField: 'variation',
                searchField: ['variation', 'dimension'],
                render: {
                    option: function (item, escape) {
                        return '<div>'
                            + '<span>' + escape(item.variation) + ' (' + escape(item.dimension) + ')</span>'
                            + '</div>';
                    },
                    item: function (item, escape) {
                        return '<div>'
                            + '<span>' + escape(item.variation) + ' (' + escape(item.dimension) + ')</span>'
                            + '</div>';
                    }
                },
            });
            $("#variation")[0].selectize.disable();

            $("#fastener").selectize({
                allowClear: true,
                create: false,
                highlight: true,
                diacritics: true
            });

            $("#material").selectize({
                allowClear: true,
                create: false,
                highlight: true,
                diacritics: true
            });

            $("#normative").selectize({
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

            $("#orientation").selectize({
                allowClear: true,
                create: false,
                highlight: true,
                diacritics: true
            });

        });
    </script>

    <?php echo $__env->make('scripts.delete-modal-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('scripts.save-modal-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php if(config('settings.googleMapsAPIStatus')): ?>
        <?php echo $__env->make('scripts.google-maps-atm-edit', [
            'latitude' => $vsignal->latitude,
            'longitude' => $vsignal->longitude,
            'google_address' => $vsignal->google_address,
        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

    <?php echo $__env->make('scripts.resize-image-before-upload', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/samuel/Documents/proyectos/Saveme/atm2/nuevo/resources/views/verticalsignals/edit-vertical-signal.blade.php ENDPATH**/ ?>