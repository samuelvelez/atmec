@extends('layouts.app')

@section('template_title')
    {!! trans('alerts.showing-all-alerts') !!}
@endsection

@section('template_linked_css')
    @if(config('atm_app.enabledDatatablesJs'))
        <link rel="stylesheet" type="text/css" href="{{ config('atm_app.datatablesCssCDN') }}">
    @endif
    <style type="text/css" media="screen">
        .alerts-table {
            border: 0;
        }

        .alerts-table tr td:first-child {
            padding-left: 15px;
        }

        .alerts-table tr td:last-child {
            padding-right: 15px;
        }

        .alerts-table.table-responsive,
        .alerts-table.table-responsive table {
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
                                {!! trans('Mostrando todas las ordenes de trabajo') !!}
                            </span>

                            @role('atmoperator|atmadmin|ccitt')
                            <div class="btn-group pull-right btn-group-xs">
                                <a class="btn btn-primary btn-sm" href="/ordenes/create">
                                    {!! trans('Nueva Orden de Trabajo') !!}
                                </a>
                            </div>
                            @endrole
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive alerts-table">
                            <table class="table table-striped table-hover table-sm data-table">
                                <caption id="alerts_count">
                                    {{ trans_choice('alerts.alerts-table.caption', $alerts->count(), ['alertstotal' => $alertstotal]) }}
                                </caption>
                                <thead class="thead">
                                <tr>
                                    <th>{!! trans('alerts.alerts-table.id') !!}</th>
                                    <th>{!! trans('alerts.alerts-table.collector') !!}</th>
                                    <th>{!! trans('alerts.alerts-table.creator') !!}</th>
                                    <th>{!! trans('alerts.alerts-table.status') !!}</th>
                                    <th class="hidden-xs">{!! trans('alerts.alerts-table.address') !!}</th>
                                    <th class="hidden-xs">{!! trans('alerts.alerts-table.readed') !!}</th>
                                    <th class="hidden-xs">{!! trans('alerts.alerts-table.description') !!}</th>

                                    <th>{!! trans('alerts.alerts-table.actions') !!}</th>
                                    <th class="no-search no-sort"></th>
                                    <th class="no-search no-sort"></th>
                                    <th class="no-search no-sort"></th>
                                </tr>
                                </thead>
                                <tbody id="alerts_table">
                                @foreach($alerts as $alert)
                                    <tr>
                                        <td>{{ $alert->id }}</td>
                                        <td>{{ $alert->collector->full_name() }}</td>
                                        <td>{{ $alert->owner->full_name() }}</td>
                                        <td>{{ $alert->status->name }}</td>
                                        <td class="hidden-xs">{{$alert->google_address}}</td>
                                        <td class="hidden-xs">
                                            @if ($alert->readed_on)
                                                {{ $alert->readed_on }}
                                            @else
                                                No leida
                                            @endif
                                        </td>
                                        <td class="hidden-xs">{{$alert->description}}</td>

                                        <td>
                                            @if (!$alert->report['id'] &&  (Auth::user()->hasRole('atmcollector') ||  Auth::user()->hasRole('ccitt')))
                                                <a class="btn btn-sm btn-danger btn-block"
                                                   href="{{ URL::to('reports/' . $alert->id . '/create/') }}"
                                                   data-toggle="tooltip" title="Realizar Inspección">
                                                    {!! trans('Realizar Informe') !!}
                                                </a>
                                            @else
                                                @if($alert->report['status_id']=="3" && (Auth::user()->hasRole('ccitt') || Auth::user()->hasRole('atmadmin')))
                                                <a class="btn btn-sm btn-warning btn-block"
                                                   href="{{ URL::to('workorders/' . $alert->report['id'] . '/create/') }}"
                                                   data-toggle="tooltip" title="Crear Reporte">
                                                    {!! trans('Crear Reporte') !!}
                                                </a>
                                                @endif
                                                @if(($alert->report['status_id']=="8" || $alert->report['status_id']=="9" ) && (Auth::user()->hasRole('atmcollector') ||  Auth::user()->hasRole('ccitt')))
                                                <a class="btn btn-sm btn-warning btn-block"
                                                   href="{{ URL::to('reports/' . $alert->report['id'] . '/edit/') }}"
                                                   data-toggle="tooltip" title="Crear Reporte">
                                                    {!! trans('Continuar Reporte') !!}
                                                </a>
                                                @endif
                                            @endif
                                            
                                            @if($alert->report['status_id']=="2" && (Auth::user()->hasRole('atmcollector')))
                                                @php
                                                    $workorder = App\Models\Workorder::where('report_id', $alert->report['id'])->first();
                                                    

                                                @endphp
                                                @if($workorder['status_id']==5)
                                                    <a class="btn btn-sm btn-warning btn-block"
                                                    href="{{ URL::to('workorders/' . $workorder->id . '/close/') }}"
                                                    data-toggle="tooltip" title="Crear Reporte">
                                                        {!! trans('Finalizar Reporte') !!}
                                                    </a>
                                                @endif
                                            @endif
                                        </td>

                                        <td>
                                            <a class="btn btn-sm btn-success btn-block"
                                               href="{{ URL::to('ordenes/' . $alert->id) }}"
                                               data-toggle="tooltip" title="Mostrar la orden">
                                                {!! trans('alerts.buttons.show') !!}
                                            </a>
                                        </td>

                                        @if (Auth::user()->hasRole('atmoperator') && !$alert->report)
                                        <td>
                                            <a class="btn btn-sm btn-info btn-block"
                                               href="{{ URL::to('ordenes/' . $alert->id . '/edit') }}"
                                               data-toggle="tooltip" title="Editar">
                                                {!! trans('alerts.buttons.edit') !!}
                                            </a>
                                        </td>

                                        <td>
                                            {!! Form::open(array('url' => 'alerts/' . $alert->id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Eliminar')) !!}
                                            {!! Form::hidden('_method', 'DELETE') !!}
                                            {!! Form::button(trans('alerts.buttons.delete'), array('class' => 'btn btn-danger btn-sm','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => trans('alerts.modals.delete_alert_title'), 'data-message' => trans('alerts.modals.delete_alert_message', ['id' => $alert->id]))) !!}
                                            {!! Form::close() !!}
                                        </td>
                                        @endrole
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            @if(config('atm_app.enablePagination'))
                                {{ $alerts->links() }}
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
    @if ((count($alerts) > config('atm_app.datatablesJsStartCount')) && config('atm_app.enabledDatatablesJs'))
        @include('scripts.datatables')
    @endif

    @include('scripts.delete-modal-script')
    @include('scripts.save-modal-script')

    @if(config('atm_app.tooltipsEnabled'))
        @include('scripts.tooltips')
    @endif
@endsection
