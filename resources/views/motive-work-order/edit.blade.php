@extends('layouts.app')

@section('template_title')
    {!! trans('motive-wo.editing-signal-subgroup', ['id' => $subgroup->id]) !!}
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
                            {!! trans('motive-wo.editing-signal-subgroup', ['id' => $subgroup->id]) !!}
                            <div class="pull-right">
                             
                                <a href="{{ url('/motive-work-order/') }}"
                                   class="btn btn-light btn-sm float-right"
                                   data-toggle="tooltip" data-placement="left"
                                   title="{{ trans('motive-wo.tooltips.back-motivewo') }}">
                                    <i class="fa fa-fw fa-reply" aria-hidden="true"></i>
                                    {!! trans('motive-wo.buttons.back-to-motivewo') !!}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        {!! Form::open(array('route' => ['motive-work-order.update', $subgroup->id], 'method' => 'PUT', 'role' => 'form', 'class' => 'needs-validation')) !!}

                        {!! csrf_field() !!}


                        <div class="form-group has-feedback row {{ $errors->has('description') ? ' has-error ' : '' }}">
                            {!! Form::label('description', trans('signal-subgroups.create_label_description'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::textarea('description', $subgroup->description, array('id' => 'description', 'rows' => '3', 'class' => 'form-control', 'placeholder' => trans('motive-wo.create_ph_description'))) !!}
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

