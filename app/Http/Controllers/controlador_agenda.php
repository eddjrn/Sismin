<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Calendar;

class controlador_agenda extends Controller
{
  public function mostrar_vista_agenda(){
  $usuario = Auth::user();
  $reunionesC = $usuario->convocado_en->sortByDesc('fecha_reunion_orden');
  $CR = $usuario->responsables->all();
  $reuniones = array();
  $tareaResp= array();
  $compromisos = array();

 for($i=0; $i<count($reunionesC); $i++)
 {
   array_push($reuniones,$reunionesC[$i]->reunion);
 }

 for($j=0; $j<count($CR); $j++)
 {
   array_push($compromisos,$CR[$j]->compromisos);
   // array_push($tareaResp,$CR[$j]->tarea);
   // array_push($tareaResp,$CR[$j]->usuario->__toString());
 }
//return $reunionesC;
return view('Paginas.agenda',['eventos'=>$reuniones, 'compromisos'=>$compromisos,'CR'=>$CR]);
}

}
