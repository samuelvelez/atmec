@extends('layouts.app')

@section('template_title')
    {!! trans('traffic-light-type.showing-signal-subgroup', ['id' => $subgroup->id]) !!}
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="card">
                    <div class="card-header text-white bg-success">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            
                            <div class="float-right">
                                <a href="{{ route('traffic-light-type.index') }}" class="btn btn-light btn-sm float-right"
                                   data-toggle="tooltip" data-placement="left"
                                   title="{{ trans('traffic-light-type.tooltips.back-to-signal-subgroups') }}">
                                    <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
                                    {!! trans('traffic-light-type.buttons.back-to-signal-subgroup') !!}
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
