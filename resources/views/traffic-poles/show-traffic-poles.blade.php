@extends('layouts.app')

@section('template_title')
    {!! trans('traffic-poles.showing-all-traffic-poles') !!}
@endsection

@section('template_linked_css')
    @if(config('atm_app.enabledDatatablesJs'))
        <link rel="stylesheet" type="text/css" href="{{ config('atm_app.datatablesCssCDN') }}">
    @endif
    <style type="text/css" media="screen">
        .traffic-poles-table {
            border: 0;
        }

        .traffic-poles-table tr td:first-child {
            padding-left: 15px;
        }

        .traffic-poles-table tr td:last-child {
            padding-right: 15px;
        }

        .traffic-poles-table.table-responsive,
        .traffic-poles-table.table-responsive table {
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
                                {!! trans('traffic-poles.showing-all-traffic-poles') !!}
                            </span>

                            @role('atmadmin|atmcollector')
                            <div class="btn-group pull-right btn-group-xs">
                                <a class="btn btn-primary btn-sm" href="/traffic-poles/create">
                                    <i class="fa fa-fw fa-plus" aria-hidden="true"></i>
                                    <span class="hidden-xs">{!! trans('traffic-poles.buttons.create-new') !!}</span>
                                </a>
                            </div>
                            @endrole
                        </div>
                    </div>

                    <div class="card-body">
                        @if(config('atm_app.enableSearch'))
                            @include('partials.search-traffic-poles-form')
                        @endif

                        <div class="table-responsive traffic-poles-table">
                            @include('traffic-poles.traffic-poles-table', [
                                'poles' => $poles,
                                'polestotal' => $polestotal,
                                'actions' => true
                            ])

                            @if(config('atm_app.enablePagination'))
                                {{ $poles->links() }}
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
    @if ((count($poles) > config('atm_app.datatablesJsStartCount')) && config('atm_app.enabledDatatablesJs'))
        @include('scripts.datatables')
    @endif

    @include('scripts.delete-modal-script')
    @include('scripts.save-modal-script')

    @if(config('atm_app.tooltipsEnabled'))
        @include('scripts.tooltips')
    @endif

    @if(config('atm_app.enableSearch'))
        @include('scripts.search-traffic-poles')
    @endif
@endsection
