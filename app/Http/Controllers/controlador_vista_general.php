<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class controlador_vista_general extends Controller
{
    //
    public function mostrar_vista_principal(){

      return view('Paginas.vista_principal');
    }
}
