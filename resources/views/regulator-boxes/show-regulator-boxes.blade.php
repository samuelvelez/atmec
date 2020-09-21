@extends('layouts.app')

@section('template_title')
    {!! trans('regulator-boxes.showing-all-regulator-boxes') !!}
@endsection

@section('template_linked_css')
    @if(config('atm_app.enabledDatatablesJs'))
        <link rel="stylesheet" type="text/css" href="{{ config('atm_app.datatablesCssCDN') }}">
    @endif
    <style type="text/css" media="screen">
        .regulator_boxes_table {
            border: 0;
        }

        .regulator_boxes_table tr td:first-child {
            padding-left: 15px;
        }

        .regulator_boxes_table tr td:last-child {
            padding-right: 15px;
        }

        .regulator_boxes_table.table-responsive,
        .regulator_boxes_table.table-responsive table {
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
                                {!! trans('regulator-boxes.showing-all-regulator-boxes') !!}
                            </span>

                            @role('atmadmin|atmcollector')
                            <div class="btn-group pull-right btn-group-xs">
                                <a class="btn btn-primary btn-sm" href="/regulator-boxes/create">
                                    <i class="fa fa-fw fa-plus" aria-hidden="true"></i>
                                    <span class="hidden-xs">{!! trans('regulator-boxes.buttons.create-new') !!}</span>
                                </a>

                                <a href="{{ URL::to('regulator-boxes/export/xlsx') }}" class="btn btn-success btn-sm float-right ml-2"
                                   data-toggle="tooltip" data-placement="left"
                                   title="{{ trans('verticalsignals.buttons.xlsx') }}">
                                    <i class="fa fa-fw fa-file-excel-o" aria-hidden="true"></i>
                                    <span class="hidden-xs">{!! trans('verticalsignals.buttons.xlsx') !!}</span>
                                </a>
                            </div>
                            @endrole
                        </div>
                    </div>

                    <div class="card-body">

                        @if(config('atm_app.enableSearch'))
                            @include('partials.search-regulator-boxes-form')
                        @endif

                        <div class="table-responsive regulator_boxes_table">
                            @include('regulator-boxes.regulators-table', [
                                'regulator_boxes' => $regulator_boxes,
                                'rbox_total' => $regulator_box_total,
                                'actions' => true
                            ])

                            @if(config('atm_app.enablePagination'))
                                {{ $regulator_boxes->links() }}
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
    @if ((count($regulator_boxes) > config('atm_app.datatablesJsStartCount')) && config('atm_app.enabledDatatablesJs'))
        @include('scripts.datatables')
    @endif
    @include('scripts.delete-modal-script')
    @include('scripts.save-modal-script')
    @if(config('atm_app.tooltipsEnabled'))
        @include('scripts.tooltips')
    @endif
    @if(config('atm_app.enableSearch'))
        @include('scripts.search-regulator-boxes')
    @endif
@endsection
