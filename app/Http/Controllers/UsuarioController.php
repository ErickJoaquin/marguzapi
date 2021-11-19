<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
    public function login(Request $request){
        //recibir datos por post
        $json = $request->input('json',null);
        $params = json_decode($json); //objeto
        $params_array = json_decode($json,true);
         //Validar datos
         $validate = \Validator::make($params_array, [
            'email' => 'required', 
            'contrasena' => 'required',
        ]);

        if($validate->fails()){
            //validacion fallo

            $signup = array(
                'status' => 'error',
                'code' => 404,
                'message' => 'El usuario no se ha identificado',
                'errors' => $validate->errors()
            );
        }
        else{
            //validacion correcta
            //cifrar password
            $pwd = hash('sha256',$params->contrasena);
            $user = Usuario::where('email',$params->email)->where('contrasena',$pwd)->first();
            if($user){
                //devolver token o datos
               
                $signup = array(
                    'status' => 'success',
                    'code' => 200,
                    'message' => 'Usuario identificado',
                    'usuario' => $user
                );

            }
            else{
                $signup = array(
                    'status' => 'error',
                    'code' => 400,
                    'message' => 'Usuario no identificado',
                );
            }
        }
        return response()->json($signup);
    }
    public function index()
    {
        $usuarios = Usuario::all();
        if($usuarios){
            $data = array(
                'status' => 'success',
                'code' => 200,
                'message' => 'Listado de usuarios',
                'usuarios' => $usuarios
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
               'nombre' => 'required',
               'apellido' => 'required',
               'telefono' => 'required',
               'pais' => 'required',
               'estado' => 'required',
               'ciudad' => 'required',
               'email' => 'required',
               'contrasena' => 'required',
               //'tipo_usuario' => 'required',
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
               //crear el usuario
               $pwd = hash('sha256',$params->contrasena);
               $usuario = new Usuario();
               $usuario->nombre = $params_array['nombre'];
               $usuario->apellido = $params_array['apellido'];
               $usuario->telefono = $params_array['telefono'];
               $usuario->pais = $params_array['pais'];
               $usuario->estado = $params_array['estado'];
               $usuario->ciudad = $params_array['ciudad'];
               $usuario->email = $params_array['email'];
               $usuario->contrasena = $pwd;
               $usuario->tipo_usuario = $params_array['tipo_usuario'];;

               //$usuario->tipo_usuario = $params_array['tipo_usuario'];
               //guardar usuario
               $usuario->save();
               $data = array(
                   'status' => 'success',
                   'code' => 200,
                   'message' => 'El usuario se ha creado',
                   'usuario' => $usuario
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
        $usuario = Usuario::where('id',$id)->first();
        if($usuario){
            $data = array(
                'status' => 'success',
                'code' => 200,
                'message' => 'Usuario encontrado',
                'usuario' => $usuario
            );
        }
        else{
            $data = array(
                'status' => 'error',
                'code' => 404,
                'message' => 'No encontramos un usuario con este id'
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
             if(isset($params->contrasena)){
                 $pwd = hash('sha256',$params->contrasena);
                 $params_array['contrasena'] = $pwd;
             }
             $user = Usuario::find($id);
             $user->update($params_array);
             $data = array(
                 'status' => 'success',
                 'code' => 200,
                 'message' => 'El usuario se ha actualizado',
                 'user' => $user
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
        $user = Usuario::where('id',$id)->first();
        if($user){
            $user->delete();
            $data = array(
                'status' => 'success',
                'code' => 200,
                'message' => 'Usuario eliminado'            
            );
            
        }
        else{
            $data = array(
                'status' => 'error',
                'code' => 404,
                'message' => 'No se ha encontrado el usuario'
            );
        }
        return response()->json($data);  
    }
    
    public function uploadImage(Request $request)
    {

        //Recoger datos por post
        $image = $request->file('file0');
        $validate = \Validator::make($request->all(),[
            'foto' => 'image|mimes:jpg,jpeg,png,gif',
        ]);

        if($validate->fails()){
            $data = array(
                'status' => 'error',
                'code' => 400,
                'message' => $validate->errors(),
            );
        }
        else{
            if($image){
                $image_name = time().$image->getClientOriginalName();
                \Storage::disk('profileimages')->put($image_name, \File::get($image));

            }
            if($image){
               
                $data = array(
                    'code' => 200,
                    'status' => 'success', 
                    'imagen' => $image_name
                );
            }
            else{
                $data = array(
                    'status' => 'error',
                    'code' => 400,
                    'message' => 'error al subir imagen'            
                );
            }
        }
        return response()->json($data,$data['code']);
    }
}
