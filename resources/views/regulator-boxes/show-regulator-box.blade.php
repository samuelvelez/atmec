@extends('layouts.app')

@section('template_title')
    {!! trans('regulator-boxes.showing-regulator-box', ['code' => $regulator->code]) !!}
@endsection

@section('template_fastload_css')
    .picture {
    height: 200px;
    width: auto;
    border: 2px solid #8eb4cb;
    }

    .pictureBg-in{
    background-image: url("@if ($regulator->picture_in) {{asset('storage/regulators/' . $regulator->picture_in)}} @else {{asset('storage/signals/no-picture.png')}} @endif");
    background-repeat: no-repeat;
    background-position: center center;
    background-size: cover;
    min-height: 300px;
    }

    .pictureBg-out{
    background-image: url("@if ($regulator->picture_out) {{asset('storage/regulators/' . $regulator->picture_out)}} @else {{asset('storage/signals/no-picture.png')}} @endif");
    background-repeat: no-repeat;
    background-position: center center;
    background-size: cover;
    min-height: 300px;
    }

    #map-canvas{
    min-height: 300px;
    height: 100%;
    width: 100%;
    }
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">

                <div class="card">

                    <div class="card-header text-white bg-success">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            {!! trans('regulator-boxes.showing-regulator-box-title', ['code' => $regulator->code]) !!}
                            <div class="float-right">
                                <a href="{{ URL::to('regulator-boxes/') }}" class="btn btn-light btn-sm float-right"
                                   data-toggle="tooltip" data-placement="left"
                                   title="{{ trans('regulator-boxes.tooltips.back-regulator-boxes') }}">
                                    <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
                                    <span class="hidden-xs">{!! trans('regulator-boxes.buttons.back-to-regulator-box') !!}</span>
                                </a>

                                <a href="{{ URL::to('regulator-boxes/' . $regulator->id . '/audit') }}" class="btn btn-danger btn-sm float-right mr-3"
                                   data-toggle="tooltip" data-placement="left"
                                   title="{{ trans('regulator-boxes.audit.button') }}">
                                    <i class="fa fa-fw fa-balance-scale" aria-hidden="true"></i>
                                    <span class="hidden-xs">{!! trans('regulator-boxes.audit.button') !!}</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-10 col-md-12" id="map-canvas">
                                map
                            </div>
                        </div>
                        <br/>

                        <div class="row">
                            <div class="col-sm-4 col-md-6">
                                <strong class="text-larger">
                                    {{ trans('regulator-boxes.labelPicuteIn') }}
                                </strong>
                                <div class="pictureBg-in"></div>
                            </div>
                            <div class="col-sm-4 col-md-6">
                                <strong class="text-larger">
                                    {{ trans('regulator-boxes.labelPicuteOut') }}
                                </strong>
                                <div class="pictureBg-out"></div>
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <div class="row">
                            <div class="col-sm-6 col-6">
                                <strong class="text-larger">
                                    {{ trans('regulator-boxes.labelCode') }}
                                </strong>
                                {{ $regulator->code }}
                            </div>
                            <div class="col-sm-6 col-6">
                                <strong class="text-larger">
                                    {{ trans('regulator-boxes.labelErpCode') }}
                                </strong>
                                {{ $regulator->erp_code }}
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <div class="row">
                            @if ($regulator->latitude)

                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('regulator-boxes.labelLatitude') }}
                                    </strong>
                                    {{ $regulator->latitude }}
                                </div>
                            @endif

                            @if ($regulator->longitude)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('regulator-boxes.labelLongitude') }}
                                    </strong>
                                    {{ $regulator->longitude }}
                                </div>
                            @endif
                        </div>

                        <div class="row">
                            @if ($regulator->intersection_id)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('regulator-boxes.labelIntersection') }}
                                    </strong>
                                    {{ $regulator->intersection->main_st }} y {{ $regulator->intersection->cross_st }}
                                </div>
                            @endif

                            @if ($regulator->google_address)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('regulator-boxes.labelGoogleAddress') }}
                                    </strong>
                                    {{ $regulator->google_address }}
                                </div>
                            @endif
                        </div>
                        
                        <div class="row">
                            @if ($regulator->street1)
                                <div class="col-sm-6 col-6">
                                   <strong class="text-larger">
                                        {{ trans('regulator-boxes.labelStreet1') }}
                                    </strong>
                                    {{ $regulator->street1 }}
                                </div>
                            @endif

                            @if ($regulator->street2)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('regulator-boxes.labelStreet2') }}
                                    </strong>
                                    {{ $regulator->street2 }}
                                </div>
                            @endif
                        </div>

                        <div class="row">
                            @if ($regulator->brand)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('regulator-boxes.labelBrand') }}
                                    </strong>
                                    {{ $regulator->brand }}
                                </div>
                            @endif

                            @if ($regulator->state)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('regulator-boxes.labelState') }}
                                    </strong>
                                    {{ $regulator->state }}
                                </div>
                            @endif
                        </div>

                        <div class="row">
                            @if ($regulator->comment)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('regulator-boxes.labelComment') }}
                                    </strong>
                                    {{ $regulator->comment }}
                                </div>
                            @endif
                            @if ($regulator->user)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('regulator-boxes.labelUser') }}
                                    </strong>
                                    {{ $regulator->user->full_name() }}
                                </div>
                            @endif
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <div class="row">
                            @if ($regulator->created_at)

                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('regulator-boxes.labelCreatedAt') }}
                                    </strong>
                                    {{ $regulator->created_at }}
                                </div>

                            @endif

                            @if ($regulator->updated_at)

                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('regulator-boxes.labelUpdatedAt') }}
                                    </strong>
                                    {{ $regulator->updated_at }}
                                </div>

                            @endif
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <br/>
                        <div class="row">
                            <div class="col-4">
                                <a class="btn btn-sm btn-success btn-block"
                                   href="{{ URL::to('/regulator-boxes/create') }}"><i
                                            class="fa fa-plus-square"></i><span
                                            class="hidden-xs"> Nueva reguladora</span></a>
                            </div>
                            
                            <div class="col-4">
                                <div class="btn-group float-right btn-block" role="group">
                                    <button id="btnGroupDrop1" type="button"
                                            class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                        <span class="hidden-xs">Continuar a...</span>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                        <a class="dropdown-item btn btn-sm"
                                           href="{{ URL::to('/traffic-poles/create') }}"><i
                                                    class="fa fa-plus-square"></i> Nuevo poste</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item btn btn-sm"
                                           href="{{ URL::to('/traffic-tensors/create') }}"><i
                                                    class="fa fa-plus-square"></i> Nuevo tensor</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item btn btn-sm"
                                           href="{{ URL::to('/regulator-devices/create') }}"><i
                                                    class="fa fa-plus-square"></i> Nuevo dispositivo</a>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-4">
                                <a class="btn btn-sm btn-info btn-block"
                                   href="{{ URL::to('regulator-boxes/' . $regulator->id . '/edit') }}"
                                   data-toggle="tooltip" title="Edit">
                                    {!! trans('regulator-boxes.buttons.edit') !!}
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-lg-10 offset-lg-1">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                Dispositivos
                            </span>
                        </div>
                    </div>

                    <div class="card-body">
                        @include('regulator-devices.regulator-devices-table', [
                                'devices' => $regulator->traffic_devices()->orderBy('updated_at', 'desc')->get(),
                                'actions' => false
                            ])
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-lg-10 offset-lg-1">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                Semáforos
                            </span>
                        </div>
                    </div>

                    <div class="card-body">
                        @include('traffic-lights.traffic-lights-table', [
                                'lights' => $regulator->traffic_lights()->orderBy('updated_at', 'desc')->get(),
                                'actions' => false
                            ])
                    </div>
                </div>
            </div>
        </div>

        @if ($regulator->reports)
            <div class="row mt-4">
                <div class="col-lg-10 offset-lg-1">
                    <div class="card">
                        <div class="card-header">
                            <span style="display: flex; justify-content: space-between; align-items: center;">
                                Reportes
                            </span>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-hover table-sm data-table">
                                <thead class="thead">
                                <tr>
                                    <th>{!! trans('reports.reports-table.id') !!}</th>
                                    <th>{!! trans('reports.reports-table.alert') !!}</th>
                                    <th>{!! trans('reports.reports-table.order') !!}</th>
                                    <th>{!! trans('reports.reports-table.status') !!}</th>
                                </tr>
                                </thead>
                                <tbody id="reports_table">
                                @foreach($regulator->reports as $report)
                                    <tr>
                                        <td><a href="{{ URL::to('reports/' . $report->id) }}" data-toggle="tooltip"
                                               title="Mostrar reporte">{{ $report->id }}</a></td>
                                        <td><a href="{{ URL::to('alerts/' . $report->alert_id) }}" data-toggle="tooltip"
                                               title="Mostrar alerta">{{ $report->alert_id }}</a></td>
                                        <td>
                                            @if ($report->workorder)
                                                <a href="{{ URL::to('workorders/' . $report->workorder->id) }}"
                                                   data-toggle="tooltip"
                                                   title="Mostrar orden de trabajo">{{ $report->workorder->id }}</a>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>{{ $report->status->name }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    @include('modals.modal-delete')

@endsection

@section('footer_scripts')
    @include('scripts.delete-modal-script')
    @if(config('atm_app.tooltipsEnabled'))
        @include('scripts.tooltips')
    @endif

    @if(config('settings.googleMapsAPIStatus'))
        @include('scripts.google-maps-atm-show', [
            'latitude' => $regulator->latitude,
            'longitude' => $regulator->longitude,
            'code' => $regulator->code,
        ])
    @endif
@endsection
