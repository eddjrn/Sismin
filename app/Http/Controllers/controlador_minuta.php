<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mail;
use Barryvdh\DomPDF\Facade as PDF;

class controlador_minuta extends Controller
{
    public function mostrar_vista_minuta($id,$codigo){
     $minuta = \App\minuta::find($id);


     if($codigo==$minuta->codigo){
       return view('Paginas.minuta',['minuta'=>$minuta]);
     }
     else{
       abort(404);
     }


    }

    public function crear_minuta(){

    }
}
