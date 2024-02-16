<?php

namespace App\Http\Controllers\Admin\configuracion\productos;

use App\Http\Controllers\Controller;
use App\Models\Inventary;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class MisProductosController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:mis_productos.index|mis_productos.edit', ['only' => ['index']]);
        $this->middleware('permission:mis_productos.edit', ['only' => ['edit', 'update']]);
    }
    public function index()
    {

        return view('admin.configuracion.productos.mis_productos.index');
    }
    public function getProductData()
    {
        return DataTables::of(Inventary::orderBy('name', 'asc'))
            ->addColumn('action', function ($product) {
                return view('admin.configuracion.productos.mis_productos.partials.actions', compact('product'));
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function edit($id)
    {
        $product = Inventary::find($id);
        return response()->json([$product]);
    }

    public function store(Request $request)
    {
        try {
            $product = Inventary::find($request->id);
            $product->update($request->post());

            Toastr::success(__('Successfully updated registration'), 'Success');
        } catch (\Illuminate\Database\QueryException $e) {
            Toastr::error(__('An error occurred please try again'), 'error');
        }
        return to_route('mis_productos.index');
    }
}
