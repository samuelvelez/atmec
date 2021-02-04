@extends('layouts.app')

@section('template_title')
    {!! trans('materials.showing-all-reports') !!}
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
                                {!! trans('materials.showing-all-reports') !!}
                               
                            </span>
                            @role('atmoperator|ccitt|atmcollector||atmadmin')
                                     <div class="btn-group pull-right btn-group-xs"><a href="/materials/create" class="btn btn-primary btn-sm">
                                    Nueva Orden de Retiro
                                </a></div>
                                        @endrole
                            
                           
                        </div>
                       
                    </div>

                    <div class="card-body">
                        <div class="table-responsive reports-table">
                            <table class="table table-striped table-hover table-sm data-table">
                                <caption id="reports_count">
                                    {{ trans_choice('materials.reports-table.caption', $reports->count(), ['reportstotal' => $reportstotal]) }}
                                </caption>
                                <thead class="thead">
                                <tr>
                                    <th>{!! trans('materials.reports-table.id') !!}</th>
                                    <th>{!! trans('materials.reports-table.reportid') !!}</th>
                                    <th>{!! trans('materials.reports-table.namecollector') !!}</th>
                                    <th>{!! trans('materials.reports-table.nameaprob') !!}</th>
                                    <th>{!! trans('materials.reports-table.status') !!}</th>                                    
                                    <th class="hidden-xs">{!! trans('materials.reports-table.description') !!}</th>

                                    <th style="text-align:center" colspan="4">{!! trans('materials.reports-table.actions') !!}</th>                                    
                                </tr>
                                </thead>
                                <tbody id="reports_table">
                                    <?php 
                                    $valor1 = '';
                                    ?>
                                @foreach($reports as $report)
                                <?php
                                $valor0 = $report->id_matrepord;
                                if ($valor1==$valor0) { }
                                else { 
                                    $valor1 = $valor0;
                                ?>
                                    <tr >
                                        <td><a href="{{ URL::to('materials/' . $report->id_matrepord) }}" data-toggle="tooltip"
                                               title="Mostrar orden de retiro">OR-{{ $report->id_matrepord }}</a></td>

                                               <td><a href="{{ URL::to('ordenes/' . $report->report_id .'') }}" data-toggle="tooltip"
                                               title="Mostrar orden de trabajo"> @if ($report->report_id) OT-{{$report->report_id}} @else No tiene OT @endif </a></td>
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
                                               href="{{ URL::to('materials/' . $report->id_matrepord) }}"
                                               data-toggle="tooltip" title="Mostrar la orden de retiro">
                                                {!! trans('materials.buttons.show') !!}
                                            </a>
                                        
                                        </td>

                                        @role('atmoperator|ccitt')
                                        <td>
                                            <a class="btn btn-sm btn-info btn-block"
                                               href="{{ URL::to('materials/' . $report->id_matrepord . '/edit') }}"
                                               data-toggle="tooltip" title="Editar">
                                                {!! trans('materials.buttons.edit') !!}
                                            </a>
                                        </td>
                                        @endrole

                                        @role('atmoperator|atmcollector|ccitt')
                                        <td>
                                            {!! Form::open(array('url' => 'materials/' . $report->id_matrepord, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Eliminar')) !!}
                                            {!! Form::hidden('_method', 'DELETE') !!}
                                            {!! Form::button(trans('materials.buttons.delete'), array('class' => 'btn btn-danger btn-sm','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => trans('materials.modals.delete_report_title'), 'data-message' => trans('materials.modals.delete_report_message', ['id' => $report->id_matrepord]))) !!}
                                            {!! Form::close() !!}
                                        </td>
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
