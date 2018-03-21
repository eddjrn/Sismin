<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class controlador_reunion extends Controller
{
    //
    public function mostrar_vista_motivo(){
      return view('Paginas.Motivo');
    }
}
