<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class controlador_pendientes extends Controller
{
    public function mostrar_vista_pendientes(){
      $usuario = Auth::user();
      $CR = $usuario->responsables->all();
      $temas =$usuario->orden_dia;
      $compromisos = array();


     for($j=0; $j<count($CR); $j++)
     {
       array_push($compromisos,$CR[$j]->compromisos);
     }


     return view('Paginas.pendientes',['compromisos'=>$compromisos,'listado'=>$temas]);
    }
}
