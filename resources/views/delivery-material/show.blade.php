@extends('layouts.app')

@section('template_title')
    {!! trans('delivery-material.showing-report-title', ['id' => $report]) !!}
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
                            {!! trans('delivery-material.showing-report-title', ['id' => $report]) !!}
                            <div class="float-right">
                                <a href="{{ route('delivery-material.index') }}" class="btn btn-light btn-sm float-right"
                                   data-toggle="tooltip" data-placement="left"
                                   title="{{ trans('delivery-material.tooltips.back-reports') }}">
                                    <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
                                    {!! trans('delivery-material.buttons.back-to-reports') !!}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 col-12">
                                  @if ($reports)
                              @foreach($reports as $reporte)
                              <?php 
                               $recibido= $reporte->state;
                               ?>
                              @endforeach
                              @endif
                               <?php if ($recibido == 'Recibido') {?>
                                <form action="../../pdf.php" method="POST" target="_blank">
                                    <input type="hidden" name="deliverymaterial" value="<?php echo $report ?>">                                    
                                    <button type="submit">PDF</button>
                                </form>
                               <?php } ?>
                                
                                
                                
                                <center><strong class="text-larger" >
                                        Materiales entregados
                                    </strong></center>
                                </div>
                               @if ($reports)
                              @foreach($reports as $reporte)
                                 <?php 
                                 $escaleraid = $reporte->id_usercreate;
                                 ?>  
                             <br>
                             <!--'materials','metrics'-->
                     
    
                              <div style="display:hidden">
      
<!--{{ $reporte->product_name <> ''  ? $valor[] =  $reporte ->product_name  : '' }}-->   
<!--{{  $reporte->product_name<> ''  ? $cantidad[] =  $reporte ->amount  : '' }}-->  
<!--{{ $reporte->product_name<> ''  ? $cantidades[] =  $reporte ->id  : '' }}-->  

                                                            </div>          

                             
  @if ($metrics)
                              @foreach($metrics as $metric)
 <!--{{ $metric->id == $reporte->metric_id  ?  $metrica[] =  $metric ->name  : '' }}-->  

                              @endforeach
                             @endif
                              
                             
                             @endforeach
                                             

                                   <?php 
                                                                           $estadodeor = $reporte->state;

//                                   for ($index = 0; $index < count($valor); $index++) {
//                          echo '<div class="col-sm-6 col-6">-'. $valor[$index].' cantidad: '. $cantidad[$index]. '  </div> <br>';
//                                   }
                                   ?>                      
                             <div class="col-md-12" >
                   
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
                                   for ($index = 0; $index < count($valor); $index++) {
                          echo '<tr>
                                       <td>'. $valor[$index].'</td>
<td>'.$metrica[$index].'</td>
                                      <td id='.'abcd'.$cantidades[$index].' >'. $cantidad[$index]. '</td>';
                                    if ($estadodeor=='Aprobada'){
                                               ?>
                                        
                                          @if (Auth::user()->hasRole('atmstockkeeper'))
                                          <td>
<input type="text" id="<?php echo $cantidades[$index]?>" name="<?php echo $cantidades[$index]?>" onblur="validacion(<?php echo $cantidades[$index] ?>)" class="form-control mr-2" placeholder="#">
@endif                
                                          </td>
                                       
  <?php
    }
//                                                                                           
//                                                           if ($estadodeor=='Entregada' || $estadodeor=='Recibido'){
//                                       echo '<td>'. $entregadovalor[$index]. '</td>';
//                                                } 
//                                                
                          }
                                   ?>
                                           <script>
                                              function validacion(valor){
                                             content = document.getElementById('abcd'+valor);                                          
//        alert (content.innerHTML);
//                                                  alert(document.getElementById('abc'+valor).value);
                                                  var original = new Number(content.innerHTML); //document.getElementById('abc'+valor).value;
//                                                  alert(original);
                                                  var nuevo= new Number(document.getElementById(valor).value);                                                  
//                                                  alert(nuevo +' + ' + original)
                                                  if (nuevo<=original) {
                                                      document.getElementById('p'+valor).value= nuevo;   
                                                  }
                                                  else {
//                                                      alert(nuevo + ' valor ori '+ original)
                                                      alert('Por favor, el número entregado no puede ser mayor al pedido originalmente.');
                                                   document.getElementById(valor).value= '';   
                                                   document.getElementById('p'+valor).value= '';   
                                                  }
                                                  //alert (getvalor);
                                                  //alert('bien');
                                              }
                                              </script>
                                        <tr>
                                        
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                  

                             @endif
                                  @if ($reporte->description)
                              <div class="col-sm-12 col-12">
                                    <strong class="text-larger">
                                        Descripción de la entrega:
                                    </strong>
                                    {{ $reporte->description }}
                                </div>
                           @endif
                            <div class="col-sm-6 col-6">
                                <strong class="text-larger">
                                    Entregado por:
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
      
       $datos = json_decode($iduserapro, true);
                                  foreach ($datos as $cliente) {
    $iduser = $cliente['id_useraproborneg'];
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
                                 ?>
                            </div>
                             
                               @if ($reporte->id_useraproborneg)
                              <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        Recibido por:
                                    </strong>
                                    {{ $nombrem }}
                                </div>
                           @endif
                                
<div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        Fecha de entrega
                                    </strong>
                                    {{ $reporte->created_at }}
                                </div>
                 
                          
                           @if ($reporte->receipt)
                              <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        Fecha de recibido
                                    </strong>
                                    {{ $reporte->receipt }}
                                </div>
                           @endif
                           
                             @if ($reporte->commentreceipt)
                              <div class="col-sm-12 col-12">
                                    <strong class="text-larger">
                                       Comentario de bodega:
                                    </strong>
                                    {{ $reporte->commentreceipt }}
                                </div>
                           @endif
                        </div>

                        <hr/>

@section('footer_scripts')
    <script type="text/javascript" src="{{ config('atm_app.selectizeJsCDN') }}"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js" type="text/javascript"></script>
<!--<script>
$(document).ready(function() {
    var valor =  new Array();
    var id =  new Array();
    var nuevo = '';
    var iteracion = 0;
 $('.form-control').change(function() {
var name1 = $(this).attr("value");
var name2 = $(this).attr("name");
        if (iteracion==0){
        valor.push(name1);
        id.push(name2);
    }       
//alert(name1 +' nombre '+ name2);
//if (iteracion>0){
var siono = 0;
//if (iteracion==1){
//    console.clear();
for (i=0; i< valor.length; i++){           
if (id[i]==name2){
//    alert('igual');
    id.splice(i,1);
    valor.splice(i,1);
   siono =1;
            }else { 
                siono=1;
            }
}
if (siono==1){
     valor.push(name1);
          id.push(name2);    
}
var nuevo = '';
for (i=0; i< valor.length; i++){
    document.getElementById('p'+id[i]).value=valor[i];
    console.log(id[i]);
    console.log(valor[i]);
     nuevo = nuevo +name1;
    }
//}
  iteracion = 1;
       nuevo = nuevo +name1;
    
//document.getElementById('cantidad').value = nuevo;
 });
});
</script>-->
<!--  <script>
        $(document).ready(function () {               
//    alert('hola');        
      
              });
        function hola(){
   $('.form-control').change(function() {
var name1 = $(this).attr("value");
alert(name1);
 });
            //alert('hola')
        }
 </script>-->
@endsection
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
                              <?php if ($estadodeor=='Ingresada'){ ?>
                         @if (Auth::user()->hasRole('atmstockkeeper'))
                            <br/>
                            <div class="row">
                                <div class="col-12" >
                                   {!! Form::open(array('route' => ['entregarnew', $report], 'method' => 'POST', 'role' => 'form')) !!}
                    {!! csrf_field() !!}
{!! Form::text('commentreceipt', null, array('id' => 'commentreceipt', 'class' => 'form-control mr-2', 'placeholder' => 'Ingrese algún comentario sobre la entrega de material')) !!}            
<br>
{!! Form::button(trans('<i class="fa fa-check"></i> Recibido'), array('class' => 'btn btn-info margin-bottom-1 mb-1 mr-2 float-right','type' => 'submit', 'id' => 'btn_enviar' )) !!}
  {!! Form::close() !!}
                                </div>                   
       
                       
                                      <!--                                    <a class="btn btn-sm btn-info float-right"
                                       href="{{ URL::to('materials//edit') }}"><i
                                                class="fa fa-check"></i> <span class="hidden-xs">Aprobar</span></a>-->
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

