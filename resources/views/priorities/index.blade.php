@extends('layouts.app')

@section('template_title')
    {!! trans('priorities.showing-all-priorities') !!}
@endsection

@section('template_linked_css')
    @if(config('atm_app.enabledDatatablesJs'))
        <link rel="stylesheet" type="text/css" href="{{ config('atm_app.datatablesCssCDN') }}">
    @endif
    <style type="text/css" media="screen">
        .priorities-table {
            border: 0;
        }

        .priorities-table tr td:first-child {
            padding-left: 15px;
        }

        .priorities-table tr td:last-child {
            padding-right: 15px;
        }

        .priorities-table.table-responsive,
        .priorities-table.table-responsive table {
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
                                {!! trans('priorities.showing-all-priorities') !!}
                            </span>

                            @role('atmadmin')
                            <div class="btn-group pull-right btn-group-xs">
                                <a class="btn btn-primary btn-sm" href="/priorities/create">
                                    {!! trans('priorities.buttons.create') !!}
                                </a>
                            </div>
                            @endrole
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive priorities-table">
                            <table class="table table-striped table-hover table-sm data-table">
                                <caption id="priorities_count">
                                    {{ trans_choice('priorities.priorities-table.caption', $priorities->count(), ['prioritiestotal' => $prioritiestotal]) }}
                                </caption>
                                <thead class="thead">
                                <tr>
                                    <th>{!! trans('priorities.priorities-table.id') !!}</th>
                                    <th>{!! trans('priorities.priorities-table.name') !!}</th>
                                    <th class="hidden-xs">{!! trans('priorities.priorities-table.description') !!}</th>

                                    <th>{!! trans('priorities.priorities-table.actions') !!}</th>
                                    <th class="no-search no-sort"></th>
                                </tr>
                                </thead>
                                <tbody id="priorities_table">
                                @foreach($priorities as $priority)
                                    <tr>
                                        <td>{{ $priority->id }}</td>
                                        <td>{{ $priority->name }}</td>
                                        <td class="hidden-xs">{{$priority->description}}</td>

                                        @role('atmadmin')
                                        <td>
                                            <a class="btn btn-sm btn-info btn-block"
                                               href="{{ URL::to('priorities/' . $priority->id . '/edit') }}"
                                               data-toggle="tooltip" title="Editar">
                                                {!! trans('priorities.buttons.edit') !!}
                                            </a>
                                        </td>
                                        @endrole
                                        @role('atmadmin')
                                        <td>
                                            {!! Form::open(array('url' => 'priorities/' . $priority->id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Eliminar')) !!}
                                            {!! Form::hidden('_method', 'DELETE') !!}
                                            {!! Form::button(trans('priorities.buttons.delete'), array('class' => 'btn btn-danger btn-sm','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => trans('priorities.modals.delete_priority_title'), 'data-message' => trans('priorities.modals.delete_priority_message', ['id' => $priority->id]))) !!}
                                            {!! Form::close() !!}
                                        </td>
                                        @endrole
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            @if(config('atm_app.enablePagination'))
                                {{ $priorities->links() }}
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
    @if ((count($priorities) > config('atm_app.datatablesJsStartCount')) && config('atm_app.enabledDatatablesJs'))
        @include('scripts.datatables')
    @endif

    @include('scripts.delete-modal-script')
    @include('scripts.save-modal-script')

    @if(config('atm_app.tooltipsEnabled'))
        @include('scripts.tooltips')
    @endif
@endsection
