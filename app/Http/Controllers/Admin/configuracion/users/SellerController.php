<?php

namespace App\Http\Controllers\Admin\configuracion\users;

use App\Http\Controllers\Controller;
use App\Models\Seller;
use Illuminate\Http\Request;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
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
}