<?php

namespace App\Http\Controllers\Admin\configuracion\direccion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Collection as Collection;
use App\Model\Parroquia;
use App\Model\Municipio;
use Flash;

class ParroquiaController extends Controller
{
  public function __construct()
    {
      $this->middleware('can:parroquia')->only('index');
      $this->middleware('can:parroquia.add')->only('add');
      $this->middleware('can:parroquia.edit')->only('edit');
    }
    public function index(Parroquia $model)
  	{    	
  		$municipality= Collection::make(Municipio::select(['id_Municipio','Municipio'])->orderBy('Municipio')->get())->pluck("Municipio", "id_Municipio");
  		return view('admin.configuracion.direccion.parroquias.index', ['parroquias' => $model->all(), 'municipios'=> $municipality]);
  	}
  	public function add (Request $request)
    {   
    	
       if($request->id == 0){
            try {
                $parish= new Parroquia();
                $parish->Municipio_id = $request['municipio'];
                $parish->Parroquia = ucfirst($request['nombre']);
                $parish->save();

                Flash::success("Registro Agregado Correctamente");            
            } catch (\Illuminate\Database\QueryException $e) {
                Flash::error('Ocurrió un error, por favor intente de nuevo');    
            }
        }else{
            try{
                $id = (int)$request->id;
                 Parroquia::where('id_Parroquia', $id)->update([
                    'Municipio_id'=>$request->municipio,
                    'Parroquia'=>ucfirst($request->nombre)
                ]);

                Flash::success("Registro Modificado Correctamente");
             }catch(\Illuminate\Database\QueryException $e){                    
                Flash::error('Ocurrió un error, por favor intente de nuevo');
            }
        }
        return redirect()->route('parroquia');
    }

  	public function edit(Request $request)
    {
        $id = (int)$request->input('id');

        $parishes= Parroquia::where('id_Parroquia','=', $id)->first();
        return response()->json([$parishes]);
    }
    public function destroy(Request $request)
    {
       $id = (int)$request->input('id');
       $parishes= Parroquia::where('id_Parroquia', $id)->delete();
        Flash::success('Registro eliminado correctamente');
         
      return redirect()->route('parroquia');
    }
}
