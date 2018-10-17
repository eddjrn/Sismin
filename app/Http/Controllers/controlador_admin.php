<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
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

    public function mostrar_vista_DB(){
      return view('Paginas.Admin_DB');
    }

    public function crearRespaldo(){
    //  $usuarios=\App\Usuario::All()->toJson();

    $Sismin= DB::select('SHOW TABLES');
    $dbSismin= array();
     // $x= DB::select(DB::raw('select * from usuario'));
     $x=DB::table('usuario')->get();
    //$x= DB::table('usuario')->first()->toArray();

    //   foreach ($Sismin as  $db) {
    //    array_push($dbSismin,DB::table('usuario'));
    //    //array_push($dbSismin,DB::select(DB::raw('select * from usuario'))->get());
    //   //array_push($dbSismin,DB::query('select * from usuario')->get());
    //   // code...
    // }
       //array_push($dbSismin,DB::table('usuario')->select(' * ')->get());

       return base64_encode($x);
      //return response()->json([ => "correcto",'datos' =>  json_encode($dbSismin)]);
    }
}
