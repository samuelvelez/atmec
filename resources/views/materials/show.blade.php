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
                                 @if ($reports)
                              @foreach($reports as $reporte)
                              <?php 
                               $recibido= $reporte->state;
                               ?>
                              @endforeach
                              @endif  
                       <?php if ($recibido == 'Recibido') {?>
                                <form action="../../pdf.php" method="POST" target="_blank">
                                    <input type="hidden" name="material" value="<?php echo $report ?>">                                    
                                    <button type="submit">PDF</button>
                                </form>
                               <?php } ?>
                                
                                
                                
                                
                                
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
<!--{{ $material->id == $reporte->material_id  ? $cantidades[] =  $reporte ->id  : '' }}-->  
<!--{{ $material->id == $reporte->material_id  ? $entregadovalor[] =  $reporte ->amount_delivery  : '' }}-->  

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
                                             <?php 
                                            if ($estadodeor=='Aprobada'){
                                            ?> 
                                              @if (Auth::user()->hasRole('atmstockkeeper'))                      
                                            <th style="width: 8px">Entregado</th>
                                            @endif
                                            <?php 
                                            }
                                            if ($estadodeor=='Entregada' || $estadodeor=='Recibido'){
                                            ?> 
                                            <th style="width: 8px">Entregado</th>
                                            <?php } ?>
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
<input type="text" id="<?php echo $cantidades[$index]?>" name="<?php echo $cantidades[$index]?>"  class="form-control mr-2" placeholder="#">
@endif                
                                          </td>
                                       
  <?php
    }
                                                                                           
                                                           if ($estadodeor=='Entregada' || $estadodeor=='Recibido'){
                                       echo '<td>'. $entregadovalor[$index]. '</td>';
                                                } 
                                                
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
                                        Descripción: 
                                    </strong>
                                    {{ $reporte->description }}
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
                                          
<div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        Fecha de creación
                                    </strong>
                                    {{ $reporte->date_create_ori }}
                                </div>
                           @if ($reporte->date_aprob_or_neg)
                             <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        Fecha de cambio de estado:
                                    </strong>
                                    {{ $reporte->date_aprob_or_neg }}
                                </div>
                           @endif
                           @if ($reporte->state)
                             <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        Estado:
                                    </strong>
                                    {{ $reporte->state }}
                                </div>
                           @endif
                           @if ($reporte->date_aprob_or_neg)
                             <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        Observación o Motivo:
                                    </strong>
                                    {{ $reporte->observations }}
                                </div>
                           @endif
                           @if ($reporte->date_delivery)
                              <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        Fecha de entrega:
                                    </strong>
                                    {{ $reporte->date_delivery }}
                                </div>
                           @endif
                           @if ($reporte->receipt)
                              <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        Fecha de recibido:
                                    </strong>
                                    {{ $reporte->receipt }}
                                </div>
                           @endif
                        </div>

                        <hr/>
                        <div class="row" id="observaciondiv" style="display: none">
                                <div class="col-10">
                                    Indique el motivo de la negación
                                    <input type="text" id="obs" class="form-control" onkeyup="document.getElementById('observtxt').value=(this.value)" name="obs" placeholder="Por favor, ingrese el motivo.">
                                </div>
                              </div>

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
                                <div class="col-10" id="negard">
                                   {!! Form::open(array('route' => ['aprobar', $report], 'method' => 'GET', 'role' => 'form')) !!}
                    {!! csrf_field() !!}
                                     
                                      {!! Form::button(trans('<i class="fa fa-check"></i> Aprobar'), array('class' => 'btn btn-info margin-bottom-1 mb-1 mr-2 float-right','type' => 'submit', 'id' => 'btn_enviar' )) !!}

       
                         {!! Form::close() !!}
                                      <!--                                    <a class="btn btn-sm btn-info float-right"
                                       href="{{ URL::to('materials//edit') }}"><i
                                                class="fa fa-check"></i> <span class="hidden-xs">Aprobar</span></a>-->
                                </div>
                                <div class="col-2" id="negar1">                                
                                     <button  class='btn btn-danger margin-bottom-1 mb-1 mr-2 float-left' type="button" onclick="document.getElementById('observaciondiv').style.display='inherit';document.getElementById('negar1').style.display='none'; document.getElementById('negarsi').style.display='inline';   "><i class="fa fa-close"></i> Negar</button>
                                     </div>
                                <div class="col-2"  id="negarsi" style="display: none">
                                   {!! Form::open(array('route' => ['negar', $report], 'method' => 'POST', 'role' => 'form')) !!}
                    {!! csrf_field() !!}
                                     {!! Form::hidden('observtxt', null, array('id' => 'observtxt')) !!}
                                      {!! Form::button(trans('<i class="fa fa-close"></i> Negar'), array('class' => 'btn btn-danger margin-bottom-1 mb-1 mr-2 float-left','type' => 'submit', 'id' => 'btn_enviar' )) !!}

       
                         {!! Form::close() !!}
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
                                   {!! Form::open(array('route' => ['entregarnewmaterial', $report], 'method' => 'POST', 'role' => 'form')) !!}
                    {!! csrf_field() !!}
<?php
  for ($index = 0; $index < count($valor); $index++) {
      ?>
{!! Form::hidden('p'.$cantidades[$index], null, array('id' => 'p'.$cantidades[$index], 'class' => 'form-control mr-2', 'placeholder' => '#')) !!}
                    <?php                       
  }
                          ?>
                     
  <!--<input type="text" id="cantidad" name="cantidad"  >-->
                                      {!! Form::button(trans('<i class="fa fa-check"></i> Entregada'), array('class' => 'btn btn-success margin-bottom-1 mb-1 mr-2 float-right','type' => 'submit', 'id' => 'btn_enviar' )) !!}
{!! Form::button(trans('<i class="fa fa-pencil"></i> Editar'), array('class' => 'btn btn-info margin-bottom-1 mb-1 mr-2 float-right','type' => 'button', 'id' => 'btn_enviar', 'onclick'=>'window.location="'.$report.'/editar"' )) !!}
       
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

