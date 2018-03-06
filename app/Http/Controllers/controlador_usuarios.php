<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
//use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Image;
use Reminder;
use Mail;
use Sentinel;

class controlador_usuarios extends Controller
{
    //
  public function mostrar_login(){
    return view('inicio.login');
  }

  public function validar(){

  }

  public function mostrar_registro(){
    return view('inicio.registro');
  }

  public function crear(Request $request){
    $validacion = Validator::make($request->all(), [
      'nombre'=>'required|min:3',
      'apellido_paterno'=>'required|min:3',
      'apellido_materno'=>'required|min:3',
      'correo_electronico'=>'required|min:3|email|unique:usuarios,correo_electronico',
      'password'=>'required|same:confirm|min:6',
      'confirm'=>'required',
    ]);

    if($validacion->fails()){
      return response()->json(['errores' => $validacion->errors()]);
    }

    $archivo = $request->file('imagen');
    $imagen = Image::make($archivo);
    $imagen->encode('jpeg', 80);

    $usuario = \App\usuario::create([
      'nombre'=>$request->nombre,
      'apellido_paterno' => $request->apellido_paterno,
      'apellido_materno' => $request->apellido_materno,
      'correo_electronico' => $request->correo_electronico,
      'password' => Hash::make($request->password),
      'rubrica' => $imagen,
    ]);

    $correo = $request->correo_electronico;
    $pass = $request->password;

    if(Auth::attempt(['correo_electronico' => $correo,'password' => $pass])){
      $msg = 'Iniciando sesión como '.$request->nombre;
      return response()->json(['mensaje' => $msg]);
    } else{
      return response()->json(['errores' => 'No se pudo inicar sesión']);
    }
  }

  public function mostrar_perfil(){
    return view('inicio.perfil');
  }

  public function iniciar_sesion(Request $request){
    $this->validate($request,[
      'correo_electronico'=>'required',
      'password'=>'required'
    ]);

    $correo = $request->correo_electronico;
    $pass = $request->password;
    $guardar = $request->rememberme;
    //return gettype($guardar);
    // if($guardar=='on'){
    //   $guardar=true;
    //
    // }
    // else{
    //   $guardar=false;
    // }

    if(Auth::attempt([
      'correo_electronico' => $correo,
      'password' => $pass],$guardar)){
      return redirect()->intended('/');
      }

      return back();
    //return $request;
  }

  public function cerrar_sesion(){
    Auth::logout();
    return redirect('/login');
  }

  public function mostrar_recuperar_password(){
    return view('inicio.recuperar_pass');
  }

  public function cambiar_password(Request $request)
  {
    $usuario = \App\usuario::wherecorreo_electronico($request->correo_electronico)->first();

    $sentinela = Sentinel::findById($usuario->id_usuario);

    if($usuario -> count() == 0)
    {
      $colores = array("bg-green");
      $mensajes = array("El link para reeestrablecer contraseña fue enviado a su correo electrónico.");
      $tiempos = 1000;
      return view('inicio.recuperar_pass',['mensaje'=> $mensajes, 'color'=>$colores, 'tiempo' => $tiempos]);
    }



    $reminder = Reminder::exist($sentinela) ?: Reminder::create($sentinela);
    $this->enviarCorreo($usuario, $remider->code);
    $colores = array("bg-green");
    $mensajes = array("El link para reeestrablecer contraseña fue enviado a su correo electrónico.");
    $tiempos = 1000;
    return view('inicio.recuperar_pass',
    ['mensaje'=> $mensajes, 'color'=>$colores, 'tiempo' => $tiempos]);
  }

  private function enviarCorreo($usuario, $codigo)
  {
    Mail::send('inicio.cambiar_password',[
      'usuario' => $usuario,
      'codigo' => $codigo
    ], function($mensaje) use ($usuario){
        $mensaje->to($usuario->correo_electronico);
        $mensaje->subjetc("Hola $usuario->nombre
        haz clic en el siguiente enlace para reestablecer tu contraseña.");
    });

  }

}
