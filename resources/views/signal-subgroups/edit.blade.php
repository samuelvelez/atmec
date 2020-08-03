@extends('layouts.app')

@section('template_title')
    {!! trans('signal-subgroups.editing-signal-subgroup', ['id' => $subgroup->id]) !!}
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
                            {!! trans('signal-subgroups.editing-signal-subgroup', ['id' => $subgroup->id]) !!}
                            <div class="pull-right">
                                <a href="{{ route('signal-subgroups.index') }}"
                                   class="btn btn-light btn-sm float-right"
                                   data-toggle="tooltip" data-placement="top"
                                   title="{{ trans('signal-subgroups.tooltips.back-to-signal-subgroups') }}">
                                    <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                    {!! trans('signal-subgroups.buttons.back-to-signal-subgroups') !!}
                                </a>
                                <a href="{{ url('/signal-subgroups/' . $subgroup->id) }}"
                                   class="btn btn-light btn-sm float-right"
                                   data-toggle="tooltip" data-placement="left"
                                   title="{{ trans('signal-subgroups.tooltips.back-to-signal-subgroup') }}">
                                    <i class="fa fa-fw fa-reply" aria-hidden="true"></i>
                                    {!! trans('signal-subgroups.buttons.back-to-signal-subgroup') !!}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        {!! Form::open(array('route' => ['signal-subgroups.update', $subgroup->id], 'method' => 'PUT', 'role' => 'form', 'class' => 'needs-validation')) !!}

                        {!! csrf_field() !!}

                        <div class="form-group has-feedback row {{ $errors->has('code') ? ' has-error ' : '' }}">
                            {!! Form::label('code', trans('signal-subgroups.create_label_code'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('code', $subgroup->code, array('id' => 'code', 'class' => 'form-control', 'placeholder' => trans('signal-subgroups.create_ph_code'))) !!}
                                </div>
                                @if ($errors->has('code'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('code') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('name') ? ' has-error ' : '' }}">
                            {!! Form::label('name', trans('signal-subgroups.create_label_name'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('name', $subgroup->name, array('id' => 'name', 'class' => 'form-control', 'placeholder' => trans('signal-subgroups.create_ph_name'))) !!}
                                </div>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('group') ? ' has-error ' : '' }}">
                            {!! Form::label('group', trans('signal-subgroups.create_label_group'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="form-group">
                                    <select name="group" id="group">
                                        <option value="">{{ trans('signal-subgroups.create_ph_group') }}</option>
                                        @if ($groups)
                                            @foreach($groups as $group)
                                                <option value="{{ $group->id }}" {{ $subgroup->group_id == $group->id ? 'selected' : '' }}>{{ $group->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('shape') ? ' has-error ' : '' }}">
                            {!! Form::label('shape', trans('signal-subgroups.create_label_shape'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="form-group">
                                    <select name="shape" id="shape">
                                        <option value="">{{ trans('signal-subgroups.create_ph_shape') }}</option>
                                        @if ($shapes)
                                            @foreach($shapes as $id => $value)
                                                <option value="{{ $value }}" {{ $subgroup->shape == $value ? 'selected' : '' }}>{{ $value }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('colors') ? ' has-error ' : '' }}">
                            {!! Form::label('colors', trans('signal-subgroups.create_label_colors'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="form-group">
                                    <select name="colors[]" id="colors">
                                        <option value="">{{ trans('signal-subgroups.create_ph_colors') }}</option>
                                        @if ($colors)
                                            @foreach($colors as $id => $value)
                                                <option value="{{ $value }}" {{ in_array($value, (array)json_decode($subgroup->colors)) ? 'selected="selected"' : '' }}>{{ $value }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('description') ? ' has-error ' : '' }}">
                            {!! Form::label('description', trans('signal-subgroups.create_label_description'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::textarea('description', $subgroup->description, array('id' => 'description', 'rows' => '3', 'class' => 'form-control', 'placeholder' => trans('signal-subgroups.create_ph_description'))) !!}
                                </div>
                                @if ($errors->has('description'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>


                        {!! Form::button(trans('forms.save-changes'), array('class' => 'btn btn-primary margin-bottom-1 mb-1 float-right','type' => 'submit' )) !!}
                        {!! Form::close() !!}
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer_scripts')
    <script type="text/javascript" src="{{ config('atm_app.selectizeJsCDN') }}"></script>

    <script type="text/javascript">
        $(function () {
            $("#group").selectize({
                allowClear: true,
                create: false,
                highlight: true,
                diacritics: true
            });

            $("#shape").selectize({
                allowClear: true,
                create: false,
                highlight: true,
                diacritics: true
            });

            $("#colors").selectize({
                allowClear: true,
                plugins: ['remove_button'],
                maxItems: null,
                create: false,
                highlight: true,
                diacritics: true
            });
        });
    </script>
@endsection

