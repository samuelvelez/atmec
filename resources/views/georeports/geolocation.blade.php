@extends('layouts.app')

@section('template_title')
    {!! trans('georeports.geolocation.title') !!}
@endsection

@section('template_linked_css')
    @if(config('atm_app.enabledSelectizeJs'))
        <link rel="stylesheet" type="text/css" href="{{ config('atm_app.selectizeCssCDN') }}">
    @endif

    @if(config('atm_app.enabledDatatablesJs'))
        <link rel="stylesheet" type="text/css" href="{{ config('atm_app.datatablesCssCDN') }}">
    @endif
@endsection

@section('template_fastload_css')
    #map-canvas{
    min-height: 700px;
    height: 100%;
    width: 100%;
    }

    .picture-preview {
    height: 200px;
    width: auto;
    }

    .gm-style-iw {
    width: 600px;
    }

    .card-horizontal {
    display: flex;
    flex: 1 1 auto;
    }

    .result-table {
    border: 0;
    }

    .result-table tr td:first-child {
    padding-left: 15px;
    }

    .result-table tr td:last-child {
    padding-right: 15px;
    }

    .result-table caption {
        caption-side: top;
        font-size: 20px;
        line-height: 26px;
        color: #007ab0;
        text-transform: uppercase;
    }

    .result-table.table-responsive,
    .result-table.table-responsive table {
    margin-bottom: 0;
    }

    .modal-picture{
        background-repeat: no-repeat;
        background-position: center center;
        background-size: cover;
        min-height: 300px;
    }

@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                <strong>{!! trans('georeports.geolocation.filters') !!}</strong>
                            </span>
                        </div>
                    </div>

                    <div class="card-body">
                        @include('georeports.filters.geo-filter', [
                            'inventories' => $sinventories,
                            'states' => $states,
                            'materials' => $materials,
                            'l_fasteners' => $l_fasteners,
                            's_fasteners' => $s_fasteners,
                            'all_st' => $all_vst,
                            'ligth_brands' => $ligth_brands
                        ])
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">

                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                <strong>Georeferenciación</strong>
                            </span>

                            <div class="btn-group pull-right btn-group-xs">
                                {!! Form::open(array('id' => 'excel-form', 'url' => '/georeports/signals-excel/')) !!}
                                {!! Form::hidden('excel_criteria', null, array('id' => 'excel_criteria')) !!}
                                {!! Form::hidden("_method", "POST") !!}
                                {!! Form::button('<i class="fa fa-fw fa-file-excel-o"></i> <span class="hidden-xs">Exportar tabla a Excel</span>', array('disabled' => true, 'id' => 'excel-export', 'class' => 'btn btn-success btn-sm float-right mr-2','type' => 'submit')) !!}
                                {!! Form::close() !!}
                                <button disabled  title="Guarda PDF" id="save-image-btn" class="btn btn-sm btn-danger float-right"><i class="fa fa-fw fa-file-pdf-o"></i> <span class="hidden-xs" id="pdf_label">Exportar mapa a PDF</span></button>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div id="map-canvas">
                                Sin acceso al servicio de mapas de Google.
                            </div>
                        </div>
                        <hr/>

                        <div class="row">
                            <div class="table-responsive result-table">
                                @include('georeports.tables.geo-table')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('modals.modal-vsignal');
    @include('modals.modal-light');
    @include('modals.modal-regulator');

@endsection

@section('footer_scripts')
    <script type="text/javascript" src="{{ config('atm_app.selectizeJsCDN') }}"></script>
    <script type="text/javascript" src="{{ config('atm_app.html2canvasJsCdn') }}"></script>

    <script type="text/javascript">
        $(function() {
            $("#l_street").selectize({
                allowClear: true,
                create: false,
                highlight: true,
                diacritics: true
            });

            $("#s_street").selectize({
                allowClear: true,
                create: false,
                highlight: true,
                diacritics: true
            });

            $("#r_street").selectize({
                allowClear: true,
                create: false,
                highlight: true,
                diacritics: true
            });

            $("#l_type").selectize({
                allowClear: true,
                create: false,
                highlight: true,
                diacritics: true
            });

            $("#s_type").selectize({
                allowClear: true,
                create: false,
                highlight: true,
                diacritics: true
            });

            $("#l_state").selectize({
                allowClear: true,
                create: false,
                highlight: true,
                diacritics: true
            });

            $("#s_state").selectize({
                allowClear: true,
                create: false,
                highlight: true,
                diacritics: true
            });

            $("#r_state").selectize({
                allowClear: true,
                create: false,
                highlight: true,
                diacritics: true
            });

            $("#s_material").selectize({
                allowClear: true,
                create: false,
                highlight: true,
                diacritics: true
            });

            $("#l_fastener").selectize({
                allowClear: true,
                create: false,
                highlight: true,
                diacritics: true
            });

            $("#s_fastener").selectize({
                allowClear: true,
                create: false,
                highlight: true,
                diacritics: true
            });

            $("#l_brand").selectize({
                allowClear: true,
                create: false,
                highlight: true,
                diacritics: true
            });

            $("#r_brand").selectize({
                allowClear: true,
                create: false,
                highlight: true,
                diacritics: true
            });
        });
    </script>

    @include('scripts.google-maps-signal-reports')
    @include('scripts.filter-geolocation')
    @include('scripts.google-maps-save-pdf')
@endsection
