<?php

namespace App\Http\Controllers\Admin\configuracion\users;

use App\Http\Controllers\Controller;
use App\Mail\NuevoUsuarioMail;
use App\Models\Inventary;
use App\Models\Order;
use App\Models\Product;
use App\Models\Seller;
use App\Models\Status;
use Illuminate\Http\Request;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\DataTables;

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
        return view('admin.configuracion.usuarios.sellers.index');
    }
    public function create()
    {
        $zones = DB::table('zones')
            ->join('cities', 'zones.idCity', '=', 'cities.id')
            ->select('zones.id', DB::raw("CONCAT(cities.name, ' - ' ,zones.name) AS name"))
            ->pluck('name', 'id');
        $status = Status::pluck('name', 'id');
        return view('admin.configuracion.usuarios.sellers.create', compact('zones', 'status'));
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
            Mail::to($request['email'])->send(new NuevoUsuarioMail($user));
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
        // dd($seller);
        $zones = DB::table('zones')
            ->join('cities', 'zones.idCity', '=', 'cities.id')
            ->select('zones.id', DB::raw("CONCAT(cities.name, ' - ' ,zones.name) AS name"))
            ->pluck('name', 'id');
        $status = Status::pluck('name', 'id');
        return view('admin.configuracion.usuarios.sellers.edit', compact('seller', 'zones', 'status'));
    }
    public function update(Request $request)
    {
        try {
            DB::beginTransaction();
            $data_user = [
                "name" => $request['name'],
                "dni" => $request['dni'],
                "status" => $request['idStatus'],
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
                "idstatus" => $request['idStatus'],
            ];
            $seller = Seller::find($request['id']);
            $seller->update($data_seller);

            DB::commit();
            Toastr::success(__('Successfully updated registration'), 'Success');
        } catch (\Illuminate\Database\QueryException $e) {
            // dd($e);
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
    public function getSellerData()
    {
        if (Auth::user()->hasAnyRole('SuperAdmin', 'JL')) {
            $seller = Seller::where('idstatus', 1)->orderBy('id', 'ASC');
        } else {
            $seller = Seller::where('id', auth()->user()->seller->id)->where('idstatus', 1)->orderBy('id', 'ASC');
        }
        return DataTables::of($seller)
            ->addColumn('action', function ($seller) {
                return view('admin.configuracion.usuarios.sellers.partials.actions', compact('seller'));
            })
            ->addColumn('status', function ($seller) {
                return view('admin.configuracion.usuarios.sellers.partials.status', compact('seller'));
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }
}
