<?php

namespace App\Http\Controllers\Admin\configuracion\pedidos;

use App\Http\Controllers\Controller;
use App\Models\Drugstore;
use App\Models\Jluser;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Pharmacy;
use App\Models\Product;
use Brian2694\Toastr\Facades\Toastr;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $products = Product::all();
        $pharmacy = Pharmacy::pluck('name', 'id');
        $drugstore = Drugstore::pluck('name', 'id');
        $jl = Jluser::pluck('name', 'id');
        return view('order.index', compact('products', 'pharmacy', 'drugstore', 'jl'));
    }

    public function store(Request $request)
    {
        $products = Product::find($request->id);
        $cant = $request->cant;
        if (empty($products)) {
            return to_route('order.index');
        } else {
            Cart::add(
                $products->id,
                $products->name,
                $cant,
                $products->price_tf,
                ['image' => $products->img]
            );
        }
        Toastr::success('Producto agregado: ' . $products->name, 'Success');
        return to_route('order.index');
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
                    'name' => $request['name'][$i],
                    'cant' => $request['cant'][$i],
                    'price' => $request['price'][$i],
                    'importe' => $request['importe'][$i],
                ];
                OrderDetail::create($detalle);
            }

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
