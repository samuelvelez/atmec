<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use App\Models\SignalGroup;
use App\Models\TrafficLightType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TrafficLightTypeController extends Controller
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
        $subgroups = TrafficLightType::orderby('id', 'asc');
        $subgroupstotal = $subgroups->count();

        if ($pagintaionEnabled) {
            $subgroups = $subgroups->paginate(config('atm_app.paginateListSize'));
        }

        return View('traffic-light-type.index', compact('subgroups', 'subgroupstotal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $groups = TrafficLightType::orderby('id', 'asc')->get();
        $shapes = json_decode(Configuration::where('code', 'forma')->first()->values);
        $colors = json_decode(Configuration::where('code', 'color')->first()->values);
        return view('traffic-light-type.create', compact('groups', 'shapes', 'colors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        $validator = Validator::make($request->all(), SignalSubgroup::rules());
//
//        if ($validator->fails()) {
//            return back()->withErrors($validator)->withInput();
//        }

        $subgroup = TrafficLightType::create([
            'description' => $request->input('code')            
        ]);

        if ($subgroup) {
            return redirect('traffic-light-type/')->with('success', trans('traffic-light-type.createSuccess'));
        }

        return back()->with('error', trans('traffic-light-type.messages.create-error'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subgroup = TrafficLightType::find($id);

        return view('traffic-light-type.show', compact('subgroup'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subgroup = TrafficLightType::find($id);
     
        if ($subgroup) {
            return view('traffic-light-type.edit', compact('subgroup'));
        }

        return back()->with('error', trans('traffic-light-type.messages.show-error'));
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
        $subgroup = TrafficLightType::find($id);

        if ($subgroup) {
            
            if ($request->description && $request->description != $subgroup->description) {
                $subgroup->description = $request->description;
            }
            
            if ($subgroup->save()) {
                return redirect('traffic-light-type/')->with('success', trans('traffic-light-type.updateSuccess'));
            }
        }

        return back()->with('error', trans('signal-subgroups.messages.update-error'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subgroup = TrafficLightType::find($id);

        if ($subgroup) {
            $subgroup->delete();

            return redirect('traffic-light-type')->with('success', trans('traffic-light-type.messages.delete-success'));
        }

        return back()->with('error', trans('traffic-light-type.messages.delete-error'));
    }
}
