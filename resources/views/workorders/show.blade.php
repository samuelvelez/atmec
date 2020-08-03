@extends('layouts.app')

@section('template_title')
    {!! trans('workorders.showing-workorder-title', ['id' => $workorder->id]) !!}
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="card">
                    <div class="card-header text-white bg-success">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            {!! trans('workorders.showing-workorder-title', ['id' => $workorder->id]) !!}
                            <div class="float-right">
                                <a href="{{ route('workorders.index') }}" class="btn btn-light btn-sm float-right"
                                   data-toggle="tooltip" data-placement="left"
                                   title="{{ trans('workorders.tooltips.back-workorders') }}">
                                    <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
                                    {!! trans('workorders.buttons.back-to-workorders') !!}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            @if ($workorder->report->alert->collector)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('workorders.labelAlertCollector') }}
                                    </strong>
                                    {{ $workorder->report->alert->collector->full_name() }}
                                </div>
                            @endif
                            @if ($workorder->collector)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('workorders.labelOrderCollector') }}
                                    </strong>
                                    {{ $workorder->collector->full_name() }}
                                </div>
                            @endif
                        </div>

                        <div class="row">
                            @if ($workorder->report->alert->description)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('workorders.labelAlertDescription') }}
                                    </strong>
                                    {{ $workorder->report->alert->description }}
                                </div>
                            @endif
                            @if ($workorder->report->description)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('workorders.labelReportDescription') }}
                                    </strong>
                                    {{ $workorder->report->description}}
                                </div>
                            @endif
                        </div>

                        <div class="row">
                            @if ($workorder->report->alert->description)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('workorders.labelOrderDescription') }}
                                    </strong>
                                    {{ $workorder->description }}
                                </div>
                            @endif
                            @if ($workorder->complete_description)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('workorders.labelCompletedDescription') }}
                                    </strong>
                                    {{ $workorder->complete_description }}
                                </div>
                            @endif
                        </div>

                        <div class="row">
                            @if ($workorder->status)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('workorders.labelStatus') }}
                                    </strong>
                                    {{ $workorder->status->name }}
                                </div>
                            @endif
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <div class="row">
                            @if ($workorder->created_at)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('workorders.labelCreated') }}
                                    </strong>
                                    {{ $workorder->created_at }}
                                </div>
                            @endif
                            @if ($workorder->updated_at)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('workorders.labelUpdated') }}
                                    </strong>
                                    {{ $workorder->updated_at }}
                                </div>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-6">
                                <strong class="text-larger">
                                    {{ trans('workorders.labelStarted') }}
                                </strong>
                                @if ($workorder->started_on)
                                    {{ $workorder->started_on }}
                                @else
                                    No iniciada
                                @endif
                            </div>
                            <div class="col-sm-6 col-6">
                                <strong class="text-larger">
                                    {{ trans('workorders.labelCompleted') }}
                                </strong>
                                @if ($workorder->completed_on)
                                    {{ $workorder->completed_on }}
                                @else
                                    No comletada
                                @endif
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        @if (Auth::user()->hasRole('atmoperator') && $workorder->status->name == \App\Models\Workorder::STATUS_OPEN)
                            <br/>
                            <div class="row">
                                <div class="col-4">
                                </div>
                                <div class="col-12">
                                    <a class="btn btn-sm btn-info float-right"
                                       href="{{ URL::to('workorders/' . $workorder->id . '/edit') }}"><i
                                                class="fa fa-edit"></i> <span class="hidden-xs">Editar</span></a>
                                </div>
                            </div>
                        @endif
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
            'latitude' => $workorder->latitude,
            'longitude' => $workorder->longitude,
            'code' => $workorder->id,
        ])
    @endif
@endsection