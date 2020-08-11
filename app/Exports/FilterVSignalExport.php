<?php

namespace App\Exports;

use App\Models\VerticalSignal;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class FilterVSignalExport extends BaseExport implements FromQuery, WithMapping, WithHeadings
{
    private $street;
    private $signal;
    private $state;
    private $material;
    private $fastener;

    public function __construct($street, $signal, $state, $material, $fastener)
    {
        $this->street = $street;
        $this->signal = $signal;
        $this->state = $state;
        $this->material = $material;
        $this->fastener = $fastener;

        $this->fileName = 'signals-' . Carbon::now()->timestamp . '.xlsx';
    }

    public function query()
    {
        $signals = VerticalSignal::query();

        if ($this->street) {
            $signals = $signals->where('street1', 'like', '%' . $this->street . '%')->orWhere('street2', 'like', '%' . $this->street . '%');
        }

        if ($this->signal) {
            $signals = $signals->where('signal_id', '=', $this->signal);
        }

        if ($this->state) {
            $signals = $signals->where('state', '=', $this->state);
        }

        if ($this->material) {
            $signals = $signals->where('material', '=', $this->material);
        }

        if ($this->fastener) {
            $signals = $signals->where('fastener', '=', $this->fastener);
        }

        return $signals;
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
            $signal->signal_inventory->name,
            $signal->variation->name,
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
            'Tipo de Señal',
            'Variacion',
            'Dirección en Google',
        ];
    }
}
