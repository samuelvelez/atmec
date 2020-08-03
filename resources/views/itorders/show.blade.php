@extends('layouts.app')

@section('template_title')
    {!! trans('itorders.showing-itorder-title', ['id' => $itorder->id]) !!}
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">

                <div class="card">

                    <div class="card-header text-white bg-success">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            {!! trans('itorders.showing-itorder-title', ['id' => $itorder->id]) !!}
                            <div class="float-right">
                                <a href="{{ route('itorders.index') }}" class="btn btn-light btn-sm float-right"
                                   data-toggle="tooltip" data-placement="left"
                                   title="{{ trans('itorders.tooltips.back-itorders') }}">
                                    <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
                                    {!! trans('itorders.buttons.back-to-itorders') !!}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            @if ($itorder->collector)
                                <div class="col-sm-12 col-12">
                                    <strong class="text-larger">
                                        {{ trans('itorders.labelCollector') }}
                                    </strong>
                                    {{ $itorder->collector->full_name() }}
                                </div>
                            @endif
                        </div>

                        @if ($itorder->materials)
                            <div class="clearfix"></div>
                            <div class="border-bottom"></div>

                            <div class="row">
                                <div class="col-sm-12 col-12">
                                    <br>
                                    <div class="text-larger text-center"><strong>Listado de materiales</strong></div>
                                    <table class="table table-hover table-striped table-sm data-table">
                                        <thead class="thead">
                                        <th>Nombre</th>
                                        <th>Código</th>
                                        <th>Unidad de medida</th>
                                        <th>Cantidad</th>
                                        </thead>
                                        <tbody>
                                        @forelse($itorder->materials as $material)
                                            <tr>
                                                <td>{{ $material->material->name }}</td>
                                                <td>{{ $material->code }}</td>
                                                <td>{{ $material->metric_unit->name . ' (' . $material->metric_unit->abbreviation . ')' }}</td>
                                                <td>{{ $material->amount }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="2">Sin materiales asignados aun.</td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <div class="row">
                            @if ($itorder->created_at)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('itorders.labelCreated') }}
                                    </strong>
                                    {{ $itorder->created_at }}
                                </div>
                            @endif
                            @if ($itorder->updated_at)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('itorders.labelUpdated') }}
                                    </strong>
                                    {{ $itorder->updated_at }}
                                </div>
                            @endif
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <br/>
                        <div class="row">
                            <div class="col-4">
                                <a class="btn btn-sm btn-success btn-block"
                                   href="{{ URL::to('/itorders/create') }}"><i
                                            class="fa fa-plus-square"></i><span
                                            class="hidden-xs"> Nueva OET</span></a>
                            </div>
                            <div class="col-4">
                                <a class="btn btn-sm btn-info btn-block"
                                   href="{{ URL::to('itorders/' . $itorder->id . '/edit') }}"><i
                                            class="fa fa-edit"></i> <span class="hidden-xs">Editar</span></a>
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
                                           href="{{ URL::to('/ito-templates/create') }}"><i
                                                    class="fa fa-plus-square"></i> Nueva plantilla</a>
                                    </div>
                                </div>
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
