@extends('layouts.app')

@section('template_title')
    {!! trans('traffic-poles.showing-traffic-pole', ['id' => $traffic_pole->id]) !!}
@endsection

@section('template_fastload_css')
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
                            {!! trans('traffic-poles.showing-traffic-pole-title', ['id' => $traffic_pole->id]) !!}
                            <div class="float-right">
                                <a href="{{ route('traffic-poles.index') }}" class="btn btn-light btn-sm float-right"
                                   data-toggle="tooltip" data-placement="left"
                                   title="{{ trans('traffic-poles.tooltips.back-traffic-poles') }}">
                                    <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
                                    {!! trans('traffic-poles.buttons.back-to-traffic-poles') !!}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12" id="map-canvas">
                                map
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <div class="row">
                            @if ($traffic_pole->latitude)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('traffic-poles.labelLatitude') }}
                                    </strong>
                                    {{ $traffic_pole->latitude }}
                                </div>
                            @endif

                            @if ($traffic_pole->longitude)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('traffic-poles.labelLongitude') }}
                                    </strong>
                                    {{ $traffic_pole->longitude }}
                                </div>
                            @endif
                        </div>

                        <div class="row">
                            @if ($traffic_pole->id)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('traffic-poles.labelID') }}
                                    </strong>
                                    {{ $traffic_pole->id }}
                                </div>
                            @endif

                            @if ($traffic_pole->erp_code)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('traffic-poles.labelErpCode') }}
                                    </strong>
                                    {{ $traffic_pole->erp_code }}
                                </div>
                            @endif
                        </div>

                        <div class="row">
                            @if ($traffic_pole->google_address)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('traffic-poles.labelGoogleAddress') }}
                                    </strong>
                                    {{ $traffic_pole->google_address }}
                                </div>
                            @endif

                            @if ($traffic_pole->intersection_id)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('traffic-poles.labelIntersection') }}
                                    </strong>
                                    {{ $traffic_pole->intersection->main_st }}
                                    y {{ $traffic_pole->intersection->cross_st }}
                                </div>
                            @endif
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <div class="row">
                            @if ($traffic_pole->height)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('traffic-poles.labelHeight') }}
                                    </strong>
                                    {{ $traffic_pole->height }}m
                                </div>
                            @endif

                            @if ($traffic_pole->state)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('traffic-poles.labelState') }}
                                    </strong>
                                    {{ $traffic_pole->state }}
                                </div>
                            @endif
                        </div>

                        <div class="row">
                            @if ($traffic_pole->material)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('traffic-poles.labelMaterial') }}
                                    </strong>
                                    {{ $traffic_pole->material }}
                                </div>
                            @endif

                            <div class="col-sm-6 col-6">
                                <strong class="text-larger">
                                    {{ trans('traffic-poles.labelAtmOwn') }}
                                </strong>
                                @if ($traffic_pole->atm_own == 0) {{ 'No' }} @else {{ 'Si' }} @endif
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <div class="row">
                            @if ($traffic_pole->user)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('traffic-poles.labelUser') }}
                                    </strong>
                                    {{ $traffic_pole->user->full_name() }}
                                </div>
                            @endif

                            @if ($traffic_pole->comment)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('traffic-poles.labelComment') }}
                                    </strong>
                                    {{ $traffic_pole->comment }}
                                </div>
                            @endif
                        </div>

                        <div class="row">
                            @if ($traffic_pole->created_at)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('traffic-poles.labelCreatedAt') }}
                                    </strong>
                                    {{ $traffic_pole->created_at }}
                                </div>
                            @endif

                            @if ($traffic_pole->updated_at)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('traffic-poles.labelUpdatedAt') }}
                                    </strong>
                                    {{ $traffic_pole->updated_at }}
                                </div>
                            @endif
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <br/>
                        <div class="row">
                            <div class="col-4">
                                <a class="btn btn-sm btn-success btn-block" href="{{ URL::to('/traffic-poles/create') }}"><i
                                            class="fa fa-plus-square"></i><span class="hidden-xs"> Nuevo poste</span></a>
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
                                           href="{{ URL::to('/regulator-boxes/create') }}"><i
                                                    class="fa fa-plus-square"></i> Nueva reguladora</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item btn btn-sm"
                                           href="{{ URL::to('/traffic-tensors/create') }}"><i
                                                    class="fa fa-plus-square"></i> Nuevo tensor</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item btn btn-sm"
                                           href="{{ URL::to('/traffic-lights/create') }}"><i
                                                    class="fa fa-plus-square"></i> Nuevo semáforo</a>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-4"><a class="btn btn-sm btn-info btn-block"
                                                  href="{{ URL::to('traffic-poles/' . $traffic_pole->id . '/edit') }}"><i
                                            class="fa fa-edit"></i> <span class="hidden-xs">Editar</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if ($traffic_pole->reports)
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
                                @foreach($traffic_pole->reports as $report)
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
            'latitude' => $traffic_pole->latitude,
            'longitude' => $traffic_pole->longitude,
            'code' => $traffic_pole->code,
        ])
    @endif
@endsection
