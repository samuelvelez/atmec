@extends('layouts.app')

@section('template_title')
    {!! trans('verticalsignals.showing-vsignal', ['name' => $vsignal->id]) !!}
@endsection

@section('template_fastload_css')
    .picture {
    height: 200px;
    width: auto;
    border: 2px solid #8eb4cb;
    }

@php

 if(file_exists ($vsignal->get_picture_path())){
    $ruta = $vsignal->get_picture_path();
 }else{
     
     $ruta = "https://upload.wikimedia.org/wikipedia/commons/d/da/Imagen_no_disponible.svg";
 }

@endphp
    .pictureBg{
    background-image: url("{{ asset($ruta) }}");
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
@php
    
@endphp
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="card">

                    <div class="card-header text-white bg-success">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            {!! trans('verticalsignals.showing-vsignal-title', ['name' => $vsignal->code]) !!}
                            <div class="float-right">
                                <a href="{{ URL::to('vertical-signals/') }}" class="btn btn-light btn-sm float-right"
                                   data-toggle="tooltip" data-placement="left"
                                   title="{{ trans('verticalsignals.tooltips.back-vsignals') }}">
                                    <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
                                    {!! trans('verticalsignals.buttons.back-to-vsignals') !!}
                                </a>

                                <a href="{{ URL::to('vertical-signals/' . $vsignal->id . '/audit') }}"
                                   class="btn btn-danger btn-sm float-right mr-3"
                                   data-toggle="tooltip" data-placement="left"
                                   title="{{ trans('verticalsignals.audit.button') }}">
                                    <i class="fa fa-fw fa-balance-scale" aria-hidden="true"></i>
                                    <span class="hidden-xs">{!! trans('verticalsignals.audit.button') !!}</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4 col-md-6 pictureBg">
                                <?php /*
                                <img src="@if ($vsignal->picture) {{asset('storage/signals/' . $vsignal->picture)}} @else {{asset('storage/signals/no-picture.png')}} @endif"
                                     class="center-block mb-3 mt-4 picture">
                                */ ?>
                            </div>
                            <div class="col-sm-4 col-md-6" id="map-canvas">
                                <span>Cargando mapa por favor espere.</span>
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>


                        @if ($vsignal->signal_inventory)
                            <div class="row">
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('verticalsignals.labelName') }}
                                    </strong>
                                    {{ $vsignal->signal_inventory->name }}
                                </div>
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('verticalsignals.labelErpCode') }}
                                    </strong>
                                    {{ $vsignal->erp_code }}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('verticalsignals.labelGroup') }}
                                    </strong>
                                    {{ $vsignal->signal_inventory->subgroup->group->name }}
                                    ({{ $vsignal->signal_inventory->subgroup->group->code  }})
                                </div>
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('verticalsignals.labelUniqueCode') }}
                                    </strong>
                                    {{ $vsignal->unique_code  }}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6 col-6">
                                    @if ($vsignal->variation)
                                        <strong class="text-larger">
                                            {{ trans('verticalsignals.labelVariation') }}
                                        </strong>
                                        {{ $vsignal->variation->variation }}
                                        ({{ $vsignal->variation->signal_dimension->value }})
                                    @endif
                                </div>
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('verticalsignals.labelSubgroup') }}
                                    </strong>
                                    {{ $vsignal->signal_inventory->subgroup->name }}
                                    ({{ $vsignal->signal_inventory->subgroup->code  }})
                                </div>
                            </div>

                            <div class="clearfix"></div>
                            <div class="border-bottom"></div>

                        @endif

                        <div class="row">
                            @if ($vsignal->latitude)

                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('verticalsignals.labelLatitude') }}
                                    </strong>
                                    {{ $vsignal->latitude }}
                                </div>
                            @endif

                            @if ($vsignal->longitude)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('verticalsignals.labelLongitude') }}
                                    </strong>
                                    {{ $vsignal->longitude }}
                                </div>
                            @endif
                        </div>

                        <div class="row">
                            @if ($vsignal->material)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('verticalsignals.labelMaterial') }}
                                    </strong>
                                    {{ $vsignal->material }}
                                </div>
                            @endif

                            @if ($vsignal->google_address)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('verticalsignals.labelGoogleAddress') }}
                                    </strong>
                                    {{ $vsignal->google_address }}
                                </div>
                            @endif
                        </div>

                        <div class="row">
                            @if ($vsignal->orientation)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('verticalsignals.labelOrientation') }}
                                    </strong>
                                    {{ $vsignal->orientation }}
                                </div>
                            @endif

                            @if ($vsignal->state)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('verticalsignals.labelState') }}
                                    </strong>
                                    {{ $vsignal->state }}
                                </div>
                            @endif
                        </div>

                        <div class="row">
                            @if ($vsignal->street1)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('verticalsignals.labelStreet1') }}
                                    </strong>
                                    {{ $vsignal->street1 }}
                                </div>
                            @endif

                            @if ($vsignal->street2)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('verticalsignals.labelStreet2') }}
                                    </strong>
                                    {{ $vsignal->street2 }}
                                </div>
                            @endif
                        </div>

                        <div class="row">
                            @if ($vsignal->neighborhood)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('verticalsignals.labelNeighborhood') }}
                                    </strong>
                                    {{ $vsignal->neighborhood }}
                                </div>
                            @endif

                            @if ($vsignal->parish)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('verticalsignals.labelParish') }}
                                    </strong>
                                    {{ $vsignal->parish }}
                                </div>
                            @endif
                        </div>

                        <div class="row">
                            @if ($vsignal->normative)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('verticalsignals.labelNormative') }}
                                    </strong>
                                    {{ $vsignal->normative }}
                                </div>
                            @endif

                            @if ($vsignal->fastener)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('verticalsignals.labelFastener') }}
                                    </strong>
                                    {{ $vsignal->fastener }}
                                </div>
                            @endif
                        </div>

                        <div class="row">
                            @if ($vsignal->comment)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('verticalsignals.labelComment') }}
                                    </strong>
                                    {{ $vsignal->comment }}
                                </div>
                            @endif
                            @if ($vsignal->user)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('verticalsignals.labelCollector') }}
                                    </strong>
                                    {{ $vsignal->user->full_name() }}
                                </div>
                            @endif
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <div class="row">
                            @if ($vsignal->created_at)

                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('verticalsignals.labelCreatedAt') }}
                                    </strong>
                                    {{ $vsignal->created_at }}
                                </div>

                            @endif

                            @if ($vsignal->updated_at)

                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('verticalsignals.labelUpdatedAt') }}
                                    </strong>
                                    {{ $vsignal->updated_at }}
                                </div>

                            @endif
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <br/>
                        @role('atmadmin|atmcollector|atmusuario')
                        <div class="row">
                            <div class="col-4">
                            
                                <a class="btn btn-sm btn-success btn-block"
                                   href="{{ URL::to('/vertical-signals/create') }}"><i
                                            class="fa fa-plus-square"></i><span
                                            class="hidden-xs"> Nueva señal 
</span></a>
                            </div>
                            <div class="col-4">
                                <a class="btn btn-sm btn-info btn-block"
                                   href="{{ URL::to('vertical-signals/' . $vsignal->id . '/edit') }}"><i
                                            class="fa fa-edit"></i> <span class="hidden-xs">Editar</span></a>
                            </div>
                            <!--<div class="col-4">
                                <div class="btn-group float-right btn-block" role="group">
                                    <button id="btnGroupDrop1" type="button"
                                            class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                        <span class="hidden-xs">Continuar a...</span>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                        <a class="dropdown-item btn btn-sm"
                                           href="{{ URL::to('/intersections/create') }}"><i
                                                    class="fa fa-plus-square"></i> Nueva intersección</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item btn btn-sm"
                                           href="{{ URL::to('/regulator-boxes/create') }}"><i
                                                    class="fa fa-plus-square"></i> Nueva reguladora</a>
                                    </div>
                                </div>
                            </div>-->
                        </div>
                        @endrole
                    </div>

                </div>
            </div>
        </div>

        @if ($vsignal->reports)
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
                                @foreach($vsignal->reports as $report)
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
            'latitude' => $vsignal->latitude,
            'longitude' => $vsignal->longitude,
            'code' => $vsignal->code,
        ])
    @endif
@endsection
