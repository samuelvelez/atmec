@extends('layouts.app')

@section('template_title')
    {!! trans('traffic-lights.showing-all-traffic-lights') !!}
@endsection

@section('template_linked_css')
    @if(config('atm_app.enabledDatatablesJs'))
        <link rel="stylesheet" type="text/css" href="{{ config('atm_app.datatablesCssCDN') }}">
    @endif
    <style type="text/css" media="screen">
        .traffic-lights-table {
            border: 0;
        }

        .traffic-lights-table tr td:first-child {
            padding-left: 15px;
        }

        .traffic-lights-table tr td:last-child {
            padding-right: 15px;
        }

        .traffic-lights-table.table-responsive,
        .traffic-lights-table.table-responsive table {
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
                                {!! trans('traffic-lights.showing-all-traffic-lights') !!}
                            </span>

                            @role('atmadmin|atmcollector')
                            <div class="btn-group pull-right btn-group-xs">
                                <a class="btn btn-primary btn-sm" href="/traffic-lights/create">
                                    <i class="fa fa-fw fa-plus" aria-hidden="true"></i>
                                    <span class="hidden-xs">{!! trans('traffic-lights.buttons.create-new') !!}</span>
                                </a>

                                <a href="{{ URL::to('traffic-lights/export/xlsx') }}" class="btn btn-success btn-sm float-right ml-2"
                                   data-toggle="tooltip" data-placement="left"
                                   title="{{ trans('traffic-lights.buttons.xlsx') }}">
                                    <i class="fa fa-fw fa-file-excel-o" aria-hidden="true"></i>
                                    <span class="hidden-xs">{!! trans('traffic-lights.buttons.xlsx') !!}</span>
                                </a>
                            </div>
                            @endrole
                        </div>
                    </div>

                    <div class="card-body">
                        @if(config('atm_app.enableSearch'))
                            @include('partials.search-traffic-lights-form')
                        @endif

                        <div class="table-responsive traffic-lights-table">
                            @include('traffic-lights.traffic-lights-table', [
                                'lights' => $lights,
                                'lightstotal' => $lightstotal,
                                'actions' => true
                            ])

                            @if(config('atm_app.enablePagination'))
                                {{ $lights->links() }}
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
    @if ((count($lights) > config('atm_app.datatablesJsStartCount')) && config('atm_app.enabledDatatablesJs'))
        @include('scripts.datatables')
    @endif

    @include('scripts.delete-modal-script')
    @include('scripts.save-modal-script')

    @if(config('atm_app.tooltipsEnabled'))
        @include('scripts.tooltips')
    @endif

    @if(config('atm_app.enableSearch'))
        @include('scripts.search-traffic-lights')
    @endif
@endsection
