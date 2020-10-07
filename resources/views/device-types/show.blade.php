@extends('layouts.app')

@section('template_title')
    {!! trans('device-types.showing-signal-subgroup', ['id' => $subgroup->id]) !!}
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="card">
                    <div class="card-header text-white bg-success">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            
                            <div class="float-right">
                                <a href="{{ route('device-types.index') }}" class="btn btn-light btn-sm float-right"
                                   data-toggle="tooltip" data-placement="left"
                                   title="{{ trans('device-types.tooltips.back-to-brands') }}">
                                    <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
                                    {!! trans('device-types.buttons.back-to-brands1') !!}
                                </a>
                            </div>
                        </div>
                    </div>

                               <div class="card-body">

                     
                        <div class="row">
                        <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('device-types.show-signal-subgroup.id') }}
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
                                        {{ trans('device-types.show-signal-subgroup.description') }}
                                    </strong>
                                    <div class="row">
                                        <div class="col-sm-12 col-12">
                                            {{ $subgroup->description }}

                                            
                                        </div>
                                    </div>
                                @endif
                            </div>
                            
                            <div class="col-sm-6 col-6">
                                @if ($subgroup->description)
                                    <strong class="text-larger">
                                        {{ trans('device-types.show-signal-subgroup.tipo') }}
                                    </strong>
                                    <div class="row">
                                        <div class="col-sm-12 col-12">

                                        @if ($groups)
  @foreach($groups as $group)
{{ $subgroup->brands_type_fk == $group->id ? $group->description : '' }}                                                
                                            @endforeach
                                        @endif
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
                                        {!! trans('device-types.show-signal-subgroup.created') !!}
                                    </strong>
                                    {{ $subgroup->created_at }}
                                </div>
                            @endif

                            @if ($subgroup->updated_at)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {!! trans('device-types.show-signal-subgroup.updated') !!}
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
