<?php

namespace App\Exports;

use App\Models\Intersection;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class IntersectionExport extends BaseExport implements FromQuery, WithMapping, WithHeadings
{
    protected $fileName;

    public function __construct()
    {
        $this->fileName = 'intersections-' . Carbon::now()->timestamp . '.xlsx';
    }

    public function query()
    {
        return Intersection::query();
    }

    public function map($intersection): array
    {
        return [
            
            $intersection->id,
            $intersection->main_st,
            $intersection->cross_st,
            $intersection->latitude,
            $intersection->longitude,
            $intersection->name,
            $intersection->google_address,
        ];
    }

    public function headings(): array
    {
        return [
            'Id',
            'Calle Principal',
            'Calle Cruzada',
            'Latitud',
            'Longitud',
            'Nombre',
            'Dirección en Google',
        ];
    }
}
