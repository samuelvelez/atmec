<table class="table table-striped table-hover table-sm data-table">
    @if ($actions)
        <caption id="signal_groups_count">
            {{ trans('signal-groups.signal-groups-table.caption', ['groupstotal' => $groupstotal]) }}
        </caption>
    @endif

    <thead class="thead">
    <tr>
        <th>{!! trans('signal-groups.signal-groups-table.id') !!}</th>
        <th>{!! trans('signal-groups.signal-groups-table.code') !!}</th>
        <th>{!! trans('signal-groups.signal-groups-table.name') !!}</th>
        <th>{!! trans('signal-groups.signal-groups-table.subgroups') !!}</th>
        <th style="width: 40%;" class="hidden-xs">{!! trans('signal-groups.signal-groups-table.description') !!}</th>

        @if ($actions)
            <th>{!! trans('signal-groups.signal-groups-table.actions') !!}</th>
            <th class="no-search no-sort"></th>
            <th class="no-search no-sort"></th>
        @endif
    </tr>
    </thead>
    <tbody id="groups_table">
    @foreach($groups as $group)
        <tr>
            <td><a href="{{ URL::to('signal-groups/' . $group->id) }}" target="_blank">{{ $group->id }}</td>
            <td>{{ $group->code }}</td>
            <td class="hidden-xs">{{ $group->name }}</td>
            <td class="hidden-xs">{{ $group->subgroups()->count() }}</td>
            <td class="hidden-xs">{{ $group->description }}</td>

            @if ($actions)
                <td>
                    <a class="btn btn-sm btn-success btn-block"
                       href="{{ URL::to('signal-groups/' . $group->id) }}"
                       data-toggle="tooltip" title="Mostrar">
                        {!! trans('signal-groups.buttons.show') !!}
                    </a>
                </td>

                <td>
                    <a class="btn btn-sm btn-info btn-block"
                       href="{{ URL::to('signal-groups/' . $group->id . '/edit') }}"
                       data-toggle="tooltip" title="Editar">
                        {!! trans('signal-groups.buttons.edit') !!}
                    </a>
                </td>

                <td>
                    {!! Form::open(array('url' => 'signal-groups/' . $group->id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Eliminar')) !!}
                    {!! Form::hidden('_method', 'DELETE') !!}
                    {!! Form::button(trans('signal-groups.buttons.delete'), array('class' => 'btn btn-danger btn-sm','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => trans('signal-groups.modals.delete_signal_group_title'), 'data-message' => trans('signal-groups.modals.delete_signal_group_message', ['id' => $group->id]))) !!}
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