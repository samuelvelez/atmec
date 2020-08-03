<table class="table table-sm data-table table-hover">
    <thead class="thead-dark">
    <tr>
        <th>{!! trans('georeports.totals.criteria') !!}</th>
        <th>{!! trans('georeports.totals.value') !!}</th>
    </tr>
    </thead>
    <tbody id="totals_table">
    <tr class="table-active">
        <td><strong>{!! trans('georeports.totals.state') !!}</strong></td>
        <td></td>
    </tr>

    @foreach($state_totals as $state => $total)
        <tr>
            <td class="pl-4">{!! $state !!}</td>
            <td>{{ $total }}</td>
        </tr>
    @endforeach

    <tr class="table-active">
        <td><strong>{!! trans('georeports.totals.brand') !!}</strong></td>
        <td></td>
    </tr>

    @foreach($material_totals as $material => $total)
        <tr>
            <td class="pl-4">{!! $material !!}</td>
            <td>{{ $total }}</td>
        </tr>
    @endforeach

    <tr class="table-active">
        <td><strong>{!! trans('georeports.light-totals.type') !!}</strong></td>
        <td></td>
    </tr>

    @foreach($type_totals as $type => $total)
        <tr>
            <td class="pl-4">{!! ucfirst(mb_strtolower($type)) !!}</td>
            <td>{{ $total }}</td>
        </tr>
    @endforeach

    <tr class="table-success">
        <td><strong>{!! trans('georeports.light-totals.general') !!}</strong></td>
        <td><strong>{{ $light_total }}</strong></td>
    </tr>
    </tbody>
</table>