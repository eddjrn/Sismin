<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class controlador_vista_general extends Controller
{
    //
    public function mostrar_vista_principal(){

      $reuniones_recientes = Auth::user()->reuniones();

      if (count($reuniones_recientes)>0) {
        return view('Paginas.vista_principal',[
          'reuniones'=>$reuniones_recientes
        ]);
      }else{
        return view('Paginas.vista_principal',[
          'nuevo'=> true]);
      }

    }

    public function mostrar_detalles_reunion(Request $id){
      $reunion =\App\reunion::find($id->id_reunion);
      $reuniones =  array();
      $convocadosData= array();
      $rol = array();
      $datosReunion = array();
      $idConvocados = array();
      $idSecre= $reunion->convocados->where('id_rol','=','1')->first()->usuario->id_usuario;
      $idMod = Auth::user()->id_usuario;


      array_push($datosReunion,$reunion->moderador()->__toString());
      array_push($datosReunion,$reunion->fecha_reunion);
      array_push($datosReunion,$reunion->getLimite());
      array_push($datosReunion,$reunion->tipo_reunion);
      array_push($datosReunion,$reunion->tipo_reunion->imagen_logo);
      array_push($datosReunion,$reunion->secretario()->__toString());
      array_push($datosReunion,$idSecre);
      array_push($datosReunion,$idMod);
      array_push($datosReunion,$reunion->tipo_reunion->descripcion);
      array_push($datosReunion,$reunion->minuta->codigo);
      array_push($datosReunion,$reunion->minuta->id_minuta);

      foreach($reunion->convocados as $convocado){
        array_push($convocadosData,$convocado->usuario->__toString());
        array_push($rol,$convocado->rol->descripcion);
        array_push($idConvocados,$convocado->usuario->id_usuario);
      }

      array_push($reuniones,$reunion);
      array_push($reuniones,$convocadosData);
      array_push($reuniones,$rol);
      array_push($reuniones,$datosReunion);
      array_push($reuniones,$idConvocados);
      return response()->json(['datos' => $reuniones]);
    }

    public function cambiarSecre(Request $request){
      $validacion = Validator::make($request->all(), [
        'id_reunion'=>'required',
        'id_convocado'=>'required|not_in:0',
      ]);

      if($validacion->fails()){
        return response()->json(['errores' => $validacion->errors()]);
      }
      $id= $request->id_reunion;
      $reunion =\App\reunion::find($id);
      $idMod = $reunion->convocados->where('id_rol','=','1')->first();
      $idU = $reunion->convocados->where('id_usuario','=',$request->id_convocado)->first();

      $idMod->update([
        "id_rol"=>2
      ]);
      $idU->update([
        "id_rol"=>1
      ]);
      return response()->json(['mensaje' => "Se asigno como secretario a ".$idU->usuario->__toString()]);
    }







}
