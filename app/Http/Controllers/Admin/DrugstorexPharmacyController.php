<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Drugstore;
use App\Models\DrugstorexPharmacy;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DrugstorexPharmacyController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:request.index', ['only' => ['index']]);
        $this->middleware('permission:request.store', ['only' => ['store']]);
        $this->middleware('permission:request.aceptar', ['only' => ['aceptar']]);
        $this->middleware('permission:request.rechazar', ['only' => ['rechazar']]);
    }
    public function index()
    {
        if (Auth::user()->hasRole('Farmacia')) {
            $drugstore = DB::table('users')
                ->whereNotIn('id', function ($query) {
                    $query->select('idDrugstore')
                        ->from('drugstorex_pharmacies');
                })
                ->pluck('name', 'id');
        } else {
            $drugstore = User::where('last_name', 'Droguería')->where('status', 1)->pluck('name', 'id');
        }
        $pharmacies = User::where('last_name', 'Farmacia')->where('status', 1)->pluck('name', 'id');
        return view('request.index', compact('drugstore', 'pharmacies'));
    }

    public function all()
    {
        if (Auth::user()->hasAnyRole('SuperAdmin', 'Vendedor')) {
            $solicitudes = DrugstorexPharmacy::where('permission', 0)->paginate(10);
        } else {
            $solicitudes = DrugstorexPharmacy::where('permission', 0)->where('idDrugstore', auth()->user()->id)->paginate(10);
        }
        return view('request.all', compact('solicitudes'));
    }

    public function store(Request $request)
    {
        $data = [
            'idDrugstore' => $request->idDrugstore,
            'idPharmacy' => $request->idPharmacy,
            'idUser' => Auth::user()->id,
        ];
        try {
            DrugstorexPharmacy::create($data);

            Toastr::success(__('Record added successfully'), 'Success');
        } catch (\Illuminate\Database\QueryException $e) {
            Toastr::error(__('An error occurred please try again'), 'error');
        }
        return to_route('request.index');
    }
    public function aceptar(Request $request)
    {
        $solicitud = DrugstorexPharmacy::where('id', $request->id)->where('permission', 0)->first();
        try {
            DB::beginTransaction();

            $solicitud->permission = 1;
            $solicitud->save();
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
        $solicitud = DrugstorexPharmacy::where('id', $request->id)->where('permission', 0)->first();
        try {
            DB::beginTransaction();

            $solicitud->observation = $request->observation;
            $solicitud->save();
            DB::commit();
            Toastr::success(__('Successfully updated registration'), 'Success');
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            Toastr::error(__('An error occurred please try again'), 'error');
        }
        return to_route('dashboard');
    }
}