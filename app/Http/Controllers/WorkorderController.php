<?php

namespace App\Http\Controllers;

use App\Models\Alert;
use App\Models\MetricUnit;
use App\Models\Priority;
use App\Models\Report;
use App\Models\Workorder;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class WorkorderController extends Controller
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

        if (Auth::user()->hasRole('atmcollector')) {
            $workorders = Workorder::where('collector_id', Auth::user()->id)->orderby('id', 'asc');
        }
        else {
            $workorders = Workorder::orderby('id', 'asc');
        }

        $workorderstotal = $workorders->count();

        if ($pagintaionEnabled) {
            $workorders = $workorders->paginate(config('atm_app.paginateListSize'));
        }

        return View('workorders.index', compact('workorders', 'workorderstotal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $collectors = User::whereHas("roles", function($q){ $q->where("slug", "atmcollector"); })->get();
        $priorities = Priority::all();

        $report = Report::find($id);
        if ($report) {
            if ($report->workorder) {
                return redirect('workorders/')->with('error', 'El reporte ya posee una orden de trabajo.');
            }

            return view('workorders.create', compact('collectors', 'priorities', 'report'));
        }

        return redirect('reports/')->with('error', 'El reporte seleccionado no existe.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), Workorder::rules(), [
            'collector.required'       => 'La escalera es requerida',
            'priority.required'       => 'La prioridad es requerida',
            'description.required'       => 'La descripción es requerida',
        ]);

        $report = Report::find($request->input('report'));
        if (!$report) {
            return redirect('reports')->with('error', 'El reporte no existe.');
        }

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $workorder = Workorder::create([
            'report_id' => $request->input('report'),
            'collector_id' => $request->input('collector'),
            'status_id' => Status::where('name', Workorder::STATUS_OPEN)->first()->id,
            'priority_id' => $request->input('priority'),
            'description' => $request->input('description'),
        ]);

        if ($workorder) {
            $report->status_id = Status::where('name', Alert::STATUS_ATTENDED)->first()->id;
            $report->save();

            return redirect('ordenes/')->with('success', trans('Orden de trabajo Reportada'));
        }

        return back()->with('error', trans('workorders.createError'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $workorder = Workorder::find($id);
        $collectors = User::whereHas("roles", function($q){ $q->where("slug", "atmcollector"); })->get();
        $priorities = Priority::all();

        if ($workorder) {
            return view('workorders.edit', compact('workorder', 'collectors', 'priorities'));
        }

        return back()->with('error', trans('workorders.editError'));
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
        $workoder = Workorder::find($id);

        if ($workoder) {
            if ($request->collector && $request->collector != $workoder->collector_id) {
                $workoder->collector_id = $request->collector;
            }

            if ($request->priority && $request->priority != $workoder->priority_id) {
                $workoder->priority_id = $request->priority;
            }

            if ($request->description && $request->description != $workoder->description) {
                $workoder->description = $request->description;
            }

            if ($workoder->save()) {
                return redirect('workorders/')->with('success', trans('workorders.updateSuccess'));
            }
        }

        return redirect('workorders')->with('error', trans('workorders.udpateError'));
    }

    public function show($id)
    {
        $workorder = Workorder::find($id);

        if ($workorder) {
            if ($workorder->collector_id == Auth::user()->id && Auth::user()->hasRole('atmcollector')) {
                $workorder->begin();
            }

            return view('workorders.show', compact('workorder'));
        }

        return redirect('workorders')->with('error', 'Orden de trabajo no encontrada.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $workorder = Workorder::find($id);

        if ($workorder) {
            if (!Auth::user()->hasRole('atmadmin|atmoperator')) {
                return redirect('workorders/')->with('error', 'No tiene permisos para realizar esta acción.');
            }

            $workorder->delete();

            return redirect('workorders')->with('success', trans('workorders.deleteSuccess'));
        }

        return redirect('workorders')->with('error', trans('workorders.deleteError'));
    }

    public function add_pictures($id)
    {
        $workorder = Workorder::find($id);
        if ($workorder) {
            if ($workorder->completed_on) {
                return redirect('workorders')->with('error', 'La orden de trabajo ya está cerrada.');
            }

            return view('workorders.close', compact('workorder'));
        }

        return redirect('workorders')->with('error', 'Orden de trabajo no encontrada.');
    }

    public function close(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'pictures'  => 'required'
        ], [
            'pictures.required'       => 'Al menos una imagen es requerida',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $workorder = Workorder::find($id);
        if ($workorder) {
            if ($workorder->completed_on) {
                return redirect('workorders')->with('error', 'La orden de trabajo ya está cerrada.');
            }

            if ($request->input('description') && !$workorder->complete_description) {
                $workorder->complete_description = $request->input('description');
            }

            if ($request->hasFile('pictures')) {
                $files = $request->file('pictures');
                $names = [];

                if (!File::exists(storage_path('/app/public_html/workorders'))) {
                    File::makeDirectory(storage_path('/app/public_html/workorders'), 755, true);
                }

                foreach ($files as $file) {
                    $filename = Str::random() . '.' . $file->getClientOriginalExtension();
                    $names[] = $filename;
                    $file->storeAs('workorders', $filename);
                }

                $workorder->pictures = json_encode($names);
                $workorder->save();
            }

            if ($workorder->save()) {
                $workorder->close();
                return redirect('ordenes/')->with('success', trans('workorders.closeSuccess'));
            }
        }
        else {
            return redirect('workorders')->with('error', 'La orden de trabajo no existe.');
        }

        return redirect('workorders')->with('error', trans('reports.closeError'));
    }

    public function complete($id) {
        $workorder = Workorder::find($id);

        if ($workorder && Auth::user()->hasRole('atmoperator')) {
            if ($workorder->status_id == Status::where('name', Workorder::STATUS_COMPLETED)->first()->id) {
                return redirect('workorders')->with('error', 'La orden de trabajo ya fue finalizada.');
            }

            $workorder->complete();

            return redirect('workorders/')->with('success', trans('workorders.completeSuccess'));
        }
    }
}
