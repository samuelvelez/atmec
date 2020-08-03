@extends('layouts.app')

@section('template_title')
    {!! trans('metric-units.showing-all-metrics') !!}
@endsection

@section('template_linked_css')
    @if(config('atm_app.enabledDatatablesJs'))
        <link rel="stylesheet" type="text/css" href="{{ config('atm_app.datatablesCssCDN') }}">
    @endif
    <style type="text/css" media="screen">
        .metric-units-table {
            border: 0;
        }

        .metric-units-table tr td:first-child {
            padding-left: 15px;
        }

        .metric-units-table tr td:last-child {
            padding-right: 15px;
        }

        .metric-units-table.table-responsive,
        .metric-units-table.table-responsive table {
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
                                {!! trans('metric-units.showing-all-metrics') !!}
                            </span>

                            @role('atmadmin')
                            <div class="btn-group pull-right btn-group-xs">
                                <a class="btn btn-primary btn-sm" href="/metric-units/create">
                                    {!! trans('metric-units.buttons.create') !!}
                                </a>
                            </div>
                            @endrole
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive metric-units-table">
                            <table class="table table-striped table-hover table-sm data-table">
                                <caption id="metric-units_count">
                                    {{ trans_choice('metric-units.metrics-table.caption', $metrics->count(), ['metricstotal' => $metricstotal]) }}
                                </caption>
                                <thead class="thead">
                                <tr>
                                    <th>{!! trans('metric-units.metrics-table.id') !!}</th>
                                    <th>{!! trans('metric-units.metrics-table.name') !!}</th>
                                    <th>{!! trans('metric-units.metrics-table.abbreviation') !!}</th>
                                    <th class="hidden-xs">{!! trans('metric-units.metrics-table.description') !!}</th>

                                    <th>{!! trans('metric-units.metrics-table.actions') !!}</th>
                                    <th class="no-search no-sort"></th>
                                </tr>
                                </thead>
                                <tbody id="metric-units_table">
                                @foreach($metrics as $motive)
                                    <tr>
                                        <td>{{ $motive->id }}</td>
                                        <td>{{ $motive->name }}</td>
                                        <td>{{ $motive->abbreviation }}</td>
                                        <td class="hidden-xs">{{$motive->description}}</td>

                                        @role('atmadmin')
                                        <td>
                                            <a class="btn btn-sm btn-info btn-block"
                                               href="{{ URL::to('metric-units/' . $motive->id . '/edit') }}"
                                               data-toggle="tooltip" title="Editar">
                                                {!! trans('metric-units.buttons.edit') !!}
                                            </a>
                                        </td>
                                        @endrole
                                        @role('atmadmin')
                                        <td>
                                            {!! Form::open(array('url' => 'metric-units/' . $motive->id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Eliminar')) !!}
                                            {!! Form::hidden('_method', 'DELETE') !!}
                                            {!! Form::button(trans('metric-units.buttons.delete'), array('class' => 'btn btn-danger btn-sm','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => trans('metric-units.modals.delete_metric_title'), 'data-message' => trans('metric-units.modals.delete_metric_message', ['id' => $motive->id]))) !!}
                                            {!! Form::close() !!}
                                        </td>
                                        @endrole
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            @if(config('atm_app.enablePagination'))
                                {{ $metrics->links() }}
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
    @if ((count($metrics) > config('atm_app.datatablesJsStartCount')) && config('atm_app.enabledDatatablesJs'))
        @include('scripts.datatables')
    @endif

    @include('scripts.delete-modal-script')
    @include('scripts.save-modal-script')

    @if(config('atm_app.tooltipsEnabled'))
        @include('scripts.tooltips')
    @endif
@endsection
