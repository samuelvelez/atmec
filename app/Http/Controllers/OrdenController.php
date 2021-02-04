<?php

namespace App\Http\Controllers;

use App\Models\Alert;
use App\Models\Intersection;
use App\Models\Status;
use App\Models\Priority;
use App\Models\WorkOrderType;
use App\Models\WorkOrder;
use App\Models\MotiveWO;
use App\Models\User;
use App\Models\Report;
use App\Models\Material;
use App\Models\Novelty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OrdenController extends Controller
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
            $alerts = Alert::orderby('id', 'desc');
            //where('collector_id', Auth::user()->id)->
        }
        else {
            $alerts = Alert::orderby('id', 'desc');
            
        }

        $alertstotal = $alerts->count();
        $priorities = Priority::all();

        if ($pagintaionEnabled) {
            $alerts = $alerts->paginate(config('atm_app.paginateListSize'));
        }

        return View('ordenes.index', compact('alerts', 'alertstotal', 'priorities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $collectors = User::whereHas("roles", function($q){ $q->where("slug", "atmcollector"); })->get();
        $intersections = Intersection::all();
        $priorities = Priority::all();
        $motivos = MotiveWO::all();
        $tipos = WorkOrderType::all();

        return view('ordenes.create', compact('collectors', 'intersections', 'priorities', 'motivos', 'tipos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), Alert::rules());

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $collector_id = null;
        if (!$request->input('collector') && (Auth::user()->hasRole('atmcollector') || Auth::user()->hasRole('ccitt'))) {
            $collector_id = Auth::user()->id;
        }
        else {
            $collector_id = $request->input('collector');
        }

        $alert = Alert::create([
            'owner_id' => Auth::user()->id,
            'collector_id' => $collector_id,
            'status_id' => Status::where('name', Alert::STATUS_UNATTENDED)->first()->id,
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
            'priority_id'  => $request->input('priority'),
            'reason'    => $request->input('motivoOrden'),
            'tipoOrden'    => $request->input('tipoOrden'),
            'google_address' => $request->input('google_address'),
            'description' => $request->input('description'),
            'storage_or_site' => $request->input('bodega'),
            'site_detail' => $request->input('sitioespecificodetail'),
        ]);

        if ($alert) {
            return redirect('ordenes/')->with('success', trans('Orden creada con exito'));
        }

        return back()->with('error', trans('Ocurrio un error al crear la orden de trabajo'));
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
        $collectors = User::whereHas("roles", function($q){ $q->where("slug", "atmcollector"); })->get();
        $intersections = Intersection::all();
        $priorities = Priority::all();
        $motivos = MotiveWO::all();
        $tipos = WorkOrderType::all();
$novelties = Novelty::where('subcategory', false)->get();
        $subnovelties = Novelty::where('subcategory', true)->where('group', false)->get();
        $worktypes = Novelty::where('subcategory', true)->where('group', true)->get();
        $alertaid = $alert->id;         
        $alertas = \App\Models\Report::select('*')->where('alert_id','like',$alertaid)->get(); 
        if ($alert) {
            return view('ordenes.edit', compact('alert', 'collectors', 'intersections', 'priorities', 'motivos', 'tipos',
                    'novelties', 'subnovelties','worktypes','alertas'));
        }

        return back()->with('error', trans('alerts.editError'));
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
        $alert = Alert::find($id);

        if ($alert) {
            $alert->owner_id = Auth::user()->id;

            if ($request->collector && $request->collector != $alert->collector_id) {
                $alert->collector_id = $request->collector;
            }

            if ($request->latitude && $request->latitude != $alert->latitude) {
                $alert->latitude = $request->latitude;
            }

            if ($request->longitude && $request->longitude != $alert->longitude) {
                $alert->longitude = $request->longitude;
            }

            if ($request->google_address && $request->google_address != $alert->google_address) {
                $alert->google_address = $request->google_address;
            }

            if ($request->description && $request->description != $alert->description) {
                $alert->description = $request->description;
            }

            if ($alert->save()) {
                $alert->mask_as_read();
                return redirect('ordenes/')->with('success', trans('Orden de trabajo modificada'));
            }
        }

        return back()->with('error', trans('alerts.udpateError'));
    }

    public function show($id)
    {
        $alert = Alert::find($id);  
 $report = Report::select('id')->where('alert_id','=', $id)->get();
 

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
        $alertaid = $alert->id;         
        $ordenalertaid=$alert->tipoOrden;
        if ($ordenalertaid<>''){            
        } else {
            $ordenalertaid = ' ';
        }
        $prioridadalertaid=$alert->priority_id;
        $motivoalertaid=$alert->reason;   
        if ($motivoalertaid<>''){            
        } else {
            $motivoalertaid = ' ';
        }
        $materialid = Material::select('id_matrepord')->where('report_id','=', $alert->id)->get();
        $alerta = '';
        $alertas = \App\Models\Report::select('*')->where('alert_id','like',$alertaid)->get();        
        $noveltys = \App\Models\Novelty::select('*')->where('id','like','%%')->get();
        $workordertypes = \App\Models\WorkOrderType::select('*')->where('id','like',$ordenalertaid)->get();
        $priorityalerts = \App\Models\Priority::select('*')->where('id','like',$prioridadalertaid)->get();
        $motivealerts = \App\Models\MotiveWO::select('*')->where('id','like',$motivoalertaid)->get();
        $tiporeportes = \App\Models\Novelty::select('*')->where('id','like','%')->get();
        $statusreportes = \App\Models\Status::select('*')->where('id','like','%')->get();
//dd($report);
        if ($alert) {
         
            $alert->mask_as_read();
            return view('ordenes.show', compact('alert','alertas','noveltys','workordertypes','priorityalerts','motivealerts','tiporeportes','statusreportes','materialid','report'));
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
        $alert = Alert::find($id);

        if ($alert) {
            if ($alert->report) {
                return redirect('alerts/')->with('error', 'No puede eliminar una alerta que ya posee un reporte.');
            }

            if (!Auth::user()->hasRole('atmadmin|atmoperator')) {
                return redirect('alerts/')->with('error', 'No tiene permisos para realizar esta acción.');
            }

            $alert->delete();

            return redirect('alerts')->with('success', trans('alerts.deleteSuccess'));
        }

        return back()->with('error', trans('alerts.deleteError'));
    }
    
    
      public function close(Request $request, $id) {
     

        $workorder = Alert::find($id);
        if ($workorder) {            

            if ($request->input('description') && !$workorder->complete_description) {
                $workorder->complete_description = $request->input('description');
            }

            if ($workorder->save()) {
                $workorder->close();
                return redirect('ordenes/')->with('success', trans('workorders.closeSuccess'));
            }
        }
        else {
            return redirect('workorders')->with('error', 'La orden de trabajo no existe.');
        }

        return redirect('workorders')->with('error', trans('reports.closeError'));
    }

    
    
}
