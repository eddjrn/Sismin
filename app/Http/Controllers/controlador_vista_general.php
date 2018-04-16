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
      return view('Paginas.vista_principal',[
        'reuniones'=>$reuniones_recientes
      ]);
    }

    public function mostrar_detalles_reunion(Request $id){
      $reunion =\App\reunion::find($id->id_reunion);
      $reuniones =  array();
      $convocadosData= array();
      $rol = array();
      $datosReunion = array();

      array_push($datosReunion,$reunion->moderador());
      array_push($datosReunion,$reunion->fecha_reunion);
      array_push($datosReunion,$reunion->getLimite());
      array_push($datosReunion,$reunion->tipo_reunion);
      array_push($datosReunion,$reunion->tipo_reunion->imagen_logo);

      foreach($reunion->convocados as $convocado){
        array_push($convocadosData,$convocado->usuario->__toString());
        array_push($rol,$convocado->rol->descripcion);
      }

      array_push($reuniones,$reunion);
      array_push($reuniones,$convocadosData);
      array_push($reuniones,$rol);
      array_push($reuniones,$datosReunion);
      return response()->json(['datos' => $reuniones]);
    }







}
