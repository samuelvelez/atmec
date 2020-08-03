@extends('layouts.app')

@section('template_title')
    {!! trans('metric-units.editing-metric', ['id' => $metric->id]) !!}
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            {!! trans('metric-units.editing-metric', ['id' => $metric->id]) !!}
                            <div class="pull-right">
                                <a href="{{ route('metric-units.index') }}" class="btn btn-light btn-sm float-right"
                                   data-toggle="tooltip" data-placement="left"
                                   title="{{ trans('metric-units.tooltips.back-metrics') }}">
                                    <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                    {!! trans('metric-units.buttons.back-to-metrics') !!}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        {!! Form::open(array('route' => ['metric-units.update', $metric->id], 'method' => 'PUT', 'role' => 'form', 'class' => 'needs-validation')) !!}

                        {!! csrf_field() !!}

                        <div class="form-group has-feedback row {{ $errors->has('name') ? ' has-error ' : '' }}">
                            {!! Form::label('name', trans('metric-units.create_label_name'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('name', $metric->name, array('id' => 'name', 'class' => 'form-control', 'placeholder' => trans('metric-units.create_ph_name'))) !!}
                                </div>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('abbreviation') ? ' has-error ' : '' }}">
                            {!! Form::label('abbreviation', trans('metric-units.create_label_abbreviation'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('abbreviation', $metric->abbreviation, array('id' => 'abbreviation', 'class' => 'form-control', 'placeholder' => trans('metric-units.create_ph_abbreviation'))) !!}
                                </div>
                                @if ($errors->has('abbreviation'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('abbreviation') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('description') ? ' has-error ' : '' }}">
                            {!! Form::label('description', trans('metric-units.create_label_description'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::textarea('description', $metric->description, array('id' => 'description', 'rows' => '3', 'class' => 'form-control', 'placeholder' => trans('metric-units.create_ph_description'))) !!}
                                </div>
                                @if ($errors->has('description'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        {!! Form::button(trans('metric-units.edit_button_text'), array('class' => 'btn btn-success margin-bottom-1 mb-1 float-right','type' => 'submit' )) !!}
                        {!! Form::close() !!}
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
