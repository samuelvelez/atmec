<table class="table table-striped table-sm data-table">
    <caption id="result_caption" class="text-center"></caption>
    <thead id="signals_heading" class="thead">
    <tr>
        <th width="10%">{!! trans('verticalsignals.vsignals-table.code') !!}</th>
        <th width="10%">{!! trans('Grupo') !!}</th>
        <th width="10%">{!! trans('Tipo de señal') !!}</th>
        <th width="10%">{!! trans('verticalsignals.vsignals-table.state') !!}</th>
        <th width="10%">{!! trans('Dirección 1') !!}</th>
        <th width="10%">{!! trans('Dirección 2') !!}</th>
        <th width="10%">{!! trans('verticalsignals.vsignals-table.latitude') !!}</th>
        <th width="10%">{!! trans('verticalsignals.vsignals-table.longitude') !!}</th>
        <th width="10%">{!! trans('verticalsignals.vsignals-table.google_address') !!}</th>
        <th width="10%">{!! trans('verticalsignals.vsignals-table.parish') !!}</th>
        <!--<th>{!! trans('verticalsignals.vsignals-table.fastener') !!}</th>
        <th>{!! trans('verticalsignals.vsignals-table.material') !!}</th>
        
        <th>{!! trans('Variación') !!}</th>
        
        <th>{!! trans('verticalsignals.vsignals-table.neighborhood') !!}</th>-->
        
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