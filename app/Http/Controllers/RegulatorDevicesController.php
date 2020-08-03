<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use App\Models\RegulatorBox;
use App\Models\TrafficDevice;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Auth;
use Validator;

class RegulatorDevicesController extends Controller
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
        $devices = TrafficDevice::whereNotNull('regulatorbox_id')->orderby('updated_at', 'desc');
        $devicestotal = TrafficDevice::count();

        if ($pagintaionEnabled) {
            $devices = $devices->paginate(config('atm_app.paginateListSize'));
        }

        return View('regulator-devices.show-regulator-devices', compact('devices', 'devicestotal'));
    }

    /**
     * Audit the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function audit($id)
    {
        $device = TrafficDevice::find($id);

        if ($device && $device->audits) {
            $audits = $device->audits()->with('user')->get();
            return view('regulator-devices.audit-regulator-device', compact('device', 'audits'));
        }

        return back()->with('error', trans('regulator-devices.messages.no-audits-records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $states = json_decode(Configuration::where('code', 'estado')->first()->values);
        $regulators = RegulatorBox::orderby('updated_at', 'desc')->get();

        if (count($regulators) == 0) {
            return redirect('/regulator-devices')->with('error', 'Aun no existen reguladoras de tráfico. Debe crearlas antes.');
        }

        return view('regulator-devices.create-regulator-device', compact('states', 'regulators'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), TrafficDevice::rules());

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $device = TrafficDevice::create([
            'code' => $request->input('code'),
            'erp_code' => $request->input('erp_code'),
            'user_id' => Auth::user()->id,
            'regulatorbox_id' => $request->input('regulator'),
            'brand' => $request->input('brand'),
            'type' => $request->input('type'),
            'model' => $request->input('model'),
            'state' => $request->input('state'),
            'comment' => $request->input('comment')
        ]);

        if ($device) {
            return redirect('regulator-devices/' . $device->id)->with('success', trans('regulator-devices.createSuccess'));
        }

        return back()->with('error', trans('regulator-devices.messages.create-error'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $device = TrafficDevice::find($id);

        if ($device) {
            return view('regulator-devices.show-regulator-device', compact('device'));
        }

        return back()->with('error', trans('regulator-devices.messages.show-error'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $device = TrafficDevice::findOrFail($id);
        $states = json_decode(Configuration::where('code', 'estado')->first()->values);
        $regulators = RegulatorBox::orderby('updated_at', 'desc')->get();
        $dev_types = TrafficDevice::dev_types;

        if ($device) {
            return view('regulator-devices.edit-regulator-device', compact('device', 'states', 'regulators', 'dev_types'));
        }

        return back()->with('error', trans('regulator-devices.messages.show-error'));
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
        $device = TrafficDevice::find($id);

        if ($device) {
            if ($request->erp_code && $request->erp_code != $device->erp_code) {
                $device->erp_code = $request->erp_code;
            }

            if ($request->regulator && $request->regulator != $device->regulatorbox_id) {
                $device->regulatorbox_id = $request->regulator;
            }

            if ($request->brand && $request->brand != $device->brand) {
                $device->brand = $request->brand;
            }

            if ($request->model && $request->model != $device->model) {
                $device->model = $request->model;
            }

            if ($request->type && $request->type != $device->type) {
                $device->type = $request->type;
            }

            if ($request->comment && $request->comment != $device->comment) {
                $device->comment = $request->comment;
            }

            if ($request->state && $request->state != $device->state) {
                $device->state = $request->state;
            }

            if ($device->save()) {
                return redirect('regulator-devices/' . $device->id)->with('success', trans('regulator-devices.updateSuccess'));
            }
        }

        return back()->with('error', trans('regulator-devices.messages.update-error'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $device = TrafficDevice::findOrFail($id);

        if ($device) {
            $device->delete();
            return redirect('regulator-devices')->with('success', trans('regulator-devices.messages.delete-success'));
        }

        return back()->with('error', trans('regulator-devices.messages.delete-error'));
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('regulator_device_search_box');
        $searchRules = [
            'regulator_device_search_box' => 'required|string|max:255',
        ];
        $searchMessages = [
            'regulator_device_search_box.required' => 'Search term is required',
            'regulator_device_search_box.string' => 'Search term has invalid characters',
            'regulator_device_search_box.max' => 'Search term has too many characters - 255 allowed',
        ];

        $validator = Validator::make($request->all(), $searchRules, $searchMessages);

        if ($validator->fails()) {
            return response()->json([
                json_encode($validator),
            ], Response::HTTP_BAD_REQUEST);
        }

        $result = TrafficDevice::select(
            'traffic_devices.id as id',
            'traffic_devices.code as code',
            'traffic_devices.type as type',
            'traffic_devices.erp_code as erp_code',
            'traffic_devices.state as state',
            'traffic_devices.brand as brand',
            'traffic_devices.model as model',
            'regulator_boxes.code as rb_code'
            )->join('regulator_boxes', 'traffic_devices.regulatorbox_id', '=', 'regulator_boxes.id')
            ->where('traffic_devices.code', 'like', '%' . $searchTerm . '%')
            ->orWhere('regulator_boxes.code', '=', $searchTerm)
            ->orWhere('traffic_devices.state', 'like', '%' . $searchTerm . '%')
            ->orWhere('traffic_devices.brand', 'like', '%' . $searchTerm . '%')
            ->orWhere('traffic_devices.model', 'like', '%' . $searchTerm . '%')
            ->orWhere('traffic_devices.erp_code', 'like', '%' . $searchTerm . '%')->get();

        return response()->json([
            json_encode($result),
        ], Response::HTTP_OK);
    }

    public function brands_by_type(Request $request)
    {
        $brands = json_decode(Configuration::where('code', $request->type)->first()->values);

        if ($brands) {
            $results = [];
            foreach ($brands as $i => $val) {
                $results[] = [
                    "id" => $i,
                    "brand" => $val
                ];
            }

            return response()->json($results, Response::HTTP_OK);
        }

        return response()->json(['No brands'], Response::HTTP_BAD_REQUEST);
    }
}
