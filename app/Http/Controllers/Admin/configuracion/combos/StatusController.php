<?php

namespace App\Http\Controllers\Admin\configuracion\combos;

use App\Http\Controllers\Controller;
use App\Models\Status;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:status.index|status.create|status.edit|status.destroy', ['only' => ['index', 'store']]);
        $this->middleware('permission:status.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:status.edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:status.destroy', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $status = Status::orderBy('id', 'ASC')->get();
        return view('admin.configuracion.combos.status.index', compact('status'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:statuses,name',
            'color' => 'required|unique:statuses,color'
        ]);
        try {
            $status = Status::create($request->post());

            Toastr::success(__('Record added successfully'), 'Success');
        } catch (\Illuminate\Database\QueryException $e) {
            Toastr::error(__('An error occurred please try again'), 'error');
        }
        return to_route('status.index');
    }

    public function edit($id)
    {
        $status = Status::find($id);
        return response()->json([$status]);
    }

    public function update(Request $request, $id)
    {
        try {
            $status = Status::find($id);
            $status->name = $request->name;
            $status->color = $request->color;
            $status->save();

            Toastr::success(__('Successfully updated registration'), 'Success');
        } catch (\Illuminate\Database\QueryException $e) {
            Toastr::error(__('An error occurred please try again'), 'error');
        }
        return to_route('status.index');
    }
    public function destroy(Status $status)
    {
        $status->delete();
        Toastr::success(__('Registry successfully deleted'), 'Success');
        return to_route('status.index');
    }
}
