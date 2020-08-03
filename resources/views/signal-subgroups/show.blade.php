@extends('layouts.app')

@section('template_title')
    {!! trans('signal-subgroups.showing-signal-subgroup', ['id' => $subgroup->id]) !!}
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="card">
                    <div class="card-header text-white bg-success">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            {!! trans('signal-subgroups.showing-signal-subgroup-title', ['id' => $subgroup->id]) !!}
                            <div class="float-right">
                                <a href="{{ route('signal-subgroups.index') }}" class="btn btn-light btn-sm float-right"
                                   data-toggle="tooltip" data-placement="left"
                                   title="{{ trans('signal-subgroups.tooltips.back-signal-subgroups') }}">
                                    <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
                                    {!! trans('signal-subgroups.buttons.back-to-signal-subgroups') !!}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            @if ($subgroup->code)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('signal-subgroups.show-signal-subgroup.code') }}
                                    </strong>
                                    {{ $subgroup->code }}
                                </div>
                            @endif

                            @if ($subgroup->name)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('signal-subgroups.show-signal-subgroup.name') }}
                                    </strong>
                                    {{ $subgroup->name }}
                                </div>
                            @endif
                        </div>

                        <div class="row">
                            @if ($subgroup->group->name)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('signal-subgroups.show-signal-subgroup.group') }}
                                    </strong>
                                    {{ $subgroup->group->name }}
                                </div>
                            @endif

                            @if ($subgroup->shape)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('signal-subgroups.show-signal-subgroup.shape') }}
                                    </strong>
                                    {{ $subgroup->shape }}
                                </div>
                            @endif
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>


                        <div class="row">
                            <div class="col-sm-6 col-6">
                                <strong class="text-larger">
                                    {{ trans('signal-subgroups.show-signal-subgroup.colors') }}
                                </strong>
                                @if ($subgroup->colors)
                                    <div class="row">
                                        <div class="col-sm-12 col-12">
                                            <ul>
                                                @foreach(json_decode($subgroup->colors) as $id => $value)
                                                    <li>{{ $value }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="col-sm-6 col-6">
                                @if ($subgroup->description)
                                    <strong class="text-larger">
                                        {{ trans('signal-subgroups.show-signal-subgroup.description') }}
                                    </strong>
                                    <div class="row">
                                        <div class="col-sm-12 col-12">
                                            {{ $subgroup->description }}
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <div class="row">
                            @if ($subgroup->created_at)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {!! trans('signal-subgroups.show-signal-subgroup.created') !!}
                                    </strong>
                                    {{ $subgroup->created_at }}
                                </div>
                            @endif

                            @if ($subgroup->updated_at)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {!! trans('signal-subgroups.show-signal-subgroup.updated') !!}
                                    </strong>
                                    {{ $subgroup->updated_at }}
                                </div>
                            @endif
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
@endsection
