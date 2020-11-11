@extends('layouts.app')

@section('template_title')
    {!! trans('alerts.showing-alert-title', ['id' => $alert->id]) !!}
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
                            Mostrando la Orden #{!! $alert->id !!}
                            <div class="float-right">
                                <a href="{{ route('ordenes.index') }}" class="btn btn-light btn-sm float-right"
                                   data-toggle="tooltip" data-placement="left"
                                   title="{{ trans('Regresar') }}">
                                    <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
                                    {!! trans('Regresar a las ordenes') !!}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12" id="map-canvas">
                                mapa
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>
                        <div class="row">
                            @if ($alert->collector)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('alerts.labelCollector') }}
                                    </strong>
                                    {{ $alert->collector->full_name() }}
                                </div>
                            @endif
                            @if ($alert->operator)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('alerts.labelOperator') }}
                                    </strong>
                                    {{ $alert->operator->full_name() }}
                                </div>
                            @endif
                        </div>

                        <div class="row">
                            @if ($alert->status)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('alerts.labelStatus') }}
                                    </strong>
                                    {{ $alert->status->name }}
                                </div>
                            @endif
                            @if ($alert->description)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('alerts.labelDescription') }}
                                    </strong>
                                    {{ $alert->description }}
                                </div>
                            @endif
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <div class="row">
                            @if ($alert->created_at)
                                <div class="col-sm-4 col-4">
                                    <strong class="text-larger">
                                        {{ trans('alerts.labelCreated') }}
                                    </strong>
                                    {{ $alert->created_at }}
                                </div>
                            @endif
                            @if ($alert->updated_at)
                                <div class="col-sm-4 col-4">
                                    <strong class="text-larger">
                                        {{ trans('alerts.labelUpdated') }}
                                    </strong>
                                    {{ $alert->updated_at }}
                                </div>
                            @endif
                            <div class="col-sm-4 col-4">
                                <strong class="text-larger">
                                    {{ trans('alerts.labelReaded') }}
                                </strong>
                                @if ($alert->readed_on)
                                    {{ $alert->readed_on }}
                                @else
                                    No leida
                                @endif
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <br/>
                        <div class="row">
                            <div class="col-4">
                                <a class="btn btn-sm btn-success btn-block"
                                   href="{{ URL::to('/ordenes/create') }}"><i
                                            class="fa fa-plus-square"></i><span
                                            class="hidden-xs"> Nueva Orden</span></a>
                            </div>
                            <div class="col-4">
                            </div>
                            <div class="col-4">
                                @role('atmoperator|atmadmin')
                                <a class="btn btn-sm btn-info btn-block"
                                   href="{{ URL::to('ordenes/' . $alert->id . '/edit') }}"><i
                                            class="fa fa-edit"></i> <span class="hidden-xs">Editar</span></a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
            'latitude' => $alert->latitude,
            'longitude' => $alert->longitude,
            'code' => $alert->id,
        ])
    @endif
@endsection