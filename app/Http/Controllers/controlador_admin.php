<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class controlador_admin extends Controller
{
    public function mostrar_vista_principal_admin(){
      return view('Paginas.mostrar_vista_principal');
    }

}
