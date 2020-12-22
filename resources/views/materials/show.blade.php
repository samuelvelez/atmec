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
                            </div>
                            <div class="col-sm-6 col-6">
                                <strong class="text-larger">
                                    Tipo de Trabajo:
                                </strong>
                            </div>
                        </div>

                        <hr/>
               

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        @if (Auth::user()->hasRole('atmcollector') && $report->workorder)
                            <br/>
                            <div class="row">
                                <div class="col-12">
                                    <a class="btn btn-sm btn-info float-right"
                                       href="{{ URL::to('reports/ee/edit') }}"><i
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