<table class="table table-striped table-sm data-table">
    @if ($actions)
        <caption id="regulator_boxes_count">
            {{ trans('regulator-boxes.regulator-boxes-table.caption', ['rbox_count' => $regulator_boxes->count(), 'rbox_total' => $regulator_box_total]) }}
        </caption>
    @endif
    <thead class="thead">
    <tr>
        <th>{!! trans('regulator-boxes.regulator-boxes-table.id') !!}</th>
        <th>{!! trans('regulator-boxes.regulator-boxes-table.intersection') !!}</th>
        <th class="hidden-xs">{!! trans('regulator-boxes.regulator-boxes-table.brand') !!}</th>
        <th class="hidden-xs">{!! trans('regulator-boxes.regulator-boxes-table.state') !!}</th>
        <th class="hidden-xs">{!! trans('Latitud') !!}</th>
        <th class="hidden-xs">{!! trans('Longitud') !!}</th>
        <th class="hidden-xs">{!! trans('regulator-boxes.regulator-boxes-table.google_address') !!}</th>

        @if ($actions)
            <th>{!! trans('regulator-boxes.regulator-boxes-table.actions') !!}</th>
            <th class="no-search no-sort"></th>
            <th class="no-search no-sort"></th>
        @endif
    </tr>
    </thead>
    <tbody id="regulator_boxes_table">
    @foreach($regulator_boxes as $regulator_box)
        <tr>
            <td><a href="{{ URL::to('regulator-boxes/' . $regulator_box->id) }}"
                   target="_blank">{{$regulator_box->id}}</a></td>
            <td>{{$regulator_box->intersection->main_st}} y {{$regulator_box->intersection->cross_st}}</td>
            <td class="hidden-xs">{{$regulator_box->brand}}</td>
            <td class="hidden-xs">{{$regulator_box->state}}</td>

            <td class="hidden-xs">{{$regulator_box->latitude}}</td>
            <td class="hidden-xs">{{$regulator_box->longitude}}</td>
            <td class="hidden-xs">{{$regulator_box->google_address}}</td>

            @if ($actions)
                <td>
                    <a class="btn btn-sm btn-success btn-block"
                       href="{{ URL::to('regulator-boxes/' . $regulator_box->id) }}"
                       data-toggle="tooltip" title="Show">
                        {!! trans('regulator-boxes.buttons.show') !!}
                    </a>
                </td>
                @role('atmadmin|atmcollector')
                <td>
                    <a class="btn btn-sm btn-info btn-block"
                       href="{{ URL::to('regulator-boxes/' . $regulator_box->id . '/edit') }}"
                       data-toggle="tooltip" title="Edit">
                        {!! trans('regulator-boxes.buttons.edit') !!}
                    </a>
                </td>
                @endrole
                @role('atmadmin')
                <td>
                    {!! Form::open(array('url' => 'regulator-boxes/' . $regulator_box->id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Delete')) !!}
                    {!! Form::hidden('_method', 'DELETE') !!}
                    {!! Form::button(trans('regulator-boxes.buttons.delete'), array('class' => 'btn btn-danger btn-sm','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Eliminar caja reguladora', 'data-message' => '¿Está seguro que desea eliminar esta caja reguladora? ¡Eliminará con ella todas sus dependencias!')) !!}
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