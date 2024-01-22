<?php

namespace App\Http\Controllers\Admin\configuracion\productos;

use App\Http\Controllers\Controller;
use App\Models\Mark;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class MarkController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:mark.index', ['only' => ['index']]);
        $this->middleware('permission:mark.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:mark.edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:mark.destroy', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $mark = Mark::orderBy('id', 'ASC')->get();
        return view('admin.configuracion.productos.mark.index', compact('mark'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:marks,name'
        ]);
        try {
            Mark::create($request->post());

            Toastr::success(__('Record added successfully'), 'Success');
        } catch (\Illuminate\Database\QueryException $e) {
            Toastr::error(__('An error occurred please try again'), 'error');
        }
        return to_route('mark.index');
    }

    public function edit($id)
    {
        $mark = Mark::find($id);
        return response()->json([$mark]);
    }

    public function update(Request $request, $id)
    {
        try {
            $mark = Mark::find($id);
            $mark->name = $request->name;
            $mark->save();

            Toastr::success(__('Successfully updated registration'), 'Success');
        } catch (\Illuminate\Database\QueryException $e) {
            Toastr::error(__('An error occurred please try again'), 'error');
        }
        return to_route('mark.index');
    }
    public function destroy(Mark $mark)
    {
        $mark->delete();
        Toastr::success(__('Registry successfully deleted'), 'Success');
        return to_route('mark.index');
    }
}
