<table class="table table-striped table-sm data-table">
    @if ($actions)
        <caption id="traffic_poles_count">
            {{ trans('traffic-poles.traffic-poles-table.caption', ['polescount' => $poles->count(), 'polestotal' => $polestotal]) }}
        </caption>
    @endif

    <thead class="thead">
    <tr>
        <th>{!! trans('traffic-poles.traffic-poles-table.id') !!}</th>
        <th>{!! trans('traffic-poles.traffic-poles-table.intersection') !!}</th>
        <th>{!! trans('traffic-poles.traffic-poles-table.height') !!}</th>
        <th class="hidden-xs">{!! trans('traffic-poles.traffic-poles-table.state') !!}</th>
        <th class="hidden-xs">{!! trans('traffic-poles.traffic-poles-table.material') !!}</th>

        @if ($actions)
            <th>{!! trans('traffic-poles.traffic-poles-table.actions') !!}</th>
            <th class="no-search no-sort"></th>
            <th class="no-search no-sort"></th>
        @endif
    </tr>
    </thead>
    <tbody id="traffic_poles_table">
    @foreach($poles as $pole)
        <tr>
            <td><a href="{{ URL::to('traffic-poles/' . $pole->id) }}" target="_blank">{{$pole->id}}</a></td>
            <td>{{$pole->intersection->main_st}} y {{$pole->intersection->cross_st}}</td>
            <td>{{$pole->height}}m</td>
            <td class="hidden-xs">{{$pole->state}}</td>
            <td class="hidden-xs">{{$pole->material}}</td>

            @if ($actions)
                <td>
                    <a class="btn btn-sm btn-success btn-block"
                       href="{{ URL::to('traffic-poles/' . $pole->id) }}"
                       data-toggle="tooltip" title="Mostrar">
                        {!! trans('traffic-poles.buttons.show') !!}
                    </a>
                </td>
                @role('atmadmin|atmcollector')
                <td>
                    <a class="btn btn-sm btn-info btn-block"
                       href="{{ URL::to('traffic-poles/' . $pole->id . '/edit') }}"
                       data-toggle="tooltip" title="Editar">
                        {!! trans('traffic-poles.buttons.edit') !!}
                    </a>
                </td>
                @endrole
                @role('atmadmin')
                <td>
                    {!! Form::open(array('url' => 'traffic-poles/' . $pole->id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Eliminar')) !!}
                    {!! Form::hidden('_method', 'DELETE') !!}
                    {!! Form::button(trans('traffic-poles.buttons.delete'), array('class' => 'btn btn-danger btn-sm','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Eliminar poste', 'data-message' => '¿Está seguro que desea eliminar el poste? ¡Eliminará con el todas sus dependencias!')) !!}
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