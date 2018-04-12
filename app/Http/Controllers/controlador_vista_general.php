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
}
