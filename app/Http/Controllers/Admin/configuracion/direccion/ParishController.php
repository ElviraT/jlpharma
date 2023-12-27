<?php

namespace App\Http\Controllers\Admin\configuracion\direccion;

use App\Http\Controllers\Controller;
use App\Models\Municipality;
use App\Models\Parish;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class ParishController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:parishes.index|parishes.create|parishes.edit|parishes.destroy', ['only' => ['index', 'store']]);
        $this->middleware('permission:parishes.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:parishes.edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:parishes.destroy', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $municipalities = Municipality::get();
        $parishes = Parish::orderBy('id', 'ASC')->get();
        return view('admin.configuracion.direccion.parroquias.index', compact('parishes', 'municipalities'));
    }
    public function store(Request $request, Parish $parish)
    {
        try {
            Parish::create($request->post());

            Toastr::success(__('Record added successfully'), 'Success');
        } catch (\Illuminate\Database\QueryException $e) {
            Toastr::error(__('An error occurred please try again'), 'error');
        }
        return to_route('parishes.index');
    }
    public function edit($id)
    {
        $parish = Parish::find($id);
        return response()->json([$parish]);
    }

    public function update(Request $request, $id)
    {
        try {
            $parish = Parish::find($request->id);
            $parish->idMunicipality = $request->idMunicipality;
            $parish->name = ucfirst($request->name);
            $parish->save();

            Toastr::success(__('Successfully updated registration'), 'Success');
        } catch (\Illuminate\Database\QueryException $e) {
            Toastr::error(__('An error occurred please try again'), 'error');
        }
        return to_route('parishes.index');
    }
    public function destroy(Parish $parish)
    {
        $parish->delete();
        Toastr::success(__('Registry successfully deleted'), 'Success');
        return to_route('parishes.index');
    }
}