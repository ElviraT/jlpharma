<?php

namespace App\Http\Controllers\Admin\configuracion\combos;

use App\Http\Controllers\Controller;
use App\Models\Sex;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class SexController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:sexes.index|sexes.create|sexes.edit|sexes.destroy', ['only' => ['index', 'store']]);
        $this->middleware('permission:sexes.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:sexes.edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:sexes.destroy', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $sexes = Sex::orderBy('id', 'ASC')->get();
        return view('admin.configuracion.combos.sexos.index', compact('sexes'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:sexes,name',
        ]);
        try {
            $sex = Sex::create(['name' => $request->input('name')]);

            Toastr::success(__('Record added successfully'), 'Success');
        } catch (\Illuminate\Database\QueryException $e) {
            Toastr::error(__('An error occurred please try again'), 'error');
        }
        return to_route('sexes.index');
    }

    public function edit($id)
    {
        $sex = Sex::find($id);
        return response()->json([$sex]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|unique:sexes,name'
        ]);
        try {
            $sex = Sex::find($id);
            $sex->name = $request->input('name');
            $sex->save();

            Toastr::success(__('Successfully updated registration'), 'Success');
        } catch (\Illuminate\Database\QueryException $e) {
            Toastr::error(__('An error occurred please try again'), 'error');
        }
        return to_route('sexes.index');
    }
    public function destroy(Sex $sex)
    {
        $sex->delete();
        Toastr::success(__('Registry successfully deleted'), 'Success');
        return to_route('sexes.index');
    }
}
