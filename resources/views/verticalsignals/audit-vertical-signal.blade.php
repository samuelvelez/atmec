@extends('layouts.app')

@section('template_title')
    {!! trans('verticalsignals.audit.auditing-vertical-signal', ['id' => $signal->id]) !!}
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">

                <div class="card">

                    <div class="card-header text-white bg-danger">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            {!! trans('verticalsignals.audit.auditing-vertical-signal-title', ['id' => $signal->id]) !!}
                            <div class="float-right">
                                <a href="{{ URL::to('vertical-signals/' . $signal->id) }}" class="btn btn-light btn-sm float-right"
                                   data-toggle="tooltip" data-placement="left"
                                   title="{{ trans('verticalsignals.tooltips.back-vsignal') }}">
                                    <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
                                    <span class="hidden-xs">{!! trans('verticalsignals.buttons.back-to-vsignal') !!}</span>
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
                                        <th>{!! trans('verticalsignals.audit.audits-table.event') !!}</th>
                                        <th>{!! trans('verticalsignals.audit.audits-table.report') !!}</th>
                                    </tr>
                                    </thead>
                                    <tbody id="regulator_boxes_table">
                                    @forelse ($audits as $audit)
                                        <tr>
                                            <td>
                                                @lang('verticalsignals.audit.'.$audit->event.'.metadata', $audit->getMetadata())

                                                <ul>
                                                    @foreach ($audit->getModified() as $attribute => $modified)
                                                        <li>@lang('verticalsignals.audit.'.$audit->event.'.modified.'.$attribute, $modified)</li>
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
                                        <p>@lang('verticalsignals.audit.unavailable_audits')</p>
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
