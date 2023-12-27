<?php

namespace App\Http\Controllers\Admin\configuracion\combos;

use App\Http\Controllers\Controller;
use App\Models\Prefix;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class PrefixController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:prefixes.index|prefixes.create|prefixes.edit|prefixes.destroy', ['only' => ['index', 'store']]);
        $this->middleware('permission:prefixes.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:prefixes.edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:prefixes.destroy', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $prefixes = Prefix::orderBy('id', 'ASC')->get();
        return view('admin.configuracion.combos.prefixes.index', compact('prefixes'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:prefixes,name',
        ]);
        try {
            $prefix = Prefix::create(['name' => $request->input('name')]);

            Toastr::success(__('Record added successfully'), 'Success');
        } catch (\Illuminate\Database\QueryException $e) {
            Toastr::error(__('An error occurred please try again'), 'error');
        }
        return to_route('prefixes.index');
    }

    public function edit($id)
    {
        $prefix = Prefix::find($id);
        return response()->json([$prefix]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|unique:prefixes,name'
        ]);
        try {
            $prefix = Prefix::find($id);
            $prefix->name = $request->input('name');
            $prefix->save();

            Toastr::success(__('Successfully updated registration'), 'Success');
        } catch (\Illuminate\Database\QueryException $e) {
            Toastr::error(__('An error occurred please try again'), 'error');
        }
        return to_route('prefixes.index');
    }
    public function destroy(Prefix $prefix)
    {
        $prefix->delete();
        Toastr::success(__('Registry successfully deleted'), 'Success');
        return to_route('prefixes.index');
    }
}
