<?php

namespace App\Exports;

use App\Models\Configuration;
use App\Models\SignalInventory;
use App\Models\VerticalSignal;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SignalTotalsExport extends BaseTotalsExport implements FromView
{
    public function __construct()
    {
        $this->fileName = 'signal-totals-' . Carbon::now()->timestamp . '.xlsx';
    }

    public function view(): View
    {
        $signal_total = VerticalSignal::count();
        if ($signal_total == 0) {
            return back()->with('error', 'Aun no existen señales verticales en el sistema.');
        }

        $states = json_decode(Configuration::where('code', 'estado')->first()->values);
        $materials = json_decode(Configuration::where('code', 'material')->first()->values);

        $state_totals = [];
        foreach ($states as $state) {
            $count = VerticalSignal::where('state', 'like', '%' . substr($state, 0, -1) . '%')->count();
            if ($count) {
                $state_totals[$state] = $count;
            }
        }

        $material_totals = [];
        foreach ($materials as $material) {
            $count = VerticalSignal::where('material', 'like', '%' . $material . '%')->count();
            if ($count) {
                $material_totals[$material] = $count;
            }
        }

        $signal_types = SignalInventory::all();
        $type_totals = [];
        foreach ($signal_types as $type) {
            $count = $type->vertical_signals()->count();
            if ($count) {
                $type_totals[$type->name] = $count;
            }
        }

        return view('georeports.tables.signals-totals-table', [
            'state_totals' => $state_totals,
            'material_totals' => $material_totals,
            'type_totals' => $type_totals,
            'signal_total' => $signal_total,
            'logo' => public_path('/images/atm.png')
        ]);
    }
}
