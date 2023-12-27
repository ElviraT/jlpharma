<?php

namespace App\Http\Controllers\Admin\configuracion\direccion;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class CityController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:cities.index|cities.create|cities.edit|cities.destroy', ['only' => ['index', 'store']]);
        $this->middleware('permission:cities.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:cities.edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:cities.destroy', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $countries = Country::get();
        $states = State::get();
        $cities = City::orderBy('id', 'ASC')->get();
        return view('admin.configuracion.direccion.ciudades.index', compact('cities', 'countries', 'states'));
    }

    public function store(Request $request, City $city)
    {
        try {
            City::create($request->post());

            Toastr::success(__('Record added successfully'), 'Success');
        } catch (\Illuminate\Database\QueryException $e) {
            Toastr::error(__('An error occurred please try again'), 'error');
        }
        return to_route('cities.index');
    }
    public function edit($id)
    {
        $city = City::find($id);
        return response()->json([$city]);
    }

    public function update(Request $request, $id)
    {
        try {
            $city = City::find($request->id);
            $city->idCountry = $request->idCountry;
            $city->idState = $request->idState;
            $city->name = ucfirst($request->name);
            $city->save();

            Toastr::success(__('Successfully updated registration'), 'Success');
        } catch (\Illuminate\Database\QueryException $e) {
            Toastr::error(__('An error occurred please try again'), 'error');
        }
        return to_route('cities.index');
    }
    public function destroy(City $city)
    {
        $city->delete();
        Toastr::success(__('Registry successfully deleted'), 'Success');
        return to_route('cities.index');
    }
}
