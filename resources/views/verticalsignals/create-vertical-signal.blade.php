@extends('layouts.app')

@section('template_title')
    {!! trans('verticalsignals.create-new-vsignal') !!}
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
                            {!! trans('verticalsignals.create-new-vsignal') !!}
                            <div class="pull-right">
                                <a href="{{ URL::to('vertical-signals/') }}" class="btn btn-light btn-sm float-right"
                                   data-toggle="tooltip" data-placement="left"
                                   title="{{ trans('verticalsignals.tooltips.back-vsignals') }}">
                                    <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                    {!! trans('verticalsignals.buttons.back-to-vsignals') !!}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        {!! Form::open(array('id' => 'vsignal_form', 'route' => 'vertical-signals.store', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation', 'files' => true)) !!}

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

                        <div class="form-group has-feedback row {{ $errors->has('orientation') ? ' has-error ' : '' }}">
                            {!! Form::label('orientation', trans('forms.create_vsignal_label_orientation'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="form-group mb-0">
                                    <select name="orientation" id="orientation">
                                        <option value="">{{ trans('forms.create_vsignal_ph_orientation') }}</option>
                                        @if ($orientations)
                                            @foreach($orientations as $i => $value)
                                                <option value="{{ $value }}" {{ old('orientation') == $value ? 'selected' : '' }}>{{ $value }}</option>
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
                        <div class="form-group has-feedback row {{ $errors->has('parish') ? ' has-error ' : '' }}">
                            {!! Form::label('parish', trans('forms.create_vsignal_label_parish'), array('class' => 'col-md-3 control-label')); !!}
                            <!--<div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('parish', NULL, array('id' => 'google_address', 'class' => 'form-control', 'placeholder' => trans('forms.create_vsignal_ph_parish'))) !!}
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
                            </div>-->
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

                        <div class="form-group has-feedback row {{ $errors->has('neighborhood') ? ' has-error ' : '' }}">
                            {!! Form::label('neighborhood', trans('forms.create_vsignal_label_neighborhood'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('neighborhood', NULL, array('id' => 'code', 'class' => 'form-control', 'placeholder' => trans('forms.create_vsignal_ph_neighborhood'))) !!}
                                    <div class="input-group-append">
                                        <label for="neighborhood" class="input-group-text">
                                            <i class="fa fa-fw {{ trans('forms.create_vsignal_icon_neighborhood') }}"
                                               aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                @if ($errors->has('neighborhood'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('neighborhood') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group has-feedback row {{ $errors->has('parish') ? ' has-error ' : '' }}">
                            {!! Form::label('direction_unifieds', "Calle 1", array('class' => 'col-md-3 control-label')); !!}
                          
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
                            {!! Form::label('direction_unifieds', "Calle 2", array('class' => 'col-md-3 control-label')); !!}
                          
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

                        <div class="form-group has-feedback row {{ $errors->has('code') ? ' has-error ' : '' }}">
                            {!! Form::label('code', trans('forms.create_vsignal_label_code'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('code', NULL, array('id' => 'code', 'class' => 'form-control', 'placeholder' => trans('forms.create_vsignal_ph_code'))) !!}
                                    <div class="input-group-append">
                                        <label for="code" class="input-group-text">
                                            <i class="fa fa-fw {{ trans('forms.create_vsignal_icon_code') }}"
                                               aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                @if ($errors->has('code'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('code') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('erp_code') ? ' has-error ' : '' }}">
                            {!! Form::label('erp_code', trans('forms.create_vsignal_label_erp_code'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('erp_code', NULL, array('id' => 'erp_code', 'class' => 'form-control', 'placeholder' => trans('forms.create_vsignal_ph_erp_code'))) !!}
                                    <div class="input-group-append">
                                        <label for="erp_code" class="input-group-text">
                                            <i class="fa fa-fw {{ trans('forms.create_vsignal_icon_erp_code') }}"
                                               aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                @if ($errors->has('erp_code'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('erp_code') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('inventory') ? ' has-error ' : '' }}">
                            {!! Form::label('inventory', trans('forms.create_vsignal_label_inventory'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="form-group">
                                    <select name="inventory" id="inventory">
                                        <option value="">{{ trans('forms.create_vsignal_ph_inventory') }}</option>
                                        @if ($sinventories)
                                            @foreach($sinventories as $sinventory)
                                                <option value="{{ $sinventory->id }}" {{ old('inventory') == $sinventory->id ? 'selected' : '' }}>{{ $sinventory->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                @if ($errors->has('inventory'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('inventory') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('fastener') ? ' has-error ' : '' }}">
                            {!! Form::label('fastener', trans('forms.create_vsignal_label_fastener'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="form-group">
                                    <select name="fastener" id="fastener">
                                        <option value="">{{ trans('forms.create_vsignal_ph_fastener') }}</option>
                                        @if ($fasteners)
                                            @foreach($fasteners as $i => $value)
                                                <option value="{{ $value }}" {{ old('fastener') == $value ? 'selected' : '' }}>{{ $value }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                @if ($errors->has('fastener'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('fastener') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('variation') ? ' has-error ' : '' }}">
                            {!! Form::label('variation', trans('forms.create_vsignal_label_variation'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="form-group">
                                    <select name="variation" id="variation">
                                        {{--<option value="">{{ trans('forms.create_vsignal_ph_variation') }}</option>
                                        @if ($sinventories)
                                            @foreach($sinventories as $sinventory)
                                                <option value="{{ $sinventory->id }}" {{ old('inventory') == $sinventory->id ? 'selected' : '' }}>{{ $sinventory->name }}</option>
                                            @endforeach
                                        @endif--}}
                                    </select>
                                </div>
                                @if ($errors->has('variation'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('variation') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        

                        <div class="form-group has-feedback row {{ $errors->has('material') ? ' has-error ' : '' }}">
                            {!! Form::label('material', trans('forms.create_vsignal_label_material'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="form-group">
                                    <select name="material" id="material">
                                        <option value="">{{ trans('forms.create_vsignal_ph_material') }}</option>
                                        @if ($materials)
                                            @foreach($materials as $i => $value)
                                                <option value="{{ $value }}" {{ old('material') == $value ? 'selected' : '' }}>{{ $value }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                @if ($errors->has('material'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('material') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('normative') ? ' has-error ' : '' }}">
                            {!! Form::label('normative', trans('forms.create_vsignal_label_normative'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="form-group">
                                    <select name="normative" id="normative">
                                        <option value="">{{ trans('forms.create_vsignal_ph_normative') }}</option>
                                        @if ($normatives)
                                            @foreach($normatives as $i => $value)
                                                <option value="{{ $value }}" {{ old('normative') == $value ? 'selected' : '' }}>{{ $value }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                @if ($errors->has('normative'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('normative') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('state') ? ' has-error ' : '' }}">
                            {!! Form::label('state', trans('forms.create_vsignal_label_state'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="form-group">
                                    <select name="state" id="state">
                                        <option value="">{{ trans('forms.create_vsignal_ph_state') }}</option>
                                        @if ($states)
                                            @foreach($states as $i => $value)
                                                <option value="{{ $value }}" {{ old('state') == $value ? 'selected' : '' }}>{{ $value }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                @if ($errors->has('state'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('state') }}</strong>
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

                        {!! Form::button(trans('forms.create_vsignal_button_text'), array('class' => 'btn btn-success margin-bottom-1 mb-1 float-right','type' => 'submit' )) !!}
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

            $("#inventory").selectize({
                allowClear: true,
                create: false,
                highlight: true,
                diacritics: true,
                onChange: function (value) {
                    if (!value.length) return;
                    let variation = $("#variation")[0].selectize;
                    variation.disable();
                    variation.clear();
                    variation.clearOptions();
                    variation.load(function(query, callback) {
                        var xhr;
                        xhr && xhr.abort();
                        xhr = $.ajax({
                            url: '{{ route('variations-by-signal') }}',
                            data: {id: value},
                            dataType: "json",
                            success: function(results) {
                                variation.addOption(results);
                                variation.enable();
                                callback(results);
                            },
                            error: function() {
                                callback();
                            }
                        })
                    });
                },
            });

            $("#variation").selectize({
                allowClear: true,
                create: false,
                highlight: true,
                diacritics: true,
                selectOnTab: true,
                valueField: 'id',
                labelField: 'variation',
                searchField: ['variation', 'dimension'],
                render: {
                    option: function (item, escape) {
                        return '<div>'
                            + '<span>' + escape(item.variation) + ' (' + escape(item.dimension) + ')</span>'
                            + '</div>';
                    },
                    item: function (item, escape) {
                        return '<div>'
                            + '<span>' + escape(item.variation) + ' (' + escape(item.dimension) + ')</span>'
                            + '</div>';
                    }
                },
            });
            $("#variation")[0].selectize.disable();

            $("#fastener").selectize({
                allowClear: true,
                create: false,
                highlight: true,
                diacritics: true
            });

            $("#material").selectize({
                allowClear: true,
                create: false,
                highlight: true,
                diacritics: true
            });

            $("#normative").selectize({
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

            $("#state").selectize({
                allowClear: true,
                create: false,
                highlight: true,
                diacritics: true
            });

            $("#orientation").selectize({
                allowClear: true,
                create: false,
                highlight: true,
                diacritics: true
            });
            $("#parish").selectize({
                allowClear: true,
                create: false,
                highlight: true,
                diacritics: true
            });
        });
    </script>

    @if(config('settings.googleMapsAPIStatus'))
        @include('scripts.google-maps-atm-create')
    @endif

    @include('scripts.resize-image-before-upload')
@endsection
