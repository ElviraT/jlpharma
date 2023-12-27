<?php

namespace App\Http\Controllers\Admin\configuracion\productos;

use App\Http\Controllers\Controller;
use App\Models\Speciality;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class SpecialityController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:speciality.index|speciality.create|speciality.edit|speciality.destroy', ['only' => ['index', 'store']]);
        $this->middleware('permission:speciality.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:speciality.edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:speciality.destroy', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $speciality = Speciality::orderBy('id', 'ASC')->get();
        return view('admin.configuracion.productos.speciality.index', compact('speciality'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:specialities,name',
        ]);
        try {
            Speciality::create($request->post());

            Toastr::success(__('Record added successfully'), 'Success');
        } catch (\Illuminate\Database\QueryException $e) {
            Toastr::error(__('An error occurred please try again'), 'error');
        }
        return to_route('speciality.index');
    }

    public function edit($id)
    {
        $speciality = Speciality::find($id);
        return response()->json([$speciality]);
    }

    public function update(Request $request, $id)
    {
        try {
            $speciality = Speciality::find($id);
            $speciality->name = $request->name;
            $speciality->save();

            Toastr::success(__('Successfully updated registration'), 'Success');
        } catch (\Illuminate\Database\QueryException $e) {
            Toastr::error(__('An error occurred please try again'), 'error');
        }
        return to_route('speciality.index');
    }
    public function destroy(Speciality $speciality)
    {
        $speciality->delete();
        Toastr::success(__('Registry successfully deleted'), 'Success');
        return to_route('speciality.index');
    }
}
