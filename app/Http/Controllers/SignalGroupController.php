<?php

namespace App\Http\Controllers;

use App\Exports\TrafficLightsExport;
use App\Models\Configuration;
use App\Models\DevicesInventory;
use App\Models\Intersection;
use App\Models\RegulatorBox;
use App\Models\SignalGroup;
use App\Models\TrafficLight;
use App\Models\TrafficPole;
use App\Models\TrafficTensor;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Svg\Tag\Group;

class SignalGroupController extends Controller
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
        $groups = SignalGroup::orderby('id', 'asc');
        $groupstotal = $groups->count();

        if ($pagintaionEnabled) {
            $groups = $groups->paginate(config('atm_app.paginateListSize'));
        }

        return View('signal-groups.index', compact('groups', 'groupstotal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('signal-groups.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), SignalGroup::rules());

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $group = SignalGroup::create([
            'code' => $request->input('code'),
            'name' => $request->input('name'),
            'description' => $request->input('description')
        ]);

        if ($group) {
            return redirect('signal-groups/')->with('success', trans('signal-groups.createSuccess'));
        }

        return back()->with('error', trans('signal-groups.messages.create-error'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $group = SignalGroup::find($id);

        return view('signal-groups.show', compact('group'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $group = SignalGroup::find($id);

        if ($group) {
            return view('signal-groups.edit', compact('group'));
        }

        return back()->with('error', trans('signal-groups.messages.show-error'));
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
        $group = SignalGroup::find($id);

        if ($group) {
            if ($request->code && $request->code != $group->code) {
                $group->code = $request->code;
            }

            if ($request->name && $request->name != $group->name) {
                $group->name = $request->name;
            }

            if ($request->description && $request->description != $group->description) {
                $group->description = $request->description;
            }

            if ($group->save()) {
                return redirect('signal-groups/')->with('success', trans('signal-groups.updateSuccess'));
            }
        }

        return back()->with('error', trans('signal-groups.messages.update-error'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $group = SignalGroup::find($id);

        if ($group) {
            $group->delete();

            return redirect('signal-groups')->with('success', trans('signal-groups.messages.delete-success'));
        }

        return back()->with('error', trans('device-lights.messages.delete-error'));
    }
}
