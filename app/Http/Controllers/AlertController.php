<?php

namespace App\Http\Controllers;

use App\Models\Alert;
use App\Models\Intersection;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AlertController extends Controller
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
            $alerts = Alert::where('collector_id', Auth::user()->id)->orderby('id', 'asc');
        }
        else {
            $alerts = Alert::orderby('id', 'asc');
        }

        $alertstotal = $alerts->count();

        if ($pagintaionEnabled) {
            $alerts = $alerts->paginate(config('atm_app.paginateListSize'));
        }

        return View('alerts.index', compact('alerts', 'alertstotal'));
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

        return view('alerts.create', compact('collectors', 'intersections'));
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
        if (!$request->input('collector') && Auth::user()->hasRole('atmcollector')) {
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
            'google_address' => $request->input('google_address'),
            'description' => $request->input('description'),
        ]);

        if ($alert) {
            return redirect('alerts/')->with('success', trans('alerts.createSuccess'));
        }

        return back()->with('error', trans('alerts.createError'));
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

        if ($alert) {
            return view('alerts.edit', compact('alert', 'collectors', 'intersections'));
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
                return redirect('alerts/')->with('success', trans('alerts.updateSuccess'));
            }
        }

        return back()->with('error', trans('alerts.udpateError'));
    }

    public function show($id)
    {
        $alert = Alert::find($id);

        if ($alert) {
            $alert->mask_as_read();

            return view('alerts.show', compact('alert'));
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
}
