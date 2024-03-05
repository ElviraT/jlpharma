<?php

namespace App\Http\Controllers\Admin\configuracion\pedidos;

use App\Http\Controllers\Controller;
use App\Mail\OrderMail;
use App\Models\Category;
use App\Models\Inventary;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Rate;
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

    public function index()
    {
        if (session('orden') != '') {
            Cart::destroy();
            Session::forget('orden');
        }
        if (Auth::user()->hasRole('Farmacia')) {
            $combo = DB::table('users')
                ->join('drugstorex_pharmacies', 'users.id', '=', 'drugstorex_pharmacies.idDrugstore')
                ->select('users.id AS id', 'users.name AS name')
                ->where('drugstorex_pharmacies.idPharmacy', auth()->user()->id)
                ->where('drugstorex_pharmacies.permission', 1)
                ->pluck('name', 'id');
        } elseif (Auth::user()->hasRole('Drogueria')) {
            $combo = User::where('name', 'LIKE', '%JL%')->pluck('name', 'id');
        } else {
            $combo = [];
        }

        return view('order.index', compact('combo'));
    }

    public function filtro(Request $request)
    {
        if (isset($request->de)) {
            session(['idPara' => $request->idPara]);
            session(['idDe' => $request->idDe]);
            session(['De' => $request->de]);
        }
        $categorias = Category::paginate(10);

        return view('order.filtro_producto', compact('categorias'));
    }
    public function products($id, $idProduct)
    {
        if (session('De') == 'Centro de Salud') {
            $products = $this->products1($id, $idProduct);
            $combo = DB::table('inventaries')
                ->join('products', 'inventaries.idProduct', 'products.id')
                ->select('inventaries.name AS name', 'inventaries.id AS id')
                ->where('products.idCategory', $id)
                ->where('inventaries.idUser', session('idPara'))
                ->pluck('name', 'id');
        } else {
            $products = $this->products2($id, $idProduct);
            $combo = Product::where('idCategory', $id)->where('available', 1)->pluck('name', 'id');
        }
        session(['idCategory' => $id]);
        $categoria = session('idCategory');
        return view('order.products', compact('products', 'combo', 'categoria'));
    }

    private function products1($id, $idProduct)
    {
        if ($idProduct  == 'null') {
            $data['products'] = DB::table('inventaries')
                ->join('products', 'inventaries.idProduct', 'products.id')
                ->select('inventaries.id', 'inventaries.name', 'inventaries.price AS price_dg', 'inventaries.quantity', 'products.description', 'products.codigo', 'products.img', 'products.idCategory')
                ->where('inventaries.idUser', session('idPara'))
                ->where('products.idCategory', $id)
                ->orderBy('inventaries.name', 'ASC')
                ->paginate(10);
        } else {
            $data['products'] = DB::table('inventaries')
                ->join('products', 'inventaries.idProduct', 'products.id')
                ->select('inventaries.id', 'inventaries.name', 'inventaries.price AS price_dg', 'inventaries.quantity', 'products.description', 'products.codigo', 'products.img', 'products.idCategory')
                ->where('inventaries.idUser', session('idPara'))
                ->where('products.idCategory', $id)
                ->where('inventaries.id', $idProduct)
                ->orderBy('inventaries.name', 'ASC')
                ->paginate(10);
        }

        $data['idde'] = session('idDe');
        $data['de'] = session('De');
        $data['categoria'] = $id;
        $data['para'] = session('idPara');
        return $data;
    }
    private function products2($id, $idProduct)
    {
        if ($idProduct  == 'null') {
            $data['products'] = Product::where('idCategory', $id)
                ->where('available', 1)
                ->orderBy('name', 'ASC')
                ->paginate(10);
        } else {
            $data['products'] = Product::where('idCategory', $id)
                ->where('available', 1)
                ->where('id', $idProduct)
                ->orderBy('name', 'ASC')
                ->paginate(10);
        }

        $data['idde'] = session('idDe');
        $data['de'] = session('De');
        $data['categoria'] = $id;
        $data['para'] = session('idPara');
        return $data;
    }

    public function store(Request $request)
    {
        for ($i = 0; $i < count($request->id); $i++) {
            if ($request->cant[$i] != null) {
                if ($request->cliente == 'Farmacia') {
                    $products = Inventary::where('id', $request->id[$i])->first();
                    $cant = $request->cant[$i];
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
                    $products = Product::find($request->id[$i]);
                    $cant = $request->cant[$i];
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
            }
        }
        Toastr::success('Producto agregado', 'Success');
        return redirect('./order/products/' . $request->idCategoria . '/null');
    }
    public function update($id, $cant)
    {
        $ok = Cart::update($id, $cant);
        return $ok;
    }
    public function checkout()
    {
        $status = StatusPedido::orderBy('orden', 'ASC')->get();
        $idReceives = session('idPara');
        $idSend = session('idDe');
        $idCategory = session('idCategory');
        $dolar = Rate::select('monto')->orderBy('id', 'DESC')->first();
        return view('order.checkout', compact('idReceives', 'idSend', 'status', 'idCategory', 'dolar'));
    }
    public function send(Request $request)
    {
        $nombre = $this->getIniciales($request['nOrder']);
        $norden = strtoupper($nombre) . date('dmYHis');
        try {
            DB::beginTransaction();
            $item = [
                'nOrder' =>  $norden,
                'idSend' => $request['idSend'],
                'idReceives' => $request['idReceives'],
                'idUser' => auth()->user()->id,
                'total' => $request['total'],
                'total_bs' => str_replace(',', '', $request['total_bs']),
                'idStatus' => $request['idStatus'],
                'observation' => $request['observation']
            ];
            $order = Order::create($item);
            $recibe = User::where('id', $request['idReceives'])->first();
            for ($i = 0; $i < count($request['name']); $i++) {
                $importe = 0;
                $importe = $request['cant'][$i] * $request['price'][$i];
                $comprobar = $this->comprobar_stock($request['idProduct'][$i], $request['cant'][$i], $request['idReceives']);
                if ($comprobar) {
                    $detalle = [
                        'idOrder' => $order['id'],
                        'idProduct' => $request['idProduct'][$i],
                        'name' => $request['name'][$i],
                        'cant' => $request['cant'][$i],
                        'price' => $request['price'][$i],
                        'importe' => $importe,
                        'importe_bs' => str_replace(',', '', $request['importe_bs'][$i]),
                    ];
                    if ($recibe->last_name == 'Droguería') {
                        $product = Inventary::where('id', $request['idProduct'][$i])
                            ->where('idUser', $request['idReceives'])
                            ->first();
                    } else {
                        $product = Product::where('id', $request['idProduct'][$i])->first();
                    }
                    $product->decrement('quantity', $request['cant'][$i]);
                    OrderDetail::create($detalle);
                } else {
                    Toastr::error(__('Producto sin stock:' . $request['name'][$i]), 'error');
                    DB::rollBack();
                    return redirect(url()->previous());
                }
            }
            $receiver = User::where('id', $request['idReceives'])->first();
            Mail::to($receiver->email)->send(new OrderMail($order));
            Cart::destroy();
            Session::forget('idPara');
            Session::forget('idDe');
            Session::forget('De');
            Session::forget('idCategory');
            DB::commit();
            Toastr::success('Pedido solicitado con exito', 'Success');
        } catch (\Throwable $th) {
            DB::rollBack();
            Toastr::error('Intente de nuevo', 'error');
            return redirect(url()->previous());
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
        $status = StatusPedido::orderBy('orden', 'ASC')->get();
        return view('order.detalle', compact('order', 'status'));
    }
    public function state($id)
    {
        $status = StatusPedido::orderBy('orden', 'ASC')->get();
        if (Auth::user()->hasAnyRole('SuperAdmin', 'JL')) {
            $order = Order::where('idStatus', $id)->paginate(10);
        } elseif (Auth::user()->hasAnyRole('Drogueria')) {
            $order = Order::where('idReceives', Auth::user()->id)->where('idStatus', $id)->paginate(10);
        } else {
            $order = Order::where('idUser', Auth::user()->id)->where('idStatus', $id)->paginate(10);
        }
        return view('order.state', compact('order', 'status'));
    }

    public function info($id)
    {
        $data['pedido'] = Order::find($id);
        $data['detalle'] = $data['pedido']->detalle;

        if ($data['pedido']->userSend->last_name == 'Droguería') {
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

    public function pdf($id)
    {
        $order = $this->info($id);
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('order.pedido_pdf', ['order' => $order]);
        return $pdf->stream('pedido-' . $order['pedido']->nOrder . '.pdf');
        // return $pdf->download('pedido-' . $order['pedido']->nOrder . '.pdf');
    }
    public function destroyCart($id)
    {
        if (Session::get('orden') != '') {
            Cart::destroy();
            Session::forget('orden');
        }
        return to_route('order.edit', $id);
    }
    public function edit(Order $order)
    {
        $comporbar =  Cart::content()->groupBy('id');
        if (count($comporbar) == 0) {
            foreach ($order->detalle as $products) {
                Cart::add(
                    $products->idProduct,
                    $products->name,
                    $products->cant,
                    $products->price,
                    ['image' => $products->prod->img]
                );
            }
        } else {
            foreach (Cart::content() as $item) {
                foreach ($order->detalle as $products) {
                    if (!isset($comporbar[$products->idProduct])) {
                        Cart::add(
                            $products->idProduct,
                            $products->name,
                            $products->cant,
                            $products->price,
                            ['image' => $products->prod->img]
                        );
                    }
                }
            }
        }
        $idCategory = $order->detalle[0]->prod->idCategory;
        $status = StatusPedido::orderBy('orden', 'ASC')->get();
        session(['orden' => $order->id]);
        $id = $order->id;
        $dolar = Rate::select('monto')->orderBy('id', 'DESC')->first();
        return view('order.edit', compact('idCategory', 'status', 'id', 'dolar', 'order'));
    }
    public function update_pedido($idOrder, $id, $cant, $idCar)
    {
        $stock = Product::where('id', $id)->first();
        if ($stock->quantity <  $cant) {
            return "No hay suficiente stock para agregar este producto a la orden";
        } else {
            session(['idCar' => $idCar]);
            Cart::update($idCar, $cant);
            Session::put('idCar', '');
            return 'Registro ACTUALIZADO con exito';
        }
    }
    public function aceptar(Request $request)
    {
        $order = Order::where('id', $request->id)->first();
        $recibe = User::where('id', $order['idSend'])->first();
        $detalle = OrderDetail::where('idOrder', $request->id)->get();
        try {
            DB::beginTransaction();
            if ($recibe->last_name == 'Droguería') {
                for ($i = 0; $i < count($detalle); $i++) {

                    $product = Inventary::where('idProduct', $detalle[$i]['idProduct'])
                        ->where('idUser', $order['idSend'])
                        ->first();
                    if (isset($product)) {
                        $product->increment('quantity', $detalle[$i]['cant']);
                    } else {
                        $inventary = new Inventary();
                        $inventary->idProduct = $detalle[$i]['idProduct'];
                        $inventary->name = $detalle[$i]['name'];
                        $inventary->idUser = $order['idSend'];
                        $inventary->quantity = $detalle[$i]['cant'];
                        $inventary->save();
                    }
                }
            }

            $order->idStatus = $request['idStatus'];
            $order->save();
            DB::commit();
            Toastr::success(__('Successfully updated registration'), 'Success');
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            Toastr::error(__('An error occurred please try again'), 'error');
        }
        return redirect(url()->previous());
    }

    public function cambiar(Request $request)
    {
        if (auth()->user()->unreadNotifications) {
            $this->leer($request->leer);
        }

        $order = Order::find($request->id);
        $order->idStatus = $request['idStatus'];
        $order->save();
        return redirect(url()->previous());
    }
    private function leer($id)
    {
        auth()->user()->unreadNotifications
            ->when($id, function ($query) use ($id) {
                return $query->where('id',  $id);
            })->markAsRead();
    }

    public function rechazar(Request $request)
    {
        $order = Order::where('id', $request->id)->first();
        $recibe = User::where('id', $order['idReceives'])->first();
        $detalle = OrderDetail::where('idOrder', $request->id)->get();
        try {
            DB::beginTransaction();

            $order->idStatus = $request['idStatus'];
            $order->observation = $request->observation;
            $order->save();
            for ($i = 0; $i < count($detalle); $i++) {
                if ($recibe->last_name == 'Droguería') {
                    $product = Inventary::where('idProduct', $detalle[$i]['idProduct'])
                        ->where('idUser', $order['idReceives'])
                        ->first();
                } else {
                    $product = Product::where('id', $detalle[$i]['idProduct'])->first();
                }
                $product->increment('quantity', $detalle[$i]['cant']);
            }
            DB::commit();
            Toastr::success(__('Successfully updated registration'), 'Success');
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            Toastr::error(__('An error occurred please try again'), 'error');
        }
        return redirect(url()->previous());
    }
    public function actualizar(Request $request)
    {
        try {
            DB::beginTransaction();
            $orden = Order::where('id', $request->id)->first();
            $recibe = User::where('id', $orden['idReceives'])->first();
            for ($i = 0; $i < count($orden->detalle); $i++) {
                if (isset($orden->detalle[$i]['idProduct'])) {
                    if ($recibe->last_name == 'Droguería') {
                        $itemP = Inventary::where('idProduct', $orden->detalle[$i]['idProduct'])
                            ->where('idUser', $orden['idReceives'])
                            ->first();
                    } else {
                        $itemP = Product::where('id', $orden->detalle[$i]['idProduct'])->first();
                    }
                    $itemP->increment('quantity', $orden->detalle[$i]['cant']);
                }
            }
            $delete = OrderDetail::where('idOrder', $orden->id);
            $delete->delete();
            $total = 0;
            for ($i = 0; $i < count($request['name']); $i++) {
                $importe = 0;
                $importe = $request['cant'][$i] * $request['price'][$i];
                $comprobar = $this->comprobar_stock($request['idProduct'][$i], $request['cant'][$i], $orden['idReceives']);
                if ($comprobar) {
                    $detalle = [
                        'idOrder' => $orden['id'],
                        'idProduct' => $request['idProduct'][$i],
                        'name' => $request['name'][$i],
                        'cant' => $request['cant'][$i],
                        'price' => $request['price'][$i],
                        'importe' => $importe,
                        'importe_bs' => str_replace(',', '', $request['importe_bs'][$i]),
                    ];
                    if ($recibe->last_name == 'Droguería') {
                        $product = Inventary::where('id', $request['idProduct'][$i])
                            ->where('idUser', $request['idReceives'])
                            ->first();
                    } else {
                        $product = Product::where('id', $request['idProduct'][$i])->first();
                    }
                    // $product = Product::where('id', $request['idProduct'][$i])->first();
                    $product->decrement('quantity', $request['cant'][$i]);
                    $total = $total + $importe;
                    OrderDetail::create($detalle);
                } else {
                    Toastr::error(__('Producto sin stock:' . $request['name'][$i]), 'error');
                    DB::rollBack();
                    return redirect(url()->previous());
                }
            }
            $totales = [
                'total' => $total,
                'total_bs' => str_replace(',', '', $request['total_bs']),
            ];
            $orden->update($totales);
            $orden->save();
            DB::commit();
            $receiver = User::where('id', $request['idReceives'])->first();
            // Mail::to($receiver->email)->send(new OrderMail($orden));
            Session::put('idCar', '');
            Session::put('orden', '');
            Cart::destroy();

            Toastr::success('Pedido solicitado con exito', 'Success');
        } catch (\Throwable $th) {
            DB::rollBack();
            Toastr::error('Intente de nuevo', 'error');
        }
        return to_route('order.state', $orden->idStatus);
    }
    private function comprobar_stock($dProduct, $cant, $receiver)
    {
        $recibe = User::where('id', $receiver)->first();
        if ($recibe->last_name == 'Droguería') {
            $stock = Inventary::where('id', $dProduct)
                ->where('idUser', $receiver)
                ->first();
        } else {
            $stock = Product::where('id', $dProduct)->first();
        }
        if ($stock->quantity  < $cant) {
            return false;
        } else {
            return true;
        }
    }
}
