<?php

namespace App\Http\Controllers;

use App\Models\Alert;
use App\Models\DevicesInventory;
use App\Models\ItorderMaterial;
use App\Models\MaterialReport;
use App\Models\MetricUnit;
use App\Models\Novelty;
use App\Models\RegulatorBox;
use App\Models\Report;
use App\Models\Status;
use App\Models\TrafficDevice;
use App\Models\TrafficLight;
use App\Models\TrafficPole;
use App\Models\TrafficTensor;
use App\Models\User;
use App\Models\Material;
use App\Models\VerticalSignal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class MaterialController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagintaionEnabled = config('atm_app.enablePagination');

        if (Auth::user()->hasRole('atmcollector')) {
            $reports = Report::select('reports.*')->join('alerts', 'alerts.id', '=', 'reports.alert_id')->orderby('id', 'asc');
            //->where('alerts.collector_id', Auth::user()->id)
        }
        else {
            $reports = Report::orderby('id', 'asc');
        }

        $reportstotal = $reports->count();

        if ($pagintaionEnabled) {
            $reports = $reports->paginate(config('atm_app.paginateListSize'));
        }

        return View('materials.index', compact('reports', 'reportstotal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $alert = '';
        $novelties = Novelty::where('subcategory', false)->get();
        $subnovelties = Novelty::where('subcategory', true)->where('group', false)->get();
        $worktypes = Novelty::where('subcategory', true)->where('group', true)->get();
        $materials = DevicesInventory::all();
        $metrics = MetricUnit::all();
//
//        $collectors = User::whereHas("roles", function($q){ $q->where("slug", "atmcollector"); })->get();
//
//        $signals = VerticalSignal::select(\DB::raw('6371 * acos(cos(radians(' .
//            $alert->latitude . ')) * cos(radians(latitude)) * cos(radians(longitude) - radians(' .
//            $alert->longitude . ')) + sin(radians(' . $alert->latitude . ')) * sin(radians(latitude))) AS distance'), 'vertical_signals.*')
//            ->whereNotNull(['latitude', 'longitude'])
//            ->orderBy('distance')
//            ->havingRaw('distance < ' . env('APP_MAP_RADIUS', 0.2) . ' and distance > 0')
//            ->get();
//        $regulators = RegulatorBox::select(\DB::raw('6371 * acos(cos(radians(' .
//            $alert->latitude . ')) * cos(radians(latitude)) * cos(radians(longitude) - radians(' .
//            $alert->longitude . ')) + sin(radians(' . $alert->latitude . ')) * sin(radians(latitude))) AS distance'), 'regulator_boxes.*')
//            ->whereNotNull(['latitude', 'longitude'])
//            ->orderBy('distance')
//            ->havingRaw('distance < ' . env('APP_MAP_RADIUS', 0.2) . ' and distance > 0')
//            ->get();
//        $devices = TrafficDevice::select(\DB::raw('6371 * acos(cos(radians(' .
//            $alert->latitude . ')) * cos(radians(latitude)) * cos(radians(longitude) - radians(' .
//            $alert->longitude . ')) + sin(radians(' . $alert->latitude . ')) * sin(radians(latitude))) AS distance'), 'traffic_devices.*', 'regulator_boxes.latitude', 'regulator_boxes.longitude')
//            ->join('regulator_boxes', 'regulator_boxes.id', '=', 'traffic_devices.regulatorbox_id')
//            ->whereNotNull(['latitude', 'longitude'])
//            ->orderBy('distance')
//            ->havingRaw('distance < ' . env('APP_MAP_RADIUS', 0.2) . ' and distance > 0')
//            ->get();
//        $poles = TrafficPole::select(\DB::raw('6371 * acos(cos(radians(' .
//            $alert->latitude . ')) * cos(radians(latitude)) * cos(radians(longitude) - radians(' .
//            $alert->longitude . ')) + sin(radians(' . $alert->latitude . ')) * sin(radians(latitude))) AS distance'), 'traffic_poles.*')
//            ->whereNotNull(['latitude', 'longitude'])
//            ->orderBy('distance')
//            ->havingRaw('distance < ' . env('APP_MAP_RADIUS', 0.2) . ' and distance > 0')
//            ->get();
//        $tensors = TrafficTensor::all();
//        $lights = TrafficLight::select(\DB::raw('6371 * acos(cos(radians(' .
//            $alert->latitude . ')) * cos(radians(latitude)) * cos(radians(longitude) - radians(' .
//            $alert->longitude . ')) + sin(radians(' . $alert->latitude . ')) * sin(radians(latitude))) AS distance'), 'traffic_lights.*', 'traffic_poles.latitude', 'traffic_poles.longitude')
//            ->join('traffic_poles', 'traffic_lights.pole_id', '=', 'traffic_poles.id')
//            ->whereNotNull(['latitude', 'longitude'])
//            ->orderBy('distance')
//            ->havingRaw('distance < ' . env('APP_MAP_RADIUS', 0.2) . ' and distance > 0')
//            ->get();
//
        return view('materials.create', compact('novelties','subnovelties','worktypes','materials','metrics','alert'));
  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            //materiales propios usados
            $materials = json_decode($request->input('materials_list'));
            if($materials){
                foreach ($materials as $material) {
                    $device = DevicesInventory::find($material->id);
                    $metric = MetricUnit::where('abbreviation', $material->metric)->first();    
                    if ($device && $metric) {
           $materialinst = Material::create([
            'id_matrepord' => 11,            
            'description' => $request->get('description'),
            'report_id' => 20,
            'material_id' => $device->id,
            'metric_id' => $metric->id,
            'amount' => $material->amount,
            'state' => 'Ingresado',
            'id_userrequire' => 1,
            'id_usercreate' => 1,
            'id_useraproborneg' => 1                            
                        ]);
            $materialinst->save();       
           }
//                    echo $material;
                   
                }
                                  

            }          
//            $materials->mask_as_read();
            //$alert->status_id = Status::where('name', Alert::STATUS_ATTENDED)->first()->id;
//            $material->save();
            return redirect('materials/')->with('success', trans('Orden de retiro guardada con éxito.'));
        return back()->with('error', trans('reports.createError'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $alert =($id);
//        $report = Report::find($id);
//        $novelties = Novelty::where('subcategory', false)->get();
//        $subnovelties = Novelty::where('subcategory', true)->where('group', false)->get();
//        $worktypes = Novelty::where('subcategory', true)->where('group', true)->get();
//        $materials = DevicesInventory::all();
//        $metrics = MetricUnit::all();

//        if ($report) {
//            $signals = VerticalSignal::select(\DB::raw('6371 * acos(cos(radians(' .
//                $report->alert->latitude . ')) * cos(radians(latitude)) * cos(radians(longitude) - radians(' .
//                $report->alert->longitude . ')) + sin(radians(' . $report->alert->latitude . ')) * sin(radians(latitude))) AS distance'), 'vertical_signals.*')
//                ->whereNotNull(['latitude', 'longitude'])
//                ->orderBy('distance')
//                ->havingRaw('distance < ' . env('APP_MAP_RADIUS', 0.2) . ' and distance > 0')
//                ->get();
//            $regulators = RegulatorBox::select(\DB::raw('6371 * acos(cos(radians(' .
//                $report->alert->latitude . ')) * cos(radians(latitude)) * cos(radians(longitude) - radians(' .
//                $report->alert->longitude . ')) + sin(radians(' . $report->alert->latitude . ')) * sin(radians(latitude))) AS distance'), 'regulator_boxes.*')
//                ->whereNotNull(['latitude', 'longitude'])
//                ->orderBy('distance')
//                ->havingRaw('distance < ' . env('APP_MAP_RADIUS', 0.2) . ' and distance > 0')
//                ->get();
//            $devices = TrafficDevice::select(\DB::raw('6371 * acos(cos(radians(' .
//                $report->alert->latitude . ')) * cos(radians(latitude)) * cos(radians(longitude) - radians(' .
//                $report->alert->longitude . ')) + sin(radians(' . $report->alert->latitude . ')) * sin(radians(latitude))) AS distance'), 'traffic_devices.*', 'regulator_boxes.latitude', 'regulator_boxes.longitude')
//                ->join('regulator_boxes', 'regulator_boxes.id', '=', 'traffic_devices.regulatorbox_id')
//                ->whereNotNull(['latitude', 'longitude'])
//                ->orderBy('distance')
//                ->havingRaw('distance < ' . env('APP_MAP_RADIUS', 0.2) . ' and distance > 0')
//                ->get();
//            $poles = TrafficPole::select(\DB::raw('6371 * acos(cos(radians(' .
//                $report->alert->latitude . ')) * cos(radians(latitude)) * cos(radians(longitude) - radians(' .
//                $report->alert->longitude . ')) + sin(radians(' . $report->alert->latitude . ')) * sin(radians(latitude))) AS distance'), 'traffic_poles.*')
//                ->whereNotNull(['latitude', 'longitude'])
//                ->orderBy('distance')
//                ->havingRaw('distance < ' . env('APP_MAP_RADIUS', 0.2) . ' and distance > 0')
//                ->get();
//            $tensors = TrafficTensor::all();
//            $lights = TrafficLight::select(\DB::raw('6371 * acos(cos(radians(' .
//                $report->alert->latitude . ')) * cos(radians(latitude)) * cos(radians(longitude) - radians(' .
//                $report->alert->longitude . ')) + sin(radians(' . $report->alert->latitude . ')) * sin(radians(latitude))) AS distance'), 'traffic_lights.*', 'traffic_poles.latitude', 'traffic_poles.longitude')
//                ->join('traffic_poles', 'traffic_lights.pole_id', '=', 'traffic_poles.id')
//                ->whereNotNull(['latitude', 'longitude'])
//                ->orderBy('distance')
//                ->havingRaw('distance < ' . env('APP_MAP_RADIUS', 0.2) . ' and distance > 0')
//                ->get();
//
//            return view('reports.edit', compact('report', 'novelties', 'subnovelties', 'worktypes',
//                'signals', 'regulators', 'devices', 'poles', 'tensors', 'lights', 'materials', 'metrics'));
//        }
 return view('materials.edit', compact('alert'));
       
//        return back()->with('error', trans('reports.editError'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $report = '18';
                //Report::find($id);

        if ($report) {
            // Update basic attributes
            if ($request->novelty && $request->novelty != $report->novelty_id) {
                $report->novelty_id = $request->novelty;
            }

            if ($request->subnovelty && $request->subnovelty != $report->subnovelty_id) {
                $report->subnovelty_id = $request->subnovelty;
            }

            if ($request->worktype && $request->worktype != $report->worktype_id) {
                $report->worktype_id = $request->worktype;
            }

            if ($request->description && $request->description != $report->description) {
                $report->description = $request->description;
            }

            // Update material list
            if ($request->input('materials_list')) {
                foreach ($report->materials as $material) {
                    $material->delete();
                }

                $materials = json_decode($request->input('materials_list'));
                foreach ($materials as $material) {
                    $device = DevicesInventory::find($material->id);
                    $metric = MetricUnit::where('abbreviation', $material->metric)->first();

                    if ($device && $metric) {
                        MaterialReport::create([
                            'report_id' => $report->id,
                            'material_id' => $device->id,
                            'metric_id' => $metric->id,
                            'amount' => $material->amount
                        ]);
                    }
                }
            }

            // Update pictures
            if($request->hasFile('pictures')) {
                $pictures = json_decode($report->pictures);
                foreach ($pictures as $picture) {
                    Storage::delete('reports/' . $picture);
                }

                $files = $request->file('pictures');
                $names = [];
                foreach($files as $file){
                    $filename = Str::random() . '.' . $file->getClientOriginalExtension();
                    $names[] = $filename;
                    $file->storeAs('reports', $filename);
                }

                $report->pictures = json_encode($names);
            }

            // Update devices
            if ($request->signals) {
                $report->vertical_signals()->detach();

                foreach ($request->signals as $signal) {
                    $item = VerticalSignal::find($signal);
                    if ($item) {
                        $report->vertical_signals()->save($item);
                    }
                }
            }

            if ($request->regulators) {
                $report->regulator_boxes()->detach();

                foreach ($request->regulators as $regulator) {
                    $item = RegulatorBox::find($regulator);
                    if ($item) {
                        $report->regulator_boxes()->save($item);
                    }
                }
            }

            if ($request->devices) {
                $report->traffic_devices()->detach();

                foreach ($request->devices as $device) {
                    $item = TrafficDevice::find($device);
                    if ($item) {
                        $report->traffic_devices()->save($item);
                    }
                }
            }

            if ($request->poles) {
                $report->traffic_poles()->detach();

                foreach ($request->poles as $pole) {
                    $item = TrafficPole::find($pole);
                    if ($item) {
                        $report->traffic_poles()->save($item);
                    }
                }
            }

            if ($request->tensors) {
                $report->traffic_tensors()->detach();

                foreach ($request->tensors as $tensor) {
                    $item = TrafficTensor::find($tensor);
                    if ($item) {
                        $report->traffic_tensors()->save($item);
                    }
                }
            }

            if ($request->lights) {
                $report->traffic_lights()->detach();

                foreach ($request->lights as $light) {
                    $item = TrafficLight::find($light);
                    if ($item) {
                        $report->traffic_lights()->save($item);
                    }
                }
            }


            if ($report->save()) {
                $report->mask_as_read();
                return redirect('reports/')->with('success', trans('reports.updateSuccess'));
            }
        }

        return back()->with('error', trans('reports.udpateError'));
    }

    public function show($id)
    {
        $report = Report::find($id);

        if ($report) {
            $report->mask_as_read();

            return view('materials.show', compact('report'));
        }

        return back()->with('error', 'Alerta no encontrada.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $report = Report::find($id);

        if ($report) {
            if (!Auth::user()->hasRole(['atmadmin', 'atmoperator']) && $report->alert->owner_id != Auth::user()->id) {
                return redirect('reports/')->with('error', 'No tiene permisos para realizar esta acción.');
            }

            $pictures = json_decode($report->pictures);
            foreach ($pictures as $picture) {
                Storage::delete('reports/' . $picture);
            }

            $report->vertical_signals()->detach();
            $report->regulator_boxes()->detach();
            $report->traffic_devices()->detach();
            $report->traffic_poles()->detach();
            $report->traffic_tensors()->detach();
            $report->traffic_lights()->detach();

            $report->delete();

            return redirect('reports')->with('success', trans('reports.deleteSuccess'));
        }

        return back()->with('error', trans('reports.deleteError'));
    }
}
