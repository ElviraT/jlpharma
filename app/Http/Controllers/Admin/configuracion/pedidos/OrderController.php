<?php

namespace App\Http\Controllers\Admin\configuracion\pedidos;

use App\Http\Controllers\Controller;
use App\Mail\OrderMail;
use App\Models\Category;
use App\Models\Drugstore;
use App\Models\Inventary;
use App\Models\Jluser;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Pharmacy;
use App\Models\Product;
use App\Models\StatusPedido;
use App\Models\User;
use Barryvdh\DomPDF\Facade as PDF;
use Brian2694\Toastr\Facades\Toastr;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

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
        Session::put('idPara', '');
        Session::put('idDe', '');
        Session::put('De', '');
        Cart::destroy();
        if (Auth::user()->hasRole('Farmacia')) {
            $combo = DB::table('users')
                ->join('drugstorex_pharmacies', 'users.id', '=', 'drugstorex_pharmacies.idDrugstore')
                ->select('users.id AS id', 'users.name AS name')
                ->where('drugstorex_pharmacies.idPharmacy', Auth::user()->id)
                ->where('drugstorex_pharmacies.permission', 1)
                ->pluck('name', 'id');
        } elseif (Auth::user()->hasRole('Drogueria')) {
            $combo = User::where('last_name', 'JL')->pluck('name', 'id');
        } else {
            $combo = [];
        }
        // dd($combo);
        return view('order.index', compact('combo'));
    }

    public function filtro(Request $request)
    {
        // dd($request);
        session(['idPara' => $request->idPara]);
        session(['idDe' => $request->idDe]);
        session(['De' => $request->de]);
        $categorias = Category::paginate(10);

        return view('order.filtro_producto', compact('categorias'));
    }
    public function products($id)
    {
        if (Auth::user()->hasAnyRole('Farmacia', 'Drogueria')) {
            $products = $this->products1($id);
        } else {
            $products = $this->products2($id);
        }

        return view('order.products', compact('products'));
    }

    private function products1($id)
    {
        $idPara = Session::get('idPara');
        $idDe = Session::get('idDe');
        $De = Session::get('De');
        // if (isset($request->idPara)) {
        //     session(['idPara' => $request->idPara]);
        //     session(['idDe' => Auth::user()->id]);
        //     $id = Session::get('idPara');
        // } else {
        //     $id = Session::get('idPara');
        // }
        if (Auth::user()->hasRole('Farmacia')) {
            $data['products'] =  DB::table('inventaries')
                ->join('products', 'inventaries.idProduct', 'products.id')
                ->select('*')
                ->where('inventaries.idUser', $idPara)
                ->where('products.idCategory', $id)
                ->paginate(10);
            $data['para'] = $idPara;
            $data['de'] = Auth::user()->id;
        } elseif (Auth::user()->hasRole('Droguería')) {
            $data['products'] = Product::where('idCategory', $id)->paginate(10);
            $data['para'] = $idPara;
            $data['de'] = Auth::user()->id;
        }
        $data['categoria'] = $id;
        return $data;
    }
    private function products2($id)
    {
        // if (isset($request->idPara)) {
        //     session(['idPara' => $request->idPara]);
        //     session(['idDe' => $request->idDe]);
        //     session(['De' => $request->de]);
        //     $idPara = Session::get('idPara');
        //     $idDe = Session::get('idDe');
        //     $De = Session::get('De');
        // } else {
        //     $idPara = Session::get('idPara');
        //     $idDe = Session::get('idDe');
        //     $De = Session::get('De');
        // }
        $idPara = Session::get('idPara');
        $idDe = Session::get('idDe');
        $De = Session::get('De');
        if ($De == 'Farmacia') {
            $data['products'] = DB::table('inventaries')
                ->join('products', 'inventaries.idProduct', 'products.id')
                ->select('*')
                ->where('inventaries.idUser', $idPara)
                ->where('products.idCategory', $id)
                ->paginate(10);

            $data['para'] = $idPara;
            $data['de'] = $idDe;
        } else {
            $data['products'] = Product::where('idCategory', $id)->paginate(10);
            $data['para'] = $idPara;
            $data['de'] = $idDe;
        }
        $data['categoria'] = $id;
        return $data;
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
        return to_route('order.products', $request->idCategoria);
    }
    public function update($id, $cant)
    {
        $ok = Cart::update($id, $cant);
        return $ok;
    }
    public function checkout()
    {
        $status = StatusPedido::all();
        $combo = Auth::user()->getRoleNames();
        $idReceives = Session::get('idPara');
        $idSend = Session::get('idDe');
        return view('order.checkout', compact('combo', 'idReceives', 'idSend', 'status'));
    }
    public function send(Request $request)
    {
        $nombre = $this->getIniciales($request['nOrder']);
        $norden = strtoupper($nombre) . date('dmYHis');
        try {
            $item = [
                'nOrder' =>  $norden,
                'idSend' => $request['idSend'],
                'idReceives' => $request['idReceives'],
                'idUser' => auth()->user()->id,
                'total' => $request['total'],
                'idStatus' => $request['idStatus'],
                'observation' => $request['observation']
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
    private function getIniciales($nombre)
    {
        // Obtener iniciales del primer nombre
        $iniciales = '';
        $cont = 0;
        $palabras = explode(' ', $nombre);
        foreach ($palabras as $palabra) {
            if (count($palabras) === 1) {
                $iniciales .= strtoupper($palabra[0]) . strtoupper($palabra[1]);
            } else {
                if ($cont <= 1) {
                    $iniciales .= strtoupper($palabra[0]);
                }
                $cont++;
            }
        }

        return $iniciales;
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
        $status = StatusPedido::all();
        return view('order.detalle', compact('order', 'status'));
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

    public function info($id)
    {
        $data['pedido'] = Order::find($id);
        $data['detalle'] = $data['pedido']->detalle;

        if (isset($data['pedido']->userSend->drugstore)) {
            $data['order'] = DB::table('users')
                ->join('orders', 'users.id', '=', 'orders.idSend')
                ->join('drugstores', 'orders.idSend', '=', 'drugstores.idUser')
                ->join('contacts', 'drugstores.id', '=', 'contacts.iddrugstore')
                ->select('users.last_name AS segmento', 'users.email', 'orders.nOrder', 'orders.observation', 'drugstores.name AS rs', 'drugstores.telefono', 'drugstores.rif', 'drugstores.sada', 'drugstores.sicm', 'drugstores.direccion', 'contacts.name AS c_nombre', 'contacts.last_name AS c_apellido')
                ->where('orders.id', $id)
                ->first();
        } else {
            $data['order'] = DB::table('users')
                ->join('orders', 'users.id', '=', 'orders.idSend')
                ->join('pharmacies', 'orders.idSend', '=', 'pharmacies.idUser')
                ->join('contacts', 'pharmacies.id', '=', 'contacts.idPharmacy')
                ->select('users.last_name AS segmento', 'users.email', 'orders.nOrder', 'orders.observation', 'pharmacies.name AS rs', 'pharmacies.telefono', 'pharmacies.rif', 'pharmacies.sada', 'pharmacies.sicm', 'pharmacies.direccion', 'contacts.name AS c_nombre', 'contacts.last_name AS c_apellido')
                ->where('orders.id', $id)
                ->first();
        }
        $data['vendedor'] = $data['pedido']->user->seller;
        return $data;
    }

    public function pdf(Request $request)
    {
        $order = $this->info($request->id);
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('order.pedido_pdf', ['order' => $order]);
        return $pdf->download('pedido-' . $order['pedido']->nOrder . '.pdf');
    }
}
