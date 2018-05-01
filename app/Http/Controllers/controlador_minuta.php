<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mail;
use Barryvdh\DomPDF\Facade as PDF;
use Hash;

class controlador_minuta extends Controller
{
    public function mostrar_vista_minuta($id,$codigo){
      $minuta = \App\minuta::find($id);


      if($codigo==$minuta->codigo){
       return view('Paginas.minuta',['minuta'=>$minuta]);
      }
      else{
       abort(404);
      }
    }

    public function firmar(Request $request){
      $validacion = Validator::make($request->all(), [
        'clave'=>'required',
        'id_convocado'=>'required',
      ]);

      if($validacion->fails()){
        return response()->json(['errores' => $validacion->errors()]);
      }

      $convocado = \App\reunion_convocado::find($request->id_convocado);

      if(Hash::check($request->clave, $convocado->usuario->password)){
        return response()->json(['mensaje' => "Firmando minuta"]);
      } else{
        return response()->json(['errores' => ["Las contraseñas no coinciden."]]);
      }
    }

    public function crear_minuta(){

    }
}
