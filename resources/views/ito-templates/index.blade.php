@extends('layouts.app')

@section('template_title')
    {!! trans('ito-templates.showing-all-templates') !!}
@endsection

@section('template_linked_css')
    @if(config('atm_app.enabledDatatablesJs'))
        <link rel="stylesheet" type="text/css" href="{{ config('atm_app.datatablesCssCDN') }}">
    @endif
    <style type="text/css" media="screen">
        .templates-table {
            border: 0;
        }

        .templates-table tr td:first-child {
            padding-left: 15px;
        }

        .templates-table tr td:last-child {
            padding-right: 15px;
        }

        .templates-table.table-responsive,
        .templates-table.table-responsive table {
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
                                {!! trans('ito-templates.showing-all-templates') !!}
                            </span>

                            @role('atmadmin|atmstockkeeper')
                            <div class="btn-group pull-right btn-group-xs">
                                <a class="btn btn-primary btn-sm" href="/ito-templates/create">
                                    {!! trans('ito-templates.buttons.create') !!}
                                </a>
                            </div>
                            @endrole
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive templates-table">
                            <table class="table table-striped table-hover table-sm data-table">
                                <caption id="templates_count">
                                    {{ trans_choice('ito-templates.templates-table.caption', $templates->count(), ['templatestotal' => $templatestotal]) }}
                                </caption>
                                <thead class="thead">
                                <tr>
                                    <th>{!! trans('ito-templates.templates-table.id') !!}</th>
                                    <th>{!! trans('ito-templates.templates-table.name') !!}</th>
                                    <th>{!! trans('ito-templates.templates-table.materials') !!}</th>
                                    <th class="hidden-xs">{!! trans('ito-templates.templates-table.description') !!}</th>

                                    <th>{!! trans('ito-templates.templates-table.actions') !!}</th>
                                    <th class="no-search no-sort"></th>
                                    <th class="no-search no-sort"></th>
                                </tr>
                                </thead>
                                <tbody id="templates_table">
                                @foreach($templates as $template)
                                    <tr>
                                        <td><a href="{{ URL::to('ito-templates/' . $template->id) }}">{{ $template->id }}</a></td>
                                        <td>{{ $template->name }}</td>
                                        <td>{{ $template->materials()->count() }}</td>
                                        <td class="hidden-xs">{{$template->description}}</td>

                                        @role('atmadmin|atmstockkeeper')
                                        <td>
                                            <a class="btn btn-sm btn-success btn-block"
                                               href="{{ URL::to('ito-templates/' . $template->id) }}"
                                               data-toggle="tooltip" title="Ver">
                                                {!! trans('ito-templates.buttons.show') !!}
                                            </a>
                                        </td>

                                        <td>
                                            <a class="btn btn-sm btn-info btn-block"
                                               href="{{ URL::to('ito-templates/' . $template->id . '/edit') }}"
                                               data-toggle="tooltip" title="Editar">
                                                {!! trans('ito-templates.buttons.edit') !!}
                                            </a>
                                        </td>

                                        <td>
                                            {!! Form::open(array('url' => 'ito-templates/' . $template->id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Eliminar')) !!}
                                            {!! Form::hidden('_method', 'DELETE') !!}
                                            {!! Form::button(trans('ito-templates.buttons.delete'), array('class' => 'btn btn-danger btn-sm','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => trans('ito-templates.modals.delete_template_title'), 'data-message' => trans('ito-templates.modals.delete_template_message', ['id' => $template->id]))) !!}
                                            {!! Form::close() !!}
                                        </td>
                                        @endrole
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            @if(config('atm_app.enablePagination'))
                                {{ $templates->links() }}
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
    @if ((count($templates) > config('atm_app.datatablesJsStartCount')) && config('atm_app.enabledDatatablesJs'))
        @include('scripts.datatables')
    @endif

    @include('scripts.delete-modal-script')
    @include('scripts.save-modal-script')

    @if(config('atm_app.tooltipsEnabled'))
        @include('scripts.tooltips')
    @endif
@endsection
