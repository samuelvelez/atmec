@extends('layouts.app')

@section('template_title')
    {!! trans('intersections.editing-intersection', ['id' => $intersection->id]) !!}
@endsection


@section('template_fastload_css')
    .picture {
    height: 200px;
    width: auto;
    border: 2px solid #8eb4cb;
    }

    .pictureBg{
    background-image: url("{{ asset($intersection->get_picture_path()) }}");
    background-repeat: no-repeat;
    background-position: center center;
    background-size: cover;
    min-height: 300px;
    }

    #map-canvas{
    min-height: 300px;
    height: 100%;
    width: 100%;
    }
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
                            {!! trans('intersections.editing-intersection', ['id' => $intersection->id]) !!}
                            <div class="pull-right">
                                <a href="{{ route('intersections.index') }}" class="btn btn-light btn-sm float-right"
                                   data-toggle="tooltip" data-placement="top"
                                   title="{{ trans('intersections.tooltips.back-intersections') }}">
                                    <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                    {!! trans('intersections.buttons.back-to-intersections') !!}
                                </a>
                                <a href="{{ url('/intersections/' . $intersection->id) }}"
                                   class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="left"
                                   title="{{ trans('intersections.tooltips.back-intersections') }}">
                                    <i class="fa fa-fw fa-reply" aria-hidden="true"></i>
                                    {!! trans('intersections.buttons.back-to-intersection') !!}
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        {!! Form::open(array('route' => ['intersections.update', $intersection->id], 'method' => 'PUT', 'role' => 'form', 'class' => 'needs-validation', 'files' => true)) !!}

                        {!! csrf_field() !!}

                        <div class="row">
                            <div class="col-sm-4 col-md-6 pictureBg">
                            </div>
                            
                            <div class="col-md-6">
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
                                    {!! Form::text('latitude', $intersection->latitude, array('id' => 'latitude', 'class' => 'form-control', 'readonly' => 'readonly', 'placeholder' => trans('forms.create_vsignal_ph_latitude'))) !!}
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
                                    {!! Form::text('longitude', $intersection->longitude, array('id' => 'longitude', 'class' => 'form-control', 'readonly' => 'readonly', 'placeholder' => trans('forms.create_vsignal_ph_longitude'))) !!}
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
                                    {!! Form::text('google_address', $intersection->google_address, array('id' => 'google_address', 'class' => 'form-control', 'readonly' => 'readonly', 'placeholder' => trans('forms.create_vsignal_ph_gaddress'))) !!}
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
                                                <option value="{{ $value }}" {{ $intersection->parish == $value ? 'selected' : '' }}>{{ $value }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                @if ($errors->has('orientation'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('orientation') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('name') ? ' has-error ' : '' }}">
                            {!! Form::label('name', trans('Nombre de Intersecci贸n'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('name', $intersection->name, array('id' => 'name', 'class' => 'form-control', 'placeholder' => trans('Nombre de la Intersecci贸n'))) !!}
                                    <div class="input-group-append">
                                        <label for="main_st" class="input-group-text">
                                            <i class="fa fa-fw {{ trans('forms.create_vsignal_icon_main_st') }}"
                                               aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('main_st') ? ' has-error ' : '' }}">
                            {!! Form::label('main_st', trans('forms.create_vsignal_label_main_st'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('main_st', $intersection->main_st, array('id' => 'main_st', 'class' => 'form-control', 'placeholder' => trans('forms.create_vsignal_ph_main_st'))) !!}
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
                                    {!! Form::text('cross_st', $intersection->cross_st, array('id' => 'cross_st', 'class' => 'form-control', 'placeholder' => trans('forms.create_vsignal_ph_cross_st'))) !!}
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
                        
                        <div class="form-group has-feedback row {{ $errors->has('street1') ? ' has-error ' : '' }}">
                            {!! Form::label('parish', 'Calle 1', array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="form-group mb-0">
                                    <select name="street1" id="street1">
                                        <option value="">Seleccione la calle 1</option>
                                        @if ($parishs)
                                            @foreach($direction_unifieds as $i => $value)
                                                <option value="{{ $value['DIRECCION_UNIFICADA'] }}" {{ $intersection->street1 == $value['DIRECCION_UNIFICADA'] ? 'selected' : '' }}>{{ $value['DIRECCION_UNIFICADA'] }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                @if ($errors->has('orientation'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('orientation') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                        
                           <div class="form-group has-feedback row {{ $errors->has('street2') ? ' has-error ' : '' }}">
                            {!! Form::label('parish','Calle 2', array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="form-group mb-0">
                                    <select name="street2" id="street2">
                                        <option value="">Seleccione la calle 2</option>
                                        @if ($parishs)
                                            @foreach($direction_unifieds as $i => $value)
                                                <option value="{{ $value['DIRECCION_UNIFICADA'] }}" {{ $intersection->street2 == $value['DIRECCION_UNIFICADA'] ? 'selected' : '' }}>{{ $value['DIRECCION_UNIFICADA'] }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                @if ($errors->has('orientation'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('orientation') }}</strong>
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
                                    {!! Form::textarea('comment', $intersection->comment, array('id' => 'comment', 'rows' => '3', 'class' => 'form-control', 'placeholder' => trans('forms.create_vsignal_ph_comment'))) !!}
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
                        {!! Form::button(trans('forms.save-changes'), array('class' => 'btn btn-success margin-bottom-1 mb-1 float-right','type' => 'button', 'data-toggle' => 'modal', 'data-target' => '#confirmSave', 'data-title' => trans('modals.edit_user__modal_text_confirm_title'), 'data-message' => trans('modals.edit_user__modal_text_confirm_message'))) !!}
                        {!! Form::close() !!}
                    </div>

                </div>
            </div>
        </div>
    </div>

    @include('modals.modal-save')
    @include('modals.modal-delete')

@endsection

@section('footer_scripts')
<script type="text/javascript" src="{{ config('atm_app.selectizeJsCDN') }}"></script>

    <script type="text/javascript">
        $(function () {
            $("#parish").selectize({
                allowClear: true,
                create: false,
                highlight: true,
                diacritics: true
            });
            
             $("#street1").selectize({
                allowClear: true,
                create: false,
                highlight: true,
                diacritics: true
            });
            
             $("#street2").selectize({
                allowClear: true,
                create: false,
                highlight: true,
                diacritics: true
            });
        });
    </script>
    @include('scripts.delete-modal-script')
    @include('scripts.save-modal-script')
    @include('scripts.resize-image-before-upload')

    @if(config('settings.googleMapsAPIStatus'))
        @include('scripts.google-maps-atm-edit', [
            'latitude' => $intersection->latitude,
            'longitude' => $intersection->longitude,
            'google_address' => $intersection->google_address,
        ])
        @include('scripts.google-maps-atm-create')
    @endif
        
    
@endsection
