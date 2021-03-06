<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Hash;
use Mail;
use Jenssegers\Date\Date;

class controlador_vista_general extends Controller
{
    public function mostrar_vista_principal(){
      $reuniones_pendientes = Auth::user()->reuniones_pendientes();
      $convocado_en = Auth::user()->convocado_en;
      $responsable_en = Auth::user()->responsable_en;
      $reuniones_historial = Auth::user()->reuniones_historial();
      $minutas_recientes = Auth::user()->minutas_recientes();
      $temas_pendientes = Auth::user()->temas_pendientes;
      $conteo_reunion = 0;

      foreach ($reuniones_pendientes as $reunion) {
        if($reunion->moderador->id_usuario == Auth::user()->id_usuario){
          $conteo_reunion++;
        }
      }

      return view('Paginas.vista_principal',[
        'reuniones_pendientes' => $reuniones_pendientes,
        'convocado_en' => $convocado_en,
        'responsable_en' => $responsable_en,
        'reuniones_historial' => $reuniones_historial,
        'minutas_recientes' => $minutas_recientes,
        'temas_pendientes' => $temas_pendientes,
        'conteo_reunion' => $conteo_reunion,
      ]);
    }

    public function mostrar_detalles_reunion(Request $id){
      $reunion =\App\reunion::find($id->id_reunion);
      $reuniones =  array();
      $convocadosData= array();
      $rol = array();
      $datosReunion = array();
      $idConvocados = array();
      $idSecre= $reunion->secretario->id_usuario;
      $idAuth = Auth::user()->id_usuario;
      $fechaR = new Date($reunion->fecha_reunion);
      $fechaHoy = Date::now();

      array_push($datosReunion,$reunion->moderador->__toString());
      array_push($datosReunion,$reunion->getFechaReunionLegible());
      array_push($datosReunion,$reunion->getLimite());
      array_push($datosReunion,$reunion->tipo_reunion);
      array_push($datosReunion,$reunion->tipo_reunion->imagen_logo);
      array_push($datosReunion,$reunion->secretario->__toString());
      array_push($datosReunion,$idSecre);
      array_push($datosReunion,$idAuth);
      array_push($datosReunion,$reunion->tipo_reunion->descripcion);
      array_push($datosReunion,$reunion->minuta->codigo);
      array_push($datosReunion,$reunion->minuta->id_minuta);
      array_push($datosReunion,$reunion->moderador->id_usuario);

      if($fechaR->diffInHours($fechaHoy) <= 12){
        array_push($datosReunion,1);
      }else{
        array_push($datosReunion,0);
      }

      foreach($reunion->convocados as $convocado){
        array_push($convocadosData,$convocado->usuario->__toString());
        array_push($rol,$convocado->puesto->descripcion);
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
      $idC = $request->id_convocado;
      $reunion =\App\reunion::find($id);
      $reunion->update([
        'id_secretario' => $idC,
      ]);
      $idU = \App\usuario::find($idC);
      return response()->json(['mensaje' => "Se asigno como secretario a ".$idU->__toString()]);
    }

    public function eliminarReunion(Request $request, $id, $codigo){

      $validacion = Validator::make($request->all(), [
        'clave'=>'required',
      ]);

      if($validacion->fails()){
        return response()->json(['errores' => $validacion->errors()]);
      }

      if(!Hash::check($request->clave, Auth::user()->password)){
        return response()->json(['errores' => ["Las constraseñas no coinciden"]]);
      }
      $reunion = \App\reunion::find($id);
      if($reunion->minuta->codigo != $codigo){
        return response()->json(['errores' => ["No existe la reunión"]]);
      }

      //enviar convocatoria por correo_electronico
      $c = str_random(10);
      for($i=0; $i< count($reunion->convocados); $i++)
      {
        $correo= $reunion->convocados->get($i)->usuario->correo_electronico;
        $this->enviarCorreo($reunion,$correo);
      }

      $reunion->delete();

      return response()->json(['mensaje' => "Limpiando registros"]);
    }

    private function enviarCorreo($reunion,$correo)
    {
      $usuario = \App\usuario::wherecorreo_electronico($correo)->first();
      Mail::send('Paginas.link_reunion',[
        'reunion' => $reunion,
        'usuario'=>$usuario
      ], function($mensaje) use ($usuario){
          $mensaje->to($usuario->correo_electronico);
          $mensaje->subject("Reunión eliminada");
      });

    }

    public function actualizarTarea(Request $request){
      $validacion = Validator::make($request->all(), [
        'id_compromiso_resp'=>'required',
        'tarea'=>'required',
      ]);

      if($validacion->fails()){
        return response()->json(['errores' => $validacion->errors()]);
      }
      $id= $request->id_compromiso_resp;
      $compromiso =\App\compromiso_responsable::find($id);
      $tarea = $request->tarea;
      $compromiso->update(['tarea'=>$tarea]);

      // return response()->json(['mensaje' => "Se asigno como secretario a ".$idU->usuario->__toString()]);
     return response()->json(['mensaje' => "Se asigno tarea al usuario "]);
    }

}
