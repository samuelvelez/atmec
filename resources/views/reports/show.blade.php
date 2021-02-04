@extends('layouts.app')

@section('template_title')
    {!! trans('reports.showing-report-title', ['id' => $report->id]) !!}
@endsection

@section('template_fastload_css')
    .picture {
    height: 400px;
    width: auto;
    }
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">

                <div class="card">
                    <div class="card-header text-white bg-success">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            {!! trans('reports.showing-report-title', ['id' => $report->id]) !!}
                            <div class="float-right">
                                <a href="{{ route('reports.index') }}" class="btn btn-light btn-sm float-right"
                                   data-toggle="tooltip" data-placement="left"
                                   title="{{ trans('reports.tooltips.back-reports') }}">
                                    <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
                                    {!! trans('reports.buttons.back-to-reports') !!}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6 col-6">
                                <strong class="text-larger">
                                    Alerta:
                                </strong>
                                {{ $report->alert->id }}
                            </div>
                            <div class="col-sm-6 col-6">
                                <strong class="text-larger">
                                    Tipo de Trabajo:
                                </strong>
                                {{ $report->worktype->name }}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6 col-6">
                                <strong class="text-larger">
                                    Novedad:
                                </strong>
                                {{ $report->novelty->name }}
                            </div>

                            <div class="col-sm-6 col-6">
                                <strong class="text-larger">
                                    Subnovedad:
                                </strong>
                                {{ $report->subnovelty->name }}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6 col-6">
                                <strong class="text-larger">
                                    Estado:
                                </strong>
                                {{ $report->status->name }}
                            </div>
                            <div class="col-sm-6 col-6">
                                <strong class="text-larger">
                                    Descripción:
                                </strong>
                                {{ $report->description }}
                            </div>
                        </div>
                        
                       @if ($alertcomments)
                         <div class="row">
                             @foreach ($alertcomments as $alertcomment)
                            <div class="col-sm-12 col-12">
                                <strong class="text-larger">
                                    Comentario a las {{ $alertcomment->created_at }}:
                                </strong>
                                {{ $alertcomment->comment_old }}
                            </div>
                            @endforeach
                             @endif
                        </div>

                        @if ($report->pictures)
                            <hr/>
                            <div class="row">
                                <div class="col-sm-12 col-12">
                                    <div class="text-center"><strong>Imagenes asociadas</strong></div>

                                    <div id="pictures-carousel" class="carousel slide" data-ride="carousel">
                                        <ol class="carousel-indicators">
                                            @foreach(json_decode($report->pictures) as $picture)
                                                <li data-target="#carouselExampleIndicators"
                                                    data-slide-to="{{ $loop->index }}"
                                                    class="@if ($loop->first) active @endif"></li>
                                            @endforeach
                                        </ol>

                                        <div class="carousel-inner">
                                            @foreach(json_decode($report->pictures) as $picture)
                                                <div class="carousel-item text-center @if ($loop->first) active @endif">
                                                    <img class="picture"
                                                         src="{{asset('storage/reports/' . $picture)}}"
                                                         alt="Imagen {{ $loop->iteration }}">
                                                </div>
                                            @endforeach
                                        </div>
                                        <a class="carousel-control-prev" href="#pictures-carousel" role="button"
                                           data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Anterior</span>
                                        </a>
                                        <a class="carousel-control-next" href="#pictures-carousel" role="button"
                                           data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Siguiente</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <hr/>
                        <div class="row">
                            <div class="col-sm-12 col-12">
                                <div class="text-center"><strong>Dispositivos afectados</strong></div>
                                <table class="table table-striped table-sm data-table">
                                    <thead class="thead">
                                    <tr>
                                        <th>Tipos de dispositivos</th>
                                        <th>Elementos</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Señales verticales</td>
                                        <td>
                                            @forelse($report->vertical_signals as $signal)
                                                <a href="{{ URL::to('vertical-signals/' . $signal->id) }}"
                                                   data-toggle="tooltip" title="Ir a señal: {{ $signal->id }}"
                                                   target="_blank">
                                                    <span class="badge-pill badge badge-danger">{{ $signal->id }}</span>
                                                </a>
                                            @empty
                                                -
                                            @endforelse
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Cajas reguladoras</td>
                                        <td>
                                            @forelse($report->regulator_boxes as $regulator)
                                                <a href="{{ URL::to('regulator-boxes/' . $regulator->id) }}"
                                                   data-toggle="tooltip"
                                                   title="Ir a reguladora: {{ $regulator->id }}"
                                                   target="_blank">
                                                    <span class="badge-pill badge badge-danger">{{ $regulator->id }}</span>
                                                </a>
                                            @empty
                                                -
                                            @endforelse
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Dispositivos de caja</td>
                                        <td>
                                            @forelse($report->traffic_devices as $item)
                                                <a href="{{ URL::to('regulator-devices/' . $item->id) }}"
                                                   data-toggle="tooltip"
                                                   title="Ir al dispositivo: {{ $item->id }}"
                                                   target="_blank">
                                                    <span class="badge-pill badge badge-danger">{{ $item->id }}</span>
                                                </a>
                                            @empty
                                                -
                                            @endforelse
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Postes de tráfico</td>
                                        <td>
                                            @forelse($report->traffic_poles as $item)
                                                <a href="{{ URL::to('traffic-poles/' . $item->id) }}"
                                                   data-toggle="tooltip" title="Ir al poste: {{ $item->id }}"
                                                   target="_blank">
                                                    <span class="badge-pill badge badge-danger">{{ $item->id }}</span>
                                                </a>
                                            @empty
                                                -
                                            @endforelse
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tensores</td>
                                        <td>
                                            @forelse($report->traffic_tensors as $item)
                                                <a href="{{ URL::to('traffic-tensors/' . $item->id) }}"
                                                   data-toggle="tooltip" title="Ir al tensor: {{ $item->id }}"
                                                   target="_blank">
                                                    <span class="badge-pill badge badge-danger">{{ $item->id }}</span>
                                                </a>
                                            @empty
                                                -
                                            @endforelse
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Semáforos</td>
                                        <td>
                                            @forelse($report->traffic_lights as $item)
                                                <a href="{{ URL::to('traffic-lights/' . $item->id) }}"
                                                   data-toggle="tooltip" title="Ir al semáforo: {{ $item->id }}"
                                                   target="_blank">
                                                    <span class="badge-pill badge badge-danger">{{ $item->id }}</span>
                                                </a>
                                            @empty
                                                -
                                            @endforelse
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        @if ($report->materials)
                            <div class="clearfix"></div>
                            <div class="border-bottom"></div>

                            <div class="row">
                                <div class="col-sm-12 col-12">
                                    <br>
                                    <div class="text-larger text-center"><strong>Listado de materiales
                                            requeridos</strong>
                                    </div>
                                    <table class="table table-hover table-striped table-sm data-table">
                                        <thead class="thead">
                                        <th>Nombre</th>
                                        <th>Unidad de medida</th>
                                        <th>Cantidad</th>
                                        </thead>
                                        <tbody>
                                        @forelse($report->materials as $material)
                                            <tr>
                                                <td>{{ $material->material->name }}</td>
                                                <td>{{ $material->metric_unit->name . ' (' . $material->metric_unit->abbreviation . ')' }}</td>
                                                <td>{{ $material->amount }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="2">Sin materiales asignados aun.</td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <div class="row">
                            @if ($report->created_at)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('reports.labelCreated') }}
                                    </strong>
                                    {{ $report->created_at }}
                                </div>
                            @endif
                            @if ($report->updated_at)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('reports.labelUpdated') }}
                                    </strong>
                                    {{ $report->updated_at }}
                                </div>
                            @endif
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        @if (Auth::user()->hasRole('atmcollector') && $report->workorder)
                            <br/>
                            <div class="row">
                                <div class="col-12">
                                    <a class="btn btn-sm btn-info float-right"
                                       href="{{ URL::to('reports/' . $report->id . '/edit') }}"><i
                                                class="fa fa-edit"></i> <span class="hidden-xs">Editar</span></a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer_scripts')
    @if(config('atm_app.tooltipsEnabled'))
        @include('scripts.tooltips')
    @endif
@endsection