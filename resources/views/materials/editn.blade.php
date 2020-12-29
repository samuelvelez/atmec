@extends('layouts.app')

@section('template_title')
    {!! trans('materials.showing-mt-title') !!}
@endsection

@section('template_fastload_css')
    .picture {
    height: 400px;
    width: auto;
    }
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="card">
                    <div class="card-header text-white bg-success">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            {!! trans('materials.showing-mt-title') !!}
                            <div class="float-right">
                                <a href="{{ route('materials.index') }}" class="btn btn-light btn-sm float-right"
                                   data-toggle="tooltip" data-placement="left"
                                   title="{{ trans('reports.tooltips.back-reports') }}">
                                    <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
                                    {!! trans('materials.buttons.back-to-reports') !!}
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <br>
                   

                    <div class="card-body">
                         {!! Form::open(array('route' => ['materials.update', $alert], 'method' => 'PUT', 'role' => 'form', 'class' => 'needs-validation')) !!}

                        {!! csrf_field() !!}


                         <div class="form-group row">
                            {!! Form::label('alert', '# Reporte al que aplica', array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                          
                                    {!! Form::text('alert', $alert , array('id' => 'alert', 'class' => 'form-control',  'readonly' => 'readonly')) !!}
                                   
                                </div>
                            </div>
                        </div>
                        
                         <div class="form-group row">
                            {!! Form::label('alert', 'Productos', array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">                          
                                    {!! Form::text('alert', $alert , array('id' => 'alert', 'class' => 'form-control',  'readonly' => 'readonly')) !!}                                   
                                </div>
                            </div>
                        </div>
                        
                        <div class="text-center" style="color: royalblue;"><strong>Materiales requeridos</strong></div>
                        <div class="row">
                            <div class="col-md-7">
                                {!! Form::label('material_slt', 'Material', array('class' => 'control-label')); !!}
                                <div class="form-group">
                                    <select id="material_slt" name="material_slt">
                                        <option value="">Seleccione el material</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                {!! Form::label('metric', 'Unidad de medida', array('class' => 'control-label')); !!}
                                <div class="form-group">
                                    <select id="metric" name="metric">
                                        <option value="">Seleccione la unidad</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2">
                                {!! Form::label('amount', 'Cantidad', array('class' => 'control-label')); !!}
                                <div class="input-group">
                                    {!! Form::text('amount', null, array('id' => 'amount', 'class' => 'form-control mr-2', 'placeholder' => '##')) !!}
                                    <button id="add-material" type="button" class="btn btn-sm btn-primary float-right">
                                        <i class="fa fa-fw fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        

                        @if (Auth::user()->hasRole('atmcollector') )
                            <br/>
                            <div class="row">
                                <div class="col-12">
                                    <a class="btn btn-sm btn-info float-right"
                                       href="{{ URL::to('reports/ee/edit') }}">Enviar solicitud</span></a>
                                    {{ $alert }}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer_scripts')
    @if(config('atm_app.tooltipsEnabled'))
        @include('scripts.tooltips')
    @endif
@endsection