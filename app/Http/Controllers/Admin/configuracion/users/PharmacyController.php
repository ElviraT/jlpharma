<?php

namespace App\Http\Controllers\Admin\configuracion\users;

use App\Http\Controllers\Controller;
use App\Mail\NuevoUsuarioMail;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Models\Pharmacy;
use App\Models\Status;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class PharmacyController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:pharmacy.index|pharmacy.create|pharmacy.edit|pharmacy.destroy', ['only' => ['index', 'store']]);
        $this->middleware('permission:pharmacy.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:pharmacy.edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:pharmacy.destroy', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if (Auth::user()->hasAnyRole('SuperAdmin', 'JL')) {
            $pharmacy = Pharmacy::where('idstatus', 1)->orderBy('id', 'ASC')->paginate(10);
        } else if (Auth::user()->hasAnyRole('Vendedor')) {
            $pharmacy = Pharmacy::where('idstatus', 1)->where('idZone', Auth::user()->seller->idZone)->orderBy('id', 'ASC')->paginate(10);
        } else {
            $pharmacy = Pharmacy::where('idUser', auth()->user()->id)->where('idstatus', 1)->orderBy('id', 'ASC')->paginate(10);
        }

        return view('admin.configuracion.usuarios.pharmacy.index', compact('pharmacy'));
    }
    public function create()
    {
        // $zones = Zone::pluck('name', 'id');
        $zones = DB::table('zones')
            ->join('cities', 'zones.idCity', '=', 'cities.id')
            ->select('zones.id', DB::raw("CONCAT(cities.name, ' - ' ,zones.name) AS name"))
            ->pluck('name', 'id');
        $status = Status::pluck('name', 'id');
        return view('admin.configuracion.usuarios.pharmacy.create', compact('zones', 'status'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $data_user = [
                "name" => $request['name'],
                "last_name" => 'Centro de Salud',
                "dni" => $request['rif'],
                "email" => $request['email'],
                "password" => Hash::make('12345'),
            ];
            $user = User::create($data_user);
            $user->assignRole([3]);

            $data_farmacia = [
                "name" => $request['name'],
                "rif" => $request['rif'],
                "sada" => $request['sada'],
                "sicm" => $request['sicm'],
                "telefono" => $request['telefono'],
                "direccion" => $request['direccion'],
                "idUser" => $user->id,
                "idZone" => $request['idZone'],
            ];
            $pharmacy = Pharmacy::create($data_farmacia);
            $data_contacto = [
                "idPharmacy" => $pharmacy->id,
                "name" => $request['namec'],
                "last_name" => $request['last_name'],
                "telephone" => $request['telephone'],
                "telephone2" => $request['telephone2'],
            ];
            Contact::create($data_contacto);
            Mail::to($request['email'])->send(new NuevoUsuarioMail($user));
            DB::commit();
            Toastr::success(__('Record added successfully'), 'Success');
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            Toastr::error(__('An error occurred please try again'), 'error');
        }
        return to_route('pharmacy.index');
    }

    public function edit(Pharmacy $pharmacy)
    {
        $zones = DB::table('zones')
            ->join('cities', 'zones.idCity', '=', 'cities.id')
            ->select('zones.id', DB::raw("CONCAT(cities.name, ' - ' ,zones.name) AS name"))
            ->pluck('name', 'id');
        $status = Status::pluck('name', 'id');
        return view('admin.configuracion.usuarios.pharmacy.edit', compact('pharmacy', 'zones', 'status'));
    }
    public function update(Request $request)
    {
        try {
            DB::beginTransaction();
            $data_user = [
                "name" => $request['name'],
                "last_name" => 'Farmacia',
                "dni" => $request['rif'],
                "status" => $request['idStatus'],
                "email" => $request['email'],
            ];
            $user = User::find($request['idUser']);
            $user->update($data_user);

            $data_farmacia = [
                "name" => $request['name'],
                "rif" => $request['rif'],
                "sada" => $request['sada'],
                "sicm" => $request['sicm'],
                "telefono" => $request['telefono'],
                "direccion" => $request['direccion'],
                "idUser" => $user->id,
                "idZone" => $request['idZone'],
                "idstatus" => $request['idStatus'],
            ];
            $pharmacy = Pharmacy::find($request['id']);
            $pharmacy->update($data_farmacia);
            $data_contacto = [
                "idPharmacy" => $request['id'],
                "name" => $request['namec'],
                "last_name" => $request['last_name'],
                "telephone" => $request['telephone'],
                "telephone2" => $request['telephone2'],
            ];
            $contact = Contact::where('idPharmacy', $request['id'])->first();
            $contact->update($data_contacto);

            DB::commit();
            Toastr::success(__('Successfully updated registration'), 'Success');
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            Toastr::error(__('An error occurred please try again'), 'error');
        }
        return to_route('pharmacy.index');
    }

    public function destroy(Pharmacy $pharmacy)
    {
        Contact::where('idPharmacy', $pharmacy->id)->delete();
        $pharmacy->delete();
        User::where('id', $pharmacy->idUser)->delete();
        Toastr::success(__('Registry successfully deleted'), 'Success');
        return to_route('pharmacy.index');
    }
}
