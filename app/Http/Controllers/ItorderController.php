<?php

namespace App\Http\Controllers;

use App\Models\DevicesInventory;
use App\Models\Itorder;
use App\Models\ItorderMaterial;
use App\Models\MaterialTemplate;
use App\Models\ItorderTemplate;
use App\Models\MetricUnit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use jeremykenedy\LaravelRoles\Models\Role;

class ItorderController extends Controller
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
        $itorders = Itorder::orderby('id', 'asc');
        $itorderstotal = Itorder::count();

        if ($pagintaionEnabled) {
            $itorders = $itorders->paginate(config('atm_app.paginateListSize'));
        }

        return View('itorders.index', compact('itorders', 'itorderstotal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $materials = DevicesInventory::all();
        $metrics = MetricUnit::all();
        $templates = ItorderTemplate::with('materials')->get();
        $collectors = User::whereHas("roles", function($q){ $q->where("slug", "atmcollector"); })->get();

        return view('itorders.create', compact('materials', 'metrics', 'templates', 'collectors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), Itorder::rules());

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $itorder = Itorder::create([
            'collector_id' => $request->input('collector'),
        ]);

        if ($itorder) {
            $materials = json_decode($request->input('materials_list'));
            foreach ($materials as $material) {
                $device = DevicesInventory::find($material->id);
                $metric = MetricUnit::where('abbreviation', $material->metric)->first();

                if ($device && $metric) {
                    ItorderMaterial::create([
                        'itorder_id' => $itorder->id,
                        'material_id' => $device->id,
                        'metric_id' => $metric->id,
                        'code' => $material->code,
                        'amount' => $material->amount
                    ]);
                }
            }

            return redirect('itorders/')->with('success', trans('itorders.createSuccess'));
        }

        return back()->with('error', trans('itorders.createError'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $materials = DevicesInventory::all();
        $metrics = MetricUnit::all();
        $templates = ItorderTemplate::with('materials')->get();
        $collectors = User::whereHas("roles", function($q){ $q->where("slug", "atmcollector"); })->get();

        $itorder = Itorder::find($id);

        if ($itorder) {
            return view('itorders.edit', compact('itorder', 'materials', 'metrics', 'templates', 'collectors'));
        }

        return back()->with('error', trans('itorders.editError'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $itorder = Itorder::find($id);

        if ($itorder) {
            if ($request->collector && $request->collector != $itorder->collector_id) {
                $itorder->collector_id = $request->collector;
            }

            if ($request->input('materials_list')) {
                foreach ($itorder->materials as $material) {
                    $material->delete();
                }

                $materials = json_decode($request->input('materials_list'));
                foreach ($materials as $material) {
                    $device = DevicesInventory::find($material->id);
                    $metric = MetricUnit::where('abbreviation', $material->metric)->first();

                    if ($device && $metric) {
                        ItorderMaterial::create([
                            'itorder_id' => $itorder->id,
                            'material_id' => $device->id,
                            'metric_id' => $metric->id,
                            'code' => $material->code,
                            'amount' => $material->amount
                        ]);
                    }
                }
            }

            if ($itorder->save()) {
                return redirect('itorders/')->with('success', trans('itorders.updateSuccess'));
            }
        }

        return back()->with('error', trans('itorders.udpateError'));
    }

    public function show($id)
    {
        $itorder = Itorder::find($id);

        if ($itorder) {
            return view('itorders.show', compact('itorder'));
        }

        return back()->with('error', 'OET no encontrada.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $itorders = Itorder::find($id);

        if ($itorders) {
            foreach ($itorders->materials as $material) {
                $material->delete();
            }

            $itorders->delete();

            return redirect('itorders/')->with('success', trans('itorders.deleteSuccess'));
        }

        return back()->with('error', trans('itorders.deleteError'));
    }
}
