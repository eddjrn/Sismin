<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class controlador_acercade extends Controller
{
    //
  public function mostrar_acercade()
  {
    return view('Paginas.acercade');
  }

}
