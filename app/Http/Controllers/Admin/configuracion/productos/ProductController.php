<?php

namespace App\Http\Controllers\Admin\configuracion\productos;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
{
    const UPLOAD_PATH = 'productos';
    function __construct()
    {
        $this->middleware('permission:product.index', ['only' => ['index']]);
        $this->middleware('permission:product.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:product.edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:product.destroy', ['only' => ['destroy']]);
    }
    public function index()
    {

        $last_code = Product::select('codigo')->orderBy('id', 'desc')->first();
        $categories = Category::all();
        return view('admin.configuracion.productos.producto.index', compact('categories', 'last_code'));
    }

    public function getProductData()
    {
        return DataTables::of(Product::with('category')->orderBy('name', 'asc'))
            ->addColumn('action', function ($product) {
                return view('partials.products.actions', compact('product'));
            })
            ->addColumn('prices', function ($product) {
                return view('partials.products.prices', compact('product'));
            })
            ->addColumn('category_name', function ($product) {
                return $product->category->name;
            })
            ->addColumn('image', function ($product) {
                return '<img src="' . asset('storage/' . str_replace('\\', '/',  $product->img)) . '" alt="imagen" class="rounded-circle shadow-4-strong img" style="width:70px; height:70px;">';
            })
            ->addColumn('available', function ($product) {
                if (Auth::user()->hasAnyRole('SuperAdmin', 'JL')) {
                    return '<input type="checkbox" name="available" id="idDis' . $product->id . '" data-toggle="toggle" data-style="ios" data-on="Si" data-off="No" data-onstyle="success" data-offstyle="danger" data-width="30" data-height="20" ' . ($product->available == 1 ? 'checked' : '') . ' onchange="activar(' . $product->id . ',' . $product->available . ')">';
                } else {
                    return '<input type="checkbox" name="available" id="idDis' . $product->id . '" data-toggle="toggle" data-style="ios" data-on="Si" data-off="No" data-onstyle="success" data-offstyle="danger" data-width="30" data-height="20" ' . ($product->available == 1 ? 'checked' : '') . ' onchange="activar(' . $product->id . ',' . $product->available . ')" disabled>';
                }
            })
            ->addColumn('rotacion', function ($product) {
                if (Auth::user()->hasAnyRole('SuperAdmin', 'JL')) {
                    return '<input type="checkbox" name="rotacion" id="idRot' . $product->id . '" data-toggle="toggle" data-style="ios" data-on="Si" data-off="No" data-onstyle="success" data-offstyle="danger" data-width="30" data-height="20" ' . ($product->rotacion == 1 ? 'checked' : '') . ' onchange="rotacion(' . $product->id . ',' . $product->rotacion . ')">';
                } else {
                    return '<input type="checkbox" name="rotacion" id="idRot' . $product->id . '" data-toggle="toggle" data-style="ios" data-on="Si" data-off="No" data-onstyle="success" data-offstyle="danger" data-width="30" data-height="20" ' . ($product->rotacion == 1 ? 'checked' : '') . ' onchange="rotacion(' . $product->id . ',' . $product->rotacion . ')" disabled>';
                }
            })
            ->rawColumns(['action', 'prices', 'image', 'available', 'rotacion'])
            ->make(true);
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
                $ruta = self::UPLOAD_PATH . '/' . $name;
                $this->_eliminarArchivo($name);
                Storage::disk('public')->put($ruta, File::get($tmp));
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
            $this->_eliminarArchivo($product->img);
            $product->delete();

            DB::commit();
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
        }
        Toastr::success(__('Registry successfully deleted'), 'Success');
        return to_route('product.index');
    }
    public function aceptar($id, $idPro)
    {
        if ($id == 1) {
            $estado = 0;
        } else {
            $estado = 1;
        }
        $producto = Product::where('id', $idPro)->first();
        $producto->available = $estado;
        $producto->save();
        return response()->json(['mensaje' => "Listo"]);
    }

    public function rotacion($id, $idPro)
    {
        if ($id == 1) {
            $estado = 0;
        } else {
            $estado = 1;
        }
        $producto = Product::where('id', $idPro)->first();
        $producto->rotacion = $estado;
        $producto->save();
        return response()->json(['mensaje' => "Listo"]);
    }

    private function _eliminarArchivo($name)
    {
        $archivo = self::UPLOAD_PATH . '/' . $name;
        Storage::disk('public')->delete([$archivo]);
        // return true;
    }
}
