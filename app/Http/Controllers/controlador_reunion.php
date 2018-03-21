<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Image;

class controlador_reunion extends Controller
{
    //
    public function mostrar_vista_motivo(){
      $tipos = \App\tipo_reunion::all();

      return view('Paginas.Motivo', ['tipos' => $tipos]);
    }

    public function registrar_motivo(Request $request){
      $validacion = Validator::make($request->all(), [
        'descripcion'=>'required|min:4',
      ]);

      if($validacion->fails()){
        return response()->json(['errores' => $validacion->errors()]);
      }

      $archivo = $request->file('croppedImage');
      $imagen = Image::make($archivo);
      $imagen->encode('jpeg', 80);

      $tipo = \App\tipo_reunion::create([
        'descripcion' => $request->descripcion,
        'imagen_logo' => $imagen,
      ]);

      $msg = 'Se agregó: '.$request->descripcion;
      return response()->json(['mensaje' => $msg]);
    }
}
