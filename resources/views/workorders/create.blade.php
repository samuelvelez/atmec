@extends('layouts.app')

@section('template_title')
    {!! trans('workorders.create-new-workorder') !!}
@endsection

@section('template_linked_css')
    @if(config('atm_app.enabledSelectizeJs'))
        <link rel="stylesheet" type="text/css" href="{{ config('atm_app.selectizeCssCDN') }}">
    @endif
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            {!! trans('Finalizar Orden de trabajo') !!}
                            <div class="pull-right">
                                <a href="{{ route('workorders.index') }}" class="btn btn-light btn-sm float-right"
                                   data-toggle="tooltip" data-placement="left"
                                   title="{{ trans('Regresar') }}">
                                    <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                    {!! trans('Regresar a las ordenes de trabajo') !!}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="form-group row">
                            {!! Form::label('report_collector', 'Escalera Asignada', array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('report_collector', $report->alert->collector->full_name(), array('id' => 'report_collector', 'class' => 'form-control', 'readonly' => 'readonly')) !!}
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            {!! Form::label('report_address', 'Dirección Google de la alerta', array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('report_address', $report->alert->google_address, array('id' => 'report_address', 'class' => 'form-control', 'readonly' => 'readonly')) !!}
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            {!! Form::label('alert_description', 'Descripción del Reporte Inicial', array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::textarea('alert_description', $report->alert->description, array('id' => 'alert_description', 'rows' => '2', 'class' => 'form-control', 'readonly' => 'readonly')) !!}
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            {!! Form::label('report_description', 'Descripción del reporte en el sitio', array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::textarea('report_description', $report->description, array('id' => 'report_description', 'rows' => '2', 'class' => 'form-control', 'readonly' => 'readonly')) !!}
                                </div>
                            </div>
                        </div>
                        <hr/>

                        {!! Form::open(array('route' => 'workorders.store', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation', 'files' => true)) !!}

                        {!! csrf_field() !!}

                        <div class="form-group has-feedback row {{ $errors->has('collector') ? ' has-error ' : '' }}">
                            {!! Form::label('collector', 'Escalera', array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="form-group">
                                    <select name="collector" id="collector">
                                        <option value="">Seleccione una escalera</option>
                                    </select>
                                </div>
                                @if ($errors->has('collector'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                @endif
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
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('description') ? ' has-error ' : '' }}">
                            {!! Form::label('description', trans('workorders.create_label_description'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::textarea('description', NULL, array('id' => 'description', 'rows' => '3', 'class' => 'form-control', 'placeholder' => trans('workorders.create_ph_description'))) !!}
                                </div>
                                @if ($errors->has('description'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
<!--                        <div class="form-group has-feedback row {{ $errors->has('description') ? ' has-error ' : '' }}">
                            {!! Form::label('description', trans('workorders.create_label_description'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    @if ($alertas)
                                            @foreach($alertas as $alerta)
                                    {!! Form::text('description', $alerta->description , array('id' => 'description', 'rows' => '3', 'class' => 'form-control' , 'placeholder' => trans('workorders.create_ph_description'))) !!}
                                  @endforeach
                                        @endif
                                </div>
                                    <span class="help-block">
                                            <strong></strong>
                                        </span>
                            </div>
                        </div>                        -->
                     

                        
                        {!! Form::hidden("report", $report->id, array('id' => 'report')) !!}
                        {!! Form::button(trans('workorders.create_button_text'), array('class' => 'btn btn-success margin-bottom-1 mb-1 float-right','type' => 'submit' )) !!}
                        {!! Form::close() !!}
                    </div>
                    <a class="btn btn-sm btn-info btn-block"
                        href="{{ URL::to('ordenes/' . $report->alert['id'] . '/edit') }}"
                        data-toggle="tooltip" title="Orden">
                        Ver Orden de trabajo
                    </a>
                    @if (Auth::user()->hasRole('atmoperator') && !$report)
                    <a class="btn btn-sm btn-info btn-block"
                        href="{{ URL::to('report/' . $report->id . '/edit') }}"
                        data-toggle="tooltip" title="Orden">
                        Ver Inspección
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer_scripts')
    <script type="text/javascript" src="{{ config('atm_app.selectizeJsCDN') }}"></script>

    @role('atmoperator|ccitt|atmadmin')
    <script>
        $(document).ready(function () {
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
        });
    </script>
    @endrole

    @if(config('settings.googleMapsAPIStatus'))
        @include('scripts.google-maps-atm-create')
    @endif
@endsection
