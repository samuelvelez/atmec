<?php

namespace App\Exports;

use App\Models\VerticalSignal;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class VerticalSignalExport extends BaseExport implements FromQuery, WithMapping, WithHeadings
{
    protected $fileName;

    public function __construct()
    {
        $this->fileName = 'signals-' . Carbon::now()->timestamp . '.xlsx';
    }

    public function query()
    {
        return VerticalSignal::query();
    }

    public function map($signal): array
    {
        return [
            /*$signal->code,
            $signal->latitude,
            $signal->longitude,
            $signal->state,
            $signal->fastener,
            $signal->material,
            //$signal->parish,
            //$signal->neighborhood,
            $signal->google_address,*/
            $signal->code,
            $signal->signal_inventory->subgroup->group->name . ' (' . $signal->signal_inventory->subgroup->group->code . ')',//$signal->grupo,
            $signal->signal_inventory->name,
            $signal->state,
            $signal->material,
            $signal->fastener,
            //$signal->normative,
            //$signal->street1,
            //$signal->street2,
            /*$signal->latitude,
            $signal->longitude,*/
            $signal->google_address,
            /*$signal->parish,
            $signal->neighborhood,
            ($signal->variation != null) ? $signal->variation->variation : "-",
            $signal->comment,
            $signal->erp_code,*/
        ];
    }

    public function headings(): array
    {
        return [
            /*'Código',
            'Latitud',
            'Longitud',
            'Estado',
            'Fijador',
            'Material',
            'Dirección en Google',*/
            'Código',
            'Grupo',
            'Tipo de Señal',
            'Estado',
            'Material',
            'Fijador',
            //'Normativa',
            //'Dirección 1',
            //'Dirección 2',*/
            //'Latitud',
            //'Longitud',
            'Dirección en Google',
            /*'Parroquia',
            'Barrio',
            'Variacion',
            'Comentario',*/
        ];
    }
}
