@extends('layouts.app')

@section('template_title')
    {!! trans('work-order-type.showing-signal-subgroup', ['id' => $subgroup->id]) !!}
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="card">
                    <div class="card-header text-white bg-success">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            
                            <div class="float-right">
                                <a href="{{ route('work-order-type.index') }}" class="btn btn-light btn-sm float-right"
                                   data-toggle="tooltip" data-placement="left"
                                   title="{{ trans('work-order-type.tooltips.back-wot') }}">
                                    <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
                                    {!! trans('work-order-type.buttons.back-wot') !!}
                                </a>
                            </div>
                        </div>
                    </div>

                               <div class="card-body">

                     
                        <div class="row">
                        <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('traffic-light-type.show-signal-subgroup.id') }}
                                    </strong>
                                    <div class="row">
                                        <div class="col-sm-12 col-12">
                                            {{ $subgroup->id }}
                                        </div>
                                    </div>
                            </div>
                            <div class="col-sm-6 col-6">
                                @if ($subgroup->description)
                                    <strong class="text-larger">
                                        {{ trans('brands.show-signal-subgroup.description') }}
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
                                        {!! trans('brands.show-signal-subgroup.created') !!}
                                    </strong>
                                    {{ $subgroup->created_at }}
                                </div>
                            @endif

                            @if ($subgroup->updated_at)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {!! trans('brands.show-signal-subgroup.updated') !!}
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
    </div>

    @include('modals.modal-delete')

@endsection

@section('footer_scripts')
    @include('scripts.delete-modal-script')
    @if(config('atm_app.tooltipsEnabled'))
        @include('scripts.tooltips')
    @endif
@endsection
