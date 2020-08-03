<?php $__env->startSection('template_title'); ?>
    <?php echo trans('itorders.editing-itorder', ['id' => $itorder->id]); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('template_linked_css'); ?>
    <?php if(config('atm_app.enabledSelectizeJs')): ?>
        <link rel="stylesheet" type="text/css" href="<?php echo e(config('atm_app.selectizeCssCDN')); ?>">
    <?php endif; ?>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <?php echo trans('itorders.editing-itorder', ['id' => $itorder->id]); ?>

                            <div class="pull-right">
                                <a href="<?php echo e(route('itorders.index')); ?>" class="btn btn-light btn-sm float-right"
                                   data-toggle="tooltip" data-placement="left"
                                   title="<?php echo e(trans('itorders.tooltips.back-itorders')); ?>">
                                    <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                    <?php echo trans('itorders.buttons.back-to-itorders'); ?>

                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <?php echo Form::open(array('route' => ['itorders.update', $itorder->id], 'method' => 'PUT', 'role' => 'form', 'class' => 'needs-validation')); ?>


                        <?php echo csrf_field(); ?>


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

                        <div class="form-group has-feedback row <?php echo e($errors->has('template') ? ' has-error ' : ''); ?>">
                            <?php echo Form::label('template', 'Plantilla', array('class' => 'col-md-3 control-label'));; ?>

                            <div class="col-md-9">
                                <div class="form-group">
                                    <select name="template" id="template">
                                        <option value="">Puede seleccionar una plantilla</option>
                                    </select>
                                    <p>Seleccionar una plantilla le completará una lista de materiales previamente configurada.</p>
                                </div>
                            </div>
                        </div>

                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="text-center">
                                    <strong>Listado de materiales</strong>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-5">
                                <?php echo Form::label('material_slt', 'Material', array('class' => 'control-label'));; ?>

                                <div class="form-group">
                                    <select id="material_slt" name="material_slt">
                                        <option value="">Seleccione el material</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <?php echo Form::label('metric', 'Unidad de medida', array('class' => 'control-label'));; ?>

                                <div class="form-group">
                                    <select id="metric" name="metric">
                                        <option value="">Seleccione la unidad</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <?php echo Form::label('code', 'Código', array('class' => 'control-label'));; ?>

                                <div class="input-group">
                                    <?php echo Form::text('code', null, array('id' => 'code', 'class' => 'form-control', 'placeholder' => '##')); ?>

                                </div>
                            </div>
                            <div class="col-md-2">
                                <?php echo Form::label('amount', 'Cantidad', array('class' => 'control-label'));; ?>

                                <div class="input-group">
                                    <?php echo Form::text('amount', null, array('id' => 'amount', 'class' => 'form-control mr-4', 'placeholder' => '##')); ?>

                                    <button id="add-material" type="button" class="btn btn-sm btn-primary float-right">
                                        <i class="fa fa-fw fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <table id="materials"
                                       class="table table-striped table-hover table-sm data-table mt-4 mb-4">
                                    <thead class="thead">
                                    <tr>
                                        <th>ID</th>
                                        <th>Material</th>
                                        <th>Unidad de medida</th>
                                        <th>Código</th>
                                        <th>Cantidad</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10">
                                <span class="red">Para eliminar un material debe seleccionarlo con click en la tabla y
                                luego presionar el boton eliminar</span>
                            </div>
                            <div class="col-md-2">
                                <button id="del-material" type="button" class="btn btn-sm btn-danger float-right">
                                    <i class="fa fa-fw fa-trash"></i>
                                </button>
                            </div>
                        </div>
                        <hr>

                        <?php echo Form::hidden("materials_list", null, array('id' => 'materials_list')); ?>


                        <?php echo Form::button(trans('itorders.create_button_text'), array('class' => 'btn btn-success margin-bottom-1 mb-1 float-right','type' => 'submit' )); ?>

                        <?php echo Form::close(); ?>

                    </div>

                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
    <script type="text/javascript" src="<?php echo e(config('atm_app.selectizeJsCDN')); ?>"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function () {
            let data = <?php echo json_encode($itorder->materials()->with(['material','metric_unit'])->get()); ?>;

            let materials_tbl = $('#materials').DataTable({
                "paging": false,
                "ordering": false,
                "info": false,
                "searching": false,
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json'
                },
            });

            $.each(data, function(index, val) {
                materials_tbl.row.add([
                    val.material.id,
                    val.material.name,
                    val.metric_unit.abbreviation,
                    val.code,
                    val.amount,
                ]).draw(false);
            });

            let serialize_table = function() {
                let data = [];
                let rows = materials_tbl.rows().data();
                for (let i=0; i<rows.length; i++) {
                    data.push({
                        'id': rows[i][0],
                        'metric': rows[i][2],
                        'code': rows[i][3],
                        'amount': rows[i][4],
                    });
                }

                $('#materials_list').val(JSON.stringify(data));
            };

            $("#material_slt").selectize({
                allowClear: true,
                create: false,
                highlight: true,
                diacritics: true,
                options: <?php echo json_encode($materials); ?>,
                valueField: 'id',
                labelField: ['name'],
                searchField: ['id', 'name'],
                render: {
                    option: function (item, escape) {
                        return '<div>'
                            + '<span>' + escape(item.name) + '</span>'
                            + '</div>';
                    },
                    item: function (item, escape) {
                        return '<div>'
                            + '<span>' + escape(item.name) + '</span> '
                            + '</div>';
                    }
                },
            });

            $("#metric").selectize({
                allowClear: true,
                create: false,
                highlight: true,
                diacritics: true,
                options: <?php echo json_encode($metrics); ?>,
                valueField: 'id',
                labelField: ['abbreviation'],
                searchField: ['id', 'name', 'abbreviation'],
                render: {
                    option: function (item, escape) {
                        return '<div>'
                            + '<span>' + escape(item.name) + ' (' + escape(item.abbreviation) + ')</span>'
                            + '</div>';
                    },
                    item: function (item, escape) {
                        return '<div>'
                            + '<span>' + escape(item.name) + ' (' + escape(item.abbreviation) + ')</span>'
                            + '</div>';
                    }
                },
            });

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
            $("#collector")[0].selectize.addItem(<?php echo e($itorder->collector_id); ?>);

            $("#template").selectize({
                allowClear: true,
                create: false,
                highlight: true,
                diacritics: true,
                options: <?php echo json_encode($templates); ?>,
                valueField: 'id',
                labelField: ['name'],
                searchField: ['id', 'name'],
                onChange: function (value) {
                    if (!value.length) return;

                    let template = this.options[value];
                    let materials = $("#material_slt")[0].selectize.options;
                    let metrics = $("#metric")[0].selectize.options;

                    materials_tbl.clear();
                    materials_tbl.draw();

                    for(let i in template.materials) {
                        let mat = -1;
                        let met = -1;

                        for (let j in materials) {
                            if (materials[j].id == template.materials[i].material_id) {
                                mat = j;
                            }
                        }

                        for (let j in metrics) {
                            if (metrics[j].id == template.materials[i].metric_id) {
                                met = j;
                            }
                        }

                        materials_tbl.row.add([
                            template.materials[i].material_id,
                            materials[mat].name,
                            metrics[met].abbreviation,
                            template.materials[i].code,
                            template.materials[i].amount,
                        ]).draw(false);
                    }
                    serialize_table();
                },
                render: {
                    option: function (item, escape) {
                        return '<div>'
                            + '<span>' + escape(item.name) + ' - ' + escape(item.description) + '</span>'
                            + '</div>';
                    },
                    item: function (item, escape) {
                        return '<div>'
                            + '<span>' + escape(item.name) + ' - ' + escape(item.description) + '</span>'
                            + '</div>';
                    }
                },
            });

            $('#add-material').on('click', function () {
                let material = $.map($('#material_slt')[0].selectize.items, function(value) {
                    return $('#material_slt')[0].selectize.options[value];
                });
                let metric = $.map($('#metric')[0].selectize.items, function(value) {
                    return $('#metric')[0].selectize.options[value];
                });

                let amount = $('#amount').val();
                let code = $('#code').val();

                if (material.length > 0 && metric.length > 0 && code.trim().length && amount.trim().length && Number.parseInt(amount) > 0) {
                    materials_tbl.row.add([
                        material[0].id,
                        material[0].name,
                        metric[0].abbreviation,
                        code,
                        Number.parseInt(amount),
                    ]).draw(false);
                }
                else {
                    alert('Introduzca los valores requeridos.');
                }
                serialize_table();

                $('#material_slt')[0].selectize.clear();
                $('#metric')[0].selectize.clear();
                $('#code').val('');
                $('#amount').val('');
            });

            $('#materials tbody').on('click', 'tr', function () {
                if ($(this).hasClass('selected')) {
                    $(this).removeClass('selected');
                } else {
                    materials_tbl.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');
                }
            });

            $('#del-material').click(function () {
                materials_tbl.row('.selected').remove().draw(false);

                serialize_table();
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/atmdeveqadoor/resources/views/itorders/edit.blade.php ENDPATH**/ ?>