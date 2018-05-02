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

    public function crear_minuta(Request $request){
      // Arreglo de booleanos de las asistencias
      $asistencia = json_decode($request->asistencia);
      if(count(array_filter($asistencia)) < 3){
        // return response()->json(['errores' => ["Necesita agregar por lo menos dos asistentes."]]);
      }
      $enterados = json_decode($request->enterados);
      if(count(array_filter($enterados)) < 3){
        // return response()->json(['errores' => ["Necesita agregar por lo menos dos firmas."]]);
      }
      $pendientes = json_decode($request->temas_pendientes);
      $hechos = json_decode($request->descripcionHechos);
      $compromisos = json_decode($request->compromisos);
      $notas = json_decode($request->notas);
      $minuta_constante = json_decode($request->minuta_constante);
      $fecha_hoy = json_decode($request->fecha_hoy);

       // return response()->json(['mensaje' => $compromisos]);

      $minuta = \App\minuta::find($minuta_constante);
      $minuta->update([
        'fecha_elaboracion' => $fecha_hoy,
        'notas' => $notas,
      ]);

      foreach($minuta->reunion->convocados as $indice => $convocado){
        if($asistencia[$indice]){
          $convocado->update([
            'asistencia' => true,
          ]);
        }
        if($enterados[$indice]){
          $convocado->update([
            'enterado' => true,
          ]);
        }
      }

      foreach($minuta->reunion->orden_dia as $indice => $orden){
        if($pendientes[$indice]){
          \App\tema_pendiente::create([
            'id_minuta' => $minuta_constante,
            'id_orden_dia' => $orden->id_orden_dia,
            'id_usuario' => $orden->id_usuario,
            'descripcion' => "Hoal",
          ]);
        }

        $orden->update([
          'descripcion_hechos' => $hechos[$indice],
        ]);
      }

      foreach($compromisos as $compromiso){
        $nuevo_compromiso = \App\compromiso::create([
          'id_minuta' => $minuta_constante,
          'id_orden_dia' => $compromiso->id_orden,
          'descripcion' => $compromiso->descripcion,
          'fecha_limite' => $compromiso->fecha,
        ]);

        $nuevo_responsable_compromiso = \App\compromiso_responsable::create([
          'id_compromiso' => $nuevo_compromiso->id_compromiso,
          'id_usuario' => '1',
        ]);
      }

      return response()->json(['mensaje' => "Minuta realizada correctamente."]);
    }
}
