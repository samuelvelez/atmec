@extends('layouts.app')

@section('template_title')
    {!! trans('workorders.showing-all-workorders') !!}
@endsection

@section('template_linked_css')
    @if(config('atm_app.enabledDatatablesJs'))
        <link rel="stylesheet" type="text/css" href="{{ config('atm_app.datatablesCssCDN') }}">
    @endif
    <style type="text/css" media="screen">
        .workorders-table {
            border: 0;
        }

        .workorders-table tr td:first-child {
            padding-left: 15px;
        }

        .workorders-table tr td:last-child {
            padding-right: 15px;
        }

        .workorders-table.table-responsive,
        .workorders-table.table-responsive table {
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
                                {!! trans('workorders.showing-all-workorders') !!}
                            </span>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive workorders-table">
                            <table class="table table-striped table-hover table-sm data-table">
                                <caption id="workorders_count">
                                    {{ trans_choice('workorders.workorders-table.caption', $workorders->count(), ['workorderstotal' => $workorderstotal]) }}
                                </caption>
                                <thead class="thead">
                                <tr>
                                    <th>{!! trans('workorders.workorders-table.id') !!}</th>
                                    <th>{!! trans('workorders.workorders-table.report') !!}</th>
                                    <th>{!! trans('workorders.workorders-table.collector') !!}</th>
                                    <th>{!! trans('workorders.workorders-table.status') !!}</th>
                                    <th>{!! trans('workorders.workorders-table.priority') !!}</th>
                                    <th class="hidden-xs">{!! trans('workorders.workorders-table.description') !!}</th>
                                    <th class="hidden-xs">{!! trans('workorders.workorders-table.started') !!}</th>
                                    <th class="hidden-xs">{!! trans('workorders.workorders-table.completed') !!}</th>

                                    <th>{!! trans('workorders.workorders-table.actions') !!}</th>
                                    <th class="no-search no-sort"></th>
                                    <th class="no-search no-sort"></th>
                                    <th class="no-search no-sort"></th>
                                </tr>
                                </thead>
                                <tbody id="workorders_table">
                                @foreach($workorders as $workorder)
                                    <tr>
                                        <td><a href="{{ URL::to('workorders/' . $workorder->id) }}"
                                               data-toggle="tooltip"
                                               title="Ver órden de trabajo">{{ $workorder->id }}</a></td>
                                        <td><a href="{{ URL::to('reports/' . $workorder->report->id) }}"
                                               data-toggle="tooltip"
                                               title="Ver reporte">{{ $workorder->report->id }}</a></td>
                                        <td>{{ $workorder->collector->full_name() }}</td>
                                        <td>{{ $workorder->status->name }}</td>
                                        <td>{{ $workorder->priority->name }}</td>
                                        <td class="hidden-xs">{{$workorder->description}}</td>
                                        <td class="hidden-xs">
                                            @if ($workorder->started_on)
                                                {{ $workorder->started_on }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="hidden-xs">
                                            @if ($workorder->completed_on)
                                                {{ $workorder->completed_on }}
                                            @else
                                                -
                                            @endif
                                        </td>

                                        <td>
                                            @if (Auth::user()->hasRole('atmcollector') && !$workorder->completed_on)
                                                <a class="btn btn-sm btn-warning btn-block"
                                                   href="{{ URL::to('workorders/' . $workorder->id . '/close') }}"
                                                   data-toggle="tooltip" title="Cerrar órden de trabajo">
                                                    {!! trans('workorders.buttons.close_order') !!}
                                                </a>
                                            @elseif(Auth::user()->hasRole('atmoperator') && $workorder->status->name == \App\Models\Workorder::STATUS_CLOSED)
                                                {!! Form::open(array('url' => 'workorders/' . $workorder->id . '/complete', 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Finalizar orden')) !!}
                                                {!! Form::hidden('_method', 'POST') !!}
                                                {!! Form::button(trans('workorders.buttons.complete_order'), array('class' => 'btn btn-warning btn-sm','type' => 'submit', 'style' =>'width: 100%;'), ['id' => $workorder->id]) !!}
                                                {!! Form::close() !!}
                                            @endif
                                        </td>

                                        <td>
                                            <a class="btn btn-sm btn-success btn-block"
                                               href="{{ URL::to('workorders/' . $workorder->id) }}"
                                               data-toggle="tooltip" title="Mostrar la órden de trabajo">
                                                {!! trans('workorders.buttons.show') !!}
                                            </a>
                                        </td>

                                        @if (Auth::user()->hasRole('atmoperator') && $workorder->status->name == \App\Models\Workorder::STATUS_OPEN)
                                        <td>
                                            <a class="btn btn-sm btn-info btn-block"
                                               href="{{ URL::to('workorders/' . $workorder->id . '/edit') }}"
                                               data-toggle="tooltip" title="Editar">
                                                {!! trans('workorders.buttons.edit') !!}
                                            </a>
                                        </td>

                                        <td>
                                            {!! Form::open(array('url' => 'workorders/' . $workorder->id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Eliminar')) !!}
                                            {!! Form::hidden('_method', 'DELETE') !!}
                                            {!! Form::button(trans('workorders.buttons.delete'), array('class' => 'btn btn-danger btn-sm','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => trans('workorders.modals.delete_workorder_title'), 'data-message' => trans('workorders.modals.delete_workorder_message', ['id' => $workorder->id]))) !!}
                                            {!! Form::close() !!}
                                        </td>
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            @if(config('atm_app.enablePagination'))
                                {{ $workorders->links() }}
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
    @if ((count($workorders) > config('atm_app.datatablesJsStartCount')) && config('atm_app.enabledDatatablesJs'))
        @include('scripts.datatables')
    @endif

    @include('scripts.delete-modal-script')
    @include('scripts.save-modal-script')

    @if(config('atm_app.tooltipsEnabled'))
        @include('scripts.tooltips')
    @endif
@endsection
