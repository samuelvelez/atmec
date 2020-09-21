<?php

namespace App\Http\Controllers;

use App\Exports\IntersectionExport;
use App\Models\Intersection;
use App\Models\Configuration;
use App\Models\VerticalSignal;
use App\Models\SignalStreet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

use DB;
use Image;


class IntersectionController extends Controller
{
    public function get_folder()
    {
        $folders = Intersection::select('folder as folder_name', DB::raw('count(folder) as folder_count'))
            ->groupBy('folder')
            ->havingRaw('COUNT(folder) < ' . env('APP_MAX_FOLDER_COUNT', 9998))
            ->get();

        if ($folders->count() > 0) {
            foreach ($folders as $dir) {
                $folder = $dir->folder_name;

                if ($folder != null && File::isDirectory(storage_path('app/public_html/intersections/') . $folder)
                    && count(File::files(storage_path('app/public_html/intersections/') . $folder)) < env('APP_MAX_FOLDER_COUNT', 9998)) {
                    return $folder;
                }
            }
        }

        $folder = Str::random();
        if (File::makeDirectory(storage_path('app/public_html/intersections/') . $folder)) {
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagintaionEnabled = config('atm_app.enablePagination');
        $intersections = Intersection::orderby('updated_at', 'desc');
        $intersectionstotal = Intersection::count();

        if ($pagintaionEnabled) {
            $intersections = $intersections->paginate(config('atm_app.paginateListSize'));
        }

        return View('intersections.show-intersections', compact('intersections', 'intersectionstotal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parishs = json_decode(Configuration::where('code', 'parish')->first()->values);
           $direction_unifieds = SignalStreet::select('id','DIRECCION_UNIFICADA')->where('DIRECCION_UNIFICADA','like','%%')->get();
        return view('intersections.create-intersection', compact('parishs','direction_unifieds'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), Intersection::rules());

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

            if (!file_put_contents(storage_path('app/public_html/intersections/') . $folder . DIRECTORY_SEPARATOR . $picture_name, $data)) {
                return back()->with('error', trans('Error guardando la imagen. Inténtelo de nuevo o contacte al administrador.'));
            }
        }

        $intersection = Intersection::create([
            'main_st' => $request->input('main_st'),
            'cross_st' => $request->input('cross_st'),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
            'google_address' => $request->input('google_address'),
            'folder' => $folder,
            'image' => $picture_name,
            'parish' => $request->input('parish'),
            'name'  => $request->input('main_st')." y ".$request->input('cross_st'),
            'comment' => $request->input('comment'),
            'street1' => $request->input('street1'),
            'street2' => $request->input('street2'),
        ]);

        if ($intersection) {
            return redirect('intersections/' . $intersection->id)->with('success', trans('intersections.createSuccess'));
        }

        return back()->with('error', trans('Error creando la intersección. Inténtelo de nuevo o contacte al administrador.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $intersection = Intersection::find($id);
        return view('intersections.show-intersection', compact('intersection'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $intersection = Intersection::find($id);
        $parishs = json_decode(Configuration::where('code', 'parish')->first()->values);
        
        return view('intersections.edit-intersection', compact('intersection', 'parishs'));
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
        $intersection = Intersection::findOrFail($id);

        if ($request->get('latitude') && $intersection->latitude != $request->input('latitude')) {
            $intersection->latitude = $request->input('latitude');
        }

        if ($request->get('longitude') && $intersection->longitude != $request->input('longitude')) {
            $intersection->longitude = $request->input('longitude');
        }

        if ($request->get('google_address') && $intersection->google_address != $request->input('google_address')) {
            $intersection->google_address = $request->input('google_address');
        }

        if ($request->get('comment') && $intersection->comment != $request->input('comment')) {
            $intersection->comment = $request->input('comment');
        }

        if ($request->get('name') && $intersection->name != $request->input('name')) {
            $intersection->name = $request->input('name');
        }

        if ($request->get('main_st') && $intersection->main_st != $request->input('main_st')) {
            $intersection->main_st = $request->input('main_st');
        }

        if ($request->get('cross_st') && $intersection->cross_st != $request->input('cross_st')) {
            $intersection->cross_st = $request->input('cross_st');
        }

        if ($request->get('parish') && $intersection->parish != $request->input('parish')) {
            $intersection->parish = $request->input('parish');
        }

        if($request->get('picture_data')){
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

                if (!file_put_contents(storage_path('app/public_html/intersections/') . $folder . DIRECTORY_SEPARATOR . $picture_name, $data)) {
                    return back()->with('error', trans('Error guardando la imagen. Inténtelo de nuevo o contacte al administrador.'));
                }
                $intersection->folder = $folder;
                $intersection->image = $picture_name;
            }
        }
        if ($intersection->save()) {
            return redirect('intersections/' . $intersection->id)->with('success', trans('verticalsignals.message.update-intersection-success'));
        }

       

        return back()->with('error', trans('verticalsignals.message.update-intersection-error'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $intersection = Intersection::findOrFail($id);

        if (Auth::user()->hasRole('atmadmin')) {
            $intersection->delete();
            return redirect('intersections')->with('success', trans('intersections.messages.delete-success'));
        }

        return back()->with('error', trans('verticalsignals.messages.delete-error'));
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('intersection_search_box');
        $searchRules = [
            'intersection_search_box' => 'required|string|max:255',
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

        $intersections = Intersection::where('main_st', 'like', '%' . $searchTerm . '%')
            ->orWhere('cross_st', 'like', '%' . $searchTerm . '%')->get();

        return response()->json([
            json_encode($intersections),
        ], Response::HTTP_OK);
    }

    public function export_xlsx()
    {
        return new IntersectionExport();
    }

    /*public function today()
    {
        return response()->json(Intersection::where('updated_at', '>=', Carbon::today())->get(), Response::HTTP_OK);
    }

    public function all()
    {
        return response()->json(Intersection::all(), Response::HTTP_OK);
    }*/
}
