<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use App\Models\SignalGroup;
use App\Models\SignalSubgroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SignalSubgroupController extends Controller
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
        $subgroups = SignalSubgroup::orderby('id', 'asc');
        $subgroupstotal = $subgroups->count();

        if ($pagintaionEnabled) {
            $subgroups = $subgroups->paginate(config('atm_app.paginateListSize'));
        }

        return View('signal-subgroups.index', compact('subgroups', 'subgroupstotal'));
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

        return view('signal-subgroups.create', compact('groups', 'shapes', 'colors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), SignalSubgroup::rules());

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $subgroup = SignalSubgroup::create([
            'code' => $request->input('code'),
            'name' => $request->input('name'),
            'group_id' => SignalGroup::find($request->input('group')) ? $request->input('group'): 1,
            'shape' => $request->input('shape'),
            'colors' => json_encode((object)$request->colors),
            'description' => $request->input('description')
        ]);

        if ($subgroup) {
            return redirect('signal-subgroups/')->with('success', trans('signal-subgroups.createSuccess'));
        }

        return back()->with('error', trans('signal-subgroups.messages.create-error'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subgroup = SignalSubgroup::find($id);

        return view('signal-subgroups.show', compact('subgroup'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subgroup = SignalSubgroup::find($id);
        $groups = SignalGroup::orderby('id', 'asc')->get();
        $shapes = json_decode(Configuration::where('code', 'forma')->first()->values);
        $colors = json_decode(Configuration::where('code', 'color')->first()->values);

        if ($subgroup) {
            return view('signal-subgroups.edit', compact('subgroup', 'groups', 'shapes', 'colors'));
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
        $subgroup = SignalSubgroup::find($id);

        if ($subgroup) {
            if ($request->code && $request->code != $subgroup->code) {
                $subgroup->code = $request->code;
            }

            if ($request->name && $request->name != $subgroup->name) {
                $subgroup->name = $request->name;
            }

            if ($request->description && $request->description != $subgroup->description) {
                $subgroup->description = $request->description;
            }

            if ($request->group_id && $request->group_id != $subgroup->group_id) {
                $subgroup->group_id = $request->group_id;
            }

            if ($request->shape && $request->shape != $subgroup->shape) {
                $subgroup->shape = $request->shape;
            }

            if ($request->colors && $request->colors != $subgroup->colors) {
                $subgroup->colors = $request->colors;
            }

            if ($subgroup->save()) {
                return redirect('signal-subgroups/')->with('success', trans('signal-subgroups.updateSuccess'));
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
        $subgroup = SignalSubgroup::find($id);

        if ($subgroup) {
            $subgroup->delete();

            return redirect('signal-subgroups')->with('success', trans('signal-subgroups.messages.delete-success'));
        }

        return back()->with('error', trans('device-lights.messages.delete-error'));
    }
}
