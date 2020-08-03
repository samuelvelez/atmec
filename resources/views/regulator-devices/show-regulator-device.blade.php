@extends('layouts.app')

@section('template_title')
    {!! trans('regulator-devices.showing-regulator-device', ['code' => $device->code]) !!}
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">

                <div class="card">

                    <div class="card-header text-white bg-success">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            {!! trans('regulator-devices.showing-regulator-device-title', ['code' => $device->code]) !!}
                            <div class="float-right">
                                <a href="{{ route('regulator-devices.index') }}"
                                   class="btn btn-light btn-sm float-right"
                                   data-toggle="tooltip" data-placement="left"
                                   title="{{ trans('regulator-devices.tooltips.back-regulator-devices') }}">
                                    <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
                                    {!! trans('regulator-devices.buttons.back-to-regulator-devices') !!}
                                </a>

                                <a href="{{ URL::to('regulator-devices/' . $device->id . '/audit') }}" class="btn btn-danger btn-sm float-right mr-3"
                                   data-toggle="tooltip" data-placement="left"
                                   title="{{ trans('regulator-devices.audit.button') }}">
                                    <i class="fa fa-fw fa-balance-scale" aria-hidden="true"></i>
                                    <span class="hidden-xs">{!! trans('regulator-devices.audit.button') !!}</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <div class="row">
                            @if ($device->code)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('regulator-devices.labelCode') }}
                                    </strong>
                                    {{ $device->code }}
                                </div>
                            @endif

                            @if ($device->erp_code)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('regulator-devices.labelErpCode') }}
                                    </strong>
                                    {{ $device->erp_code }}
                                </div>
                            @endif
                        </div>

                        <div class="row">
                            @if ($device->regulator_box)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('regulator-devices.labelRegulator') }}
                                    </strong>
                                    {{ $device->regulator_box->code }}
                                </div>
                            @endif

                            @if ($device->state)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('regulator-devices.labelState') }}
                                    </strong>
                                    {{ $device->state }}
                                </div>
                            @endif
                        </div>

                        <div class="row">
                            @if ($device->type)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('regulator-devices.labelType') }}
                                    </strong>
                                    @if ($device->type == "ups_brands")
                                        <span class="badge-pill badge badge-info">UPS</span>
                                    @endif

                                    @if ($device->type == "energy_brands")
                                        <span class="badge-pill badge badge-danger">Fuente de poder</span>
                                    @endif

                                    @if ($device->type == "mmu_brands")
                                        <span class="badge-pill badge badge-primary">MMU</span>
                                    @endif

                                    @if ($device->type == "travel_brands")
                                        <span class="badge-pill badge badge-success">Velocidad de viaje</span>
                                    @endif

                                    @if ($device->type == "controller_brands")
                                        <span class="badge-pill badge badge-warning">Controlador</span>
                                    @endif
                                </div>
                            @endif

                            @if ($device->comment)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('regulator-devices.labelComment') }}
                                    </strong>
                                    {{ $device->comment }}
                                </div>
                            @endif
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <div class="row">
                            @if ($device->user)
                                <div class="col-sm-12 col-12">
                                    <strong class="text-larger">
                                        {{ trans('regulator-devices.labelUser') }}
                                    </strong>
                                    {{ $device->user->full_name() }}
                                </div>
                            @endif
                        </div>

                        <div class="row">
                            @if ($device->created_at)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('regulator-devices.labelCreatedAt') }}
                                    </strong>
                                    {{ $device->created_at }}
                                </div>
                            @endif

                            @if ($device->updated_at)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('regulator-devices.labelUpdatedAt') }}
                                    </strong>
                                    {{ $device->updated_at }}
                                </div>
                            @endif
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <br/>
                        <div class="row">
                            <div class="col-4">
                                <a class="btn btn-sm btn-success btn-block" href="{{ URL::to('/regulator-devices/create') }}"><i
                                            class="fa fa-plus-square"></i><span class="hidden-xs"> Nuevo dispositivo</span></a>
                            </div>
                            <div class="col-4">
                                <a class="btn btn-sm btn-info btn-block"
                                   href="{{ URL::to('regulator-devices/' . $device->id . '/edit') }}"><i
                                            class="fa fa-edit"></i> <span class="hidden-xs">Editar</span></a>
                            </div>
                            <div class="col-4">
                                <div class="btn-group float-right btn-block" role="group">
                                    <button id="btnGroupDrop1" type="button"
                                            class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                        <span class="hidden-xs"> Continuar a...</span>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                        <a class="dropdown-item btn btn-sm"
                                           href="{{ URL::to('/regulator-boxes/create') }}"><i
                                                    class="fa fa-plus-square"></i> Nueva reguladora</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item btn btn-sm"
                                           href="{{ URL::to('/traffic-poles/create') }}"><i
                                                    class="fa fa-plus-square"></i> Nuevo poste</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item btn btn-sm"
                                           href="{{ URL::to('/traffic-lights/create') }}"><i
                                                    class="fa fa-plus-square"></i> Nuevo semáforo</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if ($device->reports)
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
                                @foreach($device->reports as $report)
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
@endsection
