<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clase;


class ClaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clases = Clase::all();
        if($clases){
            $data = array(
                'status' => 'success',
                'code' => 200,
                'message' => 'Listado de clases',
                'clases' => $clases
            );
        }
        else{
            $data = array(
                'status' => 'error',
                'code' => 404,
                'message' => 'No hay clases creadas'
            );
        }
        return response()->json($data);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         //Recoger datos por post
       $json = $request->input('json',null);
       $params = json_decode($json); //objeto
       $params_array = json_decode($json,true);

        if(!empty($params) && !empty($params_array)){
            //Validar datos
            $validate = \Validator::make($params_array, [
                'hora' => 'required',
                'fecha' => 'required',
                'email' => 'required',
                'descripcion' => 'required',
                'estado' => 'required',
                'cantidad' => 'required',
            ]);
            if($validate->fails()){
                $data = array(
                    'status' => 'error',
                    'code' => 404,
                    'message' => 'Hay errores en los datos subministrados',
                    'errors' => $validate->errors()
                );
            }
            else{
                //validacion correcta
                //crear la clase
                $clase = new Clase();
                $clase->hora = $params_array['hora'];
                $clase->fecha = $params_array['fecha'];
                $clase->email = $params_array['email'];
                $clase->descripcion = $params_array['descripcion'];
                $clase->estado = $params_array['estado'];
                $clase->cantidad = $params_array['cantidad'];
                //guardar la clase
                $clase->save();
                $data = array(
                    'status' => 'success',
                    'code' => 200,
                    'message' => 'La clase se ha creado',
                    'clase' => $clase
                );
            }
        }
        else{
            $data = array(
                'status' => 'error',
                'code' => 404,
                'message' => 'Los datos enviados no son correctos',
            ); 
        }
 
        return response()->json($data,$data['code']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $clase = Clase::where('id',$id)->first();
        if($clase){
            $data = array(
                'status' => 'success',
                'code' => 200,
                'message' => 'Clase encontrada',
                'clase' => $clase
            );
        }
        else{
            $data = array(
                'status' => 'error',
                'code' => 404,
                'message' => 'No encontramos una clase con este id'
            );
        }
        return response()->json($data);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Recoger datos por post
        $json = $request->input('json',null);
        $params = json_decode($json); //objeto
        $params_array = json_decode($json,true);

        if(!empty($params) && !empty($params_array)){
            $clase = Clase::find($id);
            $clase->update($params_array);
            $data = array(
                'status' => 'success',
                'code' => 200,
                'message' => 'La clase se ha actualizado',
                'clase' => $clase
            );
            

        }
        else{
            $data = array(
                'status' => 'error',
                'code' => 404,
                'message' => 'Los datos enviados no son correctos',
            ); 
        }
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $clase = Clase::where('id',$id)->first();
        if($clase){
            $clase->delete();
            $data = array(
                'status' => 'success',
                'code' => 200,
                'message' => 'Clase eliminada'            
            );
            
        }
        else{
            $data = array(
                'status' => 'error',
                'code' => 404,
                'message' => 'No se ha encontrado la clase'
            );
        }
        return response()->json($data); 
    }
}
