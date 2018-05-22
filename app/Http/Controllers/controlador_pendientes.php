<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Jenssegers\Date\Date;

class controlador_pendientes extends Controller
{
    public function mostrar_vista_pendientes(){
      $usuario = Auth::user();
      $CRs = $usuario->responsable_en->All();
      $compromisos = array();
      $datosR = array();
      $ordenD = array();
      $temas = array();
      $fechaHoy= Date::now();

     //compromisos pendientes
      foreach ($CRs as $CR) {
        $fecha_limite =Date::parse($CR->compromisos->getOriginal()['fecha_limite']);
        if($fecha_limite->greaterThan($fechaHoy)){
          array_push($compromisos,$CR->compromisos);
        }
      }

      //orden del día pendiente
      foreach($usuario->reuniones_pendientes() as $rpu){
        foreach ($rpu->orden_dia as  $usrOD) {
          if($usrOD->id_usuario == $usuario->id_usuario)
          array_push($ordenD,$usrOD);
        }
      }

      //temas pendientes
      foreach($usuario->reuniones_historial() as $rhu){
        foreach ($rhu->minuta->temas_pendientes as $usrTP) {
          if(($usrTP->id_usuario == $usuario->id_usuario) && $usrTP->expirado == 0)
          array_push($temas,$usrTP);
        }
      }

     return view('Paginas.pendientes',['compromisos'=>$compromisos,'listado'=>$ordenD,'temas'=>$temas]);
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
