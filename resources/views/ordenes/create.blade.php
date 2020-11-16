@extends('layouts.app')

@section('template_title')
    {!! trans('alerts.create-new-alert') !!}
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
                            {!! trans('Nueva Orden de trabajo') !!}
                            <div class="pull-right">
                                <a href="{{ route('alerts.index') }}" class="btn btn-light btn-sm float-right"
                                   data-toggle="tooltip" data-placement="left"
                                   title="{{ trans('alerts.tooltips.back-alerts') }}">
                                    <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                    {!! trans('Regresar a Ordenes') !!}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        {!! Form::open(array('route' => 'ordenes.store', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation')) !!}

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
                                    {!! Form::text('latitude', NULL, array('id' => 'latitude', 'class' => 'form-control', 'placeholder' => trans('forms.create_vsignal_ph_latitude'))) !!}
                                    <div class="input-group-append" onclick="ubicar()"><label for="name" class="input-group-text"><i aria-hidden="true" class="fa fa-map-marker"></i></label></div>
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
                                    {!! Form::text('longitude', NULL, array('id' => 'longitude', 'class' => 'form-control', 'placeholder' => trans('forms.create_vsignal_ph_longitude'))) !!}
                                    <div class="input-group-append" onclick="ubicar()"><label for="name" class="input-group-text"><i aria-hidden="true" class="fa fa-map-marker"></i></label></div>
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
                                    {!! Form::text('google_address', "ok", array('id' => 'google_address', 'class' => 'form-control', 'readonly' => 'readonly', 'placeholder' => trans('forms.create_vsignal_ph_gaddress'))) !!}
                                </div>
                                @if ($errors->has('google_address'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('google_address') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        @role('atmadmin|atmoperator|ccitt')
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
                        @endrole

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
                                    {!! Form::textarea('description', NULL, array('id' => 'description', 'rows' => '3', 'class' => 'form-control', 'placeholder' => trans('alerts.create_ph_description'))) !!}
                                </div>
                                @if ($errors->has('description'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        {!! Form::button(trans('alerts.create_button_text'), array('class' => 'btn btn-success margin-bottom-1 mb-1 float-right','type' => 'submit' )) !!}
                        {!! Form::close() !!}
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer_scripts')
    <script type="text/javascript" src="{{ config('atm_app.selectizeJsCDN') }}"></script>
        
    <script>
        $(document).ready(function () {
        @role('atmadmin|atmoperator|ccitt')
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
                            lat = {{ env('APP_DEFAULT_LAT') ? env('APP_DEFAULT_LAT') : -2.1894128 }};
                            lng = {{ env('APP_DEFAULT_LNG') ? env('APP_DEFAULT_LNG') : -79.8890662 }};
                        }

                        show_location(lat, lng);
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
        });
    </script>

    @if(true)
    //config('settings.googleMapsAPIStatus')
        @include('scripts.show-alert')
    @endif
@endsection
