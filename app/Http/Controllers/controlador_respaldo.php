<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;

class controlador_respaldo extends Controller
{
    public function mostrar_vista_respaldo(){
      $reunionesM = new \App\reunion;
      $reunionesM->setConnection('mysql2');
      $reuniones = $reunionesM->get();
      //return $reuniones->minuta->id_minuta;
      return view('Paginas.respaldo',['reuniones'=>$reuniones]);
    }

    public function pdf($id,$codigo){
      //creación del pdf
          $reunionesM = new \App\reunion;
          $reunionesM->setConnection('mysql2');
          $reunion= $reunionesM->find($id);
          if($codigo==$reunion->codigo){
          $pdf = PDF::loadView('Paginas.pdf',[
            'imagen'=>$reunion->tipo_reunion->imagen_logo,
            'motivo'=>$reunion->motivo,
            'convocados' =>$reunion->convocados,
            'reunion_orden_dia'=>$reunion->orden_dia,
            'fecha_reunion'=>$reunion->fecha_reunion,
            'lugar'=>$reunion->lugar,
            'fecha_creacion'=>$reunion->getFecha(),
            'img'=>$reunion->moderador->rubrica,
            'tipo'=>$reunion->tipo_reunion->descripcion,
            'reunion'=>$reunion
        ]);
          return $pdf->stream();
        }
        else{
          abort(404);
        }
          //return $pdf->download('listado.pdf');
    }

    public function pdf_minuta($id,$codigo){
      //creación del pdf
          $minutaM = new \App\minuta;
          $minutaM->setConnection('mysql2');
          $minuta= $minutaM->find($id);
         if($codigo==($minuta->codigo)){
          $pdf = PDF::loadView('Paginas.pdf_minuta',[
            'minuta'=>$minuta
        ]);
          return $pdf->stream();
        }
        else{
          abort(404);
        }
  }


}
