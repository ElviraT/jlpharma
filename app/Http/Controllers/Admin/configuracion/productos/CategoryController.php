<?php

namespace App\Http\Controllers\Admin\configuracion\productos;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Speciality;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:category.index|category.create|category.edit|category.destroy', ['only' => ['index', 'store']]);
        $this->middleware('permission:category.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:category.edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:category.destroy', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $category = Category::orderBy('id', 'ASC')->get();
        $specialities = Speciality::all();
        return view('admin.configuracion.productos.category.index', compact('category', 'specialities'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:categories,name',
            'color' => 'required|unique:categories,color'
        ]);
        try {
            Category::create($request->post());

            Toastr::success(__('Record added successfully'), 'Success');
        } catch (\Illuminate\Database\QueryException $e) {
            dd($e);
            Toastr::error(__('An error occurred please try again'), 'error');
        }
        return to_route('category.index');
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return response()->json([$category]);
    }

    public function update(Request $request, $id)
    {
        try {
            $category = Category::find($id);
            $category->name = $request->name;
            $category->color = $request->color;
            $category->idSpeciality = $request->idSpeciality;
            $category->save();

            Toastr::success(__('Successfully updated registration'), 'Success');
        } catch (\Illuminate\Database\QueryException $e) {
            Toastr::error(__('An error occurred please try again'), 'error');
        }
        return to_route('category.index');
    }
    public function destroy(Category $category)
    {
        $category->delete();
        Toastr::success(__('Registry successfully deleted'), 'Success');
        return to_route('category.index');
    }
}
