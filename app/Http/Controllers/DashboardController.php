<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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
            $pedidos = Order::where('idStatus', 1)->get();
        } else {
            $pedidos = Order::where('idReceives', Auth::user()->id)->where('idStatus', 1)->get();
        }

        $user = User::select('id')->where('last_name', '<>', 'web')->get();
        return view('dashboard', compact('pedidos', 'user'));
    }
}
