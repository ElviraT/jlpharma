<?php

namespace App\Http\Controllers\Admin\configuracion\direccion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Country;

class CountryController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:countries.index|countries.create|countries.edit|countries.destroy', ['only' => ['index', 'store']]);
        $this->middleware('permission:countries.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:countries.edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:countries.destroy', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $countries = Country::orderBy('id', 'ASC')->get();
        return view('admin.configuracion.direccion.paises.index', compact('countries'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:countries,name',
            // 'permission' => 'required',
        ]);
        try {
            $country = Country::create(['name' => $request->input('name')]);

            Toastr::success(__('Record added successfully'), 'Success');
        } catch (\Illuminate\Database\QueryException $e) {
            Toastr::error(__('An error occurred please try again'), 'error');
        }
        return to_route('countries.index');
    }

    public function edit($id)
    {
        $country = Country::find($id);
        return response()->json([$country]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|unique:countries,name'
        ]);
        try {
            $country = Country::find($id);
            $country->name = $request->input('name');
            $country->save();

            Toastr::success(__('Successfully updated registration'), 'Success');
        } catch (\Illuminate\Database\QueryException $e) {
            Toastr::error(__('An error occurred please try again'), 'error');
        }
        return to_route('countries.index');
    }
    public function destroy(Country $country)
    {
        $country->delete();
        Toastr::success(__('Registry successfully deleted'), 'Success');
        return to_route('countries.index');
    }
}
