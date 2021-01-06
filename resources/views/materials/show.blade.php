@extends('layouts.app')

@section('template_title')
    {!! trans('materials.showing-report-title', ['id' => $report]) !!}
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
                            {!! trans('materials.showing-report-title', ['id' => $report]) !!}
                            <div class="float-right">
                                <a href="{{ route('materials.index') }}" class="btn btn-light btn-sm float-right"
                                   data-toggle="tooltip" data-placement="left"
                                   title="{{ trans('materials.tooltips.back-reports') }}">
                                    <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
                                    {!! trans('materials.buttons.back-to-reports') !!}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 col-12">
                                
                      
                                
                                
                                
                                
                                
                                <center><strong class="text-larger" >
                                        Materiales solicitados
                                    </strong></center>
                                </div>
                               @if ($reports)
                              @foreach($reports as $reporte)
                                 <?php 
                                 $escaleraid = $reporte->id_userrequire;
                                 ?>  
                             <br>
                             <!--'materials','metrics'-->
                            
                               @if ($materials)
                              @foreach($materials as $material)
                              <!--{{ $material ->name  }}-->
                              
    
                              <div style="display:hidden">
      
<!--{{ $material->id == $reporte->material_id  ? $valor[] =  $material ->name  : '' }}-->   
<!--{{ $material->id == $reporte->material_id  ? $cantidad[] =  $reporte ->amount  : '' }}-->  

                                                            </div>          

                          
                              @endforeach
                             @endif
                             
                             
  @if ($metrics)
                              @foreach($metrics as $metric)
 <!--{{ $metric->id == $reporte->metric_id  ?  $metrica[] =  $metric ->name  : '' }}-->  

                              @endforeach
                             @endif
                              
                             
                             @endforeach
                                             

                                   <?php 
//                                   for ($index = 0; $index < count($valor); $index++) {
//                          echo '<div class="col-sm-6 col-6">-'. $valor[$index].' cantidad: '. $cantidad[$index]. '  </div> <br>';
//                                   }
                                   ?>                      
                             <div class="col-md-12" style="margin-top: -35px">
                   
                                                       <table id="materials2"
                                        class="table table-striped table-hover table-sm data-table mt-4 mb-4">
                                        <thead class="thead">
                                        <tr>
                                            <th>Material</th>
                                            <th>Unidad de medida</th>
                                            <th>Cantidad</th>
                                        </tr>
                                        </thead>
                                        <?php 
                                        $estadodeor = $reporte->state;
                                   for ($index = 0; $index < count($valor); $index++) {
                          echo '<tr>
                                       <td>'. $valor[$index].'</td>
<td>'.$metrica[$index].'</td>
                                      <td>'. $cantidad[$index]. '</td>
                                      
                                   <br>';
                                  //<td>'. $metrica[$index]. '</td>
                          ?>

                                        
                                        <?php
                          }
                                   ?>
                                        <tr>
                                           
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                               
<div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        Fecha de creación
                                    </strong>
                                    {{ $reporte->created_at }}
                                </div>

                             @endif
                                 
                            <div class="col-sm-6 col-6">
                                <strong class="text-larger">
                                    Solicitante:
                                </strong>
                                   <?php 
                                  $datos = json_decode($idusercrea, true);
                                  foreach ($datos as $cliente) {
    $iduser = $cliente['id_usercreate'];
}
//echo $iduser .' id user<br>';
$datospersonas = json_decode($usersol, true);                                
foreach ($datospersonas as $cliente) {
    $nombre=$cliente['name'];
    $id = $cliente['id'];
//    echo $nombre .' id '. $id. '<br>';
    if ($id==$iduser)
    {
        $nombrem = $nombre;
    } else {        
    }
//
}
      echo $nombrem .'<br>';      


                                 ?>
                            </div>
                             <div class="col-sm-6 col-6">
                                <strong class="text-larger">
                                    Escalera:                   
                                </strong>
                       
                                 
                            
                                 
                                 
                                    <?php 
//                                  $datos = json_decode($idusercrea, true);
//                                  foreach ($datos as $cliente) {
//    $iduser = $cliente['id_usercreate'];
//}
$iduser =$escaleraid;
$datospersonas = json_decode($usersol, true);                                
foreach ($datospersonas as $cliente) {
    $nombre=$cliente['name'];
    $id = $cliente['id'];
//    echo $nombre .' id '. $id. '<br>';
    if ($id==$iduser)
    {
        $nombrem = $nombre;
    } else {        
    }
//
}
      echo $nombrem .'<br>';      


                                 ?>
                            </div>
                        </div>

                        <hr/>

 <?php if ($estadodeor=='Ingresada'){ ?>
                        @if (Auth::user()->hasRole('atmadmin'))
                            <br/>
                            <div class="row">
                                <div class="col-12">
                                   {!! Form::open(array('route' => ['aprobar', $report], 'method' => 'GET', 'role' => 'form')) !!}
                    {!! csrf_field() !!}
                                     
                                      {!! Form::button(trans('<i class="fa fa-check"></i> Aprobar'), array('class' => 'btn btn-info margin-bottom-1 mb-1 mr-2 float-right','type' => 'submit', 'id' => 'btn_enviar' )) !!}

       
                         {!! Form::close() !!}
                                      <!--                                    <a class="btn btn-sm btn-info float-right"
                                       href="{{ URL::to('materials//edit') }}"><i
                                                class="fa fa-check"></i> <span class="hidden-xs">Aprobar</span></a>-->
                                </div>
                            </div>
                        @endif
                        
 <?php } ?>
                       
                        <?php if ($estadodeor=='Entregada'){ ?>
                         @if (Auth::user()->hasRole('atmcollector'))
                            <br/>
                            <div class="row">
                                <div class="col-12">
                                   {!! Form::open(array('route' => ['recibir', $report], 'method' => 'GET', 'role' => 'form')) !!}
                    {!! csrf_field() !!}
                                     
                                      {!! Form::button(trans('<i class="fa fa-check"></i> Recibido'), array('class' => 'btn btn-info margin-bottom-1 mb-1 mr-2 float-right','type' => 'submit', 'id' => 'btn_enviar' )) !!}

       
                         {!! Form::close() !!}
                                      <!--                                    <a class="btn btn-sm btn-info float-right"
                                       href="{{ URL::to('materials//edit') }}"><i
                                                class="fa fa-check"></i> <span class="hidden-xs">Aprobar</span></a>-->
                                </div>
                            </div>
                        @endif
                        <?php } ?>
                              <?php if ($estadodeor=='Aprobada'){ ?>
                         @if (Auth::user()->hasRole('atmstockkeeper'))
                            <br/>
                            <div class="row">
                                <div class="col-12">
                                   {!! Form::open(array('route' => ['entregar', $report], 'method' => 'GET', 'role' => 'form')) !!}
                    {!! csrf_field() !!}
                                     
                                      {!! Form::button(trans('<i class="fa fa-check"></i> Entregada'), array('class' => 'btn btn-info margin-bottom-1 mb-1 mr-2 float-right','type' => 'submit', 'id' => 'btn_enviar' )) !!}

       
                         {!! Form::close() !!}
                                      <!--                                    <a class="btn btn-sm btn-info float-right"
                                       href="{{ URL::to('materials//edit') }}"><i
                                                class="fa fa-check"></i> <span class="hidden-xs">Aprobar</span></a>-->
                                </div>
                            </div>
                        @endif
                        <?php } ?>
                        
                        
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