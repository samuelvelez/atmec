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

    public function __construct($street, $signal, $state, $material, $fastener, $parish, $group)
    {
        $this->street = $street;
        $this->signal = $signal;
        $this->state = $state;
        $this->material = $material;
        $this->fastener = $fastener;

        $this->fileName = 'signals-' . Carbon::now()->timestamp . '.xlsx';

        $this->parish = $parish;
        $this->group = $group;
    }

    public function query()
    {
        /*$signals = VerticalSignal::query();

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
        */
        $signals = VerticalSignal::query();
        if ($this->signal) {
            $signals = $signals->where('signal_id', '=', $this->signal);
        }

        if ($this->state) {
            $signals = $signals->where('state', $this->state);
        }

        if ($this->material) {
            $signals = $signals->where('material', $this->material);
        }

        if ($this->fastener) {
            $signals = $signals->where('fastener', '=', $this->fastener);
        }
        if ($this->street) {
            $signals = $signals->where('street1', 'like', '%' . $this->street . '%');//->orWhere('street2', 'like', '%' . $request->s_street . '%')
        }
        if ($this->parish) {
            $signals = $signals->where('parish', '=', strtoupper($this->parish));
        }
        /*if ($request->input('s_orientation')!="") {
            $signals = $signals->where('orientation', '=', $request->s_orientation);
        }*/
        if ($this->group) {
            //$signals = $signals->where('fastener', '=', $request->s_fastener);
            $request = $this;
            $signals = $signals->whereIn('signal_id', function($query) use ($request){
                $query->select('id')->from('signals_inventory')
                ->whereIn('subgroup_id', function($query_in) use ($request){
                    $query_in->select('id')->from('signal_subgroups')
                    ->whereIn('group_id', function($query_sub) use ($request){
                        $query_sub->select('id')->from('signal_groups')
                        ->where('code', $this->group);
                    });
                });
            });
        }

        return $signals;
    }

    public function map($signal): array
    {
        return [
            $signal->code,
            $signal->signal_inventory->subgroup->group->name . ' (' . $signal->signal_inventory->subgroup->group->code . ')',//$signal->grupo,
            $signal->signal_inventory->name,
            $signal->state,
            $signal->material,
            $signal->fastener,
            $signal->normative,
            $signal->street1,
            $signal->street2,
            $signal->latitude,
            $signal->longitude,
            $signal->google_address,
            $signal->parish,
            $signal->neighborhood,
            ($signal->variation != null) ? $signal->variation->variation : "-",
            $signal->comment,
            $signal->erp_code,

        ];
    }

    public function headings(): array
    {
        
        return[
            'Código',
            'Grupo',//
            'Tipo de Señal',
            'Estado',
            'Material',
            'Fijador',
            'Normativa',
            'Dirección 1',
            'Dirección 2',
            'Latitud',
            'Longitud',
            'Dirección en Google',
            'Parroquia',
            'Barrio',
            'Variacion',
            'Comentario',
        ];
        /*return [
            'Código',
            'Latitud',
            'Longitud',
            'Estado',
            'Fijador',
            'Material',
            'Tipo de Señal',
            'Variacion',
            'Dirección en Google',
            'Comentario',
            'Ubicación',
            'Dirección 1',
            'Dirección 2',
            'Barrio',
            'Parroquia',
            'Normativa'

        ];*/
    }
}
