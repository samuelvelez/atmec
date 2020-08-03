@extends('layouts.app')

@section('template_title')
    {!! trans('motives.showing-all-motives') !!}
@endsection

@section('template_linked_css')
    @if(config('atm_app.enabledDatatablesJs'))
        <link rel="stylesheet" type="text/css" href="{{ config('atm_app.datatablesCssCDN') }}">
    @endif
    <style type="text/css" media="screen">
        .motives-table {
            border: 0;
        }

        .motives-table tr td:first-child {
            padding-left: 15px;
        }

        .motives-table tr td:last-child {
            padding-right: 15px;
        }

        .motives-table.table-responsive,
        .motives-table.table-responsive table {
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
                                {!! trans('motives.showing-all-motives') !!}
                            </span>

                            @role('atmadmin')
                            <div class="btn-group pull-right btn-group-xs">
                                <a class="btn btn-primary btn-sm" href="/motives/create">
                                    {!! trans('motives.buttons.create') !!}
                                </a>
                            </div>
                            @endrole
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive motives-table">
                            <table class="table table-striped table-hover table-sm data-table">
                                <caption id="motives_count">
                                    {{ trans_choice('motives.motives-table.caption', $motives->count(), ['motivestotal' => $motivesstotal]) }}
                                </caption>
                                <thead class="thead">
                                <tr>
                                    <th>{!! trans('motives.motives-table.id') !!}</th>
                                    <th>{!! trans('motives.motives-table.name') !!}</th>
                                    <th class="hidden-xs">{!! trans('motives.motives-table.description') !!}</th>

                                    <th>{!! trans('motives.motives-table.actions') !!}</th>
                                    <th class="no-search no-sort"></th>
                                </tr>
                                </thead>
                                <tbody id="motives_table">
                                @foreach($motives as $motive)
                                    <tr>
                                        <td>{{ $motive->id }}</td>
                                        <td>{{ $motive->name }}</td>
                                        <td class="hidden-xs">{{$motive->description}}</td>

                                        @role('atmadmin')
                                        <td>
                                            <a class="btn btn-sm btn-info btn-block"
                                               href="{{ URL::to('motives/' . $motive->id . '/edit') }}"
                                               data-toggle="tooltip" title="Editar">
                                                {!! trans('motives.buttons.edit') !!}
                                            </a>
                                        </td>
                                        @endrole
                                        @role('atmadmin')
                                        <td>
                                            {!! Form::open(array('url' => 'motives/' . $motive->id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Eliminar')) !!}
                                            {!! Form::hidden('_method', 'DELETE') !!}
                                            {!! Form::button(trans('motives.buttons.delete'), array('class' => 'btn btn-danger btn-sm','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => trans('motives.modals.delete_motive_title'), 'data-message' => trans('motives.modals.delete_motive_message', ['id' => $motive->id]))) !!}
                                            {!! Form::close() !!}
                                        </td>
                                        @endrole
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            @if(config('atm_app.enablePagination'))
                                {{ $motives->links() }}
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
    @if ((count($motives) > config('atm_app.datatablesJsStartCount')) && config('atm_app.enabledDatatablesJs'))
        @include('scripts.datatables')
    @endif

    @include('scripts.delete-modal-script')
    @include('scripts.save-modal-script')

    @if(config('atm_app.tooltipsEnabled'))
        @include('scripts.tooltips')
    @endif
@endsection
