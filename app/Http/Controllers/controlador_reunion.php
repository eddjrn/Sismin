<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Image;

class controlador_reunion extends Controller
{
    //
    public function mostrar_vista_motivo(){
      $tipos = \App\tipo_reunion::orderBy('updated_at', 'desc')->get();

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

    public function mostrar_vista_tipo_usuario(){
      $tipos = \App\tipo_usuario::orderBy('updated_at', 'desc')->get();
      return view('Paginas.tipoUsuario', ['tipos' => $tipos]);
    }

  public function registrar_tipo_usuario(Request $request){
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

  public function mostrar_vista_reunion(){
    $tipos = \App\tipo_reunion::orderBy('updated_at', 'desc')->get();
    $convocados = \App\usuario::orderBy('updated_at', 'desc')->get();
    $roles = \App\rol_usuario::orderBy('updated_at', 'desc')->get();

    return view('Paginas.reunion', [
      'tipos'=>$tipos,
      'convocados'=>$convocados,
      'roles'=>$roles,
    ]);
  }

  public function actualizar_vista(Request $request, $opc){
    switch($opc){
      case 1:
        $tipo_reunion = \App\tipo_reunion::find($request->id);
        $reunion = $tipo_reunion->reuniones->sortByDesc('updated_at')->first();
        // No se tienen temas pendientes en el sistema :(
        // Por hacer
        //   Sacar los temas pendientes de las minutas y ponerlos en la seccion de orden del dia
        //   Que sean seleccionables en la seccion y sacar sus datos
        return response()->json(['mensaje' => 'No implementado temas pendientes']);

        break;
      case 2:

        break;
      case 3:

        break;
      case 4:

        break;
    }
  }

  public function crear_reunion(Request $request){
    return $request;
  }

}
