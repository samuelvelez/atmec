@extends('layouts.app')

@section('template_title')
    {!! trans('intersections.showing-intersection', ['id' => $device->id]) !!}
@endsection

@section('template_fastload_css')
    .picture {
    height: 200px;
    width: auto;
    border: 2px solid #8eb4cb;
    }


@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">

                <div class="card">

                    <div class="card-header text-white bg-success">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            {!! trans('intersections.showing-intersection-title', ['id' => $device->id]) !!}
                            <div class="float-right">
                                <a href="{{ route('storage-inventory.index') }}" class="btn btn-light btn-sm float-right"
                                   data-toggle="tooltip" data-placement="left"
                                   title="{{ trans('device-inventory.tooltips.back-intersections') }}">
                                    <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
                                    {!! trans('intersections.buttons.back-to-intersections') !!}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                   


                        
                        <div class="row">
                      

                            @if ($device->device_id)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        Nombre de producto:
                                    </strong>
     @if ($groups)
  @foreach($groups as $group)
{{ $device->device_id == $group->id ? $group->name : '' }}                                                
                                            @endforeach
                                        @endif                                    
                                    
                                    
                                </div>
                            @endif
                                  <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        Bodega:
                                    </strong>
     @if ($storages)
  @foreach($storages as $storage)
{{ $device->storage_id == $storage->id ? $storage->name : '' }}                                                
                                            @endforeach
                                        @endif                                    
                                    
                                    
                                </div>
                            
                            
                             <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        Cantidad en stock:
                                    </strong>
                                        {{ $device->quantity }}
                                
                                    
                                    
                                </div>
                            
                            
                        </div>
                        
    

                        <div class="row">
                            @if ($device->created_at)

                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('verticalsignals.labelCreatedAt') }}
                                    </strong>
                                    {{ $device->created_at }}
                                </div>

                            @endif

                            @if ($device->updated_at)

                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('verticalsignals.labelUpdatedAt') }}
                                    </strong>
                                    {{ $device->updated_at }}
                                </div>

                            @endif
                        </div>

                        

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <br/>
                        <div class="row">
                            <div class="col-4">
                                <a class="btn btn-sm btn-success btn-block"
                                   href="{{ URL::to('/intersections/create') }}"><i
                                            class="fa fa-plus-square"></i><span
                                            class="hidden-xs"> Nueva intersección</span></a>
                            </div>
                            
                            <div class="col-4">
                                <div class="btn-group float-right btn-block" role="group">
                                    <button id="btnGroupDrop1" type="button"
                                            class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                        <span class="hidden-xs">Continuar a...</span>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                        <a class="dropdown-item btn btn-sm"
                                           href="{{ URL::to('/regulator-boxes/create') }}"><i
                                                    class="fa fa-plus-square"></i> Nueva reguladora</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item btn btn-sm"
                                           href="{{ URL::to('/traffic-tensors/create') }}"><i
                                                    class="fa fa-plus-square"></i> Nuevo tensor</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item btn btn-sm"
                                           href="{{ URL::to('/traffic-poles/create') }}"><i
                                                    class="fa fa-plus-square"></i> Nuevo poste</a>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-4">
                                <a class="btn btn-sm btn-info btn-block"
                                   href="{{ URL::to('intersections/' . $device->id . '/edit') }}"><i
                                            class="fa fa-edit"></i> <span class="hidden-xs">Editar</span></a>
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
