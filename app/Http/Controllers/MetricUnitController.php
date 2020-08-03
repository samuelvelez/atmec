<?php

namespace App\Http\Controllers;

use App\Models\MetricUnit;
use App\Models\Motive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MetricUnitController extends Controller
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
        $metrics = MetricUnit::orderby('id', 'asc');
        $metricstotal = $metrics->count();

        if ($pagintaionEnabled) {
            $metrics = $metrics->paginate(config('atm_app.paginateListSize'));
        }

        return View('metric-units.index', compact('metrics', 'metricstotal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('metric-units.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), MetricUnit::rules());

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $metric = MetricUnit::create([
            'name' => $request->input('name'),
            'abbreviation' => $request->input('abbreviation'),
            'description' => $request->input('description'),
        ]);

        if ($metric) {
            return redirect('metric-units/')->with('success', trans('metric-units.createSuccess'));
        }

        return back()->with('error', trans('metric-units.createError'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $metric = MetricUnit::find($id);

        if ($metric) {

            return view('metric-units.edit', compact('metric'));
        }

        return back()->with('error', trans('metric-units.editError'));
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
        $metric = MetricUnit::find($id);

        if ($metric) {
            if ($request->name && $request->name != $metric->name) {
                $metric->name = $request->name;
            }

            if ($request->abbreviation && $request->abbreviation != $metric->abbreviation) {
                $metric->abbreviation = $request->abbreviation;
            }

            if ($request->description && $request->description != $metric->description) {
                $metric->description = $request->description;
            }

            if ($metric->save()) {
                return redirect('metric-units/')->with('success', trans('metric-units.updateSuccess'));
            }
        }

        return back()->with('error', trans('metric-units.udpateError'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $metric = MetricUnit::find($id);

        if ($metric) {
            $metric->delete();

            return redirect('metric-units')->with('success', trans('metric-units.deleteSuccess'));
        }

        return back()->with('error', trans('metric-units.deleteError'));
    }
}
