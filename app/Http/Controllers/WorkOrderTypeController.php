<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use App\Models\SignalGroup;
use App\Models\WorkOrderType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WorkOrderTypeController extends Controller
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
        $subgroups = WorkOrderType::orderby('id', 'asc');
        $subgroupstotal = $subgroups->count();

        if ($pagintaionEnabled) {
            $subgroups = $subgroups->paginate(config('atm_app.paginateListSize'));
        }

        return View('work-order-type.index', compact('subgroups', 'subgroupstotal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $groups = WorkOrderType::orderby('id', 'asc')->get();
        $shapes = json_decode(Configuration::where('code', 'forma')->first()->values);
        $colors = json_decode(Configuration::where('code', 'color')->first()->values);
        return view('work-order-type.create', compact('groups', 'shapes', 'colors'));
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

        $subgroup = WorkOrderType::create([
            'description' => $request->input('code')            
        ]);

        if ($subgroup) {
            return redirect('work-order-type/')->with('success', trans('work-order-type.createSuccess'));
        }

        return back()->with('error', trans('work-order-type.messages.create-error'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subgroup = WorkOrderType::find($id);

        return view('work-order-type.show', compact('subgroup'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subgroup = WorkOrderType::find($id);
     
        if ($subgroup) {
            return view('work-order-type.edit', compact('subgroup'));
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
        $subgroup = WorkOrderType::find($id);

        if ($subgroup) {
            
            if ($request->description && $request->description != $subgroup->description) {
                $subgroup->description = $request->description;
            }
            
            if ($subgroup->save()) {
                return redirect('work-order-type/')->with('success', trans('work-order-type.updateSuccess'));
            }
        }

        return back()->with('error', trans('work-order-type.messages.update-error'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subgroup = WorkOrderType::find($id);

        if ($subgroup) {
            $subgroup->delete();

            return redirect('work-order-type')->with('success', trans('work-order-type.messages.delete-success'));
        }

        return back()->with('error', trans('work-order-type.messages.delete-error'));
    }
}
