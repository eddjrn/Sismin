<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Image;
use Mail;
use Barryvdh\DomPDF\Facade as PDF;

class controlador_reunion extends Controller
{
    //
    public function mostrar_vista_tipo_reunion(){
      $tipos = \App\tipo_reunion::orderBy('updated_at','desc')->get();
      $usuarios = \App\usuario::orderBy('updated_at','desc')->get();

      return view('Paginas.tipo_reunion', [
        'tipos' => $tipos,
        'usuarios'=>$usuarios,
      ]);
    }

    public function registrar_tipo_reunion(Request $request){
      $validacion = Validator::make($request->all(), [
        'descripcion'=>'required|min:3|unique:tipo_reunion,descripcion',
        'id_usuario' =>'required',
      ]);

      if($validacion->fails()){
        return response()->json(['errores' => $validacion->errors()]);
      }

      $archivo = $request->file('croppedImage');
      $imagen = Image::make($archivo);
      $imagen->encode('jpeg', 80);

      $tipo = \App\tipo_reunion::create([
        'descripcion' => $request->descripcion,
        'imagen_logo' => $imagen,
        'id_usuario'  => $request->id_usuario,
      ]);

      $msg = 'Se agregó: '.$request->descripcion;
      return response()->json(['mensaje' => $msg]);
    }

    public function mostrar_vista_puesto_usuario(){
      $tipos = \App\puesto_usuario::orderBy('updated_at', 'desc')->get();
      return view('Paginas.puesto_usuario', ['tipos' => $tipos]);
    }

  public function registrar_puesto_usuario(Request $request){
    $validacion = Validator::make($request->all(), [
      'descripcion'=>'required|min:3|unique:puesto_usuario,descripcion',
    ]);

    if($validacion->fails()){
      return response()->json(['errores' => $validacion->errors()]);
    }
    $tipo = \App\puesto_usuario::create([
      'descripcion'=>$request->descripcion,
    ]);
    $msg = 'Se registro el puesto de usuario exitosamente: '.$request->descripcion;
    return response()->json(['mensaje' => $msg]);
  }

  public function mostrar_vista_reunion(){
    $tipos = \App\tipo_reunion::orderBy('updated_at', 'desc')->get();
    // $tipos = Auth::user()->grupos_reunion;
    $convocados = \App\usuario::orderBy('updated_at', 'desc')->get();
    $puestos = \App\puesto_usuario::orderBy('updated_at', 'asc')->get();

    if($puestos->count() < 1){
        abort(418, 'Debe de agregar por lo menos un puesto de reunión de trabajo');
    }
    if($tipos->count() < 1){
        abort(418, 'Debe de agregar por lo menos un grupo de reunión');
    }

    return view('Paginas.reunion', [
      'tipos'=>$tipos,
      'convocados'=>$convocados,
      'puestos'=>$puestos,
    ]);
  }

  public function actualizar_vista(Request $request){
      $tipo_reunion = \App\tipo_reunion::find($request->id);
      $reuniones = $tipo_reunion->temas_pendientes();
      $usuarios = $tipo_reunion->usuarios;
      $lista = array();

      foreach($usuarios as $usuario){
        array_push($lista, $usuario->id_usuario);
      }

      $temas = null;
      if($reuniones != null){

      }
      return response()->json([
        'mensaje' => 'No hay temas pendientes de: '.$tipo_reunion->descripcion,
        'datos' => $reuniones,
        'lista' => $lista,
      ]);
  }

  public function crear_reunion(Request $request){
    $validacion = Validator::make($request->all(), [
      'motivo'=>'required|min:3',
      'lugar'=>'required|min:3',
      'tipo_de_reunion'=>'required',
      'fecha'=>'required|date',
    ]);

    if($validacion->fails()){
      return response()->json(['errores' => $validacion->errors()]);
    }

    $lista_convocados = json_decode($request->convocados);
    $puestos = json_decode($request->puestos);
    $orden = json_decode($request->orden_dia);
    $responsables = json_decode($request->responsables);
    $pendientes = json_decode($request->pendientes);
    $secretario = json_decode($request->secretario);
    $moderador = json_decode($request->moderador);

    if(count($lista_convocados) < 2){
      return response()->json(['errores' => ["Tiene agregar por lo menos un convocado."]]);
    }
    if(count($orden) == 0){
      return response()->json(['errores' => ["Tiene que agregar por lo menos un tema para la orden del día."]]);
    }

    $c = str_random(10);
    $reunion = \App\reunion::create([
      'fecha_reunion' => $request->fecha,
      'id_tipo_reunion' => $request->tipo_de_reunion,
      'motivo' => $request->motivo,
      'lugar' => $request->lugar,
      'codigo'=> $c,
      'id_secretario' => $secretario,
      'id_moderador' => $moderador,
    ]);

    $c2 = str_random(10);
    \App\minuta::create([
      'id_reunion' => $reunion->id_reunion,
      'codigo' => $c2,
    ]);

    for($i = 0; $i < count($orden); $i++){
      $orden_dia = \App\orden_dia::create([
        'id_reunion' => $reunion->id_reunion,
        'id_usuario' => $responsables[$i],
        'descripcion' => $orden[$i],
      ]);
    }

    for($i = 0; $i < count($lista_convocados); $i++){
      $convocados = \App\reunion_convocado::create([
        'id_reunion' => $reunion->id_reunion,
        'id_usuario' => $lista_convocados[$i],
        'id_puesto' => $puestos[$i],
      ]);
    }

    foreach($pendientes as $pendiente){
      \App\tema_pendiente::find($pendiente)->update([
        'expirado' => true,
      ]);
    }

    //enviar convocatoria por correo_electronico

    for($i=0; $i< count($reunion->convocados); $i++)
    {
      $correo= $reunion->convocados->get($i)->usuario->correo_electronico;
      $this->enviarCorreo($reunion->id_reunion,$correo,$c);
    }

    return response()->json(['mensaje' => "Nueva reunión creada correctamente."]);
  }

  private function enviarCorreo($id,$correo,$codigo)
  {
    $usuario = \App\usuario::wherecorreo_electronico($correo)->first();
    Mail::send('Paginas.link_pdf',[
      'id_reunion' => $id,
      'codigo' => $codigo,
      'usuario'=>$usuario
    ], function($mensaje) use ($usuario){
        $mensaje->to($usuario->correo_electronico);
        $mensaje->subject("Hola $usuario->nombre haz sido convocada(o) a una reunión en el sistema SisMin");
    });

  }

  public function pdf($id,$codigo){
    //creación del pdf

        $reunion= \App\reunion::find($id);
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


  public function actualizar_puesto(Request $request){
    $validacion = Validator::make($request->all(), [
      'id_puesto'=>'required',
      'descripcion'=>'required|min:3',
    ]);

    if($validacion->fails()){
      return response()->json(['errores' => $validacion->errors()]);
    }

    $puesto= \App\puesto_usuario::find($request->id_puesto);
    $puesto->update([
      'descripcion' => $request->descripcion,
    ]);

    return response()->json(['mensaje' => 'Se actualizo correctamente el puesto: '.$request->descripcion]);

  }

}
