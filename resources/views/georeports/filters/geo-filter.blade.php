<div class="row">
    <div class="col-md-12">
        <ul class="nav nav-pills" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="pills-signals-tab" data-toggle="pill" href="#pills-signals" role="tab"
                   aria-controls="pills-signals" aria-selected="true">Señales verticales</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-lights-tab" data-toggle="pill" href="#pills-lights" role="tab"
                   aria-controls="pills-lights" aria-selected="false">Semáforos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-regulators-tab" data-toggle="pill" href="#pills-regulators" role="tab"
                   aria-controls="pills-regulators" aria-selected="false">Reguladoras</a>
            </li>
        </ul>
        <hr>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="pills-signals" role="tabpanel"
                 aria-labelledby="pills-signals-tab">
                <div class="row">
                    <div class="col-md-12">
                        {!! Form::open(array('id' => 'vsignal-filters', 'route' => 'vsignal-filters', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation')) !!}
                        {!! csrf_field() !!}

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <strong>{!! Form::label('s_street', trans('forms.create_label_street'), array('class' => 'control-label')); !!}</strong>
                                    <select name="s_street" id="s_street">
                                        <option value="">{{ trans('forms.create_ph_street') }}</option>
                                        @if ($all_vst)
                                            @foreach($all_vst as $street)
                                                <option value="{{ $street->street }}" {{ old('s_street') == $street->street ? 'selected' : '' }}>{{ $street->street }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <strong>{!! Form::label('s_type', trans('forms.create_vsignal_label_inventory'), array('class' => 'control-label')); !!}</strong>
                                    <select name="s_type" id="s_type">
                                        <option value="">{{ trans('forms.create_vsignal_ph_inventory') }}</option>
                                        @if ($inventories)
                                            @foreach($inventories as $inventory)
                                                <option value="{{ $inventory->id }}" {{ old('s_type') == $inventory->id ? 'selected' : '' }}>{{ $inventory->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <strong>{!! Form::label('s_state', trans('forms.create_vsignal_label_state'), array('class' => 'control-label')); !!}</strong>
                                    <select name="s_state" id="s_state">
                                        <option value="">{{ trans('forms.create_vsignal_ph_state') }}</option>
                                        @if ($states)
                                            @foreach($states as $id => $value)
                                                <option value="{{ $value }}" {{ old('s_state') == $value ? 'selected' : '' }}>{{ $value }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <strong>{!! Form::label('s_material', trans('forms.create_vsignal_label_material'), array('class' => 'control-label')); !!}</strong>
                                    <select name="s_material" id="s_material">
                                        <option value="">{{ trans('forms.create_vsignal_ph_material') }}</option>
                                        @if ($materials)
                                            @foreach($materials as $i => $value)
                                                <option value="{{ $value }}" {{ old('s_material') == $value ? 'selected' : '' }}>{{ $value }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <strong>{!! Form::label('s_fastener', trans('forms.create_vsignal_label_fastener'), array('class' => 'control-label')); !!}</strong>
                                    <select name="s_fastener" id="s_fastener">
                                        <option value="">{{ trans('forms.create_vsignal_ph_fastener') }}</option>
                                        @if ($s_fasteners)
                                            @foreach($s_fasteners as $i => $value)
                                                <option value="{{ $value }}" {{ old('s_fastener') == $value ? 'selected' : '' }}>{{ $value }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-lights" role="tabpanel" aria-labelledby="pills-lights-tab">
                <div class="row">
                    <div class="col-md-12">
                        {!! Form::open(array('id' => 'light-filters', 'route' => 'light-filters', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation')) !!}
                        {!! csrf_field() !!}

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <strong>{!! Form::label('l_street', trans('forms.create_label_street'), array('class' => 'control-label')); !!}</strong>
                                    <select name="l_street" id="l_street">
                                        <option value="">{{ trans('forms.create_ph_street') }}</option>
                                        @if ($all_lst)
                                            @foreach($all_lst as $street)
                                                <option value="{{ $street->street }}" {{ old('l_street') == $street->street ? 'selected' : '' }}>{{ $street->street }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <strong>{!! Form::label('l_type', trans('forms.create_traffic_light_label_light_type'), array('class' => 'control-label')); !!}</strong>
                                    <select name="l_type" id="l_type">
                                        <option value="">{{ trans('forms.create_traffic_light_ph_light_type') }}</option>
                                        @if ($light_types)
                                            @foreach($light_types as $type)
                                                <option value="{{ $type->id }}" {{ old('l_type') == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <strong>{!! Form::label('l_state', trans('forms.create_vsignal_label_state'), array('class' => 'control-label')); !!}</strong>
                                    <select name="l_state" id="l_state">
                                        <option value="">{{ trans('forms.create_vsignal_ph_state') }}</option>
                                        @if ($states)
                                            @foreach($states as $id => $value)
                                                <option value="{{ $value }}" {{ old('l_state') == $value ? 'selected' : '' }}>{{ $value }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <strong>{!! Form::label('l_brand', trans('forms.create_traffic_light_label_brand'), array('class' => 'control-label')); !!}</strong>
                                    <select name="l_brand" id="l_brand">
                                        <option value="">{{ trans('forms.create_traffic_light_ph_brand') }}</option>
                                        @if ($ligth_brands)
                                            @foreach($ligth_brands as $i => $value)
                                                <option value="{{ $value }}" {{ old('l_brand') == $value ? 'selected' : '' }}>{{ $value }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <strong>{!! Form::label('l_fastener', trans('forms.create_vsignal_label_fastener'), array('class' => 'control-label')); !!}</strong>
                                    <select name="l_fastener" id="l_fastener">
                                        <option value="">{{ trans('forms.create_vsignal_ph_fastener') }}</option>
                                        @if ($l_fasteners)
                                            @foreach($l_fasteners as $i => $value)
                                                <option value="{{ $value }}" {{ old('l_fastener') == $value ? 'selected' : '' }}>{{ $value }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-regulators" role="tabpanel" aria-labelledby="pills-regulators-tab">
                <div class="row">
                    <div class="col-md-12">
                        {!! Form::open(array('id' => 'regulator-filters', 'route' => 'regulator-filters', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation')) !!}
                        {!! csrf_field() !!}

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <strong>{!! Form::label('r_street', trans('forms.create_label_street'), array('class' => 'control-label')); !!}</strong>
                                    <select name="r_street" id="r_street">
                                        <option value="">{{ trans('forms.create_ph_street') }}</option>
                                        @if ($all_lst)
                                            @foreach($all_lst as $street)
                                                <option value="{{ $street->street }}" {{ old('r_street') == $street->street ? 'selected' : '' }}>{{ $street->street }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <strong>{!! Form::label('r_brand', trans('forms.create_traffic_light_label_brand'), array('class' => 'control-label')); !!}</strong>
                                    <select name="r_brand" id="r_brand">
                                        <option value="">{{ trans('forms.create_traffic_light_ph_brand') }}</option>
                                        @if ($regulator_brands)
                                            @foreach($regulator_brands as $i => $value)
                                                <option value="{{ $value }}" {{ old('r_brand') == $value ? 'selected' : '' }}>{{ $value }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <strong>{!! Form::label('r_state', trans('forms.create_vsignal_label_state'), array('class' => 'control-label')); !!}</strong>
                                    <select name="r_state" id="r_state">
                                        <option value="">{{ trans('forms.create_vsignal_ph_state') }}</option>
                                        @if ($states)
                                            @foreach($states as $id => $value)
                                                <option value="{{ $value }}" {{ old('r_state') == $value ? 'selected' : '' }}>{{ $value }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>


        <hr>
        <div class="row">
            <div class="col-md-12">
                {!! Form::button('<i class="fa fa-fw fa-filter" aria-hidden="true"></i> ' . trans('forms.filter_button_text'), array('class' => 'btn btn-sm btn-primary margin-bottom-1 mb-1 ml-1 float-right','type' => 'button', 'id' => 'filter-submit')) !!}&nbsp;&nbsp;
                {!! Form::button('<i class="fa fa-fw fa-undo" aria-hidden="true"></i> ' . trans('forms.clear_button_text'), array('class' => 'btn btn-sm btn-secondary margin-bottom-1 mb-1 float-right','type' => 'reset', 'id' => 'filter-reset')) !!}
            </div>
        </div>
    </div>
</div>