<?php

namespace App\Http\Controllers;

use App\Models\StorageInventory;
use App\Models\Storage;
use App\Models\DevicesInventory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class StorageInventoryController extends Controller
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
        $inventoriestotal = StorageInventory::count();
        $inventories = StorageInventory::orderby('id', 'asc');

        if ($pagintaionEnabled) {
            $inventories = $inventories->paginate(config('atm_app.paginateListSize'));
        }

        return View('storages-inventory.show-storage-inventories', compact('inventories', 'inventoriestotal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $storages = Storage::where('status',1)->get();
        $products = DevicesInventory::orderby('code', 'asc')->get();
        return View('storages-inventory.create-storage-inventory', compact('storages', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        

        $storage_inventory = StorageInventory::create([
            'storage_id' => $request->input('storage'),
            'device_id' => $request->input('product'),
            'quantity' => $request->input('quantity'),
            
        ]);

        if ($storage_inventory) {
            return redirect('storage-inventory/' . $storage_inventory->id)->with('success', trans('Producto agregado a la bodega'));
        }

        return back()->with('error', trans('Ocurrio un Error'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $device = StorageInventory::findOrFail($id);

        if ($device) {
            return view('storage-inventory.show-storage-inventory', compact('device'));
        }

        return back()->with('error', trans('Ocurrio un Error al mostrar el detalle'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $device = DevicesInventory::findOrFail($id);

        if ($device) {
            return view('devices-inventory.edit-device-inventory', compact('device'));
        }

        return back()->with('error', trans('device-inventory.messages.show-error'));
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
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:1|max:100'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $device = DevicesInventory::find($id);

        if ($device) {
            if ($request->name && $request->name != $device->name_id) {
                $device->name = $request->name;
            }

            if ($request->erp_code && $request->erp_code != $device->erp_code_id) {
                $device->erp_code = $request->erp_code;
            }

            if ($request->dimensions && $request->dimensions != $device->dimensions_id) {
                $device->dimensions = $request->dimensions;
            }

            $device_name = null;
            $old_symbol = null;
            if ($request->hasFile('symbol')) {
                $symbol = $request->file('symbol');
                $device_name = $device->code . '.' . $symbol->getClientOriginalExtension();

                if ($device->symbol) {
                    $old_symbol = storage_path('app/public_html//inventory/devices/' . $device->symbol);
                    File::delete($old_symbol);
                }
                $symbol->storeAs('inventory/devices/', $device_name);

                $device->symbol = $device_name;
            }

            if ($device->save()) {
                return redirect('devices-inventory/' . $device->id)->with('success', trans('device-inventory.updateSuccess'));
            }
        }

        return back()->with('error', trans('device-inventory.messages.update-error'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $device = StorageInventory::findOrFail($id);

        if ($device) {
            $device->delete();
            return redirect('storage-inventory')->with('success', trans('Producto Eliminado correctamente'));
        }

        return back()->with('error', trans('device-inventory.messages.delete-error'));
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('device_search_box');
        $searchRules = [
            'device_search_box' => 'required|string|max:255',
        ];
        $searchMessages = [
            'device_search_box.required' => 'Search term is required',
            'device_search_box.string' => 'Search term has invalid characters',
            'device_search_box.max' => 'Search term has too many characters - 255 allowed',
        ];

        $validator = Validator::make($request->all(), $searchRules, $searchMessages);

        if ($validator->fails()) {
            return response()->json([
                json_encode($validator),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $result = DevicesInventory::where('code', 'like', '%' . $searchTerm . '%')
            ->orWhere('name', 'like', '%' . $searchTerm . '%')
            ->orWhere('dimensions', 'like', '%' . $searchTerm . '%')
            ->orWhere('erp_code', 'like', '%' . $searchTerm . '%')->get();

        return response()->json([
            json_encode($result),
        ], Response::HTTP_OK);
    }
}
