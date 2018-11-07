<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class controlador_grupos extends Controller
{
    public function mostrar_vista_grupos(){
      $grupos = Auth::user()->administrador_de;
      $usuaros = \App\usuario::All();
      return view('Paginas.administrar_grupos',[
        'grupos' => $grupos,
        'usuarios' => $usuaros
      ]);
    }
}
