<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Calendar;

class controlador_agenda extends Controller
{
  public function mostrar_vista_agenda(){
  $usuario = Auth::user();
  $reunionesC = $usuario->convocado_en->all();
  $CR = $usuario->responsables->all();
  $reuniones = array();
  $convocadosData =array();
  $reunionDatos= array();
  $compromisos = array();

 for($i=0; $i<count($reunionesC); $i++)
 {
   array_push($reuniones,$reunionesC[$i]->reunion);
 }
 for($j=0; $j<count($CR); $j++)
 {
   array_push($compromisos,$CR[$j]->compromisos);
 }

  return view('Paginas.agenda',['eventos'=>$reuniones, 'compromisos'=>$compromisos,'CR'=>$CR]);
}

}
