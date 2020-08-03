@extends('layouts.app')

@section('template_title')
    {!! trans('traffic-tensors.showing-traffic-tensor', ['id' => $traffic_tensor->id]) !!}
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
                            {!! trans('traffic-tensors.showing-traffic-tensor-title', ['id' => $traffic_tensor->id]) !!}
                            <div class="float-right">
                                <a href="{{ route('traffic-tensors.index') }}" class="btn btn-light btn-sm float-right"
                                   data-toggle="tooltip" data-placement="left"
                                   title="{{ trans('traffic-tensors.tooltips.back-traffic-tensors') }}">
                                    <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
                                    {!! trans('traffic-tensors.buttons.back-to-traffic-tensors') !!}
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
                            @if ($traffic_tensor->height)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('traffic-tensors.labelHeight') }}
                                    </strong>
                                    {{ $traffic_tensor->height }}m
                                </div>
                            @endif

                            @if ($traffic_tensor->state)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('traffic-tensors.labelState') }}
                                    </strong>
                                    {{ $traffic_tensor->state }}
                                </div>
                            @endif
                        </div>

                        <div class="row">
                            @if ($traffic_tensor->material)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('traffic-tensors.labelMaterial') }}
                                    </strong>
                                    {{ $traffic_tensor->material }}
                                </div>
                            @endif

                            <div class="col-sm-6 col-6">
                                <strong class="text-larger">
                                    {{ trans('traffic-tensors.labelComment') }}
                                </strong>
                                @if ($traffic_tensor->comment){{ $traffic_tensor->comment }} @else {{ 'Sin comentarios' }} @endif
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <div class="row">
                            @if ($traffic_tensor->user)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('traffic-tensors.labelUser') }}
                                    </strong>
                                    {{ $traffic_tensor->user->full_name() }}
                                </div>
                            @endif
                        </div>

                        @if ($traffic_tensor->poles)
                            <div class="clearfix"></div>
                            <div class="border-bottom"></div>

                            <div class="row">
                                <div class="col-sm-12 col-12">
                                    <strong class="text-larger">
                                        {{ trans('traffic-tensors.labelPoles') }}
                                    </strong>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-12">
                                    <table class="table table-sm table-hover">
                                        <thead class="thead-light">
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Intersección</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($traffic_tensor->poles as $pole)
                                            <tr>
                                                <td>{{ $pole->id }}</td>
                                                <td>{{ $pole->intersection->main_st }} y {{ $pole->intersection->cross_st }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="clearfix"></div>
                            <div class="border-bottom"></div>
                        @endif

                        <div class="row">
                            @if ($traffic_tensor->created_at)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('traffic-tensors.labelCreatedAt') }}
                                    </strong>
                                    {{ $traffic_tensor->created_at }}
                                </div>
                            @endif

                            @if ($traffic_tensor->updated_at)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('traffic-tensors.labelUpdatedAt') }}
                                    </strong>
                                    {{ $traffic_tensor->updated_at }}
                                </div>
                            @endif
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <br/>
                        <div class="row">
                            <div class="col-4">
                                <a class="btn btn-sm btn-success btn-block" href="{{ URL::to('/traffic-tensors/create') }}"><i class="fa fa-plus-square"></i><span class="hidden-xs"> Nuevo tensor</span></a>
                            </div>
                            <div class="col-4"><a class="btn btn-sm btn-info btn-block"
                                                  href="{{ URL::to('traffic-tensors/' . $traffic_tensor->id . '/edit') }}"><i
                                            class="fa fa-edit"></i> <span class="hidden-xs">Editar</span></a>
                            </div>
                            <div class="col-4">
                                <div class="btn-group float-right btn-block" role="group">
                                    <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="hidden-xs">Continuar a...</span>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                        <a class="dropdown-item btn btn-sm" href="{{ URL::to('/regulator-boxes/create') }}"><i class="fa fa-plus-square"></i> Nueva reguladora</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item btn btn-sm" href="{{ URL::to('/traffic-poles/create') }}"><i class="fa fa-plus-square"></i> Nuevo poste</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item btn btn-sm" href="{{ URL::to('/traffic-lights/create') }}"><i class="fa fa-plus-square"></i> Nuevo semáforo</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if ($traffic_tensor->reports)
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
                                @foreach($traffic_tensor->reports as $report)
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
            'latitude' => $traffic_tensor->poles()->first()->latitude,
            'longitude' => $traffic_tensor->poles()->first()->longitude,
            'code' => $traffic_tensor->code,
        ])
    @endif
@endsection
