@extends('layouts.app')

@section('template_title')
    {!! trans('device-types.create-new-devicetype') !!}
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
                            {!! trans('device-types.create-new-devicetype') !!}
                            <div class="pull-right">
                                <a href="{{ route('device-types.index') }}" class="btn btn-light btn-sm float-right"
                                   data-toggle="tooltip" data-placement="left"
                                   title="{{ trans('device-types.tooltips.back-signal-subgroups') }}">
                                    <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                    {!! trans('device-types.buttons.back-to-brands') !!}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        {!! Form::open(array('route' => 'device-types.store', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation')) !!}

                        {!! csrf_field() !!}

                        <div class="form-group has-feedback row {{ $errors->has('code') ? ' has-error ' : '' }}">
                            {!! Form::label('code', trans('device-types.create_label_description'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
{!! Form::text('description', NULL, array('id' => 'description', 'class' => 'form-control', 'placeholder' => trans('device-types.create_ph_description'))) !!}
                                </div>
                                @if ($errors->has('code'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group has-feedback row {{ $errors->has('group') ? ' has-error ' : '' }}">
                            {!! Form::label('group', trans('device-types.create_label_type'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="form-group">
                                    <select name="devicetype" id="group">
                                        <option value="">{{ trans('device-types.create_ph_type') }}</option>
                                        
                                        @if ($brandstypes)
                                            @foreach($brandstypes as $brandstype)
                                                <option value="{{ $brandstype['id'] }}" {{ old('brandstype') == $brandstype ? 'selected' : '' }}>{{ $brandstype['description'] }}</option>
                                            
                                                <!--<option value="{{ $brandstype->id }}" {{ old('brandstype') == $brandstype->id ? 'selected' : '' }}>{{ $brandstype->description }}</option>-->
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>

<!--                        <div class="form-group has-feedback row {{ $errors->has('shape') ? ' has-error ' : '' }}">
                            {!! Form::label('shape', trans('signal-subgroups.create_label_shape'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="form-group">
                                    <select name="shape" id="shape">
                                        <option value="">{{ trans('signal-subgroups.create_ph_shape') }}</option>
                                        @if ($shapes)
                                            @foreach($shapes as $id => $value)
                                                <option value="{{ $value }}" {{ old('shape') == $value ? 'selected' : '' }}>{{ $value }}</option>
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
                                                <option value="{{ $value }}" {{ old('colors') == $value ? 'selected' : '' }}>{{ $value }}</option>
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
                                    {!! Form::textarea('description', NULL, array('id' => 'description', 'rows' => '3', 'class' => 'form-control', 'placeholder' => trans('signal-subgroups.create_ph_description'))) !!}
                                </div>
                                @if ($errors->has('description'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>-->

                        {!! Form::button(trans('signal-subgroups.create_button_text'), array('class' => 'btn btn-success margin-bottom-1 mb-1 float-right','type' => 'submit' )) !!}
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
