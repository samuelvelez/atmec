<?php

namespace App\Http\Controllers;

use App\Exports\FilterTLightsExport;
use App\Exports\FilterVSignalExport;
use App\Exports\FilterRegulatorsExport;
use App\Exports\LightTotalsExport;
use App\Exports\SignalTotalsExport;
use App\Models\Configuration;
use App\Models\DevicesInventory;
use App\Models\Intersection;
use App\Models\RegulatorBox;
use App\Models\SignalInventory;
use App\Models\TrafficLight;
use App\Models\VerticalSignal;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use function GuzzleHttp\Psr7\parse_query;
use App\Models\SignalGroup;


class GeoReportsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show_signals()
    {
        $sinventories = SignalInventory::all();
        $materials = json_decode(Configuration::where('code', 'material')->first()->values);

        $all_vst = VerticalSignal::select('street1 as street')->distinct()->union(
            VerticalSignal::select('street2 as street')->distinct()
        )->get();

        $light_types = DevicesInventory::where('name', 'like', '%SEMAFORO%')->get();
        $states = json_decode(Configuration::where('code', 'estado')->first()->values);
        $l_fasteners = json_decode(Configuration::where('code', 'light_fasteners')->first()->values);
        $s_fasteners = json_decode(Configuration::where('code', 'signal_fasteners')->first()->values);
        $ligth_brands = json_decode(Configuration::where('code', 'light_brands')->first()->values);
        $regulator_brands = json_decode(Configuration::where('code', 'regulator_brands')->first()->values);
        $all_lst = Intersection::select('main_st as street')->distinct()->union(
            Intersection::select('cross_st as street')->distinct()
        )->get();

        $parishs = json_decode(Configuration::where('code', 'parish')->first()->values);
        $orientations = json_decode(Configuration::where('code', 'direction')->first()->values);
        $groups = SignalGroup::select()->get();
        return view('georeports.geolocation', compact(
            'sinventories',
            'materials',
            'all_vst',
            'all_lst',
            'light_types',
            'states',
            'l_fasteners',
            's_fasteners',
            'ligth_brands',
            'regulator_brands',
            'parishs',
            'orientations',
            'groups'
        ));
    }

    public function signal_totals()
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

        return view('georeports.signal-totals', compact('signal_total', 'state_totals', 'material_totals', 'type_totals'));
    }

    public function search_signals(Request $request)
    {
        $signals = VerticalSignal::select();
       // 
        
       //$signals = $signals;

       //parroquia, sector, grupo
       //calle, *tipo de señal , * estado, *material , *tipo de fijacion
       
        if ($request->input('s_type')!="") {
            $signals = $signals->where('signal_id', '=', $request->s_type);
        }

        if ($request->input('s_state')!="") {
            $signals = $signals->where('state', $request->s_state);
        }

        if ($request->input('s_material')!="") {
            $signals = $signals->where('material', $request->s_material);
        }

        if ($request->input('s_fastener')!="") {
            $signals = $signals->where('fastener', '=', $request->s_fastener);
        }
        if ($request->input('s_street')) {
            $signals = $signals->where('street1', 'like', '%' . $request->s_street . '%');//->orWhere('street2', 'like', '%' . $request->s_street . '%')
        }
        if ($request->input('s_parish')!="") {
            $signals = $signals->where('parish', '=', $request->s_parish);
        }
        if ($request->input('s_orientation')!="") {
            $signals = $signals->where('orientation', '=', $request->s_orientation);
        }
        if ($request->input('s_group')!="") {
            //$signals = $signals->where('fastener', '=', $request->s_fastener);
        }

        //$signals = $signals->where('material', $request->s_material)->where('street1', 'like', '%' . $request->s_street . '%');
       
        $signals = $signals->get();//->paginate(10);
        $result = [];

        foreach ($signals as $vsignal) {
            $picture = 'storage/signals/';
            $path = storage_path('app/public_html/signals/');

            if ($vsignal->signal_folder) {
                $picture .= $vsignal->signal_folder . DIRECTORY_SEPARATOR;
                $path .= $vsignal->signal_folder . DIRECTORY_SEPARATOR;
            }

            if ($vsignal->picture) {
                $picture = $vsignal->picture;
            } else {
                $picture .= 'no-picture.png';
            }

            $result[] = [
                'id' => $vsignal->id,
                'code' => $vsignal->code,
                'latitude' => $vsignal->latitude,
                'longitude' => $vsignal->longitude,
                'picture' => asset($picture),
                'google_address' => $vsignal->google_address,
                'neighborhood' => $vsignal->neighborhood,
                'parish' => $vsignal->parish,
                'signal' => $vsignal->signal_inventory->name,
                'variation' => $vsignal,
                'state' => $vsignal->state,
                'material' => $vsignal->material,
                'fastener' => $vsignal->fastener,
                'comment' => $vsignal->comment,
                'group' => $vsignal->signal_inventory->subgroup->group->name . ' (' . $vsignal->signal_inventory->subgroup->group->code . ')',
                'subgroup' => $vsignal->signal_inventory->subgroup->name . ' (' . $vsignal->signal_inventory->subgroup->code . ')',
            ];
        }
        
        return response()->json([
            json_encode($result),
        ], Response::HTTP_OK);
        
        
       // return $request;//$signals->paginate(10);
    }

    public function signals_excel(Request $request)
    {
        $criteria = parse_query($request->excel_criteria);
        return new FilterVSignalExport($criteria['s_street'], $criteria['s_type'], $criteria['s_state'], $criteria['s_material'], $criteria['s_fastener']);
    }

    public function signal_totals_excel()
    {
        return new SignalTotalsExport();
    }

    public function show_lights()
    {
        $light_types = DevicesInventory::where('name', 'like', '%SEMAFORO%')->get();
        $states = json_decode(Configuration::where('code', 'estado')->first()->values);
        $fasteners = json_decode(Configuration::where('code', 'light_fasteners')->first()->values);
        $brands = json_decode(Configuration::where('code', 'light_brands')->first()->values);
        $all_st = Intersection::select('main_st as street')->distinct()->union(
            Intersection::select('cross_st as street')->distinct()
        )->get();

        return view('georeports.traffic-lights', compact('light_types', 'states', 'fasteners', 'brands', 'all_st'));
    }

    public function search_lights(Request $request)
    {
        $lights = TrafficLight::select('intersections.*','traffic_lights.*')->join('intersections', 'traffic_lights.intersection_id', '=', 'intersections.id');

        if ($request->input('l_street')) {
            $lights = $lights->where('intersections.main_st', 'like', '%' . $request->l_street . '%')->orWhere('intersections.cross_st', 'like', '%' . $request->l_street . '%');
        }

        if ($request->input('l_type')) {
            $lights = $lights->where('type_id', '=', $request->l_type);
        }

        if ($request->input('l_brand')) {
            $lights = $lights->where('brand', '=', $request->l_brand);
        }

        if ($request->input('l_state')) {
            $lights = $lights->where('state', 'like', '%' . substr($request->l_state, 0, -1) . '%');
        }

        if ($request->input('l_fastener')) {
            $lights = $lights->where('fastener', '=', $request->l_fastener);
        }

        $lights = $lights->get();
        $result = [];

        foreach ($lights as $light) {
            $picture = 'storage/lights/';
            $path = storage_path('app/public_html/lights/');

            if ($light->light_folder) {
                $picture .= $light->light_folder . '/';
                $path .= $light->light_folder . DIRECTORY_SEPARATOR;
            }

            if ($light->picture) {
                $picture .= $light->picture;
            } else {
                $picture .= 'no-picture.png';
            }

            $result[] = [
                'id' => $light->id,
                'code' => $light->code,
                'erp_code' => $light->erp_code,
                'picture' => asset($picture),
                'state' => $light->state,
                'fastener' => $light->fastener,
                'comment' => $light->comment,
                'brand' => $light->brand,
                'model' => $light->model,
                'tensor' => $light->tensor_id,
                'pole' => $light->pole_id,
                'regulator' => $light->regulator_id,
                'orientation' => $light->orientation,
                'intersection' => $light->intersection->main_st . ' y ' . $light->intersection->cross_st,
                'latitude' => $light->intersection->latitude,
                'longitude' => $light->intersection->longitude
            ];
        }

        return response()->json([
            json_encode($result),
        ], Response::HTTP_OK);
    }

    public function light_totals()
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

        return view('georeports.light-totals', compact('light_total', 'state_totals', 'material_totals', 'type_totals'));
    }

    public function lights_excel(Request $request)
    {
        $criteria = parse_query($request->excel_criteria);
        return new FilterTLightsExport($criteria['l_street'], $criteria['l_type'], $criteria['l_brand'], $criteria['l_state'], $criteria['l_fastener']);
    }

    public function light_totals_excel()
    {
        return new LightTotalsExport();
    }

    public function search_regulators(Request $request)
    {
        $regulators = RegulatorBox::select('intersections.*','regulator_boxes.*')->join('intersections', 'regulator_boxes.intersection_id', '=', 'intersections.id');

        if ($request->input('r_street')) {
            $regulators = $regulators->where('intersections.main_st', 'like', '%' . $request->r_street . '%')->orWhere('intersections.cross_st', 'like', '%' . $request->r_street . '%');
        }

        if ($request->input('r_brand')) {
            $regulators = $regulators->where('brand', '=', $request->r_brand);
        }

        if ($request->input('r_state')) {
            $regulators = $regulators->where('state', 'like', '%' . substr($request->r_state, 0, -1) . '%');
        }

        $regulators = $regulators->get();
        $result = [];

        foreach ($regulators as $regulator) {
            $picture_in = 'storage/regulators/';
            $picture_out = 'storage/regulators/';
            $path = storage_path('app/public_html/regulators/');

            if ($regulator->picture_in) {
                $picture_in .= $regulator->picture_in;
            } else {
                $picture_in .= 'no-picture.png';
            }

            if ($regulator->picture_out) {
                $picture_out .= $regulator->picture_out;
            } else {
                $picture_out .= 'no-picture.png';
            }

            $result[] = [
                'id' => $regulator->id,
                'code' => $regulator->code,
                'erp_code' => $regulator->erp_code,
                'picture_in' => asset($picture_in),
                'picture_out' => asset($picture_out),
                'state' => $regulator->state,
                'comment' => $regulator->comment,
                'brand' => $regulator->brand,
                'intersection' => $regulator->intersection->main_st . ' y ' . $regulator->intersection->cross_st,
                'latitude' => $regulator->latitude,
                'longitude' => $regulator->longitude
            ];
        }

        return response()->json([
            json_encode($result),
        ], Response::HTTP_OK);
    }

    public function regulators_excel(Request $request)
    {
        $criteria = parse_query($request->excel_criteria);
        return new FilterRegulatorsExport($criteria['r_street'], $criteria['r_brand'], $criteria['r_state']);
    }
}
