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
        $products = DevicesInventory::orderby('code', 'asc')->get();
        $storages = Storage::where('status',1)->get();

        if ($pagintaionEnabled) {
            $inventories = $inventories->paginate(config('atm_app.paginateListSize'));
        }

        return View('storages-inventory.show-storage-inventories', compact('inventories', 'inventoriestotal', 'products','storages'));
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
//            'storage_id' => $request->input('storage'),
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
            $groups = DevicesInventory::orderby('id', 'asc')->get();
        $storages = Storage::where('status',1)->get();
            return view('storages-inventory.show-storage-inventory', compact('device','groups','storages'));
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
        $device = StorageInventory::findOrFail($id);
        $products = DevicesInventory::orderby('code', 'asc')->get();
        $storages = Storage::where('status',1)->get();
        if ($device) {
            return view('storages-inventory.edit-storage-inventory', compact('device','products','storages'));
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
            'quantity' => 'required|min:1|max:1000'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $device = StorageInventory::find($id);

        if ($device) {
            if ($request->storage && $request->storage != $device->storage_id) {
                $device->storage_id = $request->storage;
            }

            if ($request->product && $request->product != $device->device_id) {
                $device->device_id = $request->product;
            }

            if ($request->quantity && $request->quantity != $device->quantity) {
                $device->quantity = $request->quantity;
            }
            if ($device->save()) {
                return redirect('storage-inventory/' . $device->id)->with('success', trans('device-inventory.updateSuccess'));
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
