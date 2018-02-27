<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class controlador_usuarios extends Controller
{
    //
  public function mostrar_login()
  {
    return view('inicio.login');
  }

  public function validar(){

  }

  public function mostrar_registro()
  {
    return view('inicio.registro');
  }

  public function mostrar_recuperar_password()
  {
    return view('inicio.recuperar_pass');
  }

  public function crear(Request $request){

    $this->validate($request,[
      'nombre'=>'required|min:3',
      'apellido_paterno'=>'required|min:3',
      'apellido_materno'=>'required|min:3',
      'correo_electronico'=>'required|min:3|e-mail|unique:usuarios,correo_electronico',
      'password'=>'required|same:confirm|min:6|max:15'
    ]);

    $usuario = \App\usuario::create([
      'nombre'=>$request->nombre,
      'apellido_paterno' => $request->apellido_paterno,
      'apellido_materno' => $request->apellido_materno,
      'correo_electronico' => $request->correo_electronico,
      'password' => bcrypt($request->password),
      'rubrica' => '01010101'
    ]);

    return redirect('/t');
  }
  public function mostrar_perfil()
  {
    return view('inicio.perfil');
  }

}
