<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materia;

class MateriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $materias = Materia::all();
        if($materias){
            $data = array(
                'status' => 'success',
                'code' => 200,
                'message' => 'Listado de materias',
                'materias' => $materias
            );
        }
        else{
            $data = array(
                'status' => 'error',
                'code' => 404,
                'message' => 'No hay usuarios creadaos'
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
                'materia' => 'required',
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
                //crear la materia
                $materia = new Materia();
                $materia->materia = $params_array['materia'];
                //guardar materia
                $materia->save();
                $data = array(
                    'status' => 'success',
                    'code' => 200,
                    'message' => 'La materia se ha creado',
                    'materia' => $materia
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
        $materia = Materia::where('id',$id)->first();
        if($materia){
            $data = array(
                'status' => 'success',
                'code' => 200,
                'message' => 'Materia encontrada',
                'materia' => $materia
            );
        }
        else{
            $data = array(
                'status' => 'error',
                'code' => 404,
                'message' => 'No encontramos una materia con este id'
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
             $materia = Materia::find($id);
             $materia->update($params_array);
             $data = array(
                 'status' => 'success',
                 'code' => 200,
                 'message' => 'La materia se ha actualizado',
                 'materia' => $materia
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
        $materia = Materia::where('id',$id)->first();
        if($materia){
            $materia->delete();
            $data = array(
                'status' => 'success',
                'code' => 200,
                'message' => 'Materia eliminada'            
            );
            
        }
        else{
            $data = array(
                'status' => 'error',
                'code' => 404,
                'message' => 'No se ha encontrado la materia'
            );
        }
        return response()->json($data); 
    }
}
