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

    public function mostrar_vista_tipo_usuario()
  {
      $tipos = \App\tipo_usuario::all();
    return view('Paginas.tipoUsuario', ['tipos' => $tipos]);
  }

  public function registrar_tipo_usuario(Request $request)
  {
    $validacion = Validator::make($request->all(), [
      'descripcion'=>'required',
    ]);

    if($validacion->fails()){
      return response()->json(['errores' => $validacion->errors()]);
    }
    $tipo = \App\tipo_usuario::create([
      'descripcion'=>$request->descripcion,
    ]);
    $msg = 'Se registro el tipo de usuario exitosamente '.$request->descripcion;
    return response()->json(['mensaje' => $msg]);
  }

  public function mostrar_vista_reunion()
  {
    return view('Paginas.reunion');
  }

  public function crear_reunion(Request $request)
  {
    return $request;
  }

}
