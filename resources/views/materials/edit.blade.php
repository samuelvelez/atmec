@extends('layouts.app')

@section('template_title')
    {!! trans('reports.editing-report', ['id' => $report->id]) !!}
@endsection

@section('template_linked_css')
    @if(config('atm_app.enabledSelectizeJs'))
        <link rel="stylesheet" type="text/css" href="{{ config('atm_app.selectizeCssCDN') }}">
    @endif

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
@endsection

@section('template_fastload_css')
    #map-canvas{
    min-height: 300px;
    height: 100%;      {!! Form::button(trans('Finalizar'), array('class' => 'btn btn-success margin-bottom-1 mb-1  mr-2 float-right','type' => 'submit', 'id'=>'finalizar')) !!}
    width: 100%;
    }
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            {!! trans('reports.editing-report', ['id' => $report->id]) !!}
                            <div class="pull-right">
                                <a href="{{ route('reports.index') }}" class="btn btn-light btn-sm float-right"
                                   data-toggle="tooltip" data-placement="left"
                                   title="{{ trans('reports.tooltips.back-reports') }}">
                                    <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                    {!! trans('reports.buttons.back-to-reports') !!}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <br>

                        {!! Form::open(array('route' => ['materials.store', $report->id], 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation', 'files' => true)) !!}

                        {!! csrf_field() !!}

                      

                        <div class="text-center" style="color: royalblue;"><strong>Datos de la orden de retiro</strong></div>
                        <div class="form-group has-feedback row {{ $errors->has('description') ? ' has-error ' : '' }}">
                            {!! Form::label('description', trans('reports.create_label_description'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::textarea('description', $report->description, array('id' => 'description', 'rows' => '3', 'class' => 'form-control', 'placeholder' => trans('reports.create_ph_description'))) !!}
                                </div>
                                @if ($errors->has('description'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                  
                    
                        <div id="cont_materiales">
                            <div class="text-center" style="color: royalblue;"><strong>Materiales incluidos en la orden de retiro a generar</strong></div>
                            <div class="row">
                                <div class="col-md-7">
                                    {!! Form::label('material_slt', 'Material', array('class' => 'control-label')); !!}
                                    <div class="form-group">
                                        <select id="material_slt" name="material_slt">
                                            <option value="">Seleccione el material</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    {!! Form::label('metric', 'Unidad de medida', array('class' => 'control-label')); !!}
                                    <div class="form-group">
                                        <select id="metric" name="metric">
                                            <option value="">Seleccione la unidad</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    {!! Form::label('amount', 'Cantidad', array('class' => 'control-label')); !!}
                                    <div class="input-group">
                                        {!! Form::text('amount', null, array('id' => 'amount', 'class' => 'form-control mr-2', 'placeholder' => '##')) !!}
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
                        </div>
                    
<!--
                        <div class="text-center" style="color: royalblue;"><strong>Materiales requeridos</strong></div>
                        <div class="row">
                            <div class="col-md-7">
                                {!! Form::label('material_slt', 'Material', array('class' => 'control-label')); !!}
                                <div class="form-group">
                                    <select id="material_slt" name="material_slt">
                                        <option value="">Seleccione el material</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                {!! Form::label('metric', 'Unidad de medida', array('class' => 'control-label')); !!}
                                <div class="form-group">
                                    <select id="metric" name="metric">
                                        <option value="">Seleccione la unidad</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2">
                                {!! Form::label('amount', 'Cantidad', array('class' => 'control-label')); !!}
                                <div class="input-group">
                                    {!! Form::text('amount', null, array('id' => 'amount', 'class' => 'form-control mr-2', 'placeholder' => '##')) !!}
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
                        </div>-->
                        <hr>
                        {!! Form::hidden("tipo", "0", array('id' => 'tipo')) !!}
                        {!! Form::hidden("materials_list", '', array('id' => 'materials_list')) !!}
                        {!! Form::hidden("orderid", $report->id, array('id' => 'orderid')) !!}
                  
                        {!! Form::button(trans('Regresar'), array('class' => 'btn btn-info margin-bottom-1 mb-1 mr-2 float-right','type' => 'submit', 'id' => 'btn_enviar' )) !!}
                        {!! Form::button(trans('Solicitar Materiales Adicionales'), array('class' => 'btn btn-primary margin-bottom-1 mb-1 mr-2 float-right','type' => 'submit', 'id' => 'btn_materiales')) !!}
                        
                        {!! Form::close() !!}
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer_scripts')
    <script type="text/javascript" src="{{ config('atm_app.selectizeJsCDN') }}"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>



    <script>
        $(document).ready(function () {
            $('#btn_enviar').click(function(){
                $("#tipo").val("8");
                console.log($('form').submit());
            });
            $('#btn_materiales').click(function(){
                $("#tipo").val("9");
                $('form').submit();
            });
            $('form').submit(function(){
               
                //alert(tipo);
                //alert('I do something before the actual submission');
                return true;
            });

            $("#mat_escalera").change(function(){
                if($(this).is(':checked')) {
                    $("#cont_materiales").show();
                }else{
                    $("#cont_materiales").hide();
                }
            });
            $("#mat_bodega").change(function(){
                if($(this).is(':checked')) {
                    $("#cont_bodega").show();
                }else{
                    $("#cont_bodega").hide();
                }
            });

    

            let data = {!! json_encode($report->materials()->with(['material','metric_unit'])->get()) !!};
            let materials_tbl = $('#materials').DataTable({
                "paging": false,
                "ordering": false,
                "info": false,
                "searching": false,
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json'
                },
            });

//            $.each(data, function(index, val) {
//                materials_tbl.row.add([
//                    val.material.id,
//                    val.material.name,
//                    val.metric_unit.abbreviation,
//                    val.amount,
//                ]).draw(false);
//            });

            let serialize_table = function() {
                let data = [];
                let rows = materials_tbl.rows().data();
                for (let i=0; i<rows.length; i++) {
                    data.push({
                        'id': rows[i][0],
                        'metric': rows[i][2],
                        'amount': rows[i][3],
                    });
                }

                $('#materials_list').val(JSON.stringify(data));
            };

            let data2 = {!! json_encode($report->materials()->with(['material','metric_unit'])->get()) !!};
            let materials_tbl2 = $('#materials2').DataTable({
                "paging": false,
                "ordering": false,
                "info": false,
                "searching": false,
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json'
                },
            });

            $.each(data, function(index, val) {
                materials_tbl2.row.add([
                    val.material.id,
                    val.material.name,
                    val.metric_unit.abbreviation,
                    val.amount,
                ]).draw(false);
            });

            let serialize_table2 = function() {
                let data = [];
                let rows = materials_tbl2.rows().data();
                for (let i=0; i<rows.length; i++) {
                    data.push({
                        'id': rows[i][0],
                        'metric': rows[i][2],
                        'amount': rows[i][3],
                    });
                }

                $('#materials_list2').val(JSON.stringify(data));
            };

            $("#material_slt").selectize({
                allowClear: true,
                create: false,
                highlight: true,
                diacritics: true,
                options: {!! json_encode($materials) !!},
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

            $("#material_slt2").selectize({
                allowClear: true,
                create: false,
                highlight: true,
                diacritics: true,
                options: {!! json_encode($materials) !!},
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
                options: {!! json_encode($metrics) !!},
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

            $("#metric2").selectize({
                allowClear: true,
                create: false,
                highlight: true,
                diacritics: true,
                options: {!! json_encode($metrics) !!},
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

            $('#add-material').on('click', function () {
                let material = $.map($('#material_slt')[0].selectize.items, function(value) {
                    return $('#material_slt')[0].selectize.options[value];
                });
                let metric = $.map($('#metric')[0].selectize.items, function(value) {
                    return $('#metric')[0].selectize.options[value];
                });

                let amount = $('#amount').val();

                if (material.length > 0 && metric.length > 0 && amount.trim().length && Number.parseInt(amount) > 0) {
                    materials_tbl.row.add([
                        material[0].id,
                        material[0].name,
                        metric[0].abbreviation,
                        Number.parseInt(amount),
                    ]).draw(false);
                }
                else {
                    alert('Introduzca los valores requeridos.');
                }
                serialize_table();

                $('#material_slt')[0].selectize.clear();
                $('#metric')[0].selectize.clear();
                $('#amount').val('');
            });

            $('#add-material2').on('click', function () {
                let material = $.map($('#material_slt2')[0].selectize.items, function(value) {
                    return $('#material_slt2')[0].selectize.options[value];
                });
                let metric = $.map($('#metric2')[0].selectize.items, function(value) {
                    return $('#metric2')[0].selectize.options[value];
                });

                let amount = $('#amount2').val();

                if (material.length > 0 && metric.length > 0 && amount.trim().length && Number.parseInt(amount) > 0) {
                    materials_tbl2.row.add([
                        material[0].id,
                        material[0].name,
                        metric[0].abbreviation,
                        Number.parseInt(amount),
                    ]).draw(false);
                }
                else {
                    alert('Introduzca los valores requeridos.');
                }
                serialize_table2();

                $('#material_slt2')[0].selectize.clear();
                $('#metric2')[0].selectize.clear();
                $('#amount2').val('');
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
@endsection
