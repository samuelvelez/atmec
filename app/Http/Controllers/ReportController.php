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
use App\Models\Material;
use App\Models\AlertsComments;
use App\Models\TrafficDevice;
use App\Models\TrafficLight;
use App\Models\TrafficPole;
use App\Models\TrafficTensor;
use App\Models\User;
use App\Models\VerticalSignal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ReportController extends Controller
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

        return View('reports.index', compact('reports', 'reportstotal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {        
         $alert = Alert::find($id);               
        ////PARA EDITAR EL ESTADO A VISTO
        if ($alert->status_id==1){
        if ((Auth::user()->hasRole('atmcollector') )) {
               $alert->status_id = 10;
             if ($alert->save()) {
                $alert->mask_as_read();
            }
        }
        }
        $alert = Alert::find($id);
        $novelties = Novelty::where('subcategory', false)->get();
        $subnovelties = Novelty::where('subcategory', true)->where('group', false)->get();
        $worktypes = Novelty::where('subcategory', true)->where('group', true)->get();
        $materials = DevicesInventory::all();
        $metrics = MetricUnit::all();

        $collectors = User::whereHas("roles", function($q){ $q->where("slug", "atmcollector"); })->get();

        $signals = VerticalSignal::select(\DB::raw('6371 * acos(cos(radians(' .
            $alert->latitude . ')) * cos(radians(latitude)) * cos(radians(longitude) - radians(' .
            $alert->longitude . ')) + sin(radians(' . $alert->latitude . ')) * sin(radians(latitude))) AS distance'), 'vertical_signals.*')
            ->whereNotNull(['latitude', 'longitude'])
            ->orderBy('distance')
            ->havingRaw('distance < ' . env('APP_MAP_RADIUS', 0.2) . ' and distance > 0')
            ->get();
        $regulators = RegulatorBox::select(\DB::raw('6371 * acos(cos(radians(' .
            $alert->latitude . ')) * cos(radians(latitude)) * cos(radians(longitude) - radians(' .
            $alert->longitude . ')) + sin(radians(' . $alert->latitude . ')) * sin(radians(latitude))) AS distance'), 'regulator_boxes.*')
            ->whereNotNull(['latitude', 'longitude'])
            ->orderBy('distance')
            ->havingRaw('distance < ' . env('APP_MAP_RADIUS', 0.2) . ' and distance > 0')
            ->get();
        $devices = TrafficDevice::select(\DB::raw('6371 * acos(cos(radians(' .
            $alert->latitude . ')) * cos(radians(latitude)) * cos(radians(longitude) - radians(' .
            $alert->longitude . ')) + sin(radians(' . $alert->latitude . ')) * sin(radians(latitude))) AS distance'), 'traffic_devices.*', 'regulator_boxes.latitude', 'regulator_boxes.longitude')
            ->join('regulator_boxes', 'regulator_boxes.id', '=', 'traffic_devices.regulatorbox_id')
            ->whereNotNull(['latitude', 'longitude'])
            ->orderBy('distance')
            ->havingRaw('distance < ' . env('APP_MAP_RADIUS', 0.2) . ' and distance > 0')
            ->get();
        $poles = TrafficPole::select(\DB::raw('6371 * acos(cos(radians(' .
            $alert->latitude . ')) * cos(radians(latitude)) * cos(radians(longitude) - radians(' .
            $alert->longitude . ')) + sin(radians(' . $alert->latitude . ')) * sin(radians(latitude))) AS distance'), 'traffic_poles.*')
            ->whereNotNull(['latitude', 'longitude'])
            ->orderBy('distance')
            ->havingRaw('distance < ' . env('APP_MAP_RADIUS', 0.2) . ' and distance > 0')
            ->get();
        $tensors = TrafficTensor::all();
        $lights = TrafficLight::select(\DB::raw('6371 * acos(cos(radians(' .
            $alert->latitude . ')) * cos(radians(latitude)) * cos(radians(longitude) - radians(' .
            $alert->longitude . ')) + sin(radians(' . $alert->latitude . ')) * sin(radians(latitude))) AS distance'), 'traffic_lights.*', 'traffic_poles.latitude', 'traffic_poles.longitude')
            ->join('traffic_poles', 'traffic_lights.pole_id', '=', 'traffic_poles.id')
            ->whereNotNull(['latitude', 'longitude'])
            ->orderBy('distance')
            ->havingRaw('distance < ' . env('APP_MAP_RADIUS', 0.2) . ' and distance > 0')
            ->get();

        return view('reports.create', compact('collectors', 'alert', 'novelties', 'subnovelties',
            'worktypes', 'signals', 'regulators', 'devices', 'poles', 'tensors', 'lights', 'materials', 'metrics'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), Report::rules());

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $alert = Alert::find($request->alert);
        if ($alert->report) {
            return redirect('alerts')->with('error', 'La alerta ya posee un reporte.');
        }
        
        $materiales = Material::select('material_report_order.*')->where('report_id',$request->alert)->orderby('id', 'asc')->get();               
//        dd($material);
        $status_id = null;
        foreach ($materiales as $material){
        if ($material->id<>'' or $material->id<>null){
          $status_id =11;  
        }         
        }
        
        if ($status_id<>null){
               $alert->status_id = $status_id;
             if ($alert->save()) {
                $alert->mask_as_read();
            } 
        }
        
        $status_id = $request->get('tipo') == 0 ? Status::where('name', Report::STATUS_PENDING)->first()->id : $request->get('tipo');        
        
         if ($status_id==13){
             $alert->status_id = 12;
             if ($alert->save()) {
                $alert->mask_as_read();
            }                 
         }
         else {
             $alert->status_id = 12;
             if ($alert->save()) {
                $alert->mask_as_read();
            }    
        } 
        $report = Report::create([
            'alert_id' => $request->get('alert'),
            'status_id' => $status_id,
            'novelty_id' => $request->get('novelty'),
            'subnovelty_id' => $request->get('subnovelty'),
            'worktype_id' => $request->get('worktype'),
            'description' => $request->get('description')
        ]);

        if ($report) {
            if($request->hasFile('pictures')) {
                $files = $request->file('pictures');
                $names = [];
                foreach($files as $file){
                    $filename = Str::random() . '.' . $file->getClientOriginalExtension();
                    $names[] = $filename;
                    $file->storeAs('reports', $filename);
                }

                $report->pictures = json_encode($names);
                $report->save();
            }

            if ($request->signals) {
                foreach ($request->signals as $signal) {
                    $item = VerticalSignal::find($signal);
                    if ($item) {
                        $report->vertical_signals()->save($item);
                    }
                }
            }

            if ($request->regulators) {
                foreach ($request->regulators as $regulator) {
                    $item = RegulatorBox::find($regulator);
                    if ($item) {
                        $report->regulator_boxes()->save($item);
                    }
                }
            }

            if ($request->devices) {
                foreach ($request->devices as $device) {
                    $item = TrafficDevice::find($device);
                    if ($item) {
                        $report->traffic_devices()->save($item);
                    }
                }
            }

            if ($request->poles) {
                foreach ($request->poles as $pole) {
                    $item = TrafficPole::find($pole);
                    if ($item) {
                        $report->traffic_poles()->save($item);
                    }
                }
            }

            if ($request->tensors) {
                foreach ($request->tensors as $tensor) {
                    $item = TrafficTensor::find($tensor);
                    if ($item) {
                        $report->traffic_tensors()->save($item);
                    }
                }
            }

            if ($request->lights) {
                foreach ($request->lights as $light) {
                    $item = TrafficLight::find($light);
                    if ($item) {
                        $report->traffic_lights()->save($item);
                    }
                }
            }
            //materiales propios usados
            $materials = json_decode($request->input('materials_list'));
            if($materials){
                foreach ($materials as $material) {
                    $device = DevicesInventory::find($material->id);
                    $metric = MetricUnit::where('abbreviation', $material->metric)->first();
    
                    if ($device && $metric) {
                        MaterialReport::create([
                            'report_id' => $report->id,
                            'material_id' => $device->id,
                            'metric_id' => $metric->id,
                            'amount' => $material->amount,
                            'bodega' => 1
                        ]);
                    }
                }
            }
            //materiales a pedir a bodega
            $materials = json_decode($request->input('materials_list2'));
            if($materials){
                foreach ($materials as $material) {
                    $device = DevicesInventory::find($material->id);
                    $metric = MetricUnit::where('abbreviation', $material->metric)->first();
    
                    if ($device && $metric) {
                        MaterialReport::create([
                            'report_id' => $report->id,
                            'material_id' => $device->id,
                            'metric_id' => $metric->id,
                            'amount' => $material->amount,
                            'bodega'    =>2
                        ]);
                    }
                }
    
            }
            
            // TODO set report status according to required materials and availability in collector ITO. If needed fire and event to notify stockkeeper about ITO to updates.

            $alert->mask_as_read();
            //$alert->status_id = Status::where('name', Alert::STATUS_ATTENDED)->first()->id;
            $alert->save();

            return redirect('ordenes/')->with('success', trans('Inspección Realizada'));
        }

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
        $alert = Alert::find($id);
        $report = Report::find($id);        
        $materialid = Material::select('id_matrepord')->where('report_id','=', $report->alert->id)->get();
//        dd($materialid);
        $novelties = Novelty::where('subcategory', false)->get();
        $subnovelties = Novelty::where('subcategory', true)->where('group', false)->get();
        $worktypes = Novelty::where('subcategory', true)->where('group', true)->get();
        $materials = DevicesInventory::all();
        $metrics = MetricUnit::all();
 $hasmaterials = Material::select('material_report_order.*')->where('report_id',$id)->orderby('id', 'asc')->get();
        if ($report) {
            $signals = VerticalSignal::select(\DB::raw('6371 * acos(cos(radians(' .
                $report->alert->latitude . ')) * cos(radians(latitude)) * cos(radians(longitude) - radians(' .
                $report->alert->longitude . ')) + sin(radians(' . $report->alert->latitude . ')) * sin(radians(latitude))) AS distance'), 'vertical_signals.*')
                ->whereNotNull(['latitude', 'longitude'])
                ->orderBy('distance')
                ->havingRaw('distance < ' . env('APP_MAP_RADIUS', 0.2) . ' and distance > 0')
                ->get();
            $regulators = RegulatorBox::select(\DB::raw('6371 * acos(cos(radians(' .
                $report->alert->latitude . ')) * cos(radians(latitude)) * cos(radians(longitude) - radians(' .
                $report->alert->longitude . ')) + sin(radians(' . $report->alert->latitude . ')) * sin(radians(latitude))) AS distance'), 'regulator_boxes.*')
                ->whereNotNull(['latitude', 'longitude'])
                ->orderBy('distance')
                ->havingRaw('distance < ' . env('APP_MAP_RADIUS', 0.2) . ' and distance > 0')
                ->get();
            $devices = TrafficDevice::select(\DB::raw('6371 * acos(cos(radians(' .
                $report->alert->latitude . ')) * cos(radians(latitude)) * cos(radians(longitude) - radians(' .
                $report->alert->longitude . ')) + sin(radians(' . $report->alert->latitude . ')) * sin(radians(latitude))) AS distance'), 'traffic_devices.*', 'regulator_boxes.latitude', 'regulator_boxes.longitude')
                ->join('regulator_boxes', 'regulator_boxes.id', '=', 'traffic_devices.regulatorbox_id')
                ->whereNotNull(['latitude', 'longitude'])
                ->orderBy('distance')
                ->havingRaw('distance < ' . env('APP_MAP_RADIUS', 0.2) . ' and distance > 0')
                ->get();
            $poles = TrafficPole::select(\DB::raw('6371 * acos(cos(radians(' .
                $report->alert->latitude . ')) * cos(radians(latitude)) * cos(radians(longitude) - radians(' .
                $report->alert->longitude . ')) + sin(radians(' . $report->alert->latitude . ')) * sin(radians(latitude))) AS distance'), 'traffic_poles.*')
                ->whereNotNull(['latitude', 'longitude'])
                ->orderBy('distance')
                ->havingRaw('distance < ' . env('APP_MAP_RADIUS', 0.2) . ' and distance > 0')
                ->get();
            $tensors = TrafficTensor::all();
            $lights = TrafficLight::select(\DB::raw('6371 * acos(cos(radians(' .
                $report->alert->latitude . ')) * cos(radians(latitude)) * cos(radians(longitude) - radians(' .
                $report->alert->longitude . ')) + sin(radians(' . $report->alert->latitude . ')) * sin(radians(latitude))) AS distance'), 'traffic_lights.*', 'traffic_poles.latitude', 'traffic_poles.longitude')
                ->join('traffic_poles', 'traffic_lights.pole_id', '=', 'traffic_poles.id')
                ->whereNotNull(['latitude', 'longitude'])
                ->orderBy('distance')
                ->havingRaw('distance < ' . env('APP_MAP_RADIUS', 0.2) . ' and distance > 0')
                ->get();

            return view('reports.edit', compact('report', 'novelties', 'subnovelties', 'worktypes',
                'signals', 'regulators', 'devices', 'poles', 'tensors', 'lights', 'materials', 'metrics','hasmaterials','materialid'));
        }
        return back()->with('error', trans('reports.editError'));
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
        $report = Report::find($id);
$status_id = $request->get('tipo') == 0 ? Status::where('name', Report::STATUS_PENDING)->first()->id : $request->get('tipo');

$alert = Alert::find($report->alert_id);
$descriptionold = $report->description;
        if ($alert){
               $alert->status_id = 7;
             if ($alert->save()) {
                $alert->mask_as_read();
            } 
        } 
 $collector_id = Auth::user()->id;
    if ($descriptionold==$request->description){ 
        
    }    else { 
        //INGRESAR LOS COMENTARIOS UNO TRAS OTRO, DEJANDO EL MÁS ACTUAL EN LA TB ALERTS
        AlertsComments::create([
                            'alert_id' => $report->alert_id,
                            'comment_old' => $descriptionold,
                            'user_create' => $collector_id
                        ]);
    }
            
        if ($report) {
            $report->status_id = $status_id;
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
                if ($request->get('tipo') == 3){
                return redirect('ordenes/')->with('success', 'Orden de trabajo finalizada, por favor, modifique los dispositivos afectados.' );
                } else {
                return redirect('ordenes/')->with('success', trans('reports.updateSuccess'));
                }
            }
        }

        return back()->with('error', trans('reports.udpateError'));
    }

    public function show($id)
    {
        $report = Report::find($id);
     
  if ($report) {
            $report->mask_as_read();
            $valores = $report['alert_id'];
//dd($valores);

$alertcomments = AlertsComments::select('*')->where('alert_id','=', $valores)->get();
      
            return view('reports.show', compact('report','alertcomments'));
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
