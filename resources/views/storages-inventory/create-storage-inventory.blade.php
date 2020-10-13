@extends('layouts.app')

@section('template_title')
    {!! trans('device-inventory.create-new-device-inventory') !!}
@endsection

@section('template_linked_css')
    @if(config('atm_app.enabledSelectizeJs'))
        <link rel="stylesheet" type="text/css" href="{{ config('atm_app.selectizeCssCDN') }}">
    @endif
@endsection


@section('template_fastload_css')
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            {!! trans('Agregar Producto a Bodega') !!}
                            <div class="pull-right">
                                <a href="{{ route('devices-inventory.index') }}" class="btn btn-light btn-sm float-right"
                                   data-toggle="tooltip" data-placement="left"
                                   title="{{ trans('device-inventory.tooltips.back-device-inventories') }}">
                                    <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                    {!! trans('Regresar al listado') !!}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        {!! Form::open(array('route' => 'storage-inventory.store', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation')) !!}

                        {!! csrf_field() !!}

                        <div class="form-group has-feedback row {{ $errors->has('storage') ? ' has-error ' : '' }}">
                            {!! Form::label('storage', "Bodega", array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="form-group">
                                    <select name="storage" id="storage">
                                        <option value="">{{ trans('Seleccione una Bodega') }}</option>
                                        @if ($storages)
                                            @foreach($storages as  $value)
                                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('storage') ? ' has-error ' : '' }}">
                            {!! Form::label('product', "Producto", array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="form-group">
                                    <select name="product" id="product">
                                        <option value="">{{ trans('Seleccione un Producto') }}</option>
                                        @if ($products)
                                            @foreach($products as  $value)
                                                <option value="{{ $value->id }}" >{{ $value->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('name') ? ' has-error ' : '' }}">
                            {!! Form::label('quantity', trans('Cantidad'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::number('quantity', NULL, array('id' => 'quantity', 'class' => 'form-control', 'placeholder' => trans('Ingrese la cantidad'))) !!}
                                    <div class="input-group-append">
                                        <label for="name" class="input-group-text">
                                            <i class="fa fa-fw {{ trans('forms.create_device_icon_name') }}"
                                               aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                @if ($errors->has('quantity'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('quantity') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        {!! Form::button(trans('forms.create_device_button_text'), array('class' => 'btn btn-success margin-bottom-1 mb-1 float-right','type' => 'submit' )) !!}
                        {!! Form::close() !!}
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>

@endsection

@section('footer_scripts')

    <script type="text/javascript" src="{{ config('atm_app.selectizeJsCDN') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>

    <script type="text/javascript">
        $(function () {
            $("#storage").selectize({
                create: false,
                selectOnTab: true,
                highlight: true,
                selectOnTab: true
            });

            $("#product").selectize({
                create: false,
                selectOnTab: true,
                highlight: true,
                selectOnTab: true
            });
        });
    </script>
@endsection
