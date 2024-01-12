<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Drugstore;
use Illuminate\Http\Request;

class DrugstorexPharmacyController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:request.index', ['only' => ['index']]);
        $this->middleware('permission:request.store', ['only' => ['store']]);
    }
    public function index()
    {
        $drugstore = Drugstore::pluck('name', 'id');
        return view('request.index', compact('drugstore'));
    }
}
