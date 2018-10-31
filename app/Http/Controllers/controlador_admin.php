<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Image;
use Jenssegers\Date\Date;

class controlador_admin extends Controller
{
    public function mostrar_vista_principal_admin(){
      return view('Paginas.mostrar_vista_principal');
    }

    public function cambiarAdmin(Request $request){
      $validacion = Validator::make($request->all(), [
        'id_tipo'=>'required',
      ]);

      //'id_usuario'=>'not_in:0',
      if($validacion->fails()){
        return response()->json(['errores' => $validacion->errors()]);
      }

      $id= $request->id_tipo;
      $idC = $request->id_usuario;
      $des = $request->descripcion;

      $idU = \App\usuario::find($idC);

      $archivo = $request->file('croppedImage');
      $imagen = Image::make($archivo);
      $imagen->encode('jpeg', 80);

    //
    //   if($des == null){
    //     $reunion =\App\tipo_reunion::find($id);
    //     $reunion->update([
    //       'id_usuario' => $idC,
    //     ]);
    //
    //     return response()->json(['mensaje' => "Se asigno como administrador del grupo a ".$idU->__toString()]);
    //
    //   }else if($idC == 0){
    //     $reunion =\App\tipo_reunion::find($id);
    //     $reunion->update([
    //       'descripcion'=>$request->descripcion,
    //     ]);
    //
    //   return response()->json(['mensaje' => "Se cambió el nombre del grupo a".$des]);
    // }else{'recuperacion/'.
      $reunion =\App\tipo_reunion::find($id);
      $reunion->update([
        'id_usuario' => $idC,
        'descripcion'=>$request->descripcion,
        'imagen_logo' => $imagen,
      ]);

      return response()->json(['mensaje' => "Se asigno como administrador  a ".$idU->__toString().", se cambió el nombre del grupo a".$des]);
    }

    public function mostrar_vista_DB(){
      $archivos = Storage::files('/recuperacion');
      Date::setLocale('es');

      $todo= array();
      foreach ($archivos as $archivo) {
        $fecha_nombre= array();
        $nombre = basename($archivo);
        $directorio = $archivo;
        $fecha_extencion = basename(explode("_",basename($archivo))[1],".sql");
        $fecha = Date::parse($fecha_extencion)->format(' l j \\d\\e F \\d\\e\\ Y \\a \\l\\a\\s H:i:s  ');
        array_push($fecha_nombre,$nombre);
        array_push($fecha_nombre,$fecha);
        array_push($fecha_nombre,$directorio);
        array_push($todo,$fecha_nombre);
      }

      return view('Paginas.Admin_DB', [
        'archivos' => $todo,
      ]);
    }

    public function crearRespaldo(){
      Artisan::call('backup:mysql-dump');
      $archivos = Storage::files('/backups');
      // return $archivos[0];
      // $datos = Storage::get($archivos[2]);
      return response()->json(['mensaje' => 'Archivo creado', 'nombre' => $archivos[0]]);
      // return response()->json(['mensaje' => 'Archivo creado', 'datos' => $datos]);
    }

    public function descargarRespaldo($archivo){
      return Storage::download('/backups/'.$archivo);
    }

    public function eliminarRespaldo($archivo){
      Storage::delete('/backups/'.$archivo);
      return back();
    }

    public function descargarRespaldoRecuperacion($archivo){
      return Storage::download('/recuperacion/'.$archivo);
    }

    public function activarRespaldo($archivo){
    //  config(['variables.recuperacion' => 5]);

      // Config::set('variables.recuperacion', 5);
      // Artisan::call('config:cache');
      // return response()->json(['mensaje' => 'Archivo: '.$archivo.' activado.']);
      $arrayx = Config::get('variables');
      $arrayx ['recuperacion']= $archivo;
      $datos = var_export($arrayx,1);
      if(File::put(base_path().'/config/variables.php',"<?php\n return $datos;")){
        Artisan::call('config:cache');
         return response()->json(['mensaje' => 'Archivo: '.$archivo.' activado.']);
      }
    }

    public function subirRespaldo(Request $request){
      $archivo = $request->file('archivo');

      Storage::putFileAs('/backups',$archivo,$archivo->getClientOriginalName());
      //realizar respaldo en la base de datos de Sismin
      Artisan::call('backup:mysql-restore',['--filename' => $archivo->getClientOriginalName()]);
      Storage::delete('/backups/'.$archivo->getClientOriginalName());

      $arrayx = Config::get('variables');
      $arrayx ['recuperacion']= $archivo->getClientOriginalName();
      $datos = var_export($arrayx,1);
      if(File::put(base_path().'/config/variables.php',"<?php\n return $datos;"))
      {
        Artisan::call('config:cache');
         return response()->json(['mensaje' => 'Archivo: '.$archivo->getClientOriginalName().' activado.']);
      }
    }
}
