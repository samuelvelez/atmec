<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use App\Models\SignalGroup;
use App\Models\MotiveWO;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MotiveWOController extends Controller
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
        $subgroups = MotiveWO::orderby('id', 'asc');
        $subgroupstotal = $subgroups->count();

        if ($pagintaionEnabled) {
            $subgroups = $subgroups->paginate(config('atm_app.paginateListSize'));
        }

        return View('motive-work-order.index', compact('subgroups', 'subgroupstotal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $groups = SignalGroup::orderby('id', 'asc')->get();        
        return view('motive-work-order.create', compact('groups'));
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

        $subgroup = MotiveWO::create([
            'description' => $request->input('code'),
        ]);

        if ($subgroup) {
            return redirect('motive-work-order/')->with('success', trans('motive-wo.createSuccess'));
        }

        return back()->with('error', trans('motive-wo.messages.create-error'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subgroup = MotiveWO::find($id);
   $groups= \App\Models\Brandstype::orderby('id','asc')->get();        

        return view('motive-work-order.show', compact('subgroup','groups'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subgroup = MotiveWO::find($id);
//        $groups = SignalGroup::orderby('id', 'asc')->get();
// $groups = SignalGroup::orderby('id', 'asc')->get();

        if ($subgroup) {
            return view('motive-work-order.edit', compact('subgroup'));
        }

        return back()->with('error', trans('motive-wo.messages.show-error'));
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
        $subgroup = MotiveWO::find($id);

        if ($subgroup) {

            if ($request->description && $request->description != $subgroup->description) {
                $subgroup->description = $request->description;
            }
            if ($subgroup->save()) {
                return redirect('motive-work-order/')->with('success', trans('motive-wo.updateSuccess'));
            }
        }

        return back()->with('error', trans('motive-wo.messages.update-error'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subgroup = MotiveWO::find($id);

        if ($subgroup) {
            $subgroup->delete();

            return redirect('motive-work-order')->with('success', trans('motive-wo.messages.delete-success'));
        }

        return back()->with('error', trans('motive-wo.messages.delete-error'));
    }
}
