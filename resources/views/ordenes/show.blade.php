@extends('layouts.app')

@section('template_title')
    {!! trans('alerts.showing-alert-title', ['id' => $alert->id]) !!}
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

                    <div class="card-header text-white bg-success">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            Mostrando la Orden #{!! $alert->id !!}
                            <div class="float-right">
                                <a href="{{ route('ordenes.index') }}" class="btn btn-light btn-sm float-right"
                                   data-toggle="tooltip" data-placement="left"
                                   title="{{ trans('Regresar') }}">
                                    <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
                                    {!! trans('Regresar a las ordenes' ) !!}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12" id="map-canvas">
                               Cargando mapa
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>
                        <div class="row">
                            @if ($alert->collector)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('alerts.labelCollector') }}
                                    </strong>
                                    {{ $alert->collector->full_name() }}
                                </div>
                            @endif
                            @if ($alert->operator)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('alerts.labelOperator') }}
                                    </strong>
                                    {{ $alert->operator->full_name() }}
                                </div>
                            @endif
                            
                       
                            @if ($alert->status)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('alerts.labelStatus') }}
                                    </strong>
                                    {{ $alert->status->name }}
                                </div>
                            @endif
                            
                               @if ($workordertypes)
                                            @foreach($workordertypes as $workordertype)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        Tipo de orden: 
                                    </strong>
                                    {{ $workordertype->description }}
                                </div>
                                            @endforeach
                                            @endif
                                            
                                            
                                              @if ($priorityalerts)
                                            @foreach($priorityalerts as $priorityalert)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        Prioridad: 
                                    </strong>
                                    {{ $priorityalert->name }}
                                </div>
                                            @endforeach
                                            @endif
                                            
                                            
                                                      @if ($motivealerts)
                                            @foreach($motivealerts as $motivealert)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        Motivo: 
                                    </strong>
                                    {{ $motivealert->description }}
                                </div>
                                            @endforeach
                                            @endif
                                            
                                            
                                            
                            @if ($alert->description)
                                <div class="col-sm-12 col-12">
                                    <strong class="text-larger">
                                        {{ trans('alerts.labelDescription') }}
                                    </strong>
                                    {{ $alert->description }}
                                </div>
                            @endif
                            
                               
                            
                              @if ($alert->google_address)
                                <div class="col-sm-12 col-12">
                                    <strong class="text-larger">
                                        Dirección de Google:
                                    </strong>
                                    {{ $alert->google_address }}
                                </div>
                            @endif
                            
                        </div>
                        
                              <div class="clearfix"></div>
                        <div class="border-bottom"></div>
                        
                         <div class="row">
                        
       
                           @if ($alertas)
                                            @foreach($alertas as $alerta)
                               
                                            
                                            
                                             @if ($noveltys)
                                            @foreach($noveltys as $novelty)
                             
                                 <?php   
                                 if ($alerta->novelty_id == $novelty->id)
                                 
                                    echo ' <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        Novedad: 
                                    </strong>'
                                    .$novelty->name.'
                                </div>      ';
                                 
                                       if ($alerta->subnovelty_id == $novelty->id)
                                 
                                    echo ' <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        Subnovedad: 
                                    </strong>'
                                    .$novelty->name.'
                                </div>      ';
                                    
                                    
                                    ?>
                                
                                            
                            @endforeach
                            @endif
                            
                            
                            

                            
                    
                            
                                  @if ($tiporeportes)
                                            @foreach($tiporeportes as $tiporeporte)
                             
                                <?php   
                                 if ($alerta->worktype_id  == $tiporeporte->id)
                                 
                                    echo ' <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        Tipo de trabajo: 
                                    </strong>'.$tiporeporte->name.'
                                </div>';
                                 ?>
                                            
                            @endforeach
                            @endif
                            
                            
                                  
                            
                            
                                @if ($alertas)
                                            @foreach($alertas as $alerta)
                             
                                              @if ($statusreportes)
                                            @foreach($statusreportes as $statusreporte)
                             
                                <?php   
                                 if ($alerta->status_id  == $statusreporte->id)
                                 
                                    echo ' <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        Estado: 
                                    </strong>'.$statusreporte->name.'
                                </div>';
                                 ?>
                                            
                            @endforeach
                            @endif
                                            
                           <div class="col-sm-12 col-12">
                                    <strong class="text-larger">
                                        Descripción de la escalera: 
                                    </strong>
                                    {{ $alerta->description }}
                                </div>
                                            @endforeach
                                            @endif
                            
                              @endforeach
                            @endif
                        </div>
                        
                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>
                        
                        
                        
                        
                        
                        
                        

                        <div class="row">
                            @if ($alert->created_at)
                                <div class="col-sm-4 col-4">
                                    <strong class="text-larger">
                                        {{ trans('alerts.labelCreated') }}
                                    </strong>
                                   
                                    {{ $alert->created_at }}
                                </div>
                            @endif
                            @if ($alert->updated_at)
                                <div class="col-sm-4 col-4">
                                    <strong class="text-larger">
                                        {{ trans('alerts.labelUpdated') }}
                                    </strong>
                                    {{ $alert->updated_at }}
                                </div>
                            @endif
                            <div class="col-sm-4 col-4">
                                <strong class="text-larger">
                                    {{ trans('alerts.labelReaded') }}
                                </strong>
                                @if ($alert->readed_on)
                                    {{ $alert->readed_on }}
                                @else
                                    No leida
                                @endif
                            </div>
                            <?php                              
                            $idmaterialfk = '';   
                            ?>
                            @if ($materialid)
                            @foreach ($materialid as $materialess)
                            <?php 
                            $idmaterialfk = $materialess->id_matrepord;
                            ?>
                            @endforeach
                            @endif
                            @if ($idmaterialfk<>'')
                            <div class="col-sm-12 col-12">
                                    <strong class="text-larger">
                                        Orden de Retiro asociada:
                                    </strong>
                                <a target="_blank" href="../materials/{{ $idmaterialfk }}">{{ $idmaterialfk }}</a>
                                </div>
                            @endif
                            
                            
                             <?php 
                             $delf[0]='';
                             if (count($report)>0){
                                    $del1 = explode(':', $report) ;
                                            $delf = explode('}', $del1[1]);
                             }
                                            ?>
                            @if($delf[0])
                            <div class="col-sm-12 col-12">
                                    <strong class="text-larger">
                                        Reporte asociado: 
                                    </strong>
                                <a target="_blank" href="../reports/{{ $delf[0] }}">{{ $delf[0] }}</a>
                                </div>
                            @endif
                            
                           
                            
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <br/>
                        <div class="row" id="esconder" style="display: none">
                             <div class="col-12">
                                
                                 <input type="text" class="form-control" placeholder="Escriba el motivo para anular la orden de trabajo">
                            </div>
                             <br>
                        </div>
                       
                        <div class="row">
                            <div class="col-4">
                                <a class="btn btn-sm btn-success btn-block"
                                   href="{{ URL::to('/ordenes/create') }}"><i
                                            class="fa fa-plus-square"></i><span
                                            class="hidden-xs"> Nueva Orden</span></a>
                            </div>
                            <div class="col-4">
                                @role('atmoperator|atmadmin')
                                <a class="btn btn-sm btn-info btn-block"
                                   href="{{ URL::to('ordenes/' . $alert->id . '/edit') }}"><i
                                            class="fa fa-edit"></i> <span class="hidden-xs">Editar</span></a>
                                   
                                @endif
                            </div>
                            <div class="col-4">
                                
                                <a id="btenviar"  style="color: white" class="btn btn-sm btn-danger btn-block"
                                             onclick="mostrar()"><i
                                                 class="fa fa-ban"></i> <span class="hidden-xs">Anular</span></a>
                            </div>
                            
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
var contador =0;
    function mostrar(){
        contador = contador +1;
                if (contador==2){
                    
                } else { 
                                    document.getElementById('esconder').style.display = 'inherit';    

                }
    }
    </script>

    @include('modals.modal-delete')

@endsection

@section('footer_scripts')
    @include('scripts.delete-modal-script')
    @if(config('atm_app.tooltipsEnabled'))
        @include('scripts.tooltips')
    @endif

    @if(config('settings.googleMapsAPIStatus'))
        @include('scripts.google-maps-atm-show', [
            'latitude' => $alert->latitude,
            'longitude' => $alert->longitude,
            'code' => $alert->id,
        ])
    @endif
@endsection