@extends('layouts.app')

@section('template_title')
    {!! trans('workorders.closing-workorder', ['id' => $workorder->id]) !!}
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            {!! trans('workorders.closing-workorder', ['id' => $workorder->id]) !!}
                            <div class="pull-right">
                                <a href="{{ route('workorders.index') }}" class="btn btn-light btn-sm float-right"
                                   data-toggle="tooltip" data-placement="left"
                                   title="{{ trans('workorders.tooltips.back-workorders') }}">
                                    <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                    {!! trans('workorders.buttons.back-to-workorders') !!}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        {!! Form::open(array('url' => 'workorders/' . $workorder->id . '/close', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation', 'files' => true)) !!}

                        {!! csrf_field() !!}

                        <div class="row">
                            <div class="col-md-12">
                                <p>Adjunte las fotos de los cambios realizados. Si es necesario realice algunas precisiones.</p>
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('pictures') ? ' has-error ' : '' }}">
                            {!! Form::label('pictures', 'Fotos', array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::file('pictures', array('id' => 'pictures', 'name' => 'pictures[]', 'placeholder' => 'Adjunte las fotos', 'multiple' => true)) !!}
                                </div>
                                @if ($errors->has('pictures'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('pictures') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('description') ? ' has-error ' : '' }}">
                            {!! Form::label('description', trans('workorders.create_label_description'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::textarea('description', null, array('id' => 'description', 'rows' => '3', 'class' => 'form-control', 'placeholder' => 'Detalles del cierre de orden.')) !!}
                                </div>
                                @if ($errors->has('description'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        {!! Form::button(trans('workorders.edit_button_text'), array('class' => 'btn btn-primary margin-bottom-1 mb-1 float-right','type' => 'submit' )) !!}
                        {!! Form::close() !!}
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
