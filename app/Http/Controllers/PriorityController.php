<?php

namespace App\Http\Controllers;

use App\Models\Motive;
use App\Models\Priority;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PriorityController extends Controller
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
        $priorities = Priority::orderby('id', 'asc');
        $prioritiestotal = $priorities->count();

        if ($pagintaionEnabled) {
            $priorities = $priorities->paginate(config('atm_app.paginateListSize'));
        }

        return View('priorities.index', compact('priorities', 'prioritiestotal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('priorities.create');
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

        $priority = Priority::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        if ($priority) {
            return redirect('priorities/')->with('success', trans('priorities.createSuccess'));
        }

        return back()->with('error', trans('priorities.createError'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $priority = Priority::find($id);

        if ($priority) {

            return view('priorities.edit', compact('priority'));
        }

        return back()->with('error', trans('priorities.editError'));
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
        $priority = Priority::find($id);

        if ($priority) {
            if ($request->name && $request->name != $priority->name) {
                $priority->name = $request->name;
            }

            if ($request->description && $request->description != $priority->description) {
                $priority->description = $request->description;
            }

            if ($priority->save()) {
                return redirect('priorities/')->with('success', trans('priorities.updateSuccess'));
            }
        }

        return back()->with('error', trans('priorities.udpateError'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $priority = Priority::find($id);

        if ($priority) {
            $priority->delete();

            return redirect('priorities')->with('success', trans('priorities.deleteSuccess'));
        }

        return back()->with('error', trans('priorities.deleteError'));
    }
}
