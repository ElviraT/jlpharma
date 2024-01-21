<?php

namespace App\Http\Controllers\Admin\configuracion\users;

use App\Http\Controllers\Controller;
use App\Mail\NuevoUsuarioMail;
use App\Models\Jluser;
use Illuminate\Http\Request;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class JluserController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:jluser.index|jluser.create|jluser.edit|jluser.destroy', ['only' => ['index', 'store']]);
        $this->middleware('permission:jluser.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:jluser.edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:jluser.destroy', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $jluser = Jluser::orderBy('id', 'ASC')->get();
        return view('admin.configuracion.usuarios.jlusers.index', compact('jluser'));
    }
    public function create()
    {
        $zones = DB::table('zones')
            ->join('cities', 'zones.idCity', '=', 'cities.id')
            ->select('zones.id', DB::raw("CONCAT(cities.name, ' - ' ,zones.name) AS name"))
            ->pluck('name', 'id');
        return view('admin.configuracion.usuarios.jlusers.create', compact('zones'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $data_user = [
                "name" => $request['name'],
                "last_name" => 'JL',
                "dni" => $request['dni'],
                "email" => $request['email'],
                "password" => Hash::make('12345'),
            ];
            $user = User::create($data_user);
            $user->assignRole([6]);

            $data_jl = [
                "name" => $request['name'],
                "dni" => $request['dni'],
                "telefono" => $request['telefono'],
                "idUser" => $user->id,
                "idZone" => $request['idZone'],
            ];
            Jluser::create($data_jl);
            Mail::to($request['email'])->send(new NuevoUsuarioMail($user));
            DB::commit();
            Toastr::success(__('Record added successfully'), 'Success');
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            Toastr::error(__('An error occurred please try again'), 'error');
        }
        return to_route('jluser.index');
    }

    public function edit(Jluser $jluser)
    {
        $zones = DB::table('zones')
            ->join('cities', 'zones.idCity', '=', 'cities.id')
            ->select('zones.id', DB::raw("CONCAT(cities.name, ' - ' ,zones.name) AS name"))
            ->pluck('name', 'id');
        return view('admin.configuracion.usuarios.jlusers.edit', compact('jluser', 'zones'));
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

            $data_jl = [
                "name" => $request['name'],
                "dni" => $request['dni'],
                "telefono" => $request['telefono'],
                "idUser" => $user->id,
                "idZone" => $request['idZone'],
            ];
            $jluser = Jluser::find($request['id']);
            $jluser->update($data_jl);

            DB::commit();
            Toastr::success(__('Successfully updated registration'), 'Success');
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            Toastr::error(__('An error occurred please try again'), 'error');
        }
        return to_route('jluser.index');
    }

    public function destroy(Jluser $jluser)
    {
        $jluser->delete();
        User::where('id', $jluser->idUser)->delete();
        Toastr::success(__('Registry successfully deleted'), 'Success');
        return to_route('jluser.index');
    }
}
