<table class="table table-striped table-sm data-table">
    <caption id="result_caption" class="text-center"></caption>
    <thead id="signals_heading" class="thead">
    <tr>
        <th>{!! trans('verticalsignals.vsignals-table.code') !!}</th>
        <th>{!! trans('verticalsignals.vsignals-table.latitude') !!}</th>
        <th>{!! trans('verticalsignals.vsignals-table.longitude') !!}</th>
        <th>{!! trans('verticalsignals.vsignals-table.state') !!}</th>
        <th>{!! trans('verticalsignals.vsignals-table.fastener') !!}</th>
        <th>{!! trans('verticalsignals.vsignals-table.material') !!}</th>
        <th>{!! trans('Tipo de señal') !!}</th>
        <th>{!! trans('Variación') !!}</th>
        <th>{!! trans('verticalsignals.vsignals-table.parish') !!}</th>
        <th>{!! trans('verticalsignals.vsignals-table.neighborhood') !!}</th>
        <th>{!! trans('verticalsignals.vsignals-table.google_address') !!}</th>
    </tr>
    </thead>

    <thead id="lights_heading" class="thead">
    <tr>
        <th>{!! trans('traffic-lights.traffic-lights-table.id') !!}</th>
        <th>{!! trans('traffic-lights.traffic-lights-table.brand') !!}</th>
        <th>{!! trans('traffic-lights.traffic-lights-table.fastener') !!}</th>
        <th>{!! trans('traffic-lights.traffic-lights-table.state') !!}</th>
        <th>{!! trans('traffic-lights.traffic-lights-table.orientation') !!}</th>
        <th>{!! trans('traffic-lights.traffic-lights-table.intersection') !!}</th>
    </tr>
    </thead>

    <thead id="regulators_heading" class="thead">
    <tr>
        <th>{!! trans('regulator-boxes.regulator-boxes-table.id') !!}</th>
        <th>{!! trans('regulator-boxes.regulator-boxes-table.code') !!}</th>
        <th>{!! trans('regulator-boxes.regulator-boxes-table.erp_code') !!}</th>
        <th>{!! trans('regulator-boxes.regulator-boxes-table.brand') !!}</th>
        <th>{!! trans('regulator-boxes.regulator-boxes-table.state') !!}</th>
        <th>{!! trans('regulator-boxes.regulator-boxes-table.intersection') !!}</th>
    </tr>
    </thead>

    <tbody id="result_table">
    </tbody>
</table>