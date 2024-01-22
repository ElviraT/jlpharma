<?php

namespace App\Http\Controllers\Admin\configuracion\combos;

use App\Http\Controllers\Controller;
use App\Models\StatusPedido;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class StatusPedidoController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:statusp.index|statusp.create|statusp.edit|statusp.destroy', ['only' => ['index', 'store']]);
        $this->middleware('permission:statusp.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:statusp.edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:statusp.destroy', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $status = StatusPedido::orderBy('orden', 'ASC')->get();
        return view('admin.configuracion.combos.statusp.index', compact('status'));
    }


    public function store(Request $request)
    {
        try {
            $status = StatusPedido::create($request->post());

            Toastr::success(__('Record added successfully'), 'Success');
        } catch (\Illuminate\Database\QueryException $e) {
            Toastr::error(__('An error occurred please try again'), 'error');
        }
        return to_route('statusp.index');
    }

    public function edit($id)
    {
        $status = StatusPedido::find($id);
        return response()->json([$status]);
    }

    public function update(Request $request, $id)
    {
        try {
            $status = StatusPedido::find($id);
            $status->name = $request->name;
            $status->color = $request->color;
            $status->orden = $request->orden;
            $status->save();

            Toastr::success(__('Successfully updated registration'), 'Success');
        } catch (\Illuminate\Database\QueryException $e) {
            Toastr::error(__('An error occurred please try again'), 'error');
        }
        return to_route('statusp.index');
    }
    public function destroy(StatusPedido $statusp)
    {
        $statusp->delete();
        Toastr::success(__('Registry successfully deleted'), 'Success');
        return to_route('statusp.index');
    }
}
