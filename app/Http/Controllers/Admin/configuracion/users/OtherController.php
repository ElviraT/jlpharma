<?php

namespace App\Http\Controllers\Admin\configuracion\users;

use App\Http\Controllers\Controller;
use App\Mail\NuevoUsuarioMail;
use App\Models\Other;
use App\Models\Status;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;

class OtherController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:other.index', ['only' => ['index']]);
        $this->middleware('permission:other.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:other.edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:other.destroy', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $other = Other::where('idstatus', 1)->orderBy('id', 'ASC')->paginate(10);
        return view('admin.configuracion.usuarios.others.index', compact('other'));
    }
    public function create()
    {
        $zones = DB::table('zones')
            ->join('cities', 'zones.idCity', '=', 'cities.id')
            ->select('zones.id', DB::raw("CONCAT(cities.name, ' - ' ,zones.name) AS name"))
            ->pluck('name', 'id');
        $roles = Role::where('name', '<>', 'SuperAdmin')->pluck('name', 'id');
        $status = Status::pluck('name', 'id');
        return view('admin.configuracion.usuarios.others.create', compact('zones', 'roles', 'status'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $data_user = [
                "name" => $request['name'],
                "last_name" => 'Latinfarma',
                "dni" => $request['dni'],
                "email" => $request['email'],
                "password" => Hash::make('12345'),
            ];
            $user = User::create($data_user);
            $user->assignRole([$request['role']]);

            $data_other = [
                "name" => $request['name'],
                "dni" => $request['dni'],
                "telefono" => $request['telefono'],
                "idUser" => $user->id,
                "idZone" => $request['idZone'],
            ];
            Other::create($data_other);
            Mail::to($request['email'])->send(new NuevoUsuarioMail($user));
            DB::commit();
            Toastr::success(__('Record added successfully'), 'Success');
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            Toastr::error(__('An error occurred please try again'), 'error');
        }
        return to_route('other.index');
    }

    public function edit(Other $other)
    {
        $zones = DB::table('zones')
            ->join('cities', 'zones.idCity', '=', 'cities.id')
            ->select('zones.id', DB::raw("CONCAT(cities.name, ' - ' ,zones.name) AS name"))
            ->pluck('name', 'id');
        $status = Status::pluck('name', 'id');
        $roles = Role::where('name', '<>', 'SuperAdmin')->pluck('name', 'id');
        return view('admin.configuracion.usuarios.others.edit', compact('other', 'zones', 'status', 'roles'));
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

            $data_other = [
                "name" => $request['name'],
                "dni" => $request['dni'],
                "telefono" => $request['telefono'],
                "idUser" => $user->id,
                "idZone" => $request['idZone'],
                "idstatus" => $request['idStatus'],
            ];
            $other = Other::find($request['id']);
            $other->update($data_other);

            DB::commit();
            Toastr::success(__('Successfully updated registration'), 'Success');
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            Toastr::error(__('An error occurred please try again'), 'error');
        }
        return to_route('other.index');
    }

    public function destroy(Other $other)
    {
        $other->delete();
        User::where('id', $other->idUser)->delete();
        Toastr::success(__('Registry successfully deleted'), 'Success');
        return to_route('other.index');
    }
}
