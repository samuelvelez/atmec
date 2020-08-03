<?php

namespace App\Exports;

use App\Models\Configuration;
use App\Models\DevicesInventory;
use App\Models\TrafficLight;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class LightTotalsExport extends BaseTotalsExport implements FromView
{
    public function __construct()
    {
        $this->fileName = 'light-totals-' . Carbon::now()->timestamp . '.xlsx';
    }

    public function view(): View
    {
        $light_total = TrafficLight::count();

        if ($light_total == 0) {
            return back()->with('error', 'Aun no existen semáforos en el sistema.');
        }

        $states = json_decode(Configuration::where('code', 'estado')->first()->values);
        $brands = json_decode(Configuration::where('code', 'light_brands')->first()->values);

        $state_totals = [];
        foreach ($states as $state) {
            $count = TrafficLight::where('state', 'like', '%' . substr($state, 0, -1) . '%')->count();
            if ($count) {
                $state_totals[$state] = $count;
            }
        }

        $material_totals = [];
        foreach ($brands as $brand) {
            $count = TrafficLight::where('brand', 'like', '%' . $brand . '%')->count();
            if ($count) {
                $material_totals[$brand] = $count;
            }
        }

        $light_types = DevicesInventory::where('name', 'like', '%SEMAFORO%')->get();
        $type_totals = [];
        foreach ($light_types as $type) {
            $count = $type->traffic_lights()->count();
            if ($count) {
                $type_totals[$type->name] = $count;
            }
        }

        return view('georeports.tables.light-totals-table', [
            'light_total' => $light_total,
            'state_totals' => $state_totals,
            'material_totals' => $material_totals,
            'type_totals' => $type_totals
        ]);
    }
}
