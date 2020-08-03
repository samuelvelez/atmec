<table class="table table-striped table-sm data-table">
    @if ($actions)
        <caption id="regulator_devices_count">
            {{ trans('regulator-devices.regulator-devices-table.caption', ['devicescount' => $devices->count(), 'devicestotal' => $devicestotal]) }}
        </caption>
    @endif
    <thead class="thead">
    <tr>
        <th>{!! trans('regulator-devices.regulator-devices-table.id') !!}</th>
        <th>{!! trans('regulator-devices.regulator-devices-table.code') !!}</th>
        <th>{!! trans('regulator-devices.regulator-devices-table.regulator') !!}</th>
        <th>{!! trans('regulator-devices.regulator-devices-table.state') !!}</th>
        <th>{!! trans('regulator-devices.regulator-devices-table.type') !!}</th>
        <th class="hidden-xs">{!! trans('regulator-devices.regulator-devices-table.brand') !!}</th>
        <th class="hidden-xs">{!! trans('regulator-devices.regulator-devices-table.model') !!}</th>
        <th class="hidden-xs">{!! trans('regulator-devices.regulator-devices-table.erp-code') !!}</th>

        @if ($actions)
            <th>{!! trans('regulator-devices.regulator-devices-table.actions') !!}</th>
            <th class="no-search no-sort"></th>
            <th class="no-search no-sort"></th>
        @endif
    </tr>
    </thead>
    <tbody id="regulator_devices_table">
    @foreach($devices as $device)
        <tr>
            <td><a href="{{ URL::to('regulator-devices/' . $device->id) }}" target="_blank">{{$device->id}}</td>
            <td>{{$device->code}}</td>
            <td>{{$device->regulator_box->code}}</td>
            <td>{{$device->state}}</td>
            <td>
                @if ($device->type)
                    <div class="col-sm-6 col-6">
                        @if ($device->type == "ups_brands")
                            <span class="badge-pill badge badge-info">UPS</span>
                        @endif

                        @if ($device->type == "energy_brands")
                            <span class="badge-pill badge badge-danger">Fuente de poder</span>
                        @endif

                        @if ($device->type == "mmu_brands")
                            <span class="badge-pill badge badge-primary">MMU</span>
                        @endif

                        @if ($device->type == "travel_brands")
                            <span class="badge-pill badge badge-success">Velocidad de viaje</span>
                        @endif

                        @if ($device->type == "controller_brands")
                            <span class="badge-pill badge badge-warning">Controlador</span>
                        @endif
                    </div>
                @endif
            </td>
            <td class="hidden-xs">{{$device->brand}}</td>
            <td class="hidden-xs">{{$device->model}}</td>
            <td class="hidden-xs">{{$device->erp_code}}</td>

            @if ($actions)
                <td>
                    <a class="btn btn-sm btn-success btn-block"
                       href="{{ URL::to('regulator-devices/' . $device->id) }}"
                       data-toggle="tooltip" title="Mostrar">
                        {!! trans('regulator-devices.buttons.show') !!}
                    </a>
                </td>
                @role('atmadmin|atmcollector')
                <td>
                    <a class="btn btn-sm btn-info btn-block"
                       href="{{ URL::to('regulator-devices/' . $device->id . '/edit') }}"
                       data-toggle="tooltip" title="Editar">
                        {!! trans('regulator-devices.buttons.edit') !!}
                    </a>
                </td>
                @endrole
                @role('atmadmin')
                <td>
                    {!! Form::open(array('url' => 'regulator-devices/' . $device->id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Eliminar')) !!}
                    {!! Form::hidden('_method', 'DELETE') !!}
                    {!! Form::button(trans('regulator-devices.buttons.delete'), array('class' => 'btn btn-danger btn-sm','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Eliminar dispositivo', 'data-message' => '¿Está seguro que desea eliminar el dispositivo? ¡Eliminará con él todas sus dependencias!')) !!}
                    {!! Form::close() !!}
                </td>
                @endrole
            @endif
        </tr>
    @endforeach
    </tbody>

    @if ($actions)
        @if(config('atm_app.enableSearch'))
            <tbody id="search_results"></tbody>
        @endif
    @endif

</table>