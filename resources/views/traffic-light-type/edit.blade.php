@extends('layouts.app')

@section('template_title')
    {!! trans('traffic-light-type.editing-signal-subgroup', ['id' => $subgroup->id]) !!}
@endsection

@section('template_linked_css')
    @if(config('atm_app.enabledSelectizeJs'))
        <link rel="stylesheet" type="text/css" href="{{ config('atm_app.selectizeCssCDN') }}">
    @endif
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            {!! trans('traffic-light-type.editing-signal-subgroup', ['id' => $subgroup->id]) !!}
                            <div class="pull-right">
                                <a href="{{ route('traffic-light-type.index') }}"
                                   class="btn btn-light btn-sm float-right"
                                   data-toggle="tooltip" data-placement="top"
                                   title="{{ trans('traffic-light-type.tooltips.back-to-signal-subgroups') }}">
                                    <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                    {!! trans('signal-subgroups.buttons.back-to-signal-subgroups') !!}
                                </a>
                                <a href="{{ url('/traffic-light-type/' . $subgroup->id) }}"
                                   class="btn btn-light btn-sm float-right"
                                   data-toggle="tooltip" data-placement="left"
                                   title="{{ trans('traffic-light-type.tooltips.back-to-signal-subgroup') }}">
                                    <i class="fa fa-fw fa-reply" aria-hidden="true"></i>
                                    {!! trans('traffic-light-type.buttons.back-to-signal-subgroup') !!}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        {!! Form::open(array('route' => ['traffic-light-type.update', $subgroup->id], 'method' => 'PUT', 'role' => 'form', 'class' => 'needs-validation')) !!}

                        {!! csrf_field() !!}
                        

                        <div class="form-group has-feedback row {{ $errors->has('description') ? ' has-error ' : '' }}">
                            {!! Form::label('description', trans('traffic-light-type.create_label_description'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('description', $subgroup->description, array('id' => 'description', 'class' => 'form-control', 'placeholder' => trans('traffic-light-type.create_ph_description'))) !!}
                                                                       
                                </div>
                                @if ($errors->has('description'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>


                        {!! Form::button(trans('forms.save-changes'), array('class' => 'btn btn-primary margin-bottom-1 mb-1 float-right','type' => 'submit' )) !!}
                        {!! Form::close() !!}
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer_scripts')
    <script type="text/javascript" src="{{ config('atm_app.selectizeJsCDN') }}"></script>

    <script type="text/javascript">
        $(function () {
            $("#group").selectize({
                allowClear: true,
                create: false,
                highlight: true,
                diacritics: true
            });

            $("#shape").selectize({
                allowClear: true,
                create: false,
                highlight: true,
                diacritics: true
            });

            $("#colors").selectize({
                allowClear: true,
                plugins: ['remove_button'],
                maxItems: null,
                create: false,
                highlight: true,
                diacritics: true
            });
        });
    </script>
@endsection

