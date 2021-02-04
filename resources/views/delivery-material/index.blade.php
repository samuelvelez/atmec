@extends('layouts.app')

@section('template_title')
    {!! trans('delivery-material.showing-all-reports') !!}
@endsection

@section('template_linked_css')
    @if(config('atm_app.enabledDatatablesJs'))
        <link rel="stylesheet" type="text/css" href="{{ config('atm_app.datatablesCssCDN') }}">
    @endif
    <style type="text/css" media="screen">
        .reports-table {
            border: 0;
        }

        .reports-table tr td:first-child {
            padding-left: 15px;
        }

        .reports-table tr td:last-child {
            padding-right: 15px;
        }

        .reports-table.table-responsive,
        .reports-table.table-responsive table {
            margin-bottom: 0;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                {!! trans('delivery-material.showing-all-reports') !!}
                               
                            </span>
                            @role('atmoperator|ccitt|atmcollector||atmadmin')
                                     <div class="btn-group pull-right btn-group-xs"><a href="/delivery-material/create" class="btn btn-primary btn-sm">
                                    Nueva Entrega de Material
                                </a></div>
                                        @endrole
                            
                           
                        </div>
                       
                    </div>

                    <div class="card-body">
                        <div class="table-responsive reports-table">
                            <table class="table table-striped table-hover table-sm data-table">
                                <caption id="reports_count">
                                    {{ trans_choice('delivery-material.reports-table.caption', $reports->count(), ['reportstotal' => $reportstotal]) }}
                                </caption>
                                <thead class="thead">
                                <tr>
                                    <th>{!! trans('delivery-material.reports-table.id') !!}</th>
                                    <th>{!! trans('delivery-material.reports-table.namecollector') !!}</th>
                                    <th>{!! trans('delivery-material.reports-table.nameaprob') !!}</th>
                                    <th>{!! trans('delivery-material.reports-table.status') !!}</th>                                    
                                    <th class="hidden-xs">{!! trans('delivery-material.reports-table.description') !!}</th>

                                    <th style="text-align:center" colspan="4">{!! trans('delivery-material.reports-table.actions') !!}</th>                                    
                                </tr>
                                </thead>
                                <tbody id="reports_table">
                                    <?php 
                                    $valor1 = '';
                                    ?>
                                @foreach($reports as $report)
                                <?php
                                $valor0 = $report->id_ingreso;
                                if ($valor1==$valor0) { }
                                else { 
                                    $valor1 = $valor0;
                                ?>
                                    <tr>
                                        <td><a href="{{ URL::to('delivery-material/' . $report->id_ingreso) }}" data-toggle="tooltip"
                                               title="Mostrar orden de retiro">{{ $report->id_ingreso }}</a></td>
                                               
                                               <td>{{ $report->name }}</td>
                                                   <?php 
                          $iduser = $report->id_useraproborneg;
                          $nombrem = '';
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
      echo '<td>'.$nombrem .'</td>';      


                                 ?>
                                        <td>{{ $report->state }}</td>
                                       
                                     
                                        <td class="hidden-xs">{{$report->description}}</td>
<td>
    @if ($report->report_id)
    <a class="btn btn-sm btn-danger  btn-block" style="color:#dc3545; width: 20px"
                                               data-toggle="tooltip" title="Proridades">
                                              i  
                                            </a>
    @else
    <a class="btn btn-sm btn-info  btn-block"style="color:#17a2b8; width: 20px"
                                               data-toggle="tooltip" title="Proridades">
                                              n
                                            </a>
    @endif
                                            </td>
                                        <td>
                                            <a class="btn btn-sm btn-success btn-block"
                                               href="{{ URL::to('delivery-material/' . $report->id_ingreso) }}"
                                               data-toggle="tooltip" title="Mostrar la entrega de material">
                                                {!! trans('delivery-material.buttons.show') !!}
                                            </a>
                                        
                                        </td>

                                        @role('atmoperator|ccitt|atmcollector')
<!--                                        <td>
                                            <a class="btn btn-sm btn-info btn-block"
                                               href="{{ URL::to('delivery-material/' . $report->id_ingreso . '/edit') }}"
                                               data-toggle="tooltip" title="Editar">
                                                {!! trans('delivery-material.buttons.edit') !!}
                                            </a>
                                        </td>-->
                                        @endrole

                                        @role('atmoperator|atmcollector|ccitt')
<!--                                        <td>
                                            {!! Form::open(array('url' => 'delivery-material/' . $report->id_ingreso, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Eliminar')) !!}
                                            {!! Form::hidden('_method', 'DELETE') !!}
                                            {!! Form::button(trans('materials.buttons.delete'), array('class' => 'btn btn-danger btn-sm','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => trans('materials.modals.delete_report_title'), 'data-message' => trans('materials.modals.delete_report_message', ['id' => $report->id_ingreso]))) !!}
                                            {!! Form::close() !!}
                                        </td>-->
                                        @endrole
                                        </td>
                                    </tr>
                                    
                                    <?php } ?>
                                @endforeach
                                
                                </tbody>
                            </table>

                            @if(config('atm_app.enablePagination'))
                                {{ $reports->links() }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('modals.modal-delete')

@endsection

@section('footer_scripts')
    @if ((count($reports) > config('atm_app.datatablesJsStartCount')) && config('atm_app.enabledDatatablesJs'))
        @include('scripts.datatables')
    @endif

    @include('scripts.delete-modal-script')
    @include('scripts.save-modal-script')

    @if(config('atm_app.tooltipsEnabled'))
        @include('scripts.tooltips')
    @endif
@endsection
