@extends('layouts.app')

@section('template_title')
    {!! trans('brands.editing-signal-subgroup', ['id' => $subgroup->id]) !!}
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
                            {!! trans('brands.editing-signal-subgroup', ['id' => $subgroup->id]) !!}
                            <div class="pull-right">
                             
                                <a href="{{ url('/brands/' . $subgroup->id) }}"
                                   class="btn btn-light btn-sm float-right"
                                   data-toggle="tooltip" data-placement="left"
                                   title="{{ trans('brands.tooltips.back-to-brands') }}">
                                    <i class="fa fa-fw fa-reply" aria-hidden="true"></i>
                                    {!! trans('brands.buttons.back-to-brands1') !!}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        {!! Form::open(array('route' => ['brands.update', $subgroup->id], 'method' => 'PUT', 'role' => 'form', 'class' => 'needs-validation')) !!}

                        {!! csrf_field() !!}


                        <div class="form-group has-feedback row {{ $errors->has('description') ? ' has-error ' : '' }}">
                            {!! Form::label('description', trans('signal-subgroups.create_label_description'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::textarea('description', $subgroup->description, array('id' => 'description', 'rows' => '3', 'class' => 'form-control', 'placeholder' => trans('signal-subgroups.create_ph_description'))) !!}
                                </div>
                                @if ($errors->has('description'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

  <div class="form-group has-feedback row {{ $errors->has('group') ? ' has-error ' : '' }}">
                            {!! Form::label('group', trans('brands.create_label_brandtype'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="form-group">
                                    <select name="group" id="group">
                                        <option value="">{{ trans('brands.create_ph_brandtipo') }}</option>
                                        @if ($groups)
                                            @foreach($groups as $group)
                                                <option value="{{ $group->id }}" {{ $subgroup->brands_type_fk == $group->id ? 'selected' : '' }}>{{ $group->description }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
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

