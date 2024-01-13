<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Drugstore;
use App\Models\DrugstorexPharmacy;
use App\Models\Order;
use App\Models\User;
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
        if (Auth::user()->hasAnyRole('SuperAdmin', 'JL')) {
            $pedidos = Order::where('idStatus', 1)->paginate(8);
        } else {
            $pedidos = Order::where('idReceives', Auth::user()->id)->where('idStatus', 1)->paginate(8);
        }
        $solicitud = DrugstorexPharmacy::where('idDrugstore', Auth::user()->id)
            ->where('permission', 0)
            ->where('observation', null)
            ->paginate(8);

        $user = User::select('id')->where('last_name', '<>', 'web')->get();
        return view('dashboard', compact('pedidos', 'user', 'solicitud'));
    }
}
