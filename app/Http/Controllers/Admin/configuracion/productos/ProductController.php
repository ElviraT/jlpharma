<?php

namespace App\Http\Controllers\Admin\configuracion\productos;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    const UPLOAD_PATH = 'productos';
    function __construct()
    {
        $this->middleware('permission:product.index|product.create|product.edit|product.destroy', ['only' => ['index', 'store']]);
        $this->middleware('permission:product.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:product.edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:product.destroy', ['only' => ['destroy']]);
    }
    public function index()
    {
        $product = Product::orderBy('id', 'ASC')->get();
        $codigo = Product::select('codigo')->orderBy('id', 'desc')->first();
        $categories = Category::all();

        return view('admin.configuracion.productos.producto.index', compact('product', 'categories', 'codigo'));
    }

    public function store(Request $request)
    {
        try {
            $ruta = $this->_procesarArchivo($request);
            $img    = array('img' => $ruta);
            $resultado = array_merge($request->post(), $img);
            Product::create($resultado);

            Toastr::success(__('Record added successfully'), 'Success');
        } catch (\Illuminate\Database\QueryException $e) {
            Toastr::error(__('An error occurred please try again'), 'error');
        }
        return to_route('product.index');
    }
    public function separadorDirectorios($path)
    {
        return str_replace(['\\', '/'], DIRECTORY_SEPARATOR, $path);
    }
    private function _procesarArchivo(Request $request)
    {
        if ($request->hasFile('img')) {
            $tmp = $request->file('img');
            if ($tmp->isValid()) {
                $extension = $tmp->extension();
                $name = Str::slug($request->name) . '.' . $extension;
                $ruta = $tmp->storeAs(
                    self::UPLOAD_PATH,
                    $name
                );
                $ruta = $this->separadorDirectorios($ruta);
                return $ruta;
            }
        }
    }
    public function edit($id)
    {
        $product = Product::find($id);
        return response()->json([$product]);
    }

    public function update(Request $request, $id)
    {
        if ($request->available == 'on') {
            $available = 1;
        } else {
            $available = 0;
        }
        try {
            $ruta = $this->_procesarArchivo($request);
            $img    = array('img' => $ruta, 'available' => $available);

            if ($img['img'] != null) {
                $resultado = array_merge($request->post(), $img);
            } else {
                $array    = array('available' => $available);
                $resultado = array_merge($request->post(), $array);
            }

            $product = Product::find($request->id);
            $product->update($resultado);

            Toastr::success(__('Successfully updated registration'), 'Success');
        } catch (\Illuminate\Database\QueryException $e) {
            Toastr::error(__('An error occurred please try again'), 'error');
        }
        return to_route('product.index');
    }
    public function destroy(Product $product)
    {
        try {
            DB::beginTransaction();
            $ruta = $this->separadorDirectorios('../public/' . $product->img);
            if (file_exists($ruta)) {
                // dd($ruta);
                unlink(storage_path($ruta));
            }
            $product->delete();

            DB::commit();
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
        }
        Toastr::success(__('Registry successfully deleted'), 'Success');
        return to_route('product.index');
    }
}
