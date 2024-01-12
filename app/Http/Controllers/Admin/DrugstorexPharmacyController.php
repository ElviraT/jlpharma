<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Drugstore;
use App\Models\DrugstorexPharmacy;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DrugstorexPharmacyController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:request.index', ['only' => ['index']]);
        $this->middleware('permission:request.store', ['only' => ['store']]);
    }
    public function index()
    {
        $drugstore = User::where('last_name', 'Droguería')->where('status', 1)->pluck('name', 'id');
        return view('request.index', compact('drugstore'));
    }

    public function store(Request $request)
    {
        $data = [
            'idDrugstore' => $request->idDrugstore,
            'idPharmacy' => Auth::user()->id,
        ];
        try {
            DrugstorexPharmacy::create($data);

            Toastr::success(__('Record added successfully'), 'Success');
        } catch (\Illuminate\Database\QueryException $e) {
            Toastr::error(__('An error occurred please try again'), 'error');
        }
        return to_route('request.index');
    }
}
