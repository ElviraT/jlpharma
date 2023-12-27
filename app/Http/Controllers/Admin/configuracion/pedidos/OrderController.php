<?php

namespace App\Http\Controllers\Admin\configuracion\pedidos;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Brian2694\Toastr\Facades\Toastr;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:order.index|order.create|order.checkout|order.remove|order.clear', ['only' => ['index', 'store']]);
        $this->middleware('permission:order.store', ['only' => ['create', 'store']]);
        $this->middleware('permission:order.checkout', ['only' => ['checkout', 'update']]);
        $this->middleware('permission:order.remove', ['only' => ['remove']]);
        $this->middleware('permission:order.clear', ['only' => ['clear']]);
    }

    public function index(Request $request)
    {
        $products = Product::all();
        return view('order.index', compact('products'));
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
        return view('order.checkout');
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
}
