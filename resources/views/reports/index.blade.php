@extends('layouts.app')

@section('template_title')
    {!! trans('reports.showing-all-reports') !!}
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
                                {!! trans('reports.showing-all-reports') !!}
                            </span>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive reports-table">
                            <table class="table table-striped table-hover table-sm data-table">
                                <caption id="reports_count">
                                    {{ trans_choice('reports.reports-table.caption', $reports->count(), ['reportstotal' => $reportstotal]) }}
                                </caption>
                                <thead class="thead">
                                <tr>
                                    <th>{!! trans('reports.reports-table.id') !!}</th>
                                    <th>{!! trans('reports.reports-table.alert') !!}</th>
                                    <th>{!! trans('reports.reports-table.status') !!}</th>
                                    <th>{!! trans('reports.reports-table.novelty') !!}</th>
                                    <th>{!! trans('reports.reports-table.subnovelty') !!}</th>
                                    <th>{!! trans('reports.reports-table.worktype') !!}</th>
                                    <th class="hidden-xs">{!! trans('reports.reports-table.readed') !!}</th>
                                    <th class="hidden-xs">{!! trans('reports.reports-table.description') !!}</th>

                                    <th>{!! trans('reports.reports-table.actions') !!}</th>
                                    <th class="no-search no-sort"></th>
                                    <th class="no-search no-sort"></th>
                                    <th class="no-search no-sort"></th>
                                </tr>
                                </thead>
                                <tbody id="reports_table">
                                @foreach($reports as $report)
                                    <tr>
                                        <td><a href="{{ URL::to('reports/' . $report->id) }}" data-toggle="tooltip"
                                               title="Mostrar reporte">{{ $report->id }}</a></td>
                                        <td><a href="{{ URL::to('alerts/' . $report->alert_id) }}" data-toggle="tooltip"
                                               title="Mostrar alerta">{{ $report->alert_id }}</a></td>
                                        <td>{{ $report->status->name }}</td>
                                        <td>{{ $report->novelty->name }}</td>
                                        <td>{{ $report->subnovelty->name }}</td>
                                        <td>{{ $report->worktype->name }}</td>
                                        <td class="hidden-xs">
                                            @if ($report->readed_on)
                                                {{ $report->readed_on }}
                                            @else
                                                No leido
                                            @endif
                                        </td>
                                        <td class="hidden-xs">{{$report->description}}</td>

                                        <td>
                                            @if ( (Auth::user()->hasRole('atmoperator') || Auth::user()->hasRole('ccitt')) && !$report->workorder)
                                                <a class="btn btn-sm btn-warning btn-block"
                                                   href="{{ URL::to('workorders/' . $report->id . '/create/') }}"
                                                   data-toggle="tooltip" title="Crear órden de trabajo">
                                                    {!! trans('reports.buttons.create_workorder') !!}
                                                </a>
                                            @endif
                                        </td>

                                        <td>
                                            <a class="btn btn-sm btn-success btn-block"
                                               href="{{ URL::to('reports/' . $report->id) }}"
                                               data-toggle="tooltip" title="Mostrar el reporte">
                                                {!! trans('reports.buttons.show') !!}
                                            </a>
                                        </td>

                                        @role('atmoperator|ccitt')
                                        <td>
                                            <a class="btn btn-sm btn-info btn-block"
                                               href="{{ URL::to('reports/' . $report->id . '/edit') }}"
                                               data-toggle="tooltip" title="Editar">
                                                {!! trans('reports.buttons.edit') !!}
                                            </a>
                                        </td>
                                        @endrole

                                        @role('atmoperator|atmcollector|ccitt')
                                        <td>
                                            {!! Form::open(array('url' => 'reports/' . $report->id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Eliminar')) !!}
                                            {!! Form::hidden('_method', 'DELETE') !!}
                                            {!! Form::button(trans('reports.buttons.delete'), array('class' => 'btn btn-danger btn-sm','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => trans('reports.modals.delete_report_title'), 'data-message' => trans('reports.modals.delete_report_message', ['id' => $report->id]))) !!}
                                            {!! Form::close() !!}
                                        </td>
                                        @endrole
                                        </td>
                                    </tr>
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
