<?php

namespace App\Exports;

use App\Models\RegulatorBox;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class RegulatorBoxExport extends BaseExport implements FromQuery, WithMapping, WithHeadings
{
    protected $fileName;

    public function __construct()
    {
        $this->fileName = 'regulatorBox-' . Carbon::now()->timestamp . '.xlsx';
    }

    public function query()
    {
        return RegulatorBox::query();
    }

    public function map($regulatorBox): array
    {
        return [
            
            $regulatorBox->code,
            $regulatorBox->erp_code,
            $regulatorBox->intersection->main_st. " y ". $regulatorBox->intersection->cross_st,
            $regulatorBox->latitude,
            $regulatorBox->longitude,
            $regulatorBox->google_address,
            $regulatorBox->state,
            $regulatorBox->brand,
        ];
    }

    public function headings(): array
    {
        return [
            'Código',
            'Código dn el ERP',
            'Intersección',
            'Latitud',
            'Longitud',
            'Dirección en Google',
            'Estado',
            'Fabricante',
        ];
    }
}
