<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StatusController extends Controller
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
        $statuses = Status::orderby('id', 'asc');
        $statusestotal = $statuses->count();

        if ($pagintaionEnabled) {
            $statuses = $statuses->paginate(config('atm_app.paginateListSize'));
        }

        return View('statuses.index', compact('statuses', 'statusestotal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('statuses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), Status::rules());

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }


        $status = Status::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);
        if ($status) {
            return redirect('statuses/')->with('success', trans('statuses.createSuccess'));
        }

        return back()->with('error', trans('statuses.createError'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $status = Status::find($id);

        if ($status) {

            return view('statuses.edit', compact('status'));
        }

        return back()->with('error', trans('statuses.editError'));
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
        $status = Status::find($id);

        if ($status) {
            if ($request->name && $request->name != $status->name) {
                $status->name = $request->name;
            }

            if ($request->description && $request->description != $status->description) {
                $status->description = $request->description;
            }

            if ($status->save()) {
                return redirect('statuses/')->with('success', trans('statuses.updateSuccess'));
            }
        }

        return back()->with('error', trans('statuses.udpateError'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $status = Status::find($id);

        if ($status) {
            $status->delete();

            return redirect('statuses')->with('success', trans('statuses.deleteSuccess'));
        }

        return back()->with('error', trans('statuses.deleteError'));
    }
}
