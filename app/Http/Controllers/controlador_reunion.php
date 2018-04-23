<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Image;
use Mail;
use Barryvdh\DomPDF\Facade as PDF;

class controlador_reunion extends Controller
{
    //
    public function mostrar_vista_tipo_reunion(){
      $tipos = \App\tipo_reunion::orderBy('updated_at', 'desc')->get();

      return view('Paginas.tipo_reunion', ['tipos' => $tipos]);
    }

    public function registrar_tipo_reunion(Request $request){
      $validacion = Validator::make($request->all(), [
        'descripcion'=>'required|min:4',
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
      ]);

      $msg = 'Se agregó: '.$request->descripcion;
      return response()->json(['mensaje' => $msg]);
    }

    public function mostrar_vista_rol_usuario(){
      $tipos = \App\rol_usuario::orderBy('updated_at', 'desc')->get();
      return view('Paginas.rolUsuario', ['tipos' => $tipos]);
    }

  public function registrar_rol_usuario(Request $request){
    $validacion = Validator::make($request->all(), [
      'descripcion'=>'required',
    ]);

    if($validacion->fails()){
      return response()->json(['errores' => $validacion->errors()]);
    }
    $tipo = \App\rol_usuario::create([
      'descripcion'=>$request->descripcion,
    ]);
    $msg = 'Se registro el rol de usuario exitosamente: '.$request->descripcion;
    return response()->json(['mensaje' => $msg]);
  }

  public function mostrar_vista_reunion(){
    $tipos = \App\tipo_reunion::orderBy('updated_at', 'desc')->get();
    $convocados = \App\usuario::orderBy('updated_at', 'desc')->get();
    $roles = \App\rol_usuario::orderBy('updated_at', 'asc')->get()->forget(0);

    return view('Paginas.reunion', [
      'tipos'=>$tipos,
      'convocados'=>$convocados,
      'roles'=>$roles,
    ]);
  }

  public function actualizar_vista(Request $request, $opc){
    switch($opc){
      case 1:
        $tipo_reunion = \App\tipo_reunion::find($request->id);
        $reunion = $tipo_reunion->reuniones->sortByDesc('fecha_reunion')->first();
        // No se tienen temas pendientes en el sistema :(
        // Por hacer
        //   Sacar los temas pendientes de las minutas y ponerlos en la seccion de orden del dia
        //   Que sean seleccionables en la seccion y sacar sus datos
        if($reunion == null){
          $temas = null;
        } else{
          $temas = $reunion->minuta->temas_pendientes;
        }
        return response()->json([
          'mensaje' => 'No hay temas pendientes de: '.$tipo_reunion->descripcion,
          'datos' => $temas,
        ]);

        break;
    }
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
    $roles = json_decode($request->roles);
    $orden = json_decode($request->orden_dia);
    $responsables = json_decode($request->responsables);

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
    $convocado = \App\reunion_convocado::create([
      'id_reunion' => $reunion->id_reunion,
      'id_usuario' => $lista_convocados[0],
      'id_rol' => $roles[0],
      'id_tipo_usuario' => 1,
    ]);

    for($i = 1; $i < count($lista_convocados); $i++){
      $convocados = \App\reunion_convocado::create([
        'id_reunion' => $reunion->id_reunion,
        'id_usuario' => $lista_convocados[$i],
        'id_rol' => $roles[$i],
        'id_tipo_usuario' => 2,
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
          'img'=>$reunion->convocados->get(0)->usuario->rubrica,
          'tipo'=>$reunion->tipo_reunion->descripcion
      ]);
        return $pdf->stream();
      }
      else{
        abort(404);
      }
        //return $pdf->download('listado.pdf');
  }

  public function pdf_minuta(){
    $pdf = PDF::loadView('Paginas.pdf_minuta');
    return $pdf->stream();
  }

}
