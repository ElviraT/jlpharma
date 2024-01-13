<?php

namespace App\Http\Controllers\Admin\configuracion\pedidos;

use App\Http\Controllers\Controller;
use App\Mail\OrderMail;
use App\Models\Drugstore;
use App\Models\Inventary;
use App\Models\Jluser;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Pharmacy;
use App\Models\Product;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:order.index|order.create|order.checkout|order.remove|order.clear', ['only' => ['index', 'store']]);
        $this->middleware('permission:order.store', ['only' => ['create', 'store']]);
        $this->middleware('permission:order.checkout', ['only' => ['checkout', 'update']]);
        $this->middleware('permission:order.remove', ['only' => ['remove']]);
        $this->middleware('permission:order.clear', ['only' => ['clear']]);
        $this->middleware('permission:order.state', ['only' => ['state']]);
    }

    public function index(Request $request)
    {
        // $products = Product::all();
        if (Auth::user()->hasRole('Farmacia')) {
            $combo = DB::table('users')
                ->join('drugstorex_pharmacies', 'users.id', '=', 'drugstorex_pharmacies.idDrugstore')
                ->select('users.id AS id', 'users.name AS name')
                ->where('drugstorex_pharmacies.idPharmacy', Auth::user()->id)
                ->where('drugstorex_pharmacies.permission', 1)
                ->pluck('name', 'id');
        } elseif (Auth::user()->hasRole('Droguería')) {
            $combo = User::where('last_name', 'JL')->pluck('name', 'id');
        }

        return view('order.index', compact('combo'));
    }

    public function products($id)
    {
        if (Auth::user()->hasRole('Farmacia') && isset($id)) {
            $products = Inventary::where('idUser', $id)->get();
            $drogueria = $id;
        } elseif (Auth::user()->hasRole('Droguería')) {
            $products = Product::all();
            $drogueria = 0;
        }
        return view('order.products', compact('products', 'drogueria'));
    }

    public function store(Request $request)
    {
        if ($request->inventary != 0) {
            $products = Inventary::where('idProduct', $request->id)->first();
            $cant = $request->cant;
            if (empty($products)) {
                return to_route('order.index');
            } else {
                Cart::add(
                    $products->id,
                    $products->name,
                    $cant,
                    $products->price,
                    ['image' => $products->product->img]
                );
            }
        } else {
            $products = Product::find($request->id);
            $cant = $request->cant;
            if (empty($products)) {
                return to_route('order.index');
            } else {
                Cart::add(
                    $products->id,
                    $products->name,
                    $cant,
                    $products->price_dg,
                    ['image' => $products->img]
                );
            }
        }
        Toastr::success('Producto agregado: ' . $products->name, 'Success');
        return to_route('order.products', $request->inventary);
    }
    public function checkout()
    {
        $pedido = Order::select('nOrder')->orderBy('id', 'desc')->first();
        $combo = Auth::user()->getRoleNames();
        return view('order.checkout', compact('pedido', 'combo'));
    }
    public function send(Request $request)
    {
        try {
            $item = [
                'nOrder' => $request['nOrder'],
                'idSend' => $request['idSend'],
                'idReceives' => $request['idReceives'],
                'idUser' => auth()->user()->id,
                'total' => $request['total']
            ];
            $order = Order::create($item);
            for ($i = 0; $i < count($request['name']); $i++) {
                $detalle = [
                    'idOrder' => $order['id'],
                    'idProduct' => $request['idProduct'][$i],
                    'name' => $request['name'][$i],
                    'cant' => $request['cant'][$i],
                    'price' => $request['price'][$i],
                    'importe' => $request['importe'][$i],
                ];
                OrderDetail::create($detalle);
            }
            $receiver = User::where('id', $request['idReceives'])->first();
            Mail::to($receiver->email)->send(new OrderMail($order));
            Cart::destroy();
            Toastr::success('Pedido solicitado con exito', 'Success');
        } catch (\Throwable $th) {
            Toastr::error('Intente de nuevo', 'error');
        }
        return to_route('order.index');
    }
    public function remove(Request $request)
    {
        Cart::remove($request->id);

        Toastr::success('Item eliminado', 'Success');
        return redirect()->back();
    }
    public function clear()
    {
        Cart::destroy();
        Toastr::success('Pedido Vacio', 'Success');
        return redirect()->back();
    }

    public function pedido(Request $request)
    {

        return to_route('order.index');
    }

    public function detalle(Order $order)
    {
        return view('order.detalle', compact('order'));
    }
    public function state()
    {
        if (Auth::user()->hasAnyRole('SuperAdmin', 'JL')) {
            $order = Order::all();
        } else {
            $order = Order::where('idSend', Auth::user()->id)->get();
        }
        return view('order.state', compact('order'));
    }
}