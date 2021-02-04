<?php

namespace App\Http\Controllers;

use App\Models\Alert;
use App\Models\DevicesInventory;
use App\Models\ItorderMaterial;
use App\Models\MaterialReport;
use App\Models\Material;
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
use App\Models\DeliveryMaterial;
use App\Models\VerticalSignal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class DeliveryMaterialController extends Controller
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

    if (Auth::user()->hasRole('atmcollector') || Auth::user()->hasRole('atmadmin')) {
    $reports = DeliveryMaterial::select('*')->join('users', 'users.id', 'delivery_material.id_usercreate')->orderby('delivery_material.id', 'desc');
      $usersol = User::all();
        
//    $reports2 = Material::select('*')->join('users', 'users.id', 'material_report_order.id_useraproborneg')->groupby('id_matrepord')->orderby('material_report_order.id', 'desc');
//    $reports = Material::select('material_report_order.*')->groupby('id_matrepord')->orderby('id', 'asc');
    
//$NO = Report::select('reports.*')->join('alerts', 'alerts.id', '=', 'reports.alert_id')->orderby('id', 'asc');            
//->where('alerts.collector_id', Auth::user()->id)
        }
        else  if (Auth::user()->hasRole('atmstockkeeper')) {
            $reports = DeliveryMaterial::select('*')->join('users', 'users.id', 'delivery_material.id_usercreate')->orderby('delivery_material.id', 'desc');
//    $reports = Material::select('material_report_order.*')->where('state','=','Aprobada')->groupby('id_matrepord')->orderby('id', 'asc');
      $usersol = User::all();
        
        }

        //$reportstotal = $reports->count();
         $reportstotal = DeliveryMaterial::max('id_ingreso');

        if ($pagintaionEnabled) {
            $reports = $reports->paginate(config('atm_app.paginateListSize'));
        }

        return View('delivery-material.index', compact('reports', 'reportstotal','usersol'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {       
        $collectors = User::whereHas("roles", function($q){ $q->where("slug", "atmcollector"); })->get();
        $alert = '';
        $novelties = Novelty::where('subcategory', false)->get();
        $subnovelties = Novelty::where('subcategory', true)->where('group', false)->get();
        $worktypes = Novelty::where('subcategory', true)->where('group', true)->get();
        $materials = DevicesInventory::all();
        $metrics = MetricUnit::all();
        $collector_id = '';
//        $collectors = User::whereHas("roles", function($q){ $q->where("slug","isno", "atmadmin"); })->get();
            if (Auth::user()->hasRole('atmadmin') || Auth::user()->hasRole('ccitt')) {
            $collectorsa = 'admin o ccitt';
            $collector_id = Auth::user()->id;
            //where('collector_id', Auth::user()->id)->
        }
        else if (Auth::user()->hasRole('atmcollector')) {
            $collectorsa =  'escalera';
            $collector_id = Auth::user()->id;
        }
        return view('delivery-material.create', compact('novelties','subnovelties','worktypes','materials','metrics','alert','collectors','collector_id','collectorsa'));
  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $matdev = 0;
                $matdev= DeliveryMaterial::max('id_ingreso');
//$matdev =Material::orderBy('id_matrepord','desc')->take(1)->get();
//$materialid = $materialid+1;
       if (Auth::user()->hasRole('atmadmin') || Auth::user()->hasRole('ccitt')) {
            $collectors = 'adminccitt';
             $collector_id = Auth::user()->id;
            //where('collector_id', Auth::user()->id)->
        }
        else if (Auth::user()->hasRole('atmcollector')) {
            $collectors =  'escalera';
            $collector_id = Auth::user()->id;
        }
$matdev=$matdev+1;        
$valor = '';
$concat = '';

            $materials = json_decode($request->input('materials_list'));            
//dd ($materials);
            if($materials){
                $factual = date('Y-m-d H:i:s');
                foreach ($materials as $material) {
                    $metric = MetricUnit::where('abbreviation', $material->metric)->first();    
                    if ($metric) {
           $materialinst = DeliveryMaterial::create([
            'id_ingreso' => $matdev,            
            'description' => $request->get('description'),   
            'product_name' => $material->product,
            'metric_id' => $metric->id,
            'amount' => $material->amount,
            'state' => 'Ingresada',
            'id_usercreate' => $collector_id,
               'id_userrequire' =>$collector_id,
            'id_useraproborneg' => null
                        ]);
            $materialinst->save();   
//            dd($materialinst);
            }
//                    echo $material;
                   
                }
                                  
            return redirect('delivery-material/')->with('success', trans('Entrega de materiales guardada con éxito.'));

            }          
//            $materials->mask_as_read();
            //$alert->status_id = Status::where('name', Alert::STATUS_ATTENDED)->first()->id;
//            $material->save();
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
        //$alert = Alert::find($id);
        $report = Alert::find($id);
        $novelties = Novelty::where('subcategory', false)->get();
        $subnovelties = Novelty::where('subcategory', true)->where('group', false)->get();
        $worktypes = Novelty::where('subcategory', true)->where('group', true)->get();
        $materials = DevicesInventory::all();
        $metrics = MetricUnit::all();
 return view('materials.edit', compact('alert','report', 'novelties', 'subnovelties', 'worktypes',
         'materials', 'metrics'));
       
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
        $material = Material::select('material_report_order.*')->where('id_matrepord',$id)->orderby('id', 'asc')->get();
//            $material = Material::find($id);
                //Report::find($id);
        if ($material) {
            // Update basic attributes
//            if ($request->state && $request->state != $material->state) {
                $material->state = 'Aprobada';
//            }
         
        }
           if ($material->save()) {
                $material->mask_as_read();
                return redirect('materials/')->with('success', trans('material.updateSuccess'));
            }
//        $report = '18';
//                //Report::find($id);
//
//        if ($report) {
//            // Update basic attributes
//            if ($request->novelty && $request->novelty != $report->novelty_id) {
//                $report->novelty_id = $request->novelty;
//            }
//
//            if ($request->subnovelty && $request->subnovelty != $report->subnovelty_id) {
//                $report->subnovelty_id = $request->subnovelty;
//            }
//
//            if ($request->worktype && $request->worktype != $report->worktype_id) {
//                $report->worktype_id = $request->worktype;
//            }
//
//            if ($request->description && $request->description != $report->description) {
//                $report->description = $request->description;
//            }
//
//            // Update material list
//            if ($request->input('materials_list')) {
//                foreach ($report->materials as $material) {
//                    $material->delete();
//                }
//
//                $materials = json_decode($request->input('materials_list'));
//                foreach ($materials as $material) {
//                    $device = DevicesInventory::find($material->id);
//                    $metric = MetricUnit::where('abbreviation', $material->metric)->first();
//
//                    if ($device && $metric) {
//                        MaterialReport::create([
//                            'report_id' => $report->id,
//                            'material_id' => $device->id,
//                            'metric_id' => $metric->id,
//                            'amount' => $material->amount
//                        ]);
//                    }
//                }
//            }
//
//            // Update pictures
//            if($request->hasFile('pictures')) {
//                $pictures = json_decode($report->pictures);
//                foreach ($pictures as $picture) {
//                    Storage::delete('reports/' . $picture);
//                }
//
//                $files = $request->file('pictures');
//                $names = [];
//                foreach($files as $file){
//                    $filename = Str::random() . '.' . $file->getClientOriginalExtension();
//                    $names[] = $filename;
//                    $file->storeAs('reports', $filename);
//                }
//
//                $report->pictures = json_encode($names);
//            }
//
//            // Update devices
//            if ($request->signals) {
//                $report->vertical_signals()->detach();
//
//                foreach ($request->signals as $signal) {
//                    $item = VerticalSignal::find($signal);
//                    if ($item) {
//                        $report->vertical_signals()->save($item);
//                    }
//                }
//            }
//
//            if ($request->regulators) {
//                $report->regulator_boxes()->detach();
//
//                foreach ($request->regulators as $regulator) {
//                    $item = RegulatorBox::find($regulator);
//                    if ($item) {
//                        $report->regulator_boxes()->save($item);
//                    }
//                }
//            }
//
//            if ($request->devices) {
//                $report->traffic_devices()->detach();
//
//                foreach ($request->devices as $device) {
//                    $item = TrafficDevice::find($device);
//                    if ($item) {
//                        $report->traffic_devices()->save($item);
//                    }
//                }
//            }
//
//            if ($request->poles) {
//                $report->traffic_poles()->detach();
//
//                foreach ($request->poles as $pole) {
//                    $item = TrafficPole::find($pole);
//                    if ($item) {
//                        $report->traffic_poles()->save($item);
//                    }
//                }
//            }
//
//            if ($request->tensors) {
//                $report->traffic_tensors()->detach();
//
//                foreach ($request->tensors as $tensor) {
//                    $item = TrafficTensor::find($tensor);
//                    if ($item) {
//                        $report->traffic_tensors()->save($item);
//                    }
//                }
//            }
//
//            if ($request->lights) {
//                $report->traffic_lights()->detach();
//
//                foreach ($request->lights as $light) {
//                    $item = TrafficLight::find($light);
//                    if ($item) {
//                        $report->traffic_lights()->save($item);
//                    }
//                }
//            }
//
//
//            if ($report->save()) {
//                $report->mask_as_read();
//                return redirect('reports/')->with('success', trans('reports.updateSuccess'));
//            }
        }

    
    
    public function aprobar($id)
    {
        $material = Material::where('id_matrepord','=',$id)->get();         
//        dd($material);
        $factual = date('Y-m-d H:i:s');
             $collector_id = Auth::user()->id;
            //where('collector_id', Auth::user()->id)->
      
        if ($material) {
            foreach ($material as $materia) {
         $materia->state='Aprobada';        
         $materia->date_aprob_or_neg=$factual;
         $materia->id_useraproborneg=$collector_id;
            if ($materia->save()) {
                $materia->mask_as_read();
                
            }
              }
            // Update basic attributes
                return redirect('materials/')->with('success', trans('materials.aprobSuccess'));
          
        }

        return back()->with('error', trans('material.udpateError'));
//        echo $id;
    }

    
     
    public function entregar($id)
    {
        $material = Material::where('id_matrepord','=',$id)->get();         
//        dd($material);
        $factual = date('Y-m-d H:i:s');
             $collector_id = Auth::user()->id;
            //where('collector_id', Auth::user()->id)->      
        if ($material) {
            foreach ($material as $materia) {
         $materia->state='Entregada';        
         $materia->date_delivery=$factual;
            if ($materia->save()) {
                $materia->mask_as_read();                
            }
              }
            // Update basic attributes
                return redirect('materials/')->with('success', trans('materials.entregSuccess'));          
        }
        return back()->with('error', trans('materials.udpateError'));
//        echo $id;
    }
    
    
    
    public function entregarnew(Request $request, $id)
    {
          if (Auth::user()->hasRole('atmstockkeeper')) {
            $collector_id = Auth::user()->id;
        }
        $material = DeliveryMaterial::where('id_ingreso','=',$id)->get();         
//        dd($material);
        $factual = date('Y-m-d H:i:s');
        if ($material) {
            foreach ($material as $materia) {
         $materia->state='Recibido';        
         $materia->id_useraproborneg=$collector_id;
         $materia->receipt=$factual;
         $materia->commentreceipt=$request->get('commentreceipt');
            if ($materia->save()) {
                $materia->mask_as_read();                
            }
              }
            // Update basic attributes
                return redirect('delivery-material/')->with('success', trans('delivery-material.entregSuccess'));          
        }
        return back()->with('error', trans('materials.udpateError'));
//        echo $id;
    }
    
    public function recibir($id)
    {
        $material = Material::where('id_matrepord','=',$id)->get();         
//        dd($material);
        $factual = date('Y-m-d H:i:s');
             $collector_id = Auth::user()->id;
            //where('collector_id', Auth::user()->id)->      
        if ($material) {
            foreach ($material as $materia) {
         $materia->state='Recibido';        
         $materia->receipt=$factual;
            if ($materia->save()) {
                $materia->mask_as_read();                
            }
              }
            // Update basic attributes
                return redirect('materials/')->with('success', trans('materials.recibSuccess'));          
        }
        return back()->with('error', trans('materials.udpateError'));
//        echo $id;
    }

    
    public function show($id)
    {
        $reports = DeliveryMaterial::select('*')->where('id_ingreso',$id)->orderby('delivery_material.id', 'asc')->get();
        $idusercrea = DeliveryMaterial::select('id_usercreate')->where('id_ingreso',$id)->get();
        $iduserapro = DeliveryMaterial::select('id_useraproborneg')->where('id_ingreso',$id)->get();
      $usersol = User::all();
      $reporteee = DeliveryMaterial::select('*')->join('users', 'users.id', '.id_usercreate')->where('id_ingreso',$id)->orderby('delivery_material.id', 'desc');
       //Report::select('reports.*')->join('alerts', 'alerts.id', '=', 'reports.alert_id')->orderby('id', 'asc');
        $report = $id;
//   $groups= \App\Models\Brandstype::orderby('id','asc')->get();  
                $materials = DeliveryMaterial::all();
        $metrics = MetricUnit::all();
        if ($reports) {
//            $reports->mask_as_read();
            return view('delivery-material.show', compact('reports','report','materials','metrics','idusercrea','usersol','reporteee','iduserapro'));
        }

        return back()->with('error', 'Orden de retiro no encontrada.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
//        $report = Material::all();
        $reports = Material::select('material_report_order.*')->where('id_matrepord','=',$id);
        foreach ($reports as $report) {
                  $report->delete();
   }
   return redirect('materials')->with('success', trans('materials.deleteSuccess'));
//   
//
//            return redirect('reports')->with('success', trans('reports.deleteSuccess'));
//   foreach ($materials as $material) {
//                    $device = DevicesInventory::find($material->id);
//   }
//        if ($report) {
//            if (!Auth::user()->hasRole(['atmadmin', 'atmoperator']) && $report->alert->owner_id != Auth::user()->id) {
//                return redirect('reports/')->with('error', 'No tiene permisos para realizar esta acción.');
//            }
//
//            $pictures = json_decode($report->pictures);
//            foreach ($pictures as $picture) {
//                Storage::delete('reports/' . $picture);
//            }
//
//            $report->vertical_signals()->detach();
//            $report->regulator_boxes()->detach();
//            $report->traffic_devices()->detach();
//            $report->traffic_poles()->detach();
//            $report->traffic_tensors()->detach();
//            $report->traffic_lights()->detach();
//
//            $report->delete();
//
//            return redirect('reports')->with('success', trans('reports.deleteSuccess'));
//        }

        return back()->with('error', trans('reports.deleteError'));
    }
}
