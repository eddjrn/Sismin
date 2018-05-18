<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class controlador_pendientes extends Controller
{
    public function mostrar_vista_pendientes(){
      $usuario = Auth::user();
      $CR = $usuario->responsable_en->All();
      $temas =$usuario->orden_dia;
      $temas2 =$usuario->temas_pendientes;
      $compromisos = array();
      $datosR = array();
      $datosR2 = array();


     for($j=0; $j<count($CR); $j++)
     {
       array_push($compromisos,$CR[$j]->compromisos);
     }

      foreach ($temas2 as $key => $tema) {
        array_push($datosR,$tema);
      }


     return view('Paginas.pendientes',['compromisos'=>$compromisos,'listado'=>$temas,'temas'=>$datosR]);
    }

    public function actualizarEstatus(Request $request){
      $validacion = Validator::make($request->all(), [
        'id_compromiso_resp'=>'required',
        'realizado'=>'required',
      ]);

      if($validacion->fails()){
        return response()->json(['errores' => $validacion->errors()]);
      }

      $id= $request->id_compromiso_resp;
      $compromiso =\App\compromiso_responsable::find($id);
      $f=$request->realizado;
      $compromiso->update(['realizado'=>$f]);

      $rbandera=1;

      $idc= $compromiso->id_compromiso;

      $regidc=$compromiso->where('id_compromiso','=',$idc)->get();
      $regc= count($regidc);
      foreach ($regidc as $c) {
        if($c->realizado==true){
            $rbandera++;
        }
      }

      $compromisoF =\App\compromiso::find($idc);

      if(($rbandera-1) == $regc){
        $compromisoF->update(['finalizado'=>1]);
      }else{
        $compromisoF->update(['finalizado'=>0]);
      }

      // return response()->json(['mensaje' => "Se asigno como secretario a ".$idU->usuario->__toString()]);
     return response()->json(['mensaje' => "Se cambio el estatus de su compromiso a finalizado"]);
    }
}
