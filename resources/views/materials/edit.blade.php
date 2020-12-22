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
                                <a href="{{ route('reports.index') }}" class="btn btn-light btn-sm float-right"
                                   data-toggle="tooltip" data-placement="left"
                                   title="{{ trans('reports.tooltips.back-reports') }}">
                                    <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
                                    {!! trans('reports.buttons.back-to-reports') !!}
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <br>
                   

                    <div class="card-body">
                     
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

                        @if (Auth::user()->hasRole('atmcollector') )
                            <br/>
                            <div class="row">
                                <div class="col-12">
                                    <a class="btn btn-sm btn-info float-right"
                                       href="{{ URL::to('reports/ee/edit') }}">Enviar solicitud</span></a>
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