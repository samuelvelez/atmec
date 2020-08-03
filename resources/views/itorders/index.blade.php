@extends('layouts.app')

@section('template_title')
    {!! trans('itorders.showing-all-itorders') !!}
@endsection

@section('template_linked_css')
    @if(config('atm_app.enabledDatatablesJs'))
        <link rel="stylesheet" type="text/css" href="{{ config('atm_app.datatablesCssCDN') }}">
    @endif
    <style type="text/css" media="screen">
        .itorders-table {
            border: 0;
        }

        .itorders-table tr td:first-child {
            padding-left: 15px;
        }

        .itorders-table tr td:last-child {
            padding-right: 15px;
        }

        .itorders-table.table-responsive,
        .itorders-table.table-responsive table {
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
                                {!! trans('itorders.showing-all-itorders') !!}
                            </span>

                            @role('atmadmin|atmstockkeeper')
                            <div class="btn-group pull-right btn-group-xs">
                                <a class="btn btn-primary btn-sm" href="/itorders/create">
                                    {!! trans('itorders.buttons.create') !!}
                                </a>
                            </div>
                            @endrole
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive itorders-table">
                            <table class="table table-striped table-hover table-sm data-table">
                                <caption id="itorders_count">
                                    {{ trans_choice('itorders.itorders-table.caption', $itorders->count(), ['itorderstotal' => $itorderstotal]) }}
                                </caption>
                                <thead class="thead">
                                <tr>
                                    <th>{!! trans('itorders.itorders-table.id') !!}</th>
                                    <th>{!! trans('itorders.itorders-table.collector') !!}</th>
                                    <th>{!! trans('itorders.itorders-table.materials') !!}</th>
                                    <th>{!! trans('itorders.itorders-table.created') !!}</th>
                                    <th>{!! trans('itorders.itorders-table.actions') !!}</th>
                                    <th class="no-search no-sort"></th>
                                    <th class="no-search no-sort"></th>
                                </tr>
                                </thead>
                                <tbody id="itorders_table">
                                @foreach($itorders as $itorder)
                                    <tr>
                                        <td><a href="{{ URL::to('itorders/' . $itorder->id) }}">{{ $itorder->id }}</a></td>
                                        <td>{{ $itorder->collector->full_name() }}</td>
                                        <td>{{ $itorder->materials()->count() }}</td>
                                        <td>{{ $itorder->created_at }}</td>

                                        @role('atmadmin|atmstockkeeper')
                                        <td>
                                            <a class="btn btn-sm btn-success btn-block"
                                               href="{{ URL::to('itorders/' . $itorder->id) }}"
                                               data-toggle="tooltip" title="Ver">
                                                {!! trans('itorders.buttons.show') !!}
                                            </a>
                                        </td>

                                        <td>
                                            <a class="btn btn-sm btn-info btn-block"
                                               href="{{ URL::to('itorders/' . $itorder->id . '/edit') }}"
                                               data-toggle="tooltip" title="Editar">
                                                {!! trans('itorders.buttons.edit') !!}
                                            </a>
                                        </td>

                                        <td>
                                            {!! Form::open(array('url' => 'itorders/' . $itorder->id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Eliminar')) !!}
                                            {!! Form::hidden('_method', 'DELETE') !!}
                                            {!! Form::button(trans('itorders.buttons.delete'), array('class' => 'btn btn-danger btn-sm','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => trans('itorders.modals.delete_itorder_title'), 'data-message' => trans('itorders.modals.delete_itorder_message', ['id' => $itorder->id]))) !!}
                                            {!! Form::close() !!}
                                        </td>
                                        @endrole
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            @if(config('atm_app.enablePagination'))
                                {{ $itorders->links() }}
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
    @if ((count($itorders) > config('atm_app.datatablesJsStartCount')) && config('atm_app.enabledDatatablesJs'))
        @include('scripts.datatables')
    @endif

    @include('scripts.delete-modal-script')
    @include('scripts.save-modal-script')

    @if(config('atm_app.tooltipsEnabled'))
        @include('scripts.tooltips')
    @endif
@endsection
