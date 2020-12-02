@extends('layouts.app')

@section('template_title')
    {!! trans('alerts.editing-alert', ['id' => $alert->id]) !!}
@endsection

@section('template_linked_css')
    @if(config('atm_app.enabledSelectizeJs'))
        <link rel="stylesheet" type="text/css" href="{{ config('atm_app.selectizeCssCDN') }}">
    @endif
@endsection

@section('template_fastload_css')
    #map-canvas{
    min-height: 300px;
    height: 100%;
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
                            Editando la orden #{!! $alert->id !!}
                            <div class="pull-right">
                                <a href="{{ route('ordenes.index') }}" class="btn btn-light btn-sm float-right"
                                   data-toggle="tooltip" data-placement="left"
                                   title="{{ trans('alerts.tooltips.back-alerts') }}">
                                    <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                    {!! trans('Regresar a las Ordenes') !!}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        {!! Form::open(array('route' => ['alerts.update', $alert->id], 'method' => 'PUT', 'role' => 'form', 'class' => 'needs-validation')) !!}

                        {!! csrf_field() !!}

                        <div class="row">
                            <div class="col-md-12">
                                <div id="map-canvas"></div>
                            </div>
                        </div>

                        <br>

                        <div class="row">
                            {!! Form::label('Intersección', trans('alerts.create_label_intersection'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="form-group">
                                    <select id="intersection" name="intersection">
                                        <option value="">Seleccione una intersección</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <div class="form-group has-feedback row {{ $errors->has('latitude') ? ' has-error ' : '' }}">
                            {!! Form::label('latitude', trans('forms.create_vsignal_label_latitude'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('latitude', $alert->latitude, array('id' => 'latitude', 'class' => 'form-control', 'placeholder' => trans('forms.create_vsignal_ph_latitude'))) !!}
                                    <div class="input-group-append">
                                        <label for="latitude" class="input-group-text">
                                            <i class="fa fa-fw {{ trans('forms.create_vsignal_icon_latitude') }}"
                                               aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                @if ($errors->has('latitude'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('latitude') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('longitude') ? ' has-error ' : '' }}">
                            {!! Form::label('longitude', trans('forms.create_vsignal_label_longitude'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('longitude', $alert->longitude, array('id' => 'longitude', 'class' => 'form-control', 'placeholder' => trans('forms.create_vsignal_ph_longitude'))) !!}
                                    <div class="input-group-append">
                                        <label for="longitude" class="input-group-text">
                                            <i class="fa fa-fw {{ trans('forms.create_vsignal_icon_longitude') }}"
                                               aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                @if ($errors->has('longitude'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('longitude') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('google_address') ? ' has-error ' : '' }}">
                            {!! Form::label('google_address', trans('forms.create_vsignal_label_gaddress'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('google_address', $alert->google_address, array('id' => 'google_address', 'class' => 'form-control', 'readonly' => 'readonly', 'placeholder' => trans('forms.create_vsignal_ph_gaddress'))) !!}
                                    <div class="input-group-append">
                                        <label for="google_address" class="input-group-text">
                                            <i class="fa fa-fw {{ trans('forms.create_vsignal_icon_gaddress') }}"
                                               aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                @if ($errors->has('google_address'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('google_address') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('collector') ? ' has-error ' : '' }}">
                            {!! Form::label('collector', 'Escalera', array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="form-group">
                                    <select name="collector" id="collector">
                                        <option value="">Seleccione una escalera</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group has-feedback row {{ $errors->has('priority') ? ' has-error ' : '' }}">
                            {!! Form::label('priority', 'Prioridad', array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="form-group">
                                    <select name="priority" id="priority">
                                        <option value="">Seleccione la prioridad</option>
                                    </select>
                                </div>
                                @if ($errors->has('priority'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('priority') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('longitude') ? ' has-error ' : '' }}">
                            {!! Form::label('motivoOrden', trans('Motivo de Orden de trabajo'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="form-group">
                                    <select name="motivoOrden" id="motivoOrden">
                                        <option value="">Seleccione un motivo</option>
                                    </select>
                                </div>
                                
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('tipo') ? ' has-error ' : '' }}">
                            {!! Form::label('tipo', trans('Tipo de Orden'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="form-group">
                                    <select name="tipoOrden" id="tipo">
                                        <option value="">Seleccione un tipo </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group has-feedback row {{ $errors->has('description') ? ' has-error ' : '' }}">
                            {!! Form::label('description', trans('alerts.create_label_description'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::textarea('description', $alert->description, array('id' => 'description', 'rows' => '3', 'class' => 'form-control', 'placeholder' => trans('alerts.create_ph_description'))) !!}
                                </div>
                                @if ($errors->has('description'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                        
                        <hr>
                        
                        
                        <div class="text-center" style="color: royalblue;"><strong>Datos del reporte</strong></div>

                        <div class="form-group has-feedback row {{ $errors->has('novelty') ? ' has-error ' : '' }}">
                            {!! Form::label('novelty', 'Novedad', array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="form-group">
                                    <select name="novelty" id="novelty">
                                        <option value="">Seleccione una novedad</option>
                                    </select>
                                </div>
                                @if ($errors->has('novelty'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('novelty') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('subnovelty') ? ' has-error ' : '' }}">
                            {!! Form::label('subnovelty', 'Subnovedad', array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="form-group">
                                    <select name="subnovelty" id="subnovelty">
                                        <option value="">Seleccione una subnovedad</option>
                                    </select>
                                </div>
                                @if ($errors->has('subnovelty'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('subnovelty') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('worktype') ? ' has-error ' : '' }}">
                            {!! Form::label('worktype', 'Tipo de trabajo', array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="form-group">
                                    <select name="worktype" id="worktype">
                                        <option value="">Seleccione el tipo de trabajo</option>
                                    </select>
                                </div>
                                @if ($errors->has('worktype'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('worktype') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('description') ? ' has-error ' : '' }}">
                            {!! Form::label('description', trans('reports.create_label_description'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::textarea('description', NULL, array('id' => 'description', 'rows' => '3', 'class' => 'form-control', 'placeholder' => trans('reports.create_ph_description'))) !!}
                                </div>
                                @if ($errors->has('description'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('pictures') ? ' has-error ' : '' }}">
                            {!! Form::label('pictures', trans('forms.create_vsignal_label_picture'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::file('pictures', array('id' => 'pictures', 'name' => 'pictures[]', 'placeholder' => trans('forms.create_vsignal_ph_picture'), 'multiple' => true)) !!}
                                </div>
                                @if ($errors->has('pictures'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('pictures') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                        
                        
                        

                        {!! Form::button(trans('alerts.edit_button_text'), array('class' => 'btn btn-primary margin-bottom-1 mb-1 float-right','type' => 'submit' )) !!}
                        {!! Form::close() !!}
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer_scripts')
    @include('scripts.delete-modal-script')
    @include('scripts.save-modal-script')
    <script type="text/javascript" src="{{ config('atm_app.selectizeJsCDN') }}"></script>

    <script>
        $(document).ready(function () {
        @role('atmoperator|atmadmin')
            $("#collector").selectize({
                allowClear: true,
                create: false,
                highlight: true,
                diacritics: true,
                options: {!! json_encode($collectors) !!},
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
            $("#collector")[0].selectize.addItem({{ $alert->collector_id }});
        @endrole

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
                            lat = {{env('APP_DEFAULT_LAT') ? env('APP_DEFAULT_LAT') : -2.1894128  }};
                            lng = {{ env('APP_DEFAULT_LNG') ? env('APP_DEFAULT_LNG') : -79.8890662 }};
                        }

                        //show_location(lat, lng);
                    }
                },
                options: {!! json_encode($intersections) !!},
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
            $("#intersection")[0].selectize.addItem({{ $alert->priority_id }});
            

            $("#priority").selectize({
                allowClear: true,
                create: false,
                highlight: true,
                diacritics: true,
                options: {!! json_encode($priorities) !!},
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
                            + '<span>' + escape(item.name) + '</span>'
                            + '</div>';
                    }
                },
            });
            $("#priority")[0].selectize.addItem({{ $alert->priority_id }});

            $("#motivoOrden").selectize({
                allowClear: true,
                create: false,
                highlight: true,
                diacritics: true,
                options: {!! json_encode($motivos) !!},
                valueField: 'id',
                labelField: ['description'],
                searchField: ['id', 'description'],
                render: {
                    option: function (item, escape) {
                        return '<div>'
                            + '<span>' + escape(item.description) + '</span>'
                            + '</div>';
                    },
                    item: function (item, escape) {
                        return '<div>'
                            + '<span>' + escape(item.description) + '</span>'
                            + '</div>';
                    }
                },
            });
            $("#motivoOrden")[0].selectize.addItem({{ $alert->reason }});

            $("#tipo").selectize({
                allowClear: true,
                create: false,
                highlight: true,
                diacritics: true,
                options: {!! json_encode($tipos) !!},
                valueField: 'id',
                labelField: ['description'],
                searchField: ['id', 'description'],
                render: {
                    option: function (item, escape) {
                        return '<div>'
                            + '<span>' + escape(item.description) + '</span>'
                            + '</div>';
                    },
                    item: function (item, escape) {
                        return '<div>'
                            + '<span>' + escape(item.description) + '</span>'
                            + '</div>';
                    }
                },
            });
            $("#tipo")[0].selectize.addItem({{ $alert->tipoOrden }});

            //show_location({{ $alert->latitude }}, {{ $alert->longitude }});
        });
        
        
        //PARA REPORTE
        
        $("#novelty").selectize({
                allowClear: true,
                create: false,
                highlight: true,
                diacritics: true,
                options: {!! json_encode($novelties) !!},
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
                            + '<span>' + escape(item.name) + '</span>'
                            + '</div>';
                    }
                },
            });

            $("#subnovelty").selectize({
                allowClear: true,
                create: false,
                highlight: true,
                diacritics: true,
                options: {!! json_encode($subnovelties) !!},
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
                            + '<span>' + escape(item.name) + '</span>'
                            + '</div>';
                    }
                },
            });

            $("#worktype").selectize({
                allowClear: true,
                create: false,
                highlight: true,
                diacritics: true,
                options: {!! json_encode($worktypes) !!},
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
                            + '<span>' + escape(item.name) + '</span>'
                            + '</div>';
                    }
                },
            });
        
        
//        $("#novelty").selectize({
//                allowClear: true,
//                create: false,
//                highlight: true,
//                diacritics: true,
//                           
//            });
//            
//        $("#subnovelty").selectize({
//                allowClear: true,
//                create: false,
//                highlight: true,
//                diacritics: true,
//                valueField: 'id',
//                labelField: ['name'],
//                searchField: ['id', 'name'],                
//            });
//            
//              $("#worktype").selectize({
//                allowClear: true,
//                create: false,
//                highlight: true,
//                diacritics: true,
//                options: {!! json_encode($priorities) !!},
//                valueField: 'id',
//                labelField: ['name'],
//                searchField: ['id', 'name'],                
//            });
            
            
        
    </script>

    @if(config('settings.googleMapsAPIStatus'))
        @include('scripts.show-alert')
    @endif
@endsection
