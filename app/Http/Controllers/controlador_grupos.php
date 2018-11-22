<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class controlador_grupos extends Controller
{
    public function mostrar_vista_grupos(){
      $grupos = Auth::user()->administrador_de;
      $usuaros = \App\usuario::All()->where('estatus','=','1');
      return view('Paginas.administrar_grupos',[
        'grupos' => $grupos,
        'usuarios' => $usuaros
      ]);
    }

    public function actualizar_grupos(Request $request){
      $validacion = Validator::make($request->all(), [
        'id_grupo'=>'required',
      ]);

      if($validacion->fails()){
        return response()->json(['errores' => $validacion->errors()]);
      }

      $usuarios =json_decode($request->usuarios);
      $grupo = \App\grupo_usuario::whereid_tipo_reunion($request->id_grupo);

       $grupoUsr= array();
       $grup = \App\tipo_reunion::find($request->id_grupo);
       foreach ($grup->usuarios as $usuario) {
         array_push($grupoUsr,$usuario->id_usuario);
       }

       foreach ($usuarios as $usr2) {
         $existe = false;
         foreach ($grupoUsr as $usrE) {
            if($usrE == $usr2){
              $existe= true;
              $break;
            }
         }
         if($existe == false){
           $grupo->create([
             'id_tipo_reunion' => $request->id_grupo,
             'id_usuario' => $usr2,
           ]);
         }
       }

       foreach($grupoUsr as $usr){
         $encontrado = false;
         foreach ($usuarios as $newUsr) {
            if($usr==$newUsr){
              $encontrado = true;
              $break;
            }
         }
         if($encontrado == false){
           $grups=\App\grupo_usuario::where('id_tipo_reunion',$request->id_grupo)
                                    ->where('id_usuario',$usr)
                                    ->delete();
         }
       }
      return response()->json(['mensaje' => "Se actualizaron los usuarios integrantes  del grupo: ".$grup->descripcion]);
  }
}
