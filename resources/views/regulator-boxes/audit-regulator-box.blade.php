@extends('layouts.app')

@section('template_title')
    {!! trans('regulator-boxes.audit.auditing-regulator-box', ['id' => $regulator->id]) !!}
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">

                <div class="card">

                    <div class="card-header text-white bg-danger">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            {!! trans('regulator-boxes.audit.auditing-regulator-box-title', ['id' => $regulator->id]) !!}
                            <div class="float-right">
                                <a href="{{ URL::to('regulator-boxes/') }}" class="btn btn-light btn-sm float-right"
                                   data-toggle="tooltip" data-placement="left"
                                   title="{{ trans('regulator-boxes.tooltips.back-regulator-boxes') }}">
                                    <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
                                    <span class="hidden-xs">{!! trans('regulator-boxes.buttons.back-to-regulator-box') !!}</span>
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
                                        <th>{!! trans('regulator-boxes.audit.audits-table.event') !!}</th>
                                        <th>{!! trans('regulator-boxes.audit.audits-table.report') !!}</th>
                                    </tr>
                                    </thead>
                                    <tbody id="regulator_boxes_table">
                                    @forelse ($audits as $audit)
                                        <tr>
                                            <td>
                                                @lang('regulator-boxes.audit.'.$audit->event.'.metadata', $audit->getMetadata())

                                                <ul>
                                                    @foreach ($audit->getModified() as $attribute => $modified)
                                                        <li>@lang('regulator-boxes.audit.'.$audit->event.'.modified.'.$attribute, $modified)</li>
                                                        
                                                        @if(($attribute == "picture_in" || $attribute == "picture_out") && $audit->event == "updated")
                                                            
                                                            @if(file_exists(storage_path('app/public_html/regulators/')."/".$audit->old_values['picture_out']))
                                                                <a target="_blank" href="../../storage/regulators/{{$audit->old_values['picture_out']}}">Ver imagen Anterior</a>
                                                            @endif
                                                        @endif
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
                                        <p>@lang('regulator-boxes.audit.unavailable_audits')</p>
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
