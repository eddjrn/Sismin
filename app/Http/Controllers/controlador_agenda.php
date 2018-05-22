<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Calendar;
use Jenssegers\Date\Date;

class controlador_agenda extends Controller
{
  public function mostrar_vista_agenda(){
  $usuario = Auth::user();
  $rp =$usuario->reuniones_pendientes();
  $rh =$usuario->reuniones_historial();
  $CRs = $usuario->responsable_en->all();
  $compromisos = array();
  $crh = array();
  $crp = array();
  $crpT = array();
  $crhT = array();
  $fechaHoy= Date::now();

  foreach ($CRs as $CR) {
  $fecha_limite =Date::parse($CR->compromisos->getOriginal()['fecha_limite']);
  if($fecha_limite->greaterThan($fechaHoy)){
    array_push($crp,$CR->compromisos);
    array_push($crpT,$CR);
  }
  else if($fecha_limite->lessThan($fechaHoy)){
    array_push($crh,$CR->compromisos);
    array_push($crhT,$CR);
  }
  }


//return count($rh);
return view('Paginas.agenda',['eventoshs'=>$rh,'eventos'=>$rp,'compromisos'=>$crp,'compromisosh'=>$crh,'tareaP'=>$crpT,'tareaH'=>$crhT]);
//return view('Paginas.agenda',['ep'=>$rp,'eventos'=>$reuniones, 'compromisos'=>$compromisos,'CR'=>$CR,'datos'=>$datosR]);
}

}
