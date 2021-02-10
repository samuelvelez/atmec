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
use App\Models\StorageInventory;
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

    if (Auth::user()->hasRole('atmcollector') || Auth::user()->hasRole('atmadmin')|| Auth::user()->hasRole('ccitt')) {
    $reports = Material::select('*')->join('users', 'users.id', 'material_report_order.id_userrequire')->orderby('material_report_order.id', 'desc');
      $usersol = User::all();
        
//    $reports2 = Material::select('*')->join('users', 'users.id', 'material_report_order.id_useraproborneg')->groupby('id_matrepord')->orderby('material_report_order.id', 'desc');
//    $reports = Material::select('material_report_order.*')->groupby('id_matrepord')->orderby('id', 'asc');
    
//$NO = Report::select('reports.*')->join('alerts', 'alerts.id', '=', 'reports.alert_id')->orderby('id', 'asc');            
//->where('alerts.collector_id', Auth::user()->id)
        }
        else  if (Auth::user()->hasRole('atmstockkeeper')) {
            $reports = Material::select('*')->join('users', 'users.id', 'material_report_order.id_userrequire')->where('state','=','Aprobada')->orderby('material_report_order.id', 'desc');
//    $reports = Material::select('material_report_order.*')->where('state','=','Aprobada')->groupby('id_matrepord')->orderby('id', 'asc');
      $usersol = User::all();
        
        }

        //$reportstotal = $reports->count();
         $reportstotal = Material::max('id_matrepord');

        if ($pagintaionEnabled) {
            $reports = $reports->paginate(config('atm_app.paginateListSize'));
        }

        return View('materials.index', compact('reports', 'reportstotal','usersol'));
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
        $materials = StorageInventory::select('devices_inventory.*')->join('devices_inventory','storage_inventory.device_id','devices_inventory.id')->get();
//        dd($materials);
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
        return view('materials.create', compact('novelties','subnovelties','worktypes','materials','metrics','alert','collectors','collector_id','collectorsa'));
  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        ////ES EDICION
        if (isset($_REQUEST['esedicion'])){
            //echo $_REQUEST['esedicion'];
//               $matdev = 0;
//                $matdev=  Material::max('id_matrepord');

//$matdev =Material::orderBy('id_matrepord','desc')->take(1)->get();
//$materialid = $materialid+1;
//$fechac = Material::select('created_at')->where('id_matrepord',$request->get('idmtr'))->orderby('id', 'asc')->get();            
            
       if (Auth::user()->hasRole('atmadmin') || Auth::user()->hasRole('ccitt')) {
            $collectors = 'adminccitt';
             $collector_id = Auth::user()->id;
            //where('collector_id', Auth::user()->id)->
        }
        else if (Auth::user()->hasRole('atmcollector')) {
            $collectors =  'escalera';
            $collector_id = Auth::user()->id;
        } else {
               $collectors =  'bodega';
            $collector_id = Auth::user()->id;
        }
//$matdev=$matdev+1;        
$valor = '';
$concat = '';
$valor = $request->get('aprob');

$matdev = $request->get('idmtr');

//BORRAR ANTERIORES REGISTROS
//$vsignal = Material::select('*')->where('id_matrepord','=',$matdev)->orderby('id', 'asc')->get();            
//            $vsignal->delete();

           Material::select('material_report_order')->where('id_matrepord', $matdev)->delete();
           
            $materials = json_decode($request->input('materials_list'));            
            if($materials){
//            dd($materials);
                $factual = date('Y-m-d H:i:s');
                foreach ($materials as $material) {
                    $device = DevicesInventory::find($material->id);
                    $metric = MetricUnit::where('abbreviation', $material->metric)->first();    

                    if ($device && $metric) {
                        if ($collectors=='escalera'){
           $materialinst = Material::create([
            'id_matrepord' => $matdev,            
            'description' => $request->get('description'),   
            'material_id' => $device->id,
            'metric_id' => $metric->id,
            'amount' => $material->amount,
            'state' => 'Ingresada',
            'id_usercreate' => $collector_id,
               'id_userrequire' =>$collector_id,
            'id_useraproborneg' => null,
            'report_id' => $request->get('orderid'),
               'date_create_ori' =>$request->get('fechac'),
                        ]);
            $materialinst->save();       
           } else  if ($collectors=='adminccitt'){
if ($valor=='Si'){ 
    $materialinst = Material::create([
            'id_matrepord' => $matdev,            
            'description' => $request->get('description'),   
            'id_useraproborneg' => $collector_id,
            'report_id' => null,
            'material_id' => $device->id,
            'metric_id' => $metric->id,
            'amount' => $material->amount,
            'state' => 'Aprobada',
            'id_usercreate' => $collector_id,
            'id_userrequire' =>$request->collector,
            'date_aprob_or_neg' => $factual,
            'id_useraproborneg' => $collector_id,
        'report_id' => $request->get('orderid'),
        'date_create_ori' =>$request->get('fechac'),
                        ]);
            $materialinst->save();   
} else {                
           $materialinst = Material::create([
            'id_matrepord' => $matdev,            
            'description' => $request->get('description'),   
           'id_useraproborneg' => null,
            'report_id' => null,
            'material_id' => $device->id,
            'metric_id' => $metric->id,
            'amount' => $material->amount,
            'state' => 'Ingresada',
            'id_usercreate' => $request->get('iduserc'),
               'id_userrequire' =>$request->get('iduserr'),
               'date_aprob_or_neg' => null,
            'id_useraproborneg' => null,  
               'date_create_ori' =>$request->get('fechac'),
                        ]);
//           dd($materialinst);
            $materialinst->save();       
         }  } else  if ($collectors=='bodega'){
    $materialinst = Material::create([
            'id_matrepord' => $matdev,            
            'description' => $request->get('description'),   
            'id_useraproborneg' => $request->get('iduseraon'),
            'report_id' => $request->get('reporid'),
            'material_id' => $device->id,
            'metric_id' => $metric->id,
            'amount' => $material->amount,
            'state' => 'Aprobada',
            'id_usercreate' => $request->get('iduserc'),
            'id_userrequire' =>$request->get('iduserr'),
            'date_aprob_or_neg' => $request->get('dateaporne'),
        'report_id' => $request->get('orderid'),
        'date_create_ori' =>$request->get('fechac'),
                        ]);
            $materialinst->save();   
      
         } }
//                    echo $material;
                   
                }
                                  
            return redirect('materials/'.$matdev)->with('success', trans('Orden de retiro edita con éxito.'));

            }          
//            $materials->mask_as_read();
            //$alert->status_id = Status::where('name', Alert::STATUS_ATTENDED)->first()->id;
//            $material->save();
        return back()->with('error', trans('reports.createError'));
            
            
        } 
        //FIN DE EDICION DEL MATERIAL
        else {
        $matdev = 0;
                $matdev=  Material::max('id_matrepord');

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
$valor = $request->get('aprob');


            $materials = json_decode($request->input('materials_list'));            
            if($materials){
                $factual = date('Y-m-d H:i:s');
                foreach ($materials as $material) {
                    $device = DevicesInventory::find($material->id);
                    $metric = MetricUnit::where('abbreviation', $material->metric)->first();    
                    if ($device && $metric) {
                        if ($collectors=='escalera'){
           $materialinst = Material::create([
            'id_matrepord' => $matdev,            
            'description' => $request->get('description'),   
            'material_id' => $device->id,
            'metric_id' => $metric->id,
            'amount' => $material->amount,
            'state' => 'Ingresada',
            'id_usercreate' => $collector_id,
               'id_userrequire' =>$collector_id,
            'id_useraproborneg' => null,
            'report_id' => $request->get('orderid'),
               'date_create_ori' =>$factual,
                        ]);
            $materialinst->save();       
           } else  if ($collectors=='adminccitt'){
if ($valor=='Si'){ 
    $materialinst = Material::create([
            'id_matrepord' => $matdev,            
            'description' => $request->get('description'),   
            'id_useraproborneg' => $collector_id,
            'report_id' => null,
            'material_id' => $device->id,
            'metric_id' => $metric->id,
            'amount' => $material->amount,
            'state' => 'Aprobada',
            'id_usercreate' => $collector_id,
            'id_userrequire' =>$request->collector,
            'date_aprob_or_neg' => $factual,
            'id_useraproborneg' => $collector_id,
        'report_id' => $request->get('orderid'),
        'date_create_ori' =>$factual,
                        ]);
            $materialinst->save();   
} else {                
           $materialinst = Material::create([
            'id_matrepord' => $matdev,            
            'description' => $request->get('description'),   
           'id_useraproborneg' => $collector_id,
            'report_id' => null,
            'material_id' => $device->id,
            'metric_id' => $metric->id,
            'amount' => $material->amount,
            'state' => 'Ingresada',
            'id_usercreate' => $collector_id,
               'id_userrequire' =>$request->collector,
               'date_aprob_or_neg' => null,
            'id_useraproborneg' => null,  
               'report_id' => $request->get('orderid'),
               'date_create_ori' =>$factual,
                        ]);
            $materialinst->save();       
         }  } }
//                    echo $material;
                   
                }
                                  
            return redirect('materials/')->with('success', trans('Orden de retiro guardada con éxito.'));

            }          
//            $materials->mask_as_read();
            //$alert->status_id = Status::where('name', Alert::STATUS_ATTENDED)->first()->id;
//            $material->save();
        return back()->with('error', trans('reports.createError'));
    }
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

        
    
    public function negar(Request $request, $id)
    {
        $material = Material::where('id_matrepord','=',$id)->get();         
//        dd($material);
        $collector_id = Auth::user()->id;
        $factual = date('Y-m-d H:i:s');
        if ($material) {
            foreach ($material as $materia) {
        
         $materia->observations=$request->get('observtxt');
         $materia->state='Negada';        
         $materia->date_aprob_or_neg=$factual;
         $materia->id_useraproborneg=$collector_id;
         
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
         $materia->id_userdelivery=$collector_id;
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
    
    
    
    public function entregarnewmaterial(Request $request, $id)
    {
        $material = Material::where('id_matrepord','=',$id)->get();         
        $factual = date('Y-m-d H:i:s');
                   $collector_id = Auth::user()->id;
        if ($material) {
            ///FOR PARA VER SI ESTA BIEN O NO
            $contador=0;
            $sicumple=0;
              foreach ($material as $materia) {
                  $contador=$contador+1;
            $nuevacantidad = $materia->amount;

                  if ($request->get('p'.$materia->id) <> '' ){
                  if ($request->get('p'.$materia->id) > 0){
$nuevacantidad=$request->get('p'.$materia->id); 
                  }
                  }
//                  echo $materia->material_id.' es id material<br>';
$validarstock = StorageInventory::select('quantity')->where('device_id','=',$materia->material_id)->get();
$va1 = explode('":"', $validarstock);
//echo $validarstock.' validarstock<br>';
        $va2 = explode('"}', $va1[1]);
        echo 'if '.intval($nuevacantidad).'<='.intval($va2[0]).'<br>';
        if (intval($nuevacantidad)<=intval($va2[0])){
//            echo 'si cumple<br>';
            $sicumple=$sicumple+1;
        } else {
//            echo 'NO cumple<br>';
            $sicumple=$sicumple+0;
        }
              }

        //SI CUMPLE VALIDA QUE LO ENTREGADO ESTÉ DENTRO DEL STOCK
//              echo $sicumple.'='.$contador;
//                                        dd($sicumple);

            if ($sicumple ==$contador){   
            foreach ($material as $materia) {
            $nuevacantidad = $materia->amount;
//echo $request->get($materia->id);
                    if ($request->get('p'.$materia->id) <> '' ){
                  if ($request->get('p'.$materia->id) > 0){
$nuevacantidad=$request->get('p'.$materia->id); 
                  }
                  }
         $materia->amount_delivery=$nuevacantidad;
         $materia->state='Entregada';        
         $materia->date_delivery=$factual;
         $materia->id_userdelivery=$collector_id;
            if ($materia->save()) {
                $materia->mask_as_read();                
            }
       $nuevastock = StorageInventory::select('*')->where('device_id',$materia->material_id)->get();
               foreach ($nuevastock as $nuest) {
         $nuest->quantity=($nuest->quantity)-$nuevacantidad;
          if ($nuest->save()) {
//                $nuest->mask_as_read();                
            }
              }
            
            
            }
            // Update basic attributes
                return redirect('materials/')->with('success', trans('materials.entregSuccess'));          
        } else {
            // Update basic attributes
                return redirect('materials/'.$id)->with('success', "Lo entregado es mayor a lo que se posee en stock. Por favor, valide.");          
        } 
            
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
        $reports = Material::select('material_report_order.*')->where('id_matrepord',$id)->orderby('id', 'asc')->get();
        $idusercrea = Material::select('id_usercreate')->where('id_matrepord',$id)->get();
      $usersol = User::all();
      $reporteee = Material::select('*')->join('users', 'users.id', 'material_report_order.id_userrequire')->where('id_matrepord',$id)->orderby('material_report_order.id', 'desc');
       //Report::select('reports.*')->join('alerts', 'alerts.id', '=', 'reports.alert_id')->orderby('id', 'asc');
        $report = $id;
//   $groups= \App\Models\Brandstype::orderby('id','asc')->get();  
                $materials = DevicesInventory::all();
                $cantstocks = StorageInventory::all();
        $metrics = MetricUnit::all();
        if ($reports) {
//            $reports->mask_as_read();
            return view('materials.show', compact('reports','report','materials','metrics','idusercrea','usersol','reporteee','cantstocks'));
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
    
    
       public function editar($id)
     {       
        $collectors = User::whereHas("roles", function($q){ $q->where("slug", "atmstockkeeper"); })->get();
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
        else {
              $collectorsa =  'bodega';
            $collector_id = Auth::user()->id;
        }        
$materialid = Material::select('*')->where('id_matrepord','=',$id)->orderby('id', 'asc')->get();               
        return view('materials.editar', compact('novelties','subnovelties','worktypes','materials','metrics','alert','collectors','collector_id','collectorsa','materialid'));
  
    }
    
    
    
    public function index2()
    {
        $pagintaionEnabled = config('atm_app.enablePagination');

    if (Auth::user()->hasRole('atmcollector') || Auth::user()->hasRole('atmadmin')|| Auth::user()->hasRole('ccitt')) {
    $reports = Material::select('*')->join('users', 'users.id', 'material_report_order.id_userrequire')->where('material_report_order.state','=','Aprobada')->orderby('material_report_order.id', 'desc');
      $usersol = User::all();
        
//    $reports2 = Material::select('*')->join('users', 'users.id', 'material_report_order.id_useraproborneg')->groupby('id_matrepord')->orderby('material_report_order.id', 'desc');
//    $reports = Material::select('material_report_order.*')->groupby('id_matrepord')->orderby('id', 'asc');
    
//$NO = Report::select('reports.*')->join('alerts', 'alerts.id', '=', 'reports.alert_id')->orderby('id', 'asc');            
//->where('alerts.collector_id', Auth::user()->id)
        }
        else  if (Auth::user()->hasRole('atmstockkeeper')) {
            $reports = Material::select('*')->join('users', 'users.id', 'material_report_order.id_userrequire')->where('state','=','Aprobada')->orderby('material_report_order.id', 'desc');
//    $reports = Material::select('material_report_order.*')->where('state','=','Aprobada')->groupby('id_matrepord')->orderby('id', 'asc');
      $usersol = User::all();
        
        }

        //$reportstotal = $reports->count();
         $reportstotal = Material::max('id_matrepord');

        if ($pagintaionEnabled) {
            $reports = $reports->paginate(config('atm_app.paginateListSize'));
        }

        return View('materials.index2', compact('reports', 'reportstotal','usersol'));
    }
    
    
       
    public function index3()
    {
        $pagintaionEnabled = config('atm_app.enablePagination');

    if (Auth::user()->hasRole('atmcollector') || Auth::user()->hasRole('atmadmin')|| Auth::user()->hasRole('ccitt')) {
    $reports = Material::select('*')->join('users', 'users.id', 'material_report_order.id_userrequire')->where('material_report_order.state','=','Negada')->orderby('material_report_order.id', 'desc');
      $usersol = User::all();
        
//    $reports2 = Material::select('*')->join('users', 'users.id', 'material_report_order.id_useraproborneg')->groupby('id_matrepord')->orderby('material_report_order.id', 'desc');
//    $reports = Material::select('material_report_order.*')->groupby('id_matrepord')->orderby('id', 'asc');
    
//$NO = Report::select('reports.*')->join('alerts', 'alerts.id', '=', 'reports.alert_id')->orderby('id', 'asc');            
//->where('alerts.collector_id', Auth::user()->id)
        }
        else  if (Auth::user()->hasRole('atmstockkeeper')) {
            $reports = Material::select('*')->join('users', 'users.id', 'material_report_order.id_userrequire')->where('state','=','Negada')->orderby('material_report_order.id', 'desc');
//    $reports = Material::select('material_report_order.*')->where('state','=','Aprobada')->groupby('id_matrepord')->orderby('id', 'asc');
      $usersol = User::all();
        
        }

        //$reportstotal = $reports->count();
         $reportstotal = Material::max('id_matrepord');

        if ($pagintaionEnabled) {
            $reports = $reports->paginate(config('atm_app.paginateListSize'));
        }

        return View('materials.index3', compact('reports', 'reportstotal','usersol'));
    }
    
     public function index4()
    {
        $pagintaionEnabled = config('atm_app.enablePagination');

    if (Auth::user()->hasRole('atmcollector') || Auth::user()->hasRole('atmadmin')|| Auth::user()->hasRole('ccitt')) {
    $reports = Material::select('*')->join('users', 'users.id', 'material_report_order.id_userrequire')->where('material_report_order.state','=','Ingresada')->orderby('material_report_order.id', 'desc');
      $usersol = User::all();
        
//    $reports2 = Material::select('*')->join('users', 'users.id', 'material_report_order.id_useraproborneg')->groupby('id_matrepord')->orderby('material_report_order.id', 'desc');
//    $reports = Material::select('material_report_order.*')->groupby('id_matrepord')->orderby('id', 'asc');
    
//$NO = Report::select('reports.*')->join('alerts', 'alerts.id', '=', 'reports.alert_id')->orderby('id', 'asc');            
//->where('alerts.collector_id', Auth::user()->id)
        }
        else  if (Auth::user()->hasRole('atmstockkeeper')) {
            $reports = Material::select('*')->join('users', 'users.id', 'material_report_order.id_userrequire')->where('state','=','Ingresada')->orderby('material_report_order.id', 'desc');
//    $reports = Material::select('material_report_order.*')->where('state','=','Aprobada')->groupby('id_matrepord')->orderby('id', 'asc');
      $usersol = User::all();
        
        }

        //$reportstotal = $reports->count();
         $reportstotal = Material::max('id_matrepord');

        if ($pagintaionEnabled) {
            $reports = $reports->paginate(config('atm_app.paginateListSize'));
        }

        return View('materials.index3', compact('reports', 'reportstotal','usersol'));
    }
    
    
    
    
     public function index5()
    {
        $pagintaionEnabled = config('atm_app.enablePagination');

    if (Auth::user()->hasRole('atmcollector') || Auth::user()->hasRole('atmadmin')|| Auth::user()->hasRole('ccitt')) {
    $reports = Material::select('*')->join('users', 'users.id', 'material_report_order.id_userrequire')->where('material_report_order.state','=','Recibido')->orderby('material_report_order.id', 'desc');
      $usersol = User::all();
        
//    $reports2 = Material::select('*')->join('users', 'users.id', 'material_report_order.id_useraproborneg')->groupby('id_matrepord')->orderby('material_report_order.id', 'desc');
//    $reports = Material::select('material_report_order.*')->groupby('id_matrepord')->orderby('id', 'asc');
    
//$NO = Report::select('reports.*')->join('alerts', 'alerts.id', '=', 'reports.alert_id')->orderby('id', 'asc');            
//->where('alerts.collector_id', Auth::user()->id)
        }
        else  if (Auth::user()->hasRole('atmstockkeeper')) {
            $reports = Material::select('*')->join('users', 'users.id', 'material_report_order.id_userrequire')->where('state','=','Recibido')->orderby('material_report_order.id', 'desc');
//    $reports = Material::select('material_report_order.*')->where('state','=','Aprobada')->groupby('id_matrepord')->orderby('id', 'asc');
      $usersol = User::all();
        
        }

        //$reportstotal = $reports->count();
         $reportstotal = Material::max('id_matrepord');

        if ($pagintaionEnabled) {
            $reports = $reports->paginate(config('atm_app.paginateListSize'));
        }

        return View('materials.index5', compact('reports', 'reportstotal','usersol'));
    }
    
    
     
     public function index6()
    {
        $pagintaionEnabled = config('atm_app.enablePagination');

    if (Auth::user()->hasRole('atmcollector') || Auth::user()->hasRole('atmadmin')|| Auth::user()->hasRole('ccitt')) {
    $reports = Material::select('*')->join('users', 'users.id', 'material_report_order.id_userrequire')->where('material_report_order.state','=','Entregada')->orderby('material_report_order.id', 'desc');
      $usersol = User::all();
        
//    $reports2 = Material::select('*')->join('users', 'users.id', 'material_report_order.id_useraproborneg')->groupby('id_matrepord')->orderby('material_report_order.id', 'desc');
//    $reports = Material::select('material_report_order.*')->groupby('id_matrepord')->orderby('id', 'asc');
    
//$NO = Report::select('reports.*')->join('alerts', 'alerts.id', '=', 'reports.alert_id')->orderby('id', 'asc');            
//->where('alerts.collector_id', Auth::user()->id)
        }
        else  if (Auth::user()->hasRole('atmstockkeeper')) {
            $reports = Material::select('*')->join('users', 'users.id', 'material_report_order.id_userrequire')->where('state','=','Entregada')->orderby('material_report_order.id', 'desc');
//    $reports = Material::select('material_report_order.*')->where('state','=','Aprobada')->groupby('id_matrepord')->orderby('id', 'asc');
      $usersol = User::all();
        
        }

        //$reportstotal = $reports->count();
         $reportstotal = Material::max('id_matrepord');

        if ($pagintaionEnabled) {
            $reports = $reports->paginate(config('atm_app.paginateListSize'));
        }

        return View('materials.index6', compact('reports', 'reportstotal','usersol'));
    }
    
}
