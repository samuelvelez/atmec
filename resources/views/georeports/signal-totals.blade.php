@extends('layouts.app')

@section('template_title')
    {!! trans('georeports.signal-totals.title') !!}
@endsection

@section('template_linked_css')
    @if(config('atm_app.enabledDatatablesJs'))
        <link rel="stylesheet" type="text/css" href="{{ config('atm_app.datatablesCssCDN') }}">
    @endif
@endsection

@section('template_fastload_css')
    .totals-table {
    border: 0;
    }

    .totals-table tr td:first-child {
    padding-left: 15px;
    }

    .totals-table tr td:last-child {
    padding-right: 15px;
    }

    .totals-table.table-responsive,
    .totals-table.table-responsive table {
    margin-bottom: 0;
    }
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <strong>{!! trans('georeports.signal-totals.title') !!}</strong>
                            <div class="float-right">
                                {!! Form::open(array('url' => '/georeports/signal-totals-excel/')) !!}
                                {!! Form::button('<i class="fa fa-fw fa-file-excel-o"></i> Exportar', array('id' => 'excel-export', 'class' => 'btn btn-success btn-sm float-right mr-1','type' => 'submit')) !!}
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="table-responsive totals-table">
                                @include('georeports.tables.signals-totals-table', [$state_totals, $material_totals, $type_totals, $signal_total, 'logo' => asset('/images/atm.png') ])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer_scripts')

@endsection
