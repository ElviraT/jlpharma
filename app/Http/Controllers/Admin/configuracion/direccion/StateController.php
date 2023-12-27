<?php

namespace App\Http\Controllers\Admin\configuracion\direccion;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\State;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class StateController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:states.index|states.create|states.edit|states.destroy', ['only' => ['index', 'store']]);
        $this->middleware('permission:states.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:states.edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:states.destroy', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $countries = Country::get();
        $states = State::orderBy('id', 'ASC')->get();
        return view('admin.configuracion.direccion.estados.index', compact('states', 'countries'));
    }

    public function store(Request $request, State $state)
    {
        try {
            State::create($request->post());

            Toastr::success(__('Record added successfully'), 'Success');
        } catch (\Illuminate\Database\QueryException $e) {
            // dd($e);
            Toastr::error(__('An error occurred please try again'), 'error');
        }
        return to_route('states.index');
    }
    public function edit($id)
    {
        $state = State::find($id);
        return response()->json([$state]);
    }

    public function update(Request $request, $id)
    {
        try {
            $state = State::find($request->id);
            $state->idCountry = $request->idCountry;
            $state->name = ucfirst($request->name);
            $state->save();

            Toastr::success(__('Successfully updated registration'), 'Success');
        } catch (\Illuminate\Database\QueryException $e) {
            Toastr::error(__('An error occurred please try again'), 'error');
        }
        return to_route('states.index');
    }
    public function destroy(State $state)
    {
        $state->delete();
        Toastr::success(__('Registry successfully deleted'), 'Success');
        return to_route('states.index');
    }
}
