<?php

namespace App\Http\Controllers;

use App\Exports\VerticalSignalExport;
use App\Models\Configuration;
use App\Models\TrafficLight;
use App\Models\VerticalSignal;
use App\Models\SignalInventory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

use DB;
use Image;
use Validator;
use DateTime;

class VerticalSignalController extends Controller
{
    public function get_folder()
    {
        $folders = VerticalSignal::select('signal_folder as folder_name', DB::raw('count(signal_folder) as folder_count'))
            ->groupBy('signal_folder')
            ->havingRaw('COUNT(signal_folder) < ' . env('APP_MAX_FOLDER_COUNT', 9998))
            ->get();

        if ($folders->count() > 0) {
            foreach ($folders as $dir) {
                $folder = $dir->folder_name;

                if ($folder != null && File::isDirectory(storage_path('app/public_html/signals/') . $folder)
                    && count(File::files(storage_path('app/public_html/signals/') . $folder)) < env('APP_MAX_FOLDER_COUNT', 9998)) {
                    return $folder;
                }
            }
        }

        $folder = Str::random();
        if (File::makeDirectory(storage_path('app/public_html/signals/') . $folder)) {
            return $folder;
        }

        return null;
    }

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
     * Audit the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function audit($id)
    {
        $signal = VerticalSignal::find($id);

        if ($signal && $signal->audits) {
            $audits = $signal->audits()->with('user')->get();
            return view('verticalsignals.audit-vertical-signal', compact('signal', 'audits'));
        }

        return back()->with('error', trans('verticalsignals.messages.no-audits-records'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagintaionEnabled = config('atm_app.enablePagination');
        $vsignals = VerticalSignal::orderby('updated_at', 'desc');
        $vsignalstotal = VerticalSignal::count();

        if ($pagintaionEnabled) {
            $vsignals = $vsignals->paginate(config('atm_app.paginateListSize'));
        }
        
        return View('verticalsignals.show-vertical-signals', compact('vsignals', 'vsignalstotal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sinventories = SignalInventory::orderby('updated_at', 'desc')->get();
        $materials = json_decode(Configuration::where('code', 'material')->first()->values);
        $fasteners = json_decode(Configuration::where('code', 'signal_fasteners')->first()->values);
        $normatives = json_decode(Configuration::where('code', 'normativa')->first()->values);
        $orientations = json_decode(Configuration::where('code', 'direction')->first()->values);
        $parishs = json_decode(Configuration::where('code', 'parish')->first()->values);
        $states = json_decode(Configuration::where('code', 'estado')->first()->values);

        return view('verticalsignals.create-vertical-signal', compact(
                'sinventories',
                'materials',
                'fasteners',
                'normatives',
                'orientations',
                'parishs',
                'states')
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), VerticalSignal::rules());

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $picture_name = null;
        $folder = $this->get_folder();
        if ($request->input('picture_data')) {
            $picture_data = $request->input('picture_data');

            $ext = null;
            if (strpos($picture_data, 'data:image/jpeg;base64,') === 0) {
                $picture_data = str_replace('data:image/jpeg;base64,', '', $picture_data);
                $ext = '.jpg';
            }
            if (strpos($picture_data, 'data:image/png;base64,') === 0) {
                $picture_data = str_replace('data:image/png;base64,', '', $picture_data);
                $ext = '.png';
            }

            $picture_name = Str::random() . $ext;
            $picture_data = str_replace(' ', '+', $picture_data);
            $data = base64_decode($picture_data);

            if (!file_put_contents(storage_path('app/public_html/signals/') . $folder . DIRECTORY_SEPARATOR . $picture_name, $data)) {
                return back()->with('error', trans('Error guardando la imagen. Inténtelo de nuevo o contacte al administrador.'));
            }
        }
        $fecha = new DateTime();

        $vsignal = VerticalSignal::create([
            'user_id' => Auth::user()->id,
            'code' => $request->input('code'),
            'signal_id' => $request->input('inventory'),
            'variation_id' => $request->input('variation'),
            'signal_folder' => $folder,
            'picture' => $picture_name,
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
            'comment' => $request->input('comment'),
            'orientation' => $request->input('orientation'),
            'google_address' => $request->input('google_address'),
            'state' => $request->input('state'),
            'normative' => $request->input('normative'),
            'fastener' => $request->input('fastener'),
            'material' => $request->input('material'),
            'erp_code' => $request->input('erp_code'),
            'unique_code' => $request->input('code').'_'.$request->input('erp_code'),
        ]);

        $vsignal->save();

        return redirect('vertical-signals/' . $vsignal->id)->with('success', trans('verticalsignals.createSuccess'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vsignal = VerticalSignal::find($id);

        return view('verticalsignals.show-vertical-signal', compact('vsignal'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vsignal = VerticalSignal::findOrFail($id);
        $sinventories = SignalInventory::orderby('updated_at', 'desc')->get();
        $materials = json_decode(Configuration::where('code', 'material')->first()->values);
        $fasteners = json_decode(Configuration::where('code', 'signal_fasteners')->first()->values);
        $normatives = json_decode(Configuration::where('code', 'normativa')->first()->values);
        $orientations = json_decode(Configuration::where('code', 'direction')->first()->values);
        $states = json_decode(Configuration::where('code', 'estado')->first()->values);

        return view('verticalsignals.edit-vertical-signal', compact(
                'vsignal',
                'sinventories',
                'materials',
                'fasteners',
                'normatives',
                'orientations',
                'states')
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $vsignal = VerticalSignal::findOrFail($id);

        if ($request->get('latitude') && $vsignal->latitude != $request->input('latitude')) {
            $vsignal->latitude = $request->input('latitude');
        }

        if ($request->get('longitude') && $vsignal->longitude != $request->input('longitude')) {
            $vsignal->longitude = $request->input('longitude');
        }

        if ($request->get('google_address') && $vsignal->google_address != $request->input('google_address')) {
            $vsignal->google_address = $request->input('google_address');
        }

        if ($request->get('comment') && $vsignal->comment != $request->input('comment')) {
            $vsignal->comment = $request->input('comment');
        }

        if ($request->get('orientation') && $vsignal->orientation != $request->input('orientation')) {
            $vsignal->orientation = $request->input('orientation');
        }

        if ($request->get('state') && $vsignal->state != $request->input('state')) {
            $vsignal->state = $request->input('state');
        }

        if ($request->get('normative') && $vsignal->normative != $request->input('normative')) {
            $vsignal->normative = $request->input('normative');
        }

        if ($request->get('fastener') && $vsignal->fastener != $request->input('fastener')) {
            $vsignal->fastener = $request->input('fastener');
        }

        if ($request->get('material') && $vsignal->material != $request->input('material')) {
            $vsignal->material = $request->input('material');
        }

        if ($request->get('erp_code') && $vsignal->erp_code != $request->input('erp_code')) {
            $vsignal->erp_code = $request->input('erp_code');
        }

        if ($request->get('inventory') && $vsignal->signal_id != $request->input('inventory')) {
            $vsignal->signal_id = $request->input('inventory');
        }

        if ($request->get('variation') && $vsignal->variation_id != $request->input('variation')) {
            $vsignal->variation_id = $request->input('variation');
        }

        $old_picture = null;
        $picture_name = null;
        if ($request->input('picture_data')) {
            $picture_data = $request->input('picture_data');

            $ext = null;
            if (strpos($picture_data, 'data:image/jpeg;base64,') === 0) {
                $picture_data = str_replace('data:image/jpeg;base64,', '', $picture_data);
                $ext = '.jpg';
            }
            if (strpos($picture_data, 'data:image/png;base64,') === 0) {
                $picture_data = str_replace('data:image/png;base64,', '', $picture_data);
                $ext = '.png';
            }

            $picture_name = Str::random() . $ext;
            $old_picture = storage_path('app/public_html/signals/' . $vsignal->signal_folder . DIRECTORY_SEPARATOR . $vsignal->picture);
            $picture_data = str_replace(' ', '+', $picture_data);
            $data = base64_decode($picture_data);

            if (!file_put_contents(storage_path('app/public_html/signals/') . $vsignal->signal_folder . DIRECTORY_SEPARATOR . $picture_name, $data)) {
                return back()->with('error', trans('Error guardando la imagen. Inténtelo de nuevo o contacte al administrador.'));
            }

            $vsignal->picture = $picture_name;
        }
        if($vsignal->user_id == Auth::user()->id || Auth::user()->hasRole('atmadmin')){
            $vsignal->user_id = Auth::user()->id;

            if ($vsignal->save()) {
                if ($old_picture) {
                    //no borramos la imagen anterior por respaldo
                   // File::delete($old_picture);
                }

                return redirect('vertical-signals/' . $vsignal->id)->with('success', trans('verticalsignals.updateSuccess'));
            }
        }else{
            return redirect('vertical-signals/' . $vsignal->id)->with('error', trans('No tiene permisos para modificar.'));
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vsignal = VerticalSignal::findOrFail($id);

        if (Auth::user()->hasRole('atmadmin') || $vsignal->user_id == Auth::user()->id) {
            $picture_path = storage_path('app/public_html/signals/') . $vsignal->signal_folder . DIRECTORY_SEPARATOR . $vsignal->picture;
            File::delete($picture_path);
            $vsignal->delete();

            return redirect('vertical-signals')->with('success', trans('verticalsignals.messages.delete-success'));
        }

        return back()->with('error', trans('verticalsignals.messages.delete-error'));
    }

    /**
     * Method to search the users.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $searchTerm = $request->input('vsignal_search_box');
        $searchRules = [
            'vsignal_search_box' => 'required|string|max:255',
        ];
        $searchMessages = [
            'vsignal_search_box.required' => 'Search term is required',
            'vsignal_search_box.string' => 'Search term has invalid characters',
            'vsignal_search_box.max' => 'Search term has too many characters - 255 allowed',
        ];

        $validator = Validator::make($request->all(), $searchRules, $searchMessages);

        if ($validator->fails()) {
            return response()->json([
                json_encode($validator),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $vsignals = VerticalSignal::where('code', 'like', '%' . $searchTerm . '%')
            ->orWhere('erp_code', 'like', '%' . $searchTerm . '%')
            ->orWhere('google_address', 'like', '%' . $searchTerm . '%')
            ->orWhere('state', 'like', '%' . $searchTerm . '%')
            ->orWhere('normative', 'like', '%' . $searchTerm . '%')
            ->orWhere('fastener', 'like', '%' . $searchTerm . '%')
            ->orWhere('material', 'like', '%' . $searchTerm . '%')
            ->orWhere('comment', 'like', '%' . $searchTerm . '%');

        $result = [];
        foreach ($vsignals->get() as $vsignal) {
            $result[] = [
                'id' => $vsignal->id,
                'code' => $vsignal->code,
                'group' => $vsignal->signal_inventory->subgroup->group->name . ' (' . $vsignal->signal_inventory->subgroup->group->code . ')',
                'signal' => $vsignal->signal_inventory->name,
                'erp_code' => $vsignal->erp_code != null ? $vsignal->erp_code : "", 
                'creator' => $vsignal->user->full_name(),
                'state' => $vsignal->state,
                'fastener' => $vsignal->fastener,
                'material' => $vsignal->material,
                'normative' => $vsignal->normative,
                'google_address' => $vsignal->google_address
            ];
        }
       

        return response()->json([
            json_encode($result),
        ], Response::HTTP_OK);
        
        //return $result;
    }

    public function export_xlsx()
    {
        return new VerticalSignalExport();
    }
}
