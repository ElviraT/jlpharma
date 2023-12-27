<?php

namespace App\Http\Controllers\Admin\configuracion\direccion;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\State;
use App\Models\Zone;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class ZoneController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:zones.index|zones.create|zones.edit|zones.destroy', ['only' => ['index', 'store']]);
        $this->middleware('permission:zones.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:zones.edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:zones.destroy', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $zones = Zone::orderBy('id', 'ASC')->get();
        $countries = Country::all();
        $states = State::all();
        $cities = City::all();
        return view('admin.configuracion.direccion.zonas.index', compact('zones', 'countries', 'states', 'cities'));
    }


    public function store(Request $request)
    {
        // $this->validate($request, [
        //     'name' => 'required|unique:zones,name',
        //     // 'permission' => 'required',
        // ]);
        try {
            $zone = Zone::create($request->post());

            Toastr::success(__('Record added successfully'), 'Success');
        } catch (\Illuminate\Database\QueryException $e) {
            Toastr::error(__('An error occurred please try again'), 'error');
        }
        return to_route('zones.index');
    }

    public function edit($id)
    {
        $zone = Zone::find($id);
        return response()->json([$zone]);
    }

    public function update(Request $request, $id)
    {
        // $this->validate($request, [
        //     'name' => 'required|unique:zones,name'
        // ]);
        try {
            $zone = Zone::find($id);
            $zone->idCountry = $request->input('idCountry');
            $zone->idState = $request->input('idState');
            $zone->idCity = $request->input('idCity');
            $zone->name = $request->input('name');
            $zone->save();

            Toastr::success(__('Successfully updated registration'), 'Success');
        } catch (\Illuminate\Database\QueryException $e) {
            Toastr::error(__('An error occurred please try again'), 'error');
        }
        return to_route('zones.index');
    }
    public function destroy(Zone $zone)
    {
        $zone->delete();
        Toastr::success(__('Registry successfully deleted'), 'Success');
        return to_route('zones.index');
    }
}