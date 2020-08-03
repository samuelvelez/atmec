<?php

namespace App\Exports;

use App\Models\RegulatorBox;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class FilterRegulatorsExport extends BaseExport implements FromQuery, WithMapping, WithHeadings
{
    private $street;
    private $brand;
    private $state;

    public function __construct($street, $brand, $state)
    {
        $this->street = $street;
        $this->brand = $brand;
        $this->state = $state;

        $this->fileName = 'regulators-' . Carbon::now()->timestamp . '.xlsx';
    }

    public function query()
    {
        $regulators = RegulatorBox::select('intersections.*','regulator_boxes.*')->join('intersections', 'regulator_boxes.intersection_id', '=', 'intersections.id');

        if ($this->street) {
            $regulators = $regulators->where('intersections.main_st', 'like', '%' . $this->street . '%')->orWhere('intersections.cross_st', 'like', '%' . $this->street . '%');
        }

        if ($this->brand) {
            $regulators = $regulators->where('brand', '=', $this->brand);
        }

        if ($this->state) {
            $regulators = $regulators->where('state', 'like', '%' . substr($this->state, 0, -1) . '%');
        }

        return $regulators;
    }

    public function headings(): array
    {
        return [
            'Identificador',
            'Código',
            'Código ERP',
            'Fabricante',
            'Estado',
            'Intersección',
            'Comentario',
        ];
    }

    public function map($regulator): array
    {
        return [
            $regulator->id,
            $regulator->code,
            $regulator->erp_code,
            $regulator->brand,
            $regulator->state,
            $regulator->intersection->main_st . ' y ' . $regulator->intersection->cross_st,
            $regulator->comment,
        ];
    }
}
