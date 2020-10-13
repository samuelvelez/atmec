@extends('layouts.app')

@section('template_title')
    {!! trans('traffic-lights.showing-traffic-light', ['id' => $traffic_light->id]) !!}
@endsection

@section('template_fastload_css')
    #map-canvas{
    min-height: 300px;
    height: 100%;
    width: 100%;
    }

    .pictureBg{
    background-image: url("{{ asset($traffic_light->get_picture_path()) }}");
    background-repeat: no-repeat;
    background-position: center center;
    background-size: cover;
    min-height: 300px;
    }
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="card">
                    <div class="card-header text-white bg-success">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            {!! trans('traffic-lights.showing-traffic-light-title', ['id' => $traffic_light->id]) !!}
                            <div class="float-right">
                                <a href="{{ route('traffic-lights.index') }}" class="btn btn-light btn-sm float-right"
                                   data-toggle="tooltip" data-placement="left"
                                   title="{{ trans('traffic-lights.tooltips.back-traffic-lights') }}">
                                    <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
                                    {!! trans('traffic-lights.buttons.back-to-traffic-lights') !!}
                                </a>

                                <a href="{{ URL::to('traffic-lights/' . $traffic_light->id . '/audit') }}" class="btn btn-danger btn-sm float-right mr-3"
                                   data-toggle="tooltip" data-placement="left"
                                   title="{{ trans('traffic-lights.audit.button') }}">
                                    <i class="fa fa-fw fa-balance-scale" aria-hidden="true"></i>
                                    <span class="hidden-xs">{!! trans('traffic-lights.audit.button') !!}</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4 col-md-6 pictureBg">
                            </div>
                            <div class="col-sm-4 col-md-6" id="map-canvas">
                                @if ($traffic_light->intersection->latitude == null || $traffic_light->intersection->longitude == null)
                                    <strong>Las coordenadas de la intersección seleccionada son incorrectas</strong>
                                @endif
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <div class="row">
                            @if ($traffic_light->code)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('traffic-lights.labelCode') }}
                                    </strong>
                                    {{ $traffic_light->code }}
                                </div>
                            @endif

                            @if ($traffic_light->erp_code)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('traffic-lights.labelErpCode') }}
                                    </strong>
                                    {{ $traffic_light->erp_code }}
                                </div>
                            @endif
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <div class="row">
                            @if ($traffic_light->brand)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('traffic-lights.labelBrand') }}
                                    </strong>
                                    {{ $traffic_light->brand }}
                                </div>
                            @endif

                            @if ($traffic_light->model)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('traffic-lights.labelModel') }}
                                    </strong>
                                    {{ $traffic_light->model }}
                                </div>
                            @endif
                        </div>

                        <div class="row">
                            @if ($traffic_light->orientation)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('traffic-lights.labelOrientation') }}
                                    </strong>
                                    {{ $traffic_light->orientation }}
                                </div>
                            @endif

                            @if ($traffic_light->state)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('traffic-lights.labelState') }}
                                    </strong>
                                    {{ $traffic_light->state }}
                                </div>
                            @endif
                        </div>

                        <div class="row">
                            @if ($traffic_light->regulator)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('traffic-lights.labelRegulator') }}
                                    </strong>
                                    {{ $traffic_light->regulator->code }}
                                    | {{ $traffic_light->regulator->intersection->main_st }}
                                    y {{ $traffic_light->regulator->intersection->cross_st }}
                                </div>
                            @endif

                            @if ($traffic_light->light_type)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('traffic-lights.labelType') }}
                                    </strong>
                                    {{ $traffic_light->light_type->description }}
                                </div>
                            @endif
                        </div>

                        <div class="row">
                            @if ($traffic_light->intersection)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('traffic-lights.labelIntersection') }}
                                    </strong>
                                    {{ $traffic_light->intersection->main_st }}
                                    y {{ $traffic_light->intersection->cross_st }}
                                </div>
                            @endif

                            @if ($traffic_light->traffic_pole)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('traffic-lights.labelPole') }}
                                    </strong>
                                    {{ $traffic_light->traffic_pole->id }}
                                </div>
                            @elseif ($traffic_light->traffic_tensor)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('traffic-lights.labelTensor') }}
                                    </strong>
                                    {{ $traffic_light->traffic_tensor->id }}
                                </div>
                            @endif
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <div class="row">
                            @if ($traffic_light->user)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('traffic-lights.labelUser') }}
                                    </strong>
                                    {{ $traffic_light->user->full_name() }}
                                </div>
                            @endif

                            <div class="col-sm-6 col-6">
                                <strong class="text-larger">
                                    {{ trans('traffic-lights.labelComment') }}
                                </strong>
                                @if ($traffic_light->comment){{ $traffic_light->comment }} @else {{ 'Sin comentarios' }} @endif
                            </div>
                        </div>

                        <div class="row">
                            @if ($traffic_light->created_at)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('traffic-lights.labelCreatedAt') }}
                                    </strong>
                                    {{ $traffic_light->created_at }}
                                </div>
                            @endif

                            @if ($traffic_light->updated_at)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('traffic-lights.labelUpdatedAt') }}
                                    </strong>
                                    {{ $traffic_light->updated_at }}
                                </div>
                            @endif
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <br/>
                        <div class="row">
                            <div class="col-4">
                                <a class="btn btn-sm btn-success btn-block" href="{{ URL::to('/traffic-lights/create') }}"><i class="fa fa-plus-square"></i> Nuevo semáforo</a>
                            </div>
                            
                            <div class="col-4">
                                <div class="btn-group float-right btn-block" role="group">
                                    <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Continuar a...
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                        <a class="dropdown-item btn btn-sm" href="{{ URL::to('/traffic-lights/create') }}"><i class="fa fa-plus-square"></i> Nueva reguladora</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item btn btn-sm" href="{{ URL::to('/traffic-tensors/create') }}"><i class="fa fa-plus-square"></i> Nuevo tensor</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item btn btn-sm" href="{{ URL::to('/traffic-poles/create') }}"><i class="fa fa-plus-square"></i> Nuevo poste</a>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-4"><a class="btn btn-sm btn-info btn-block"
                                                  href="{{ URL::to('traffic-lights/' . $traffic_light->id . '/edit') }}"><i
                                            class="fa fa-edit"></i> <span class="hidden-xs">Editar</span></a>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if ($traffic_light->reports)
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
                                @foreach($traffic_light->reports as $report)
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

    @if(config('settings.googleMapsAPIStatus') && $traffic_light->intersection->latitude && $traffic_light->intersection->longitude)
        @include('scripts.google-maps-atm-show', [
            'latitude' => $traffic_light->intersection->latitude,
            'longitude' => $traffic_light->intersection->longitude,
            'code' => $traffic_light->code,
        ])
    @endif
@endsection
