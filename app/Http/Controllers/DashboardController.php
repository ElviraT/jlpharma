<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Drugstore;
use App\Models\DrugstorexPharmacy;
use App\Models\Order;
use App\Models\Rate;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:dashboard', ['only' => ['index']]);
    }
    public function index()
    {
        if (Auth::user()->hasAnyRole('SuperAdmin', 'JL', 'Analista')) {
            $pedidos = DB::table('orders')
                ->join('status_pedidos', 'orders.idStatus', '=', 'status_pedidos.id')
                ->select('status_pedidos.id', 'status_pedidos.name', 'status_pedidos.color', DB::raw("COUNT(orders.nOrder) AS count"))
                ->groupBy('status_pedidos.id', 'status_pedidos.name', 'status_pedidos.color')
                ->orderBy('orden', 'ASC')
                ->get();
        } elseif (Auth::user()->hasRole('Vendedor')) {
            $pedidos = DB::table('orders')
                ->join('status_pedidos', 'orders.idStatus', '=', 'status_pedidos.id')
                ->select('status_pedidos.id', 'status_pedidos.name', 'status_pedidos.color', DB::raw("COUNT(orders.nOrder) AS count"))
                ->where('orders.idUser', auth()->user()->id)
                ->groupBy('status_pedidos.id', 'status_pedidos.name', 'status_pedidos.color')
                ->orderBy('orden', 'ASC')
                ->get();
        } else {
            $pedidos = DB::table('orders')
                ->join('status_pedidos', 'orders.idStatus', '=', 'status_pedidos.id')
                ->select('status_pedidos.id', 'status_pedidos.name', 'status_pedidos.color', DB::raw("COUNT(orders.nOrder) AS count"))
                ->where('orders.idReceives', auth()->user()->id)
                ->groupBy('status_pedidos.id', 'status_pedidos.name', 'status_pedidos.color')
                ->orderBy('orden', 'ASC')
                ->get();
        }
        if (Auth::user()->hasAnyRole('SuperAdmin', 'JL', 'Analista')) {
            $user = DB::table('users')
                ->where('users.last_name', '<>', 'web')
                ->select('users.last_name', DB::raw("COUNT(users.last_name) AS count"))
                ->groupBy('users.last_name')
                ->get();
        } elseif (Auth::user()->hasRole('Vendedor')) {
            $user = DB::table('pharmacies')
                ->join('users', 'pharmacies.idUser', '=', 'users.id')
                ->select('users.last_name', DB::raw("COUNT(users.last_name) AS count"))
                ->where('pharmacies.idZone', auth()->user()->seller->idZone)
                ->groupBy('users.last_name')
                ->get();
        } else {
            $user = [];
        }
        $rate = Rate::select('monto')->orderBy('id', 'DESC')->first();
        session(['rate' => $rate->monto]);
        if (Auth::user()->hasAnyRole('SuperAdmin', 'Vendedor')) {
            $solicitudes = DrugstorexPharmacy::where('permission', 0)->take(4)->get();
        } else {
            $solicitudes = DrugstorexPharmacy::where('permission', 0)->where('idDrugstore', auth()->user()->id)->take(4)->get();
        }
        return view('dashboard', compact('pedidos', 'user', 'solicitudes'));
    }
}