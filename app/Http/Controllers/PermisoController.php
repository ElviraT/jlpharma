<?php

namespace App\Http\Controllers;

use App\Events\PermisoEvent;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Permiso;
use App\Models\StatusPedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PermisoController extends Controller
{
    public function index()
    {
        $status = StatusPedido::orderBy('orden', 'ASC')->get();
        return view('order.cambio_estado', compact('status'));
    }
    public function enviarNotificacion(Request $request)
    {

        $data = [
            'idPedido' => $request->id,
            'vendedor' => Auth::user()->name,
            'cliente' => $request->cliente,
            'pedido' => $request->pedido

        ];
        $permiso = Permiso::create($data);
        event(new PermisoEvent($permiso));

        return redirect(url()->previous());
    }
    public function cambio($id, $leer)
    {
        $status = StatusPedido::orderBy('orden', 'ASC')->get();


        $resultado = DB::table('orders')
            ->join('status_pedidos', 'orders.idStatus', '=', 'status_pedidos.id')
            ->select('status_pedidos.orden', 'orders.*')
            ->where('status_pedidos.orden', 2)
            ->where('orders.id', $id)
            ->first();
        if (!isset($resultado)) {
            return to_route('dashboard');
        } else {
            return view('order.cambio_estado', compact('resultado', 'status'));
        }
    }
}