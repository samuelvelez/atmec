<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use App\Models\SignalGroup;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
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
        $subgroups = Brand::orderby('id', 'asc');
        $subgroupstotal = $subgroups->count();

        if ($pagintaionEnabled) {
            $subgroups = $subgroups->paginate(config('atm_app.paginateListSize'));
        }

        return View('brands.index', compact('subgroups', 'subgroupstotal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $groups = SignalGroup::orderby('id', 'asc')->get();
        $shapes = json_decode(Configuration::where('code', 'forma')->first()->values);
        $colors = json_decode(Configuration::where('code', 'color')->first()->values);
   $brandstypes= \App\Models\Brandstype::select('id','description')->where('description','like','%%')->get();        
        return view('brands.create', compact('groups', 'shapes', 'colors','brandstypes'));
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

        $subgroup = Brand::create([
            'description' => $request->input('code'),
//            'name' => $request->input('name'),
//            'group_id' => SignalGroup::find($request->input('group')) ? $request->input('group'): 1,
//            'shape' => $request->input('shape'),
//            'colors' => json_encode((object)$request->colors),
            'brands_type_fk' => $request->input('group')
        ]);

        if ($subgroup) {
            return redirect('brands/')->with('success', trans('brands.createSuccess'));
        }

        return back()->with('error', trans('brands.messages.create-error'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subgroup = Brand::find($id);
   $groups= \App\Models\Brandstype::orderby('id','asc')->get();        

        return view('brands.show', compact('subgroup','groups'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subgroup = Brand::find($id);
//        $groups = SignalGroup::orderby('id', 'asc')->get();
// $groups = SignalGroup::orderby('id', 'asc')->get();
   $groups= \App\Models\Brandstype::orderby('id','asc')->get();        
        $shapes = json_decode(Configuration::where('code', 'forma')->first()->values);
        $colors = json_decode(Configuration::where('code', 'color')->first()->values);

        if ($subgroup) {
            return view('brands.edit', compact('subgroup', 'groups', 'shapes', 'colors'));
        }

        return back()->with('error', trans('signal-subgroups.messages.show-error'));
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
        $subgroup = Brand::find($id);

        if ($subgroup) {

            if ($request->description && $request->description != $subgroup->description) {
                $subgroup->description = $request->description;
            }
            if ($request->group && $request->group != $subgroup->brands_type_fk) {
                $subgroup->brands_type_fk = $request->group;
            }



            if ($subgroup->save()) {
                return redirect('brands/')->with('success', trans('brands.updateSuccess'));
            }
        }

        return back()->with('error', trans('brands.messages.update-error'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subgroup = Brand::find($id);

        if ($subgroup) {
            $subgroup->delete();

            return redirect('brands')->with('success', trans('brands.messages.delete-success'));
        }

        return back()->with('error', trans('brand.messages.delete-error'));
    }
}
