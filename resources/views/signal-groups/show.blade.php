@extends('layouts.app')

@section('template_title')
    {!! trans('signal-groups.showing-signal-group', ['id' => $group->id]) !!}
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="card">
                    <div class="card-header text-white bg-success">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            {!! trans('signal-groups.showing-signal-group-title', ['id' => $group->id]) !!}
                            <div class="float-right">
                                <a href="{{ route('signal-groups.index') }}" class="btn btn-light btn-sm float-right"
                                   data-toggle="tooltip" data-placement="left"
                                   title="{{ trans('signal-groups.tooltips.back-signal-groups') }}">
                                    <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
                                    {!! trans('signal-groups.buttons.back-to-signal-groups') !!}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            @if ($group->code)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('signal-groups.show-signal-group.code') }}
                                    </strong>
                                    {{ $group->code }}
                                </div>
                            @endif

                            @if ($group->name)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('signal-groups.show-signal-group.name') }}
                                    </strong>
                                    {{ $group->name }}
                                </div>
                            @endif
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        @if ($group->description)
                            <div class="row">
                                <div class="col-sm-12 col-12">
                                    <strong class="text-larger">
                                        {{ trans('signal-groups.show-signal-group.description') }}
                                    </strong>
                                </div>
                            </div><div class="row">
                                <div class="col-sm-12 col-12">
                                    {{ $group->description }}
                                </div>
                            </div>

                            <div class="clearfix"></div>
                            <div class="border-bottom"></div>
                        @endif

                        <div class="row">
                            @if ($group->created_at)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {!! trans('signal-groups.show-signal-group.created') !!}
                                    </strong>
                                    {{ $group->created_at }}
                                </div>
                            @endif

                            @if ($group->updated_at)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {!! trans('signal-groups.show-signal-group.updated') !!}
                                    </strong>
                                    {{ $group->updated_at }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-lg-10 offset-lg-1">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                Subgrupos
                            </span>
                        </div>
                    </div>

                    <div class="card-body">
                        @include('signal-subgroups.table', [
                                'subgroups' => $group->subgroups()->orderBy('updated_at', 'desc')->get(),
                                'actions' => false
                            ])
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
@endsection
