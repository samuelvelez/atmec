<?php

namespace App\Exports;

use App\Models\TrafficLight;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TrafficLightsExport extends BaseExport implements FromQuery, WithMapping, WithHeadings
{
    protected $fileName;

    public function __construct()
    {
        $this->fileName = 'lights-' . Carbon::now()->timestamp . '.xlsx';
    }

    public function query()
    {
        return TrafficLight::select()->join('intersections', 'traffic_lights.intersection_id', '=', 'intersections.id');
    }

    public function headings(): array
    {
        return [
            'Identificador',
            'Tipo',
            'Fabricante',
            'Fijador',
            'Estado',
            'Orientación',
            'Intersección',

        ];
    }

    public function map($light): array
    {
        return [
            $light->id,
            $light->light_type->name,
            $light->brand,
            $light->fastener,
            $light->state,
            $light->orientation,
            $light->intersection->main_st . ' y ' . $light->intersection->cross_st,
        ];
    }
}
