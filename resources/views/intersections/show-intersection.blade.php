@extends('layouts.app')

@section('template_title')
    {!! trans('intersections.showing-intersection', ['id' => $intersection->id]) !!}
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
                            {!! trans('intersections.showing-intersection-title', ['id' => $intersection->id]) !!}
                            <div class="float-right">
                                <a href="{{ route('intersections.index') }}" class="btn btn-light btn-sm float-right"
                                   data-toggle="tooltip" data-placement="left"
                                   title="{{ trans('intersections.tooltips.back-intersections') }}">
                                    <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
                                    {!! trans('intersections.buttons.back-to-intersections') !!}
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
                            @if ($intersection->latitude)

                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('intersections.labelLatitude') }}
                                    </strong>
                                    {{ $intersection->latitude }}
                                </div>
                            @endif

                            @if ($intersection->longitude)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('intersections.labelLongitude') }}
                                    </strong>
                                    {{ $intersection->longitude }}
                                </div>
                            @endif
                        </div>

                        <div class="row">
                            @if ($intersection->main_st)

                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('intersections.labelMainStreet') }}
                                    </strong>
                                    {{ $intersection->main_st }}
                                </div>
                            @endif

                            @if ($intersection->cross_st)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('intersections.labelCrossStreet') }}
                                    </strong>
                                    {{ $intersection->cross_st }}
                                </div>
                            @endif
                        </div>

                        <div class="row">
                            @if ($intersection->google_address)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('intersections.labelGoogleAddress') }}
                                    </strong>
                                    {{ $intersection->google_address }}
                                </div>
                            @endif
                            @if ($intersection->comment)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('intersections.labelComment') }}
                                    </strong>
                                    {{ $intersection->comment }}
                                </div>
                            @endif
                        </div>

                        <div class="row">
                            @if ($intersection->created_at)

                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('verticalsignals.labelCreatedAt') }}
                                    </strong>
                                    {{ $intersection->created_at }}
                                </div>

                            @endif

                            @if ($intersection->updated_at)

                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('verticalsignals.labelUpdatedAt') }}
                                    </strong>
                                    {{ $intersection->updated_at }}
                                </div>

                            @endif
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <br/>
                        <div class="row">
                            <div class="col-4">
                                <a class="btn btn-sm btn-success btn-block"
                                   href="{{ URL::to('/intersections/create') }}"><i
                                            class="fa fa-plus-square"></i><span
                                            class="hidden-xs"> Nueva intersección</span></a>
                            </div>
                            <div class="col-4">
                                <a class="btn btn-sm btn-info btn-block"
                                   href="{{ URL::to('intersections/' . $intersection->id . '/edit') }}"><i
                                            class="fa fa-edit"></i> <span class="hidden-xs">Editar</span></a>
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
                                           href="{{ URL::to('/traffic-poles/create') }}"><i
                                                    class="fa fa-plus-square"></i> Nuevo poste</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if ($intersection->regulators)
            <div class="row mt-4">
                <div class="col-lg-10 offset-lg-1">
                    <div class="card">
                        <div class="card-header">
                            <span style="display: flex; justify-content: space-between; align-items: center;">
                                Cajas reguladoras
                            </span>
                        </div>

                        <div class="card-body">
                            @include('regulator-boxes.regulators-table', [
                                'regulator_boxes' => $intersection->regulators()->orderBy('updated_at', 'desc')->get(),
                                'actions' => false
                            ])
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if ($intersection->poles)
            <div class="row mt-4">
                <div class="col-lg-10 offset-lg-1">
                    <div class="card">
                        <div class="card-header">
                            <span style="display: flex; justify-content: space-between; align-items: center;">
                                Postes de tráfico
                            </span>
                        </div>

                        <div class="card-body">
                            @include('traffic-poles.traffic-poles-table', [
                                'poles' => $intersection->poles()->orderBy('updated_at', 'desc')->get(),
                                'actions' => false
                            ])
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if ($intersection->lights)
            <div class="row mt-4">
                <div class="col-lg-10 offset-lg-1">
                    <div class="card">
                        <div class="card-header">
                            <span style="display: flex; justify-content: space-between; align-items: center;">
                                Semáforos
                            </span>
                        </div>

                        <div class="card-body">
                            @include('traffic-lights.traffic-lights-table', [
                                'lights' => $intersection->lights()->orderBy('updated_at', 'desc')->get(),
                                'actions' => false
                            ])
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
            'latitude' => $intersection->latitude,
            'longitude' => $intersection->longitude,
            'code' => $intersection->id,
        ])
    @endif
@endsection
