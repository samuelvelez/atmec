<?php

namespace App\Http\Controllers;

use App\Models\DevicesInventory;
use App\Models\MaterialTemplate;
use App\Models\ItorderTemplate;
use App\Models\MetricUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ItorderTemplateController extends Controller
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
        $templates = ItorderTemplate::orderby('id', 'asc');
        $templatestotal = ItorderTemplate::count();

        if ($pagintaionEnabled) {
            $templates = $templates->paginate(config('atm_app.paginateListSize'));
        }

        return View('ito-templates.index', compact('templates', 'templatestotal'));
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

        return view('ito-templates.create', compact('materials', 'metrics'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), ItorderTemplate::rules());

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $template = ItorderTemplate::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        if ($template) {
            $materials = json_decode($request->input('materials_list'));
            foreach ($materials as $material) {
                $device = DevicesInventory::find($material->id);
                $metric = MetricUnit::where('abbreviation', $material->metric)->first();

                if ($device && $metric) {
                    MaterialTemplate::create([
                        'template_id' => $template->id,
                        'material_id' => $device->id,
                        'metric_id' => $metric->id,
                        'code' => $material->code,
                        'amount' => $material->amount
                    ]);
                }
            }

            return redirect('ito-templates/')->with('success', trans('ito-templates.createSuccess'));
        }

        return back()->with('error', trans('ito-templates.createError'));
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
        $template = ItorderTemplate::find($id);

        if ($template) {
            return view('ito-templates.edit', compact('template', 'materials', 'metrics'));
        }

        return back()->with('error', trans('ito-templates.editError'));
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
        $template = ItorderTemplate::find($id);

        if ($template) {
            if ($request->name && $request->name != $template->name) {
                $template->name = $request->name;
            }

            if ($request->description && $request->description != $template->description) {
                $template->description = $request->description;
            }

            if ($request->input('materials_list')) {
                foreach ($template->materials as $material) {
                    $material->delete();
                }

                $materials = json_decode($request->input('materials_list'));
                foreach ($materials as $material) {
                    $device = DevicesInventory::find($material->id);
                    $metric = MetricUnit::where('abbreviation', $material->metric)->first();

                    if ($device && $metric) {
                        MaterialTemplate::create([
                            'template_id' => $template->id,
                            'material_id' => $device->id,
                            'metric_id' => $metric->id,
                            'code' => $material->code,
                            'amount' => $material->amount
                        ]);
                    }
                }
            }

            if ($template->save()) {
                return redirect('ito-templates/')->with('success', trans('ito-templates.updateSuccess'));
            }
        }

        return back()->with('error', trans('ito-templates.udpateError'));
    }

    public function show($id)
    {
        $template = ItorderTemplate::find($id);

        if ($template) {
            return view('ito-templates.show', compact('template'));
        }

        return back()->with('error', 'Plantilla no encontrada.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $template = ItorderTemplate::find($id);

        if ($template) {
            foreach ($template->materials as $material) {
                $material->delete();
            }

            $template->delete();

            return redirect('ito-templates/')->with('success', trans('ito-templates.deleteSuccess'));
        }

        return back()->with('error', trans('ito-templates.deleteError'));
    }
}
