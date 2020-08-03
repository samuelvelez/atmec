@extends('layouts.app')

@section('template_title')
    {!! trans('statuses.showing-all-statuses') !!}
@endsection

@section('template_linked_css')
    @if(config('atm_app.enabledDatatablesJs'))
        <link rel="stylesheet" type="text/css" href="{{ config('atm_app.datatablesCssCDN') }}">
    @endif
    <style type="text/css" media="screen">
        .statuses-table {
            border: 0;
        }

        .statuses-table tr td:first-child {
            padding-left: 15px;
        }

        .statuses-table tr td:last-child {
            padding-right: 15px;
        }

        .statuses-table.table-responsive,
        .statuses-table.table-responsive table {
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
                                {!! trans('statuses.showing-all-statuses') !!}
                            </span>

                            @role('atmadmin')
                            <div class="btn-group pull-right btn-group-xs">
                                <a class="btn btn-primary btn-sm" href="/statuses/create">
                                    {!! trans('statuses.buttons.create') !!}
                                </a>
                            </div>
                            @endrole
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive statuses-table">
                            <table class="table table-striped table-hover table-sm data-table">
                                <caption id="statuses_count">
                                    {{ trans_choice('statuses.statuses-table.caption', $statuses->count(), ['statusestotal' => $statusestotal]) }}
                                </caption>
                                <thead class="thead">
                                <tr>
                                    <th>{!! trans('statuses.statuses-table.id') !!}</th>
                                    <th>{!! trans('statuses.statuses-table.name') !!}</th>
                                    <th class="hidden-xs">{!! trans('statuses.statuses-table.description') !!}</th>

                                    <th>{!! trans('statuses.statuses-table.actions') !!}</th>
                                    <th class="no-search no-sort"></th>
                                </tr>
                                </thead>
                                <tbody id="statuses_table">
                                @foreach($statuses as $status)
                                    <tr>
                                        <td>{{ $status->id }}</td>
                                        <td>{{ $status->name }}</td>
                                        <td class="hidden-xs">{{$status->description}}</td>

                                        @role('atmadmin')
                                        <td>
                                            <a class="btn btn-sm btn-info btn-block"
                                               href="{{ URL::to('statuses/' . $status->id . '/edit') }}"
                                               data-toggle="tooltip" title="Editar">
                                                {!! trans('statuses.buttons.edit') !!}
                                            </a>
                                        </td>
                                        @endrole
                                        @role('atmadmin')
                                        <td>
                                            {!! Form::open(array('url' => 'statuses/' . $status->id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Eliminar')) !!}
                                            {!! Form::hidden('_method', 'DELETE') !!}
                                            {!! Form::button(trans('statuses.buttons.delete'), array('class' => 'btn btn-danger btn-sm','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => trans('statuses.modals.delete_status_title'), 'data-message' => trans('statuses.modals.delete_status_message', ['id' => $status->id]))) !!}
                                            {!! Form::close() !!}
                                        </td>
                                        @endrole
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            @if(config('atm_app.enablePagination'))
                                {{ $statuses->links() }}
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
    @if ((count($statuses) > config('atm_app.datatablesJsStartCount')) && config('atm_app.enabledDatatablesJs'))
        @include('scripts.datatables')
    @endif

    @include('scripts.delete-modal-script')
    @include('scripts.save-modal-script')

    @if(config('atm_app.tooltipsEnabled'))
        @include('scripts.tooltips')
    @endif
@endsection
