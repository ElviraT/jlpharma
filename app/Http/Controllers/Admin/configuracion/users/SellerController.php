<?php

namespace App\Http\Controllers\Admin\configuracion\users;

use App\Http\Controllers\Controller;
use App\Models\Inventary;
use App\Models\Order;
use App\Models\Product;
use App\Models\Seller;
use Illuminate\Http\Request;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SellerController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:seller.index|seller.create|seller.edit|seller.destroy', ['only' => ['index', 'store']]);
        $this->middleware('permission:seller.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:seller.edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:seller.destroy', ['only' => ['destroy']]);
        $this->middleware('permission:seller.aceptar', ['only' => ['aceptar']]);
        $this->middleware('permission:seller.rechazar', ['only' => ['rechazar']]);
    }

    public function index(Request $request)
    {
        $seller = Seller::orderBy('id', 'ASC')->get();
        return view('admin.configuracion.usuarios.sellers.index', compact('seller'));
    }
    public function create()
    {
        $zones = DB::table('zones')
            ->join('cities', 'zones.idCity', '=', 'cities.id')
            ->select('zones.id', DB::raw("CONCAT(cities.name, ' - ' ,zones.name) AS name"))
            ->pluck('name', 'id');
        return view('admin.configuracion.usuarios.sellers.create', compact('zones'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $data_user = [
                "name" => $request['name'],
                "last_name" => 'Vendedor',
                "dni" => $request['dni'],
                "email" => $request['email'],
                "password" => Hash::make('12345'),
            ];
            $user = User::create($data_user);
            $user->assignRole([7]);

            $data_seller = [
                "name" => $request['name'],
                "dni" => $request['dni'],
                "telefono" => $request['telefono'],
                "idUser" => $user->id,
                "idZone" => $request['idZone'],
            ];
            Seller::create($data_seller);

            DB::commit();
            Toastr::success(__('Record added successfully'), 'Success');
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            Toastr::error(__('An error occurred please try again'), 'error');
        }
        return to_route('seller.index');
    }

    public function edit(Seller $seller)
    {
        $zones = DB::table('zones')
            ->join('cities', 'zones.idCity', '=', 'cities.id')
            ->select('zones.id', DB::raw("CONCAT(cities.name, ' - ' ,zones.name) AS name"))
            ->pluck('name', 'id');
        return view('admin.configuracion.usuarios.sellers.edit', compact('seller', 'zones'));
    }
    public function update(Request $request)
    {
        try {
            DB::beginTransaction();
            $data_user = [
                "name" => $request['name'],
                "dni" => $request['dni'],
                "email" => $request['email']
            ];
            $user = User::find($request['idUser']);
            $user->update($data_user);

            $data_seller = [
                "name" => $request['name'],
                "dni" => $request['dni'],
                "telefono" => $request['telefono'],
                "idUser" => $user->id,
                "idZone" => $request['idZone'],
            ];
            $seller = Seller::find($request['id']);
            $seller->update($data_seller);

            DB::commit();
            Toastr::success(__('Successfully updated registration'), 'Success');
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            Toastr::error(__('An error occurred please try again'), 'error');
        }
        return to_route('seller.index');
    }

    public function destroy(Seller $seller)
    {
        $seller->delete();
        User::where('id', $seller->idUser)->delete();
        Toastr::success(__('Registry successfully deleted'), 'Success');
        return to_route('seller.index');
    }

    public function aceptar(Request $request)
    {
        $order = Order::where('id', $request->id)->where('idStatus', 1)->first();
        try {
            DB::beginTransaction();
            foreach ($order->detalle as $value) {
                if (Auth::user()->hasAnyRole('Drogueria', 'Farmacia')) {
                    $stock = Inventary::where('name', $value->name)->where('idUser', $order['idReceives'])->first();
                } else {
                    $stock = Product::where('name', $value->name)->first();
                }
                if (empty($stock) || $stock->quantity < $value['cant']) {
                    DB::rollBack();
                    Toastr::error(__('No hay cantidad suficiente para uno de los productos'), 'error');
                    return to_route('dashboard');
                }
                $data_inventary = [
                    "idProduct" => $value['idProduct'],
                    "name" => $value['name'],
                    "idUser" => $order['idSend'],
                    "quantity" => $value['cant']
                ];
                $inv = Inventary::where('idProduct', $value['idProduct'])->where('idUser', $order['idSend'])->first();
                if (isset($inv)) {
                    $inv->increment('quantity', $value['cant']);
                } else {
                    Inventary::create($data_inventary);
                }

                $order->idStatus = '4';
                $order->save();

                $stock->decrement('quantity', $value['cant']);
            }
            DB::commit();
            Toastr::success(__('Successfully updated registration'), 'Success');
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            Toastr::error(__('An error occurred please try again'), 'error');
        }
        return to_route('dashboard');
    }

    public function rechazar(Request $request)
    {
        $order = Order::where('id', $request->id)->where('idStatus', 1)->first();
        try {
            DB::beginTransaction();

            $order->idStatus = '5';
            $order->observation = $request->observation;
            $order->save();
            DB::commit();
            Toastr::success(__('Successfully updated registration'), 'Success');
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            Toastr::error(__('An error occurred please try again'), 'error');
        }
        return to_route('dashboard');
    }
}