<table class="table table-striped table-hover table-sm data-table">
    @if ($actions)
        <caption id="signal_subgroups_count">
            {{ trans('traffic-light-type.signal-subgroups-table.caption', ['subgroupstotal' => $subgroupstotal]) }}
        </caption>
    @endif

    <thead class="thead">
    <tr>
        <th>{!! trans('traffic-light-type.signal-subgroups-table.id') !!}</th>
<!--        <th>{!! trans('signal-subgroups.signal-subgroups-table.code') !!}</th>
        <th style="width: 10%;">{!! trans('signal-subgroups.signal-subgroups-table.name') !!}</th>
        <th class="hidden-xs">{!! trans('signal-subgroups.signal-subgroups-table.shape') !!}</th>
        @if ($actions)
            <th>{!! trans('signal-subgroups.signal-subgroups-table.group') !!}</th>
        @endif-->
        <th style="width: 40%;"
            class="hidden-xs">{!! trans('traffic-light-type.signal-subgroups-table.description') !!}</th>

        @if ($actions)
            <th>{!! trans('traffic-light-type.signal-subgroups-table.actions') !!}</th>
            <th class="no-search no-sort"></th>
            <th class="no-search no-sort"></th>
        @endif
    </tr>
    </thead>
    <tbody id="groups_table">
    @foreach($subgroups as $subgroup)
        <tr>
            <td><a href="{{ URL::to('traffic-light-type/' . $subgroup->id) }}" target="_blank">{{ $subgroup->id }}</td>

            <td class="hidden-xs">{{ $subgroup->description }}</td>

            @if ($actions)
                <td>
                    <a class="btn btn-sm btn-success btn-block"
                       href="{{ URL::to('traffic-light-type/' . $subgroup->id) }}"
                       data-toggle="tooltip" title="Mostrar">
                        {!! trans('signal-subgroups.buttons.show') !!}
                    </a>
                </td>

                <td>
                    <a class="btn btn-sm btn-info btn-block"
                       href="{{ URL::to('traffic-light-type/' . $subgroup->id . '/edit') }}"
                       data-toggle="tooltip" title="Editar">
                        {!! trans('signal-subgroups.buttons.edit') !!}
                    </a>
                </td>

                <td>
                    {!! Form::open(array('url' => 'traffic-light-type/' . $subgroup->id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Eliminar')) !!}
                    {!! Form::hidden('_method', 'DELETE') !!}
                    {!! Form::button(trans('traffic-light-type.buttons.delete'), array('class' => 'btn btn-danger btn-sm','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => trans('traffic-light-type.modals.delete_signal_subgroup_title'), 'data-message' => trans('traffic-light-type.modals.delete_signal_subgroup_message', ['id' => $subgroup->id]))) !!}
                    {!! Form::close() !!}
                </td>
            @endif
        </tr>
    @endforeach
    </tbody>

    @if(config('atm_app.enableSearch'))
        <tbody id="search_results"></tbody>
    @endif
</table>