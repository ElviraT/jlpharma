<?php

namespace App\Http\Controllers\Admin\configuracion\users;

use App\Http\Controllers\Controller;
use App\Mail\NuevoUsuarioMail;
use App\Models\Drugstore;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Status;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Mail;

class DrugstoreController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:drugstore.index|drugstore.create|drugstore.edit|drugstore.destroy', ['only' => ['index', 'store']]);
        $this->middleware('permission:drugstore.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:drugstore.edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:drugstore.destroy', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        return view('admin.configuracion.usuarios.drugstore.index');
    }
    public function create()
    {
        $zones = DB::table('zones')
            ->join('cities', 'zones.idCity', '=', 'cities.id')
            ->select('zones.id', DB::raw("CONCAT(cities.name, ' - ' ,zones.name) AS name"))
            ->pluck('name', 'id');
        $status = Status::pluck('name', 'id');
        return view('admin.configuracion.usuarios.drugstore.create', compact('zones', 'status'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $data_user = [
                "name" => $request['name'],
                "last_name" => 'Droguería',
                "dni" => $request['rif'],
                "email" => $request['email'],
                "password" => Hash::make('12345'),
            ];
            $user = User::create($data_user);
            $user->assignRole([4]);

            $data_drogueria = [
                "name" => $request['name'],
                "rif" => $request['rif'],
                "sada" => $request['sada'],
                "sicm" => $request['sicm'],
                "telefono" => $request['telefono'],
                "direccion" => $request['direccion'],
                "idUser" => $user->id,
                "idZone" => $request['idZone'],
            ];
            $drugstore = Drugstore::create($data_drogueria);

            $data_contacto = [
                "iddrugstore" => $drugstore->id,
                "name" => $request['namec'],
                "last_name" => $request['last_name'],
                "telephone" => $request['telephone'],
                "telephone2" => $request['telephone2'],
            ];
            Contact::create($data_contacto);
            // Mail::to($request['email'])->send(new NuevoUsuarioMail($user));
            DB::commit();
            Toastr::success(__('Record added successfully'), 'Success');
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            if ($e->getCode() == 23000) {
                Toastr::error(__('Duplicate entry'), 'error');
            } else {
                Toastr::error(__('An error occurred please try again'), 'error');
            }
        }
        return to_route('drugstore.index');
    }

    public function edit(Drugstore $drugstore)
    {
        $zones = DB::table('zones')
            ->join('cities', 'zones.idCity', '=', 'cities.id')
            ->select('zones.id', DB::raw("CONCAT(cities.name, ' - ' ,zones.name) AS name"))
            ->pluck('name', 'id');
        $status = Status::pluck('name', 'id');
        return view('admin.configuracion.usuarios.drugstore.edit', compact('drugstore', 'zones', 'status'));
    }
    public function update(Request $request)
    {
        try {
            DB::beginTransaction();
            $data_user = [
                "name" => $request['name'],
                "dni" => $request['rif'],
                "status" => $request['idStatus'],
                "email" => $request['email'],
            ];
            $user = User::find($request['idUser']);
            $user->update($data_user);

            $data_drogueria = [
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
            $drugstore = Drugstore::find($request['id']);
            $drugstore->update($data_drogueria);
            $data_contacto = [
                "iddrugstore" => $request['id'],
                "name" => $request['namec'],
                "last_name" => $request['last_name'],
                "telephone" => $request['telephone'],
                "telephone2" => $request['telephone2'],
            ];
            $contact = Contact::where('iddrugstore', $request['id'])->first();
            $contact->update($data_contacto);

            DB::commit();
            Toastr::success(__('Successfully updated registration'), 'Success');
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            Toastr::error(__('An error occurred please try again'), 'error');
        }
        return to_route('drugstore.index');
    }

    public function destroy(Drugstore $drugstore)
    {
        Contact::where('iddrugstore', $drugstore->id)->delete();
        $drugstore->delete();
        User::where('id', $drugstore->idUser)->delete();
        Toastr::success(__('Registry successfully deleted'), 'Success');
        return to_route('drugstore.index');
    }

    public function getDrugstoreData()
    {
        if (Auth::user()->hasAnyRole('SuperAdmin', 'JL')) {
            $drugstore = Drugstore::where('idstatus', 1)->orderBy('id', 'ASC');
        } else if (Auth::user()->hasAnyRole('Vendedor')) {
            $drugstore = Drugstore::where('idstatus', 1)->orderBy('id', 'ASC')->where('idZone', Auth::user()->seller->idZone);
        } else {
            $drugstore = Drugstore::where('idUser', auth()->user()->id)->orderBy('id', 'ASC');
        }
        return DataTables::of($drugstore)
            ->addColumn('action', function ($drugstore) {
                return view('admin.configuracion.usuarios.drugstore.partials.actions', compact('drugstore'));
            })
            ->addColumn('status', function ($drugstore) {
                return view('admin.configuracion.usuarios.drugstore.partials.status', compact('drugstore'));
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }
}