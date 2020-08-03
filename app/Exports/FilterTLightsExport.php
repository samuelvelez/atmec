<?php

namespace App\Exports;

use App\Models\TrafficLight;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class FilterTLightsExport extends BaseExport implements FromQuery, WithMapping, WithHeadings
{
    private $street;
    private $ligth;
    private $brand;
    private $state;
    private $fastener;

    public function __construct($street, $light, $brand, $state, $fastener)
    {
        $this->street = $street;
        $this->ligth = $light;
        $this->brand = $brand;
        $this->state = $state;
        $this->fastener = $fastener;

        $this->fileName = 'lights-' . Carbon::now()->timestamp . '.xlsx';
    }

    public function query()
    {
        $lights = TrafficLight::select('intersections.*','traffic_lights.*')->join('intersections', 'traffic_lights.intersection_id', '=', 'intersections.id');

        if ($this->street) {
            $lights = $lights->where('intersections.main_st', 'like', '%' . $this->street . '%')->orWhere('intersections.cross_st', 'like', '%' . $this->street . '%');
        }

        if ($this->ligth) {
            $lights = $lights->where('type_id', '=', $this->light);
        }

        if ($this->brand) {
            $lights = $lights->where('brand', '=', $this->brand);
        }

        if ($this->state) {
            $lights = $lights->where('state', 'like', '%' . substr($this->state, 0, -1) . '%');
        }

        if ($this->fastener) {
            $lights = $lights->where('fastener', '=', $this->fastener);
        }

        return $lights;
    }

    public function headings(): array
    {
        return [
            'Identificador',
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
            $light->brand,
            $light->fastener,
            $light->state,
            $light->orientation,
            $light->intersection->main_st . ' y ' . $light->intersection->cross_st,
        ];
    }
}
