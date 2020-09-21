@extends('layouts.app')

@section('template_title')
    {!! trans('intersections.create-new-intersection') !!}
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
                            {!! trans('intersections.create-new-intersection') !!}
                            <div class="pull-right">
                                <a href="{{ route('intersections.index') }}" class="btn btn-light btn-sm float-right"
                                   data-toggle="tooltip" data-placement="left"
                                   title="{{ trans('intersections.tooltips.back-intersections') }}">
                                    <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                    {!! trans('intersections.buttons.back-to-intersections') !!}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        {!! Form::open(array('route' => 'intersections.store', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation', 'files' => true)) !!}

                        {!! csrf_field() !!}

                        <div class="row">
                            <div class="col-md-12">
                                <div id="map-canvas"></div>
                            </div>
                        </div>

                        <br>
                        <div class="text-right mb-2">
                        <a class="btn btn-info" onclick="get_location()">Ubicar en el Mapa</a>
                        </div>
                        <div class="form-group has-feedback row {{ $errors->has('latitude') ? ' has-error ' : '' }}">
                            {!! Form::label('latitude', trans('forms.create_vsignal_label_latitude'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('latitude', NULL, array('id' => 'latitude', 'class' => 'form-control', 'readonly' => 'readonly', 'placeholder' => trans('forms.create_vsignal_ph_latitude'))) !!}
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
                                    {!! Form::text('longitude', NULL, array('id' => 'longitude', 'class' => 'form-control', 'readonly' => 'readonly', 'placeholder' => trans('forms.create_vsignal_ph_longitude'))) !!}
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
                                    {!! Form::text('google_address', NULL, array('id' => 'google_address', 'class' => 'form-control', 'readonly' => 'readonly', 'placeholder' => trans('forms.create_vsignal_ph_gaddress'))) !!}
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

                        <div class="form-group has-feedback row {{ $errors->has('parish') ? ' has-error ' : '' }}">
                            {!! Form::label('parish', trans('forms.create_vsignal_label_parish'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="form-group mb-0">
                                    <select name="parish" id="parish">
                                        <option value="">{{ trans('forms.create_vsignal_ph_parish') }}</option>
                                        @if ($parishs)
                                            @foreach($parishs as $i => $value)
                                                <option value="{{ $value }}" {{ old('parish') == $value ? 'selected' : '' }}>{{ $value }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                @if ($errors->has('parish'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('parish') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('main_st') ? ' has-error ' : '' }}">
                            {!! Form::label('main_st', trans('forms.create_vsignal_label_main_st'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('main_st', NULL, array('id' => 'main_st', 'class' => 'form-control', 'placeholder' => trans('forms.create_vsignal_ph_main_st'))) !!}
                                    <div class="input-group-append">
                                        <label for="main_st" class="input-group-text">
                                            <i class="fa fa-fw {{ trans('forms.create_vsignal_icon_main_st') }}"
                                               aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                @if ($errors->has('main_st'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('main_st') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('cross_st') ? ' has-error ' : '' }}">
                            {!! Form::label('cross_st', trans('forms.create_vsignal_label_cross_st'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('cross_st', NULL, array('id' => 'cross_st', 'class' => 'form-control', 'placeholder' => trans('forms.create_vsignal_ph_cross_st'))) !!}
                                    <div class="input-group-append">
                                        <label for="cross_st" class="input-group-text">
                                            <i class="fa fa-fw {{ trans('forms.create_vsignal_icon_cross_st') }}"
                                               aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                @if ($errors->has('cross_st'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('cross_st') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group has-feedback row {{ $errors->has('parish') ? ' has-error ' : '' }}">
                            {!! Form::label('parish',"Calle 1", array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="form-group mb-0">
                                    <select name="street1" id="street1">
                                        <option value="">Seleccione la calle 1</option>
                                        @if ($parishs)
                                            @foreach($direction_unifieds as $i => $value)
                                                <option value="{{ $value['DIRECCION_UNIFICADA'] }}" {{ old('direction_unifieds') == $value ? 'selected' : '' }}>{{ $value['DIRECCION_UNIFICADA'] }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                @if ($errors->has('parish'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('parish') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group has-feedback row {{ $errors->has('parish') ? ' has-error ' : '' }}">
                            {!! Form::label('parish',"Calle 2", array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="form-group mb-0">
                                    <select name="street2" id="street2">
                                        <option value="">Seleccione la calle 2</option>
                                        @if ($parishs)
                                            @foreach($direction_unifieds as $i => $value)
                                                <option value="{{ $value['DIRECCION_UNIFICADA'] }}" {{ old('direction_unifieds') == $value ? 'selected' : '' }}>{{ $value['DIRECCION_UNIFICADA'] }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                @if ($errors->has('parish'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('parish') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('picture_data') ? ' has-error ' : '' }}">
                            {!! Form::label('picture', trans('forms.create_vsignal_label_picture'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::file('picture', array('id' => 'picture', 'placeholder' => trans('forms.create_vsignal_ph_picture'))) !!}
                                    {!! Form::hidden("picture_data", null, array('id' => 'picture_data')) !!}
                                    <div class="input-group-append">
                                        <label class="input-group-text" for="picture">
                                            <i class="fa fa-fw {{ trans('forms.create_vsignal_icon_picture') }}"
                                               aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                @if ($errors->has('picture_data'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('picture_data') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('comment') ? ' has-error ' : '' }}">
                            {!! Form::label('comment', trans('forms.create_vsignal_label_comment'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::textarea('comment', NULL, array('id' => 'comment', 'rows' => '3', 'class' => 'form-control', 'placeholder' => trans('forms.create_vsignal_ph_comment'))) !!}
                                    <div class="input-group-append">
                                        <label class="input-group-text" for="comment">
                                            <i class="fa fa-fw {{ trans('forms.create_vsignal_icon_comment') }}"
                                               aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                @if ($errors->has('comment'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('comment') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        {!! Form::button(trans('forms.create_intersection_button_text'), array('class' => 'btn btn-success margin-bottom-1 mb-1 float-right','type' => 'submit' )) !!}
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
            set_selectize_options = function (selectize, options) {
                selectize.disable();
                selectize.clear();
                selectize.clearOptions();
                selectize.renderCache['option'] = {};
                selectize.renderCache['item'] = {};
                selectize.addOption(options);
                selectize.enable();
            };
            $("#parish").selectize({
                allowClear: true,
                create: false,
                highlight: false,
                diacritics: true
            });
            
            
              $("#street1").selectize({
                allowClear: true,
                create: false,
                highlight: false,
                diacritics: true
            });
            
              $("#street2").selectize({
                allowClear: true,
                create: false,
                highlight: false,
                diacritics: true
            });
        });
    </script>
        @include('scripts.resize-image-before-upload')

    @if(true)//config('settings.googleMapsAPIStatus'))
        @include('scripts.google-maps-atm-create')
    @endif
@endsection
