<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class controlador_vista_general extends Controller
{
    //
    public function mostrar_vista_principal(){

      $reuniones = Auth::user()->convocado_en->sortByDesc('updated_at')->all();
      $id_reuniones =  array();
      $reuniones_recientes =  array();

      for($i=0; $i<count($reuniones); $i++)
      {
          $id =$reuniones[$i]->reunion->id_tipo_reunion;

          if(!(in_array($id,$id_reuniones))){
            $igualar=$reuniones[$i]->reunion;
            array_push($id_reuniones,$id);
            array_push($reuniones_recientes,$igualar);

          }
      }
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
      $idSecre= $reunion->convocados->where('id_rol','=','1')->get(0)->usuario->id_usuario;
      $idMod = Auth::user()->id_usuario;


      array_push($datosReunion,$reunion->moderador());
      array_push($datosReunion,$reunion->fecha_reunion);
      array_push($datosReunion,$reunion->getLimite());
      array_push($datosReunion,$reunion->tipo_reunion);
      array_push($datosReunion,$reunion->tipo_reunion->imagen_logo);
      array_push($datosReunion,$reunion->secretario());
      array_push($datosReunion,$idSecre);
      array_push($datosReunion,$idMod);
      array_push($datosReunion,$reunion->tipo_reunion->descripcion);

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







}
