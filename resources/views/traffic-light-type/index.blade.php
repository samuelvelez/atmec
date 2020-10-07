@extends('layouts.app')

@section('template_title')
    {!! trans('traffic-light-type.showing-all-tlt') !!}
@endsection

@section('template_linked_css')
    @if(config('atm_app.enabledDatatablesJs'))
        <link rel="stylesheet" type="text/css" href="{{ config('atm_app.datatablesCssCDN') }}">
    @endif
    <style type="text/css" media="screen">
        .subgroups-table {
            border: 0;
        }

        .subgroups-table tr td:first-child {
            padding-left: 15px;
        }

        .subgroups-table tr td:last-child {
            padding-right: 15px;
        }

        .subgroups-table.table-responsive,
        .subgroups-table.table-responsive table {
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
                                {!! trans('traffic-light-type.showing-all-ts') !!}
                            </span>

                            <div class="btn-group pull-right btn-group-xs">
                                <a class="btn btn-primary btn-sm" href="/traffic-light-type/create">
                                    <i class="fa fa-fw fa-plus" aria-hidden="true"></i>
                                    <span class="hidden-xs">{!! trans('traffic-light-type.buttons.create-new') !!}</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive subgroups-table">
                            @include('traffic-light-type.table', [
                                'subgroups' => $subgroups,
                                'subgroupstotal' => $subgroupstotal,
                                'actions' => true
                            ])

                            @if(config('atm_app.enablePagination'))
                                {{ $subgroups->links() }}
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
    @if ((count($subgroups) > config('atm_app.datatablesJsStartCount')) && config('atm_app.enabledDatatablesJs'))
        @include('scripts.datatables')
    @endif

    @include('scripts.delete-modal-script')
    @include('scripts.save-modal-script')

    @if(config('atm_app.tooltipsEnabled'))
        @include('scripts.tooltips')
    @endif
@endsection
