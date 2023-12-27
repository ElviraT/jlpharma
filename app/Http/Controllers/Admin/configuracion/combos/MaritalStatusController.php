<?php

namespace App\Http\Controllers\Admin\configuracion\combos;

use App\Http\Controllers\Controller;
use App\Models\MaritalStatus;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class MaritalStatusController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:maritalStatus.index|maritalStatus.create|maritalStatus.edit|maritalStatus.destroy', ['only' => ['index', 'store']]);
        $this->middleware('permission:maritalStatus.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:maritalStatus.edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:maritalStatus.destroy', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $maritalStatuses = MaritalStatus::orderBy('id', 'ASC')->get();
        return view('admin.configuracion.combos.civil.index', compact('maritalStatuses'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:marital_statuses,name',
        ]);
        try {
            $maritalStatus = MaritalStatus::create(['name' => $request->input('name')]);

            Toastr::success(__('Record added successfully'), 'Success');
        } catch (\Illuminate\Database\QueryException $e) {
            Toastr::error(__('An error occurred please try again'), 'error');
        }
        return to_route('maritalStatus.index');
    }

    public function edit($id)
    {
        $maritalStatus = MaritalStatus::find($id);
        return response()->json([$maritalStatus]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|unique:marital_statuses,name'
        ]);
        try {
            $maritalStatus = MaritalStatus::find($id);
            $maritalStatus->name = $request->input('name');
            $maritalStatus->save();

            Toastr::success(__('Successfully updated registration'), 'Success');
        } catch (\Illuminate\Database\QueryException $e) {
            Toastr::error(__('An error occurred please try again'), 'error');
        }
        return to_route('maritalStatus.index');
    }
    public function destroy(MaritalStatus $maritalStatus)
    {
        $maritalStatus->delete();
        Toastr::success(__('Registry successfully deleted'), 'Success');
        return to_route('maritalStatus.index');
    }
}
