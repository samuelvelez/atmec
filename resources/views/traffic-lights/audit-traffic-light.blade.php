@extends('layouts.app')

@section('template_title')
    {!! trans('traffic-lights.audit.auditing-traffic-light', ['id' => $light->id]) !!}
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">

                <div class="card">

                    <div class="card-header text-white bg-danger">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            {!! trans('traffic-lights.audit.auditing-traffic-light-title', ['id' => $light->id]) !!}
                            <div class="float-right">
                                <a href="{{ URL::to('traffic-lights/') }}" class="btn btn-light btn-sm float-right"
                                   data-toggle="tooltip" data-placement="left"
                                   title="{{ trans('traffic-lights.tooltips.back-traffic-lights') }}">
                                    <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
                                    <span class="hidden-xs">{!! trans('traffic-lights.buttons.back-to-traffic-light') !!}</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-hover table-sm data-table">
                                    <thead class="thead">
                                    <tr>
                                        <th>{!! trans('traffic-lights.audit.audits-table.event') !!}</th>
                                        <th>{!! trans('traffic-lights.audit.audits-table.report') !!}</th>
                                    </tr>
                                    </thead>
                                    <tbody id="regulator_boxes_table">
                                    @forelse ($audits as $audit)
                                        <tr>
                                            <td>
                                                @lang('traffic-lights.audit.'.$audit->event.'.metadata', $audit->getMetadata())

                                                <ul>
                                                    @foreach ($audit->getModified() as $attribute => $modified)
                                                        <li>@lang('traffic-lights.audit.'.$audit->event.'.modified.'.$attribute, $modified)</li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                            <td>
                                                @if ($audit->tags)
                                                    <a href="{{ URL::to('reportes/' . Illuminate\Support\Str::after($audit->tags, 'report_')) }}"
                                                       class="btn btn-danger btn-sm"
                                                       data-toggle="tooltip" data-placement="left"
                                                       title="Ver reporte"
                                                       target="_blank"
                                                    >
                                                        <i class="fa fa-fw fa-archive" aria-hidden="true"></i>
                                                        <span class="hidden-xs">Ver reporte</span>
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <p>@lang('traffic-lights.audit.unavailable_audits')</p>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
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
