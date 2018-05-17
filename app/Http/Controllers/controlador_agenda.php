<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Calendar;

class controlador_agenda extends Controller
{
  public function mostrar_vista_agenda(){
  $usuario = Auth::user();
  $reunionesC = $usuario->convocado_en;
  $CR = $usuario->responsables->all();
  $reuniones = array();
  $datosR = array();
  $tareaResp= array();
  $compromisos = array();


 for($i=0; $i<count($reunionesC); $i++)
 {
   array_push($reuniones,$reunionesC[$i]->reunion);
   array_push($datosR,$reunionesC[$i]->reunion->reunion_temas_pendientes());
 }

 for($j=0; $j<count($CR); $j++)
 {
   array_push($compromisos,$CR[$j]->compromisos);
 }


//return $datosR;
return view('Paginas.agenda',['eventos'=>$reuniones, 'compromisos'=>$compromisos,'CR'=>$CR,'datos'=>$datosR]);
}

}
