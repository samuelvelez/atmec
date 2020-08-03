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
            $signal->code,
            $signal->latitude,
            $signal->longitude,
            $signal->state,
            $signal->fastener,
            $signal->material,
            //$signal->parish,
            //$signal->neighborhood,
            $signal->google_address,
        ];
    }

    public function headings(): array
    {
        return [
            'Código',
            'Latitud',
            'Longitud',
            'Estado',
            'Fijador',
            'Material',
            'Dirección en Google',
        ];
    }
}
