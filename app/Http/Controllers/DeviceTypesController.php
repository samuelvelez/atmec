<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use App\Models\SignalGroup;
use App\Models\Brand;
use App\Models\DeviceTypes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DeviceTypesController extends Controller
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
        $subgroups = DeviceTypes::orderby('id', 'asc');
        $subgroupstotal = $subgroups->count();

        if ($pagintaionEnabled) {
            $subgroups = $subgroups->paginate(config('atm_app.paginateListSize'));
        }

        return View('device-types.index', compact('subgroups', 'subgroupstotal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $groups = DeviceTypes::orderby('id', 'asc')->get();
        $shapes = json_decode(Configuration::where('code', 'forma')->first()->values);
        $colors = json_decode(Configuration::where('code', 'color')->first()->values);
   $brandstypes= \App\Models\Brandstype::select('id','description')->where('description','like','%%')->get();        
        return view('device-types.create', compact('groups', 'shapes', 'colors','brandstypes'));
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

        $subgroup = DeviceTypes::create([
            'description' => $request->input('description'),
            'brands_type_fk' => $request->input('devicetype')
        ]);

        if ($subgroup) {
            return redirect('device-types/')->with('success', trans('device-types.createSuccess'));
        }

        return back()->with('error', trans('device-types.messages.create-error'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subgroup = DeviceTypes::find($id);
   $groups= \App\Models\Brandstype::orderby('id','asc')->get();        

        return view('device-types.show', compact('subgroup','groups'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subgroup = DeviceTypes::find($id);
//        $groups = SignalGroup::orderby('id', 'asc')->get();
// $groups = SignalGroup::orderby('id', 'asc')->get();
   $groups= \App\Models\Brandstype::orderby('id','asc')->get();        
        $shapes = json_decode(Configuration::where('code', 'forma')->first()->values);
        $colors = json_decode(Configuration::where('code', 'color')->first()->values);

        if ($subgroup) {
            return view('device-types.edit', compact('subgroup', 'groups', 'shapes', 'colors'));
        }

        return back()->with('error', trans('device-types.messages.show-error'));
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
        $subgroup = DeviceTypes::find($id);

        if ($subgroup) {

            if ($request->description && $request->description != $subgroup->description) {
                $subgroup->description = $request->description;
            }
            if ($request->group && $request->group != $subgroup->brands_type_fk) {
                $subgroup->brands_type_fk = $request->group;
            }



            if ($subgroup->save()) {
                return redirect('device-types/')->with('success', trans('device-types.updateSuccess'));
            }
        }

        return back()->with('error', trans('device-types.messages.update-error'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subgroup = DeviceTypes::find($id);

        if ($subgroup) {
            $subgroup->delete();

            return redirect('device-types')->with('success', trans('device-types.messages.delete-success'));
        }

        return back()->with('error', trans('device-types.messages.delete-error'));
    }
}
