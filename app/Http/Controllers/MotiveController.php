<?php

namespace App\Http\Controllers;

use App\Models\Motive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MotiveController extends Controller
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
        $motives = Motive::orderby('id', 'asc');
        $motivesstotal = Motive::count();

        if ($pagintaionEnabled) {
            $motives = $motives->paginate(config('atm_app.paginateListSize'));
        }

        return View('motives.index', compact('motives', 'motivesstotal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('motives.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), Motive::rules());

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $motive = Motive::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        if ($motive) {
            return redirect('motives/')->with('success', trans('motives.createSuccess'));
        }

        return back()->with('error', trans('motives.createError'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $motive = Motive::find($id);

        if ($motive) {

            return view('motives.edit', compact('motive'));
        }

        return back()->with('error', trans('motives.editError'));
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
        $motive = Motive::find($id);

        if ($motive) {
            if ($request->name && $request->name != $motive->name) {
                $motive->name = $request->name;
            }

            if ($request->description && $request->description != $motive->description) {
                $motive->description = $request->description;
            }

            if ($motive->save()) {
                return redirect('motives/')->with('success', trans('motives.updateSuccess'));
            }
        }

        return back()->with('error', trans('motives.udpateError'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $motive = Motive::find($id);

        if ($motive) {
            $motive->delete();

            return redirect('motives')->with('success', trans('motives.deleteSuccess'));
        }

        return back()->with('error', trans('motives.deleteError'));
    }
}
