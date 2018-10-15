<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Image;

class controlador_admin extends Controller
{
    public function mostrar_vista_principal_admin(){
      return view('Paginas.mostrar_vista_principal');
    }

    public function cambiarAdmin(Request $request){
      $validacion = Validator::make($request->all(), [
        'id_tipo'=>'required',
      ]);

      //'id_usuario'=>'not_in:0',
      if($validacion->fails()){
        return response()->json(['errores' => $validacion->errors()]);
      }

      $id= $request->id_tipo;
      $idC = $request->id_usuario;
      $des = $request->descripcion;

      $idU = \App\usuario::find($idC);

      $archivo = $request->file('croppedImage');
      $imagen = Image::make($archivo);
      $imagen->encode('jpeg', 80);

    // 
    //   if($des == null){
    //     $reunion =\App\tipo_reunion::find($id);
    //     $reunion->update([
    //       'id_usuario' => $idC,
    //     ]);
    //
    //     return response()->json(['mensaje' => "Se asigno como administrador del grupo a ".$idU->__toString()]);
    //
    //   }else if($idC == 0){
    //     $reunion =\App\tipo_reunion::find($id);
    //     $reunion->update([
    //       'descripcion'=>$request->descripcion,
    //     ]);
    //
    //   return response()->json(['mensaje' => "Se cambió el nombre del grupo a".$des]);
    // }else{
      $reunion =\App\tipo_reunion::find($id);
      $reunion->update([
        'id_usuario' => $idC,
        'descripcion'=>$request->descripcion,
        'imagen_logo' => $imagen,
      ]);

    return response()->json(['mensaje' => "Se asigno como administrador  a ".$idU->__toString().", se cambió el nombre del grupo a".$des]);

    }
}
