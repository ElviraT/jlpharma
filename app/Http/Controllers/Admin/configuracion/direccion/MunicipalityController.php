<?php

namespace App\Http\Controllers\Admin\configuracion\direccion;

use App\Http\Controllers\Controller;
use App\Models\Municipality;
use App\Models\State;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class MunicipalityController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:municipality.index|municipality.create|municipality.edit|municipality.destroy', ['only' => ['index', 'store']]);
        $this->middleware('permission:municipality.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:municipality.edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:municipality.destroy', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $states = State::get();
        $municipality = Municipality::orderBy('id', 'ASC')->get();
        return view('admin.configuracion.direccion.municipios.index', compact('municipality', 'states'));
    }
    public function store(Request $request, Municipality $municipality)
    {
        try {
            Municipality::create($request->post());

            Toastr::success(__('Record added successfully'), 'Success');
        } catch (\Illuminate\Database\QueryException $e) {
            Toastr::error(__('An error occurred please try again'), 'error');
        }
        return to_route('municipality.index');
    }
    public function edit($id)
    {
        $municipality = Municipality::find($id);
        return response()->json([$municipality]);
    }

    public function update(Request $request, $id)
    {
        try {
            $municipality = Municipality::find($request->id);
            $municipality->idState = $request->idState;
            $municipality->name = ucfirst($request->name);
            $municipality->save();

            Toastr::success(__('Successfully updated registration'), 'Success');
        } catch (\Illuminate\Database\QueryException $e) {
            Toastr::error(__('An error occurred please try again'), 'error');
        }
        return to_route('municipality.index');
    }
    public function destroy(Municipality $municipality)
    {
        $municipality->delete();
        Toastr::success(__('Registry successfully deleted'), 'Success');
        return to_route('municipality.index');
    }
}