<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
//use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Image;
use Mail;


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
      'correo_electronico'=>'required|min:3|email|unique:usuario,correo_electronico',
      'password'=>'required|same:confirm|min:6',
      'confirm'=>'required',
    ]);

    if($validacion->fails()){
      return response()->json(['errores' => $validacion->errors()]);
    }

    $archivo = $request->file('imagen')->getClientSize();
    if($archivo <= 1537){
        return response()->json(['errores' => ["La rúbrica no puede estar vacía."]]);
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
      return response()->json(['errores' => ['No se pudo inicar sesión.']]);
    }
  }

  public function mostrar_perfil(){
    return view('Paginas.perfil');
  }

  public function iniciar_sesion(Request $request){
    $validacion = Validator::make($request->all(), [
      'correo_electronico'=>'required',
      'password'=>'required'
    ]);

    if($validacion->fails()){
      return response()->json(['errores' => $validacion->errors()]);
    }

    $correo = $request->correo_electronico;
    $pass = $request->password;

    if(Auth::attempt(['correo_electronico' => $correo, 'password' => $pass],false)){
      $msg = 'Iniciando sesión.';
      return response()->json(['mensaje' => $msg]);
    } else{
      return response()->json(['errores' => ['Datos incorrectos.']]);
    }
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

    if($usuario == null)
    {
      $colores = array("bg-green");
      $mensajes = array("El link para reestrablecer su contraseña fue enviado a su correo electrónico.");
      $tiempos = 1000;
      return view('inicio.recuperar_pass',['mensaje'=> $mensajes, 'color'=>$colores, 'tiempo' => $tiempos]);
    }

    $this->enviarCorreo($usuario);

    $colores = array("bg-green");
    $mensajes = array("El link para reeestrablecer su contraseña fue enviado a su correo electrónico.");
    $tiempos = 1000;
    return view('inicio.recuperar_pass',
    ['mensaje'=> $mensajes, 'color'=>$colores, 'tiempo' => $tiempos]);
  }

  private function enviarCorreo($usuario)
  {
    $codigo = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);
    $registro = \App\clave_usuarios::create([
      'correo_electronico' => $usuario->correo_electronico,
      'codigo' =>$codigo,
    ]);

    Mail::send('inicio.link_contraseña',[
      'usuario' => $usuario,
      'codigo' => $codigo
    ], function($mensaje) use ($usuario){
        $mensaje->to($usuario->correo_electronico);
        $mensaje->subject("Hola $usuario->nombre
        Solicitud de restablecimiento de contraseña.-SISMIN");
    });

  }

  public function mostrar_cambiar_password($correo, $codigo)
  {
      return view('inicio.cambiar_password',['correo'=>$correo,'codigo'=>$codigo]);
  }

  public function reestablecer_password(Request $request)
  {
    $validacion = Validator::make($request->all(), [
      'password'=>'required|same:confirm|min:6',
      'confirm'=>'required',
    ]);

    if($validacion->fails()){
      return response()->json(['errores' => $validacion->errors()]);
    }
    else{
      $usuario = \App\usuario::wherecorreo_electronico($request->correo_electronico)->first();
      $usuario->update([
        'password'=>Hash::make($request->password)
      ]);
      $codigo = 'DELETE FROM clave_usuario  WHERE correo_electronico = ?';
      \DB::delete($codigo, [$request->correo_electronico]);
      return response()->json(['mensaje' => "Se cambio la contraseña exitosamente"]);
    }
  }

  public function reestablecer_password_perfil(Request $request)
  {
    $validacion = Validator::make($request->all(), [
      'passwordAnt'=>'required',
      'password'=>'required|same:confirm|min:6',
      'confirm'=>'required',
    ]);

    if($validacion->fails()){
      return response()->json(['errores' => $validacion->errors()]);
    }
    else{
      $pass = Hash::make($request->passwordAnt);
      if (Hash::check($request->passwordAnt,Auth::user()->password))
      {
        $usuario = \App\usuario::wherecorreo_electronico($request->correo_electronico)->first();
        $usuario->update([
          'password'=>Hash::make($request->password)
        ]);
        Auth::logout();
        $msg = 'Se cambio la contraseña exitosamente, por favor inicie sesion para continuar '.$request->nombre;
        return response()->json(['mensaje' => $msg]);
    }
    else
    {
      return response()->json(['errores' => ['La contraseña no es correcta']]);
    }
  }
  }

}
