

<?php $__env->startSection('template_title'); ?>
    <?php echo trans('traffic-lights.create-new-traffic-light'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('template_linked_css'); ?>
    <?php if(config('atm_app.enabledSelectizeJs')): ?>
        <link rel="stylesheet" type="text/css" href="<?php echo e(config('atm_app.selectizeCssCDN')); ?>">
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('template_fastload_css'); ?>
    .selectizeLoading > .selectize-input, .selectizeLoading > .selectize-input > input
    {
    cursor: wait !important;
    font-style: italic;
    background: url('<?php echo e(asset('images/ajax-loader.gif')); ?>' no-repeat center center;
    }
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <?php echo trans('traffic-lights.create-new-traffic-light'); ?>

                            <div class="pull-right">
                                <a href="<?php echo e(route('traffic-lights.index')); ?>" class="btn btn-light btn-sm float-right"
                                   data-toggle="tooltip" data-placement="left"
                                   title="<?php echo e(trans('traffic-lights.tooltips.back-traffic-lights')); ?>">
                                    <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                    <?php echo trans('traffic-lights.buttons.back-to-traffic-lights'); ?>

                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <?php echo Form::open(array('route' => 'traffic-lights.store', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation', 'files' => true)); ?>


                        <?php echo csrf_field(); ?>


                        <div class="form-group has-feedback row <?php echo e($errors->has('code') ? ' has-error ' : ''); ?>">
                            <?php echo Form::label('code', trans('forms.create_traffic_light_label_code'), array('class' => 'col-md-3 control-label'));; ?>

                            <div class="col-md-9">
                                <div class="input-group">
                                    <?php echo Form::text('code', NULL, array('id' => 'code', 'disabled' => true, 'class' => 'form-control', 'placeholder' => trans('forms.create_traffic_light_ph_code'))); ?>

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
                                    <?php echo Form::text('erp_code', NULL, array('id' => 'erp_code', 'disabled' => true, 'class' => 'form-control', 'placeholder' => trans('forms.create_traffic_light_ph_erp_code'))); ?>

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
                                    <select name="light_type" id="light_type"></select>
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

                        <div class="form-group has-feedback row <?php echo e($errors->has('intersection') ? ' has-error ' : ''); ?>">
                            <?php echo Form::label('intersection', trans('forms.create_traffic_light_label_intersection'), array('class' => 'col-md-3 control-label'));; ?>

                            <div class="col-md-9">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-11">
                                            <select name="intersection" id="intersection">
                                            </select>
                                        </div>
                                        <div class="col-1">
                                            <a href="<?php echo e(url('intersections/create')); ?>"
                                               title="Pulse si desea crear una nueva intersección" target="_blank"
                                               class="btn btn-sm btn-success float-right"><i
                                                        class="fa fa-fw fa-plus-square"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group has-feedback row <?php echo e($errors->has('regulator') ? ' has-error ' : ''); ?>">
                            <?php echo Form::label('regulator', trans('forms.create_traffic_light_label_regulator'), array('class' => 'col-md-3 control-label'));; ?>

                            <div class="col-md-9">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-11">
                                            <select name="regulator" id="regulator">
                                            </select>
                                        </div>
                                        <div class="col-1">
                                            <a href="<?php echo e(url('regulator-boxes/create')); ?>"
                                               title="Pulse si desea crear una nueva caja reguladora" target="_blank"
                                               class="btn btn-sm btn-success float-right"><i
                                                        class="fa fa-fw fa-plus-square"></i></a>
                                        </div>
                                    </div>

                                    <?php echo Form::checkbox('today_regulators', 1, true, array('id' => 'today_regulators', 'disabled' => true)); ?>

                                    <?php echo Form::label('today_regulators', 'Creadas hoy', array('class' => 'form-check-label'));; ?>

                                </div>
                            </div>
                        </div>

                        <div class="form-group has-feedback row <?php echo e($errors->has('pole') ? ' has-error ' : ''); ?>">
                            <?php echo Form::label('pole', trans('forms.create_traffic_light_label_pole'), array('class' => 'col-md-3 control-label'));; ?>

                            <div class="col-md-9">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-11">
                                            <select name="pole" id="pole">
                                            </select>
                                        </div>
                                        <div class="col-1">
                                            <a href="<?php echo e(url('traffic-poles/create')); ?>"
                                               title="Pulse si desea crear un nuevo poste" target="_blank"
                                               class="btn btn-sm btn-success float-right"><i
                                                        class="fa fa-fw fa-plus-square"></i></a>
                                        </div>
                                    </div>

                                    <?php echo Form::checkbox('today_poles', 1, true, array('id' => 'today_poles')); ?>

                                    <?php echo Form::label('today_poles', 'Creados hoy', array('class' => 'form-check-label'));; ?>

                                </div>
                            </div>
                        </div>

                        <div class="form-group has-feedback row <?php echo e($errors->has('tensor') ? ' has-error ' : ''); ?>">
                            <?php echo Form::label('tensor', trans('forms.create_traffic_light_label_tensor'), array('class' => 'col-md-3 control-label'));; ?>

                            <div class="col-md-9">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-11">
                                            <select name="tensor" id="tensor">
                                            </select>
                                        </div>
                                        <div class="col-1">
                                            <a href="<?php echo e(url('traffic-tensors/create')); ?>"
                                               title="Pulse si desea crear un nuevo tensor" target="_blank"
                                               class="btn btn-sm btn-success float-right"><i
                                                        class="fa fa-fw fa-plus-square"></i></a>
                                        </div>
                                    </div>

                                    <?php echo Form::checkbox('today_tensors', 1, true, array('id' => 'today_tensors')); ?>

                                    <?php echo Form::label('today_tensors', 'Creados hoy', array('class' => 'form-check-label'));; ?>

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
                                                <option value="<?php echo e($value); ?>" <?php echo e(old('state') == $value ? 'selected' : ''); ?>><?php echo e($value); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
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
                                                <option value="<?php echo e($value); ?>" <?php echo e(old('orientation') == $value ? 'selected' : ''); ?>><?php echo e($value); ?></option>
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
                                                <option value="<?php echo e($value); ?>" <?php echo e(old('brand') == $value ? 'selected' : ''); ?>><?php echo e($value); ?></option>
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
                                    <?php echo Form::text('model', NULL, array('id' => 'model', 'class' => 'form-control', 'placeholder' => trans('forms.create_traffic_light_ph_model'))); ?>

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
                                    <?php echo Form::textarea('comment', NULL, array('id' => 'comment', 'rows' => '3', 'class' => 'form-control', 'placeholder' => trans('forms.create_traffic_light_ph_comment'))); ?>

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

                        <?php echo Form::button(trans('forms.create_traffic_light_button_text'), array('class' => 'btn btn-success margin-bottom-1 mb-1 float-right','type' => 'submit' )); ?>

                        <?php echo Form::close(); ?>

                    </div>

                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
    <script type="text/javascript" src="<?php echo e(config('atm_app.selectizeJsCDN')); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>

    <script type="text/javascript">
        $(function () {
            function load_today_regulators(callback) {
                $.ajax({
                    url: '<?php echo e(route('today-regulators')); ?>',
                    //data: { query: query},
                    dataType: "json",
                    type: 'GET',
                    error: function () {
                        console.log('Error all regulators');
                        callback();
                    },
                    success: function (res) {
                        callback(res);
                        $('#regulator')[0].selectize.enable();
                        $('#today_regulators').removeAttr("disabled");
                    }
                });
            }
            function load_all_regulators(callback) {
                $.ajax({
                    url: '<?php echo e(route('all-regulators')); ?>',
                    //data: { query: query},
                    dataType: "json",
                    type: 'GET',
                    error: function () {
                        console.log('Error all regulators');
                        callback();
                    },
                    success: function (res) {
                        callback(res);
                        $('#regulator')[0].selectize.enable();
                        $('#today_regulators').removeAttr("disabled");
                    }
                });
            }

            function load_today_poles(callback) {
                $.ajax({
                    url: '<?php echo e(route('today-poles')); ?>',
                    //data: { query: query},
                    dataType: "json",
                    type: 'GET',
                    error: function () {
                        console.log('Error all regulators');
                        callback();
                    },
                    success: function (res) {
                        callback(res);
                        $('#pole')[0].selectize.enable();
                        $('#today_poles').removeAttr("disabled");
                    }
                });
            }
            function load_all_poles(callback) {
                $.ajax({
                    url: '<?php echo e(route('all-poles')); ?>',
                    //data: { query: query},
                    dataType: "json",
                    type: 'GET',
                    error: function () {
                        console.log('Error all regulators');
                        callback();
                    },
                    success: function (res) {
                        callback(res);
                        $('#pole')[0].selectize.enable();
                        $('#today_poles').removeAttr("disabled");
                    }
                });
            }

            function load_today_tensors(callback) {
                $.ajax({
                    url: '<?php echo e(route('today-tensors')); ?>',
                    //data: { query: query},
                    dataType: "json",
                    type: 'GET',
                    error: function () {
                        console.log('Error all regulators');
                        callback();
                    },
                    success: function (res) {
                        callback(res);
                        $('#tensor')[0].selectize.enable();
                        $('#today_tensors').removeAttr("disabled");
                    }
                });
            }
            function load_all_tensors(callback) {
                $.ajax({
                    url: '<?php echo e(route('all-tensors')); ?>',
                    //data: { query: query},
                    dataType: "json",
                    type: 'GET',
                    error: function () {
                        console.log('Error all regulators');
                        callback();
                    },
                    success: function (res) {
                        callback(res);
                        $('#tensor')[0].selectize.enable();
                        $('#today_tensors').removeAttr("disabled");
                    }
                });
            }

            $("#regulator").selectize({
                preload: true,
                loadingClass: 'selectizeLoading',
                create: false,
                highlight: true,
                selectOnTab: true,
                placeholder: '<?php echo e(trans('forms.create_traffic_light_ph_regulator')); ?>',
                sortField: [{field: 'updated_at', direction: 'desc'}, {field: '$score'}],
                searchField: ['code', 'brand'],
                options: [],
                valueField: 'id',
                labelField: 'code',
                render: {
                    option: function (item, escape) {
                        return '<div>'
                            + '<span>' + escape(item.code) + '</span> | '
                            + '<span>' + escape(item.brand) + '</span>'
                            + '</div>';
                    },
                    item: function (item, escape) {
                        return '<div>'
                            + '<span>' + escape(item.code) + '</span> | '
                            + '<span>' + escape(item.brand) + '</span>'
                            + '</div>';
                    }
                },
                load: function (query, callback) {
                    this.settings.load = null; // prevent selectize from loading when typing

                    $.ajax({
                        url: '<?php echo e(route('today-regulators')); ?>',
                        dataType: "json",
                        type: 'GET',
                        error: function () {
                            callback();
                        },
                        success: function (res) {
                            callback(res);
                            $('#today_regulators').removeAttr("disabled");
                        }
                    });
                },
            });

            $("#intersection").selectize({
                preload: true,
                loadingClass: 'selectizeLoading',
                create: false,
                highlight: true,
                selectOnTab: true,
                placeholder: 'Seleccione una intersección',
                sortField: [{field: 'updated_at', direction: 'desc'}, {field: '$score'}],
                searchField: ['id', 'main_st', 'cross_st'],
                options: <?php echo json_encode($intersections); ?>,
                valueField: 'id',
                labelField: 'main_st',
                render: {
                    option: function (item, escape) {
                        return '<div>'
                            + '<span>' + escape(item.id) + '</span> | '
                            + '<span>' + escape(item.main_st) + ' y ' + escape(item.cross_st) + '</span>'
                            + '</div>';
                    },
                    item: function (item, escape) {
                        return '<div>'
                            + '<span>' + escape(item.id) + '</span> | '
                            + '<span>' + escape(item.main_st) + ' y ' + escape(item.cross_st) + '</span>'
                            + '</div>';
                    }
                },
                /*onChange: function (value) {
                    if (!value.length) return;
                    alert(value);
                    /!*select_city.disable();
                    select_city.clearOptions();
                    select_city.load(function(callback) {
                        xhr && xhr.abort();
                        xhr = $.ajax({
                            url: 'https://jsonp.afeld.me/?url=http://api.sba.gov/geodata/primary_city_links_for_state_of/' + value + '.json',
                            success: function(results) {
                                select_city.enable();
                                callback(results);
                            },
                            error: function() {
                                callback();
                            }
                        })
                    });*!/
                },*/
            });

            $("#pole").selectize({
                preload: true,
                loadingClass: 'selectizeLoading',
                create: false,
                highlight: true,
                selectOnTab: true,
                placeholder: '<?php echo e(trans('forms.create_traffic_light_ph_pole')); ?>',
                sortField: [{field: 'updated_at', direction: 'desc'}, {field: '$score'}],
                searchField: ['id', 'main_st', 'cross_st'],
                valueField: 'id',
                options: [],
                labelField: 'code',
                render: {
                    option: function (item, escape) {
                        return '<div>'
                            + '<span>Usuario: ' + escape(item.user_id) + ' | Poste: ' + escape(item.id) + '</span> | '
                            + '<span>Material: ' + escape(item.material) + ' | Estado: ' + escape(item.state) + '</span>'
                            + '</div>';
                    },
                    item: function (item, escape) {
                        return '<div>'
                            + '<span>Usuario: ' + escape(item.user_id) + ' | Poste: ' + escape(item.id) + '</span> | '
                            + '<span>Material: ' + escape(item.material) + ' | Estado: ' + escape(item.state) + '</span>'
                            + '</div>';
                    }
                },
                load: function (query, callback) {
                    this.settings.load = null; // prevent selectize from loading when typing

                    $.ajax({
                        url: '<?php echo e(route('today-poles')); ?>',
                        dataType: "json",
                        type: 'GET',
                        error: function () {
                            callback();
                        },
                        success: function (res) {
                            callback(res);
                            $('#today_poles').removeAttr("disabled");
                        }
                    });
                },
            });

            $("#tensor").selectize({
                preload: true,
                loadingClass: 'selectizeLoading',
                create: false,
                highlight: true,
                selectOnTab: true,
                placeholder: '<?php echo e(trans('forms.create_traffic_light_ph_tensor')); ?>',
                sortField: [{field: 'updated_at', direction: 'desc'}, {field: '$score'}],
                searchField: ['id'],
                valueField: 'id',
                labelField: 'id',
                options: [],
                render: {
                    option: function (item, escape) {
                        return '<div>'
                            + '<span>' + escape(item.id) + '</span> | '
                            + '<span>' + escape(item.material) + ' - ' + escape(item.state) + '</span>'
                            + '</div>';
                    },
                    item: function (item, escape) {
                        return '<div>'
                            + '<span>' + escape(item.id) + '</span> | '
                            + '<span>' + escape(item.material) + ' - ' + escape(item.state) + '</span>'
                            + '</div>';
                    }
                },
                load: function (query, callback) {
                    this.settings.load = null; // prevent selectize from loading when typing

                    $.ajax({
                        url: '<?php echo e(route('today-tensors')); ?>',
                        dataType: "json",
                        type: 'GET',
                        error: function () {
                            callback();
                        },
                        success: function (res) {
                            callback(res);
                            $('#today_tensors').removeAttr("disabled");
                        }
                    });
                },
            });

            $("#light_type").selectize({
                create: false,
                highlight: true,
                selectOnTab: true,
                valueField: 'id',
                labelField: 'name',
                searchField: ['name'],
                options: <?php echo json_encode($light_types); ?>,
                sortField: [{field: 'updated_at', direction: 'desc'}, {field: '$score'}],
                placeholder: '<?php echo e(trans('forms.create_traffic_light_ph_light_type')); ?>',
                render: {
                    option: function (item, escape) {
                        return '<div>' + escape(item.name) + '</div>';
                    },
                    item: function (item, escape) {
                        return '<div>' + escape(item.name) + '</div>';
                    }
                },
            });

            $("#state").selectize({
                create: false,
                selectOnTab: true,
                highlight: true,
                selectOnTab: true
            });

            $("#fastener").selectize({
                create: false,
                selectOnTab: true,
                highlight: true,
                selectOnTab: true
            });

            $("#brand").selectize({
                create: false,
                selectOnTab: true,
                highlight: true,
                selectOnTab: true
            });

            $("#orientation").selectize({
                create: false,
                selectOnTab: true,
                highlight: true,
                selectOnTab: true
            });

            set_selectize_options = function (selectize, options) {
                selectize.disable();
                selectize.clear();
                selectize.clearOptions();
                selectize.renderCache['option'] = {};
                selectize.renderCache['item'] = {};
                selectize.addOption(options);
                selectize.enable();
            };

            clear_reload_selectize = function (selectize, callback) {
                selectize.disable();
                selectize.clear();
                selectize.clearOptions();
                selectize.renderCache['option'] = {};
                selectize.renderCache['item'] = {};
                selectize.load(callback);
            };

            $('#today_regulators').change(function () {
                let selectize = $('#regulator')[0].selectize;
                $('#today_regulators').attr("disabled", true);

                if ($(this).is(":checked")) {
                    clear_reload_selectize(selectize, load_today_regulators);
                } else {
                    clear_reload_selectize(selectize, load_all_regulators);
                }
            });

            $('#today_poles').change(function () {
                let selectize = $('#pole')[0].selectize;
                $('#today_poles').attr("disabled", true);

                if ($(this).is(":checked")) {
                    clear_reload_selectize(selectize, load_today_poles);
                } else {
                    clear_reload_selectize(selectize, load_all_poles);
                }
            });

            $('#today_tensors').change(function () {
                let selectize = $('#tensor')[0].selectize;
                $('#today_tensors').attr("disabled", true);

                if ($(this).is(":checked")) {
                    clear_reload_selectize(selectize, load_today_tensors);
                } else {
                    clear_reload_selectize(selectize, load_all_tensors);
                }
            });
        });
    </script>

    <?php echo $__env->make('scripts.resize-image-before-upload', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/atmeccom/resources/views/traffic-lights/create-traffic-light.blade.php ENDPATH**/ ?>