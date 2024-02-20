<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Municipality;
use App\Models\Parish;
use App\Models\State;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ComboController extends Controller
{
    public function state($country)
    {
        $states = State::select(['id', 'name'])->where('idCountry', $country)->get();
        return response()->json($states);
    }

    public function city($state)
    {
        $cities = City::select(['id', 'name'])->where('idState', $state)->get();
        return response()->json($cities);
    }

    public function municipality($state)
    {
        $municipalities = Municipality::select(['id', 'name'])->where('idState', $state)->get();
        return response()->json($municipalities);
    }

    public function parish($municipality)
    {
        $municipalities = Parish::select(['id', 'name'])->where('idMunicipality', $municipality)->get();
        return response()->json($municipalities);
    }
    public function pedido($pedido)
    {
        if (is_numeric($pedido)) {
            $result = DB::table('users')
                ->join('drugstorex_pharmacies', 'users.id', '=', 'drugstorex_pharmacies.idDrugstore')
                ->select('users.id AS id', 'users.name AS name')
                ->where('drugstorex_pharmacies.idPharmacy', $pedido)
                ->where('drugstorex_pharmacies.permission', 1)
                ->get();
        } else {
            if (Auth::user()->hasAnyRole('Vendedor') && $pedido == 'Droguería') {
                $result = DB::table('users')
                    ->join('drugstores', 'users.id', '=', 'drugstores.idUser')
                    ->select('users.id AS id', 'users.name AS name')
                    ->where('drugstores.idZone', auth()->user()->seller->idZone)
                    ->where('users.status', 1)
                    ->get();
            }
            if (Auth::user()->hasAnyRole('Vendedor') && $pedido == 'Farmacia') {
                $result = DB::table('users')
                    ->join('pharmacies', 'users.id', '=', 'pharmacies.idUser')
                    ->select('users.id AS id', 'users.name AS name')
                    ->where('pharmacies.idZone', auth()->user()->seller->idZone)
                    ->where('users.status', 1)
                    ->get();
            }
            if (Auth::user()->hasAnyRole('Vendedor') && $pedido == 'JL') {
                $result = User::select(['id', 'name'])
                    ->where('name', 'LIKE', '%' . $pedido . '%')
                    ->where('status', 1)
                    ->get();
            } else {
                $result = User::select(['id', 'name'])
                    ->where('last_name', $pedido)
                    ->get();
            }
        }
        return response()->json($result);
    }
    public function user($iduser)
    {
        $user = User::select(['name'])->where('id', $iduser)->first();
        return response()->json($user);
    }
}
