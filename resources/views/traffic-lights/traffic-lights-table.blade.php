<table class="table table-striped table-sm data-table">
    @if ($actions)
        <caption id="traffic_lights_count">
            {{ trans('traffic-lights.traffic-lights-table.caption', ['lightscount' => $lights->count(), 'lightstotal' => $lightstotal]) }}
        </caption>
    @endif

    <thead class="thead">
    <tr>
        <th>{!! trans('traffic-lights.traffic-lights-table.id') !!}</th>
        <th>{!! trans('traffic-lights.traffic-lights-table.intersection') !!}</th>
        <th class="hidden-xs">{!! trans('Id Poste') !!}</th>
        <th class="hidden-xs">{!! trans('Tipo') !!}</th>
        <!--<th class="hidden-xs">{!! trans('traffic-lights.traffic-lights-table.model') !!}</th>-->
        <th class="hidden-xs">{!! trans('traffic-lights.traffic-lights-table.state') !!}</th>
        <th>{!! trans('traffic-lights.traffic-lights-table.orientation') !!}</th>

        @if ($actions)
            <th>{!! trans('traffic-lights.traffic-lights-table.actions') !!}</th>
            <th class="no-search no-sort"></th>
            <th class="no-search no-sort"></th>
        @endif
    </tr>
    </thead>
    <tbody id="traffic_lights_table">
    @foreach($lights as $light)
        <tr>
            <td><a href="{{ URL::to('traffic-lights/' . $light->id) }}" target="_blank">{{ $light->id }}</td>
            <td>{{$light->intersection->main_st}} y {{$light->intersection->cross_st}}</td>
            <td>{{ $light->pole_id }}</td>
            <td>{{ print_r($light->light_type->name) }}</td>

            <!--<td class="hidden-xs">{{$light->brand}}</td>
            <td class="hidden-xs">{{$light->model}}</td>-->
            <td class="hidden-xs">{{$light->state}}</td>
            <td>{{$light->orientation}}</td>

            @if ($actions)
                <td>
                    <a class="btn btn-sm btn-success btn-block"
                       href="{{ URL::to('traffic-lights/' . $light->id) }}"
                       data-toggle="tooltip" title="Mostrar">
                        {!! trans('traffic-lights.buttons.show') !!}
                    </a>
                </td>
                @role('atmadmin|atmcollector')
                <td>
                    <a class="btn btn-sm btn-info btn-block"
                       href="{{ URL::to('traffic-lights/' . $light->id . '/edit') }}"
                       data-toggle="tooltip" title="Editar">
                        {!! trans('traffic-lights.buttons.edit') !!}
                    </a>
                </td>
                @endrole
                @role('atmadmin')
                <td>
                    {!! Form::open(array('url' => 'traffic-lights/' . $light->id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Eliminar')) !!}
                    {!! Form::hidden('_method', 'DELETE') !!}
                    {!! Form::button(trans('traffic-lights.buttons.delete'), array('class' => 'btn btn-danger btn-sm','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Eliminar semáforo', 'data-message' => '¿Está seguro que desea eliminar el semáforo? ¡Eliminará con el todas sus dependencias!')) !!}
                    {!! Form::close() !!}
                </td>
                @endrole
            @endif
        </tr>
    @endforeach
    </tbody>

    @if(config('atm_app.enableSearch'))
        <tbody id="search_results"></tbody>
    @endif
</table>