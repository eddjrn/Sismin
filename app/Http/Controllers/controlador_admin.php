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
            'id_usuario'=>'required',
            'descripcion' => 'required|min:3',
            'existe'=>'required',
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
          $reunion =\App\tipo_reunion::find($id);
          $admin = $reunion->id_usuario;
          $descripciones = array();
          $descripcion_reunion = \App\tipo_reunion::All();



         $grupoUs=\App\grupo_usuario::where('id_tipo_reunion',$reunion->id_tipo_reunion)
                                  ->where('id_usuario',$idC)
                                  ->delete();

          foreach ($descripcion_reunion as $reunionx) {
            array_push($descripciones,strtoupper($reunionx->descripcion));
          }

          if($archivo && $request->existe=='true'){
            if(strtoupper($reunion->descripcion) == strtoupper($request->descripcion)){
              $reunion->update([
                'id_usuario' => $idC,
                'imagen_logo' => $imagen,
              ]);
              $grupoUsr=\App\grupo_usuario::where('id_tipo_reunion',$reunion->id_tipo_reunion)
                                       ->where('id_usuario',$admin)
                                       ->update([
                                         'id_usuario'=>$idC
                                       ]);
             $grupoUsr=\App\grupo_usuario::where('id_tipo_reunion',$reunion->id_tipo_reunion)
                                      ->where('id_usuario',$admin)
                                      ->delete();

            }else if (in_array(strtoupper($request->descripcion), $descripciones)) {
                return response()->json(['errores' => $request->descripcion.' ya existe']);
             }else{
               $reunion->update([
                 'id_usuario' => $idC,
                 'descripcion'=>$request->descripcion,
                 'imagen_logo' => $imagen,
               ]);
               $grupoUsr=\App\grupo_usuario::create([
                 'id_tipo_reunion'=>$reunion->id_tipo_reunion,
                 'id_usuario'=>$idC,
               ]);

            }
        }else {
        if(strtoupper($reunion->descripcion) == strtoupper($request->descripcion)){
            $reunion->update([
              'id_usuario' => $idC,
            ]);
            $grupoUsr=\App\grupo_usuario::create([
              'id_tipo_reunion'=>$reunion->id_tipo_reunion,
              'id_usuario'=>$idC,
            ]);
          }else if (in_array( strtoupper($request->descripcion), $descripciones)) {
            return response()->json(['errores' => $request->descripcion.' ya existe']);
         }else{
           $reunion->update([
             'id_usuario' => $idC,
             'descripcion'=>$request->descripcion,
           ]);
           $grupoUsr=\App\grupo_usuario::create([
             'id_tipo_reunion'=>$reunion->id_tipo_reunion,
             'id_usuario'=>$idC,
           ]);
        }
      }
      return response()->json(['mensaje' => "Se asigno como administrador  a ".$idU->__toString().", se cambió el nombre del grupo a".$des]);
      }

    public function mostrar_vista_DB(){
      $archivos = Storage::files('/recuperacion');
      $usuarios = \App\usuario::All();
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
        'usuarios' => $usuarios,
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
        config(['database.connections.mysql.database'=>'Sismin_recuperacion']);
        Storage::copy('recuperacion/'.$archivo, 'backups/'.$archivo);
        Artisan::call('backup:mysql-restore',['--filename' => $archivo,'--yes'=>true]);
        Storage::delete('/backups/'.$archivo);
        Artisan::call('config:cache');

         return response()->json(['mensaje' => 'Archivo: '.$archivo.' activado.']);
      }
    }

    public function subirRespaldo(Request $request){
      $archivo = $request->file('archivo');

      Storage::putFileAs('/backups',$archivo,$archivo->getClientOriginalName());
      //realizar respaldo en la base de datos de Sismin
      config(['database.connections.mysql.database'=>'Sismin_recuperacion']);
      Artisan::call('backup:mysql-restore',['--filename' => $archivo->getClientOriginalName(),'--yes'=>true]);
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

    public function Usuario_datos(Request $request){
      $validacion = Validator::make($request->all(), [
        'nombre'=>'required|min:3',
        'a_paterno'=>'required|min:3',
        'a_materno'=>'required|min:3',
        'correo'=>'required|min:3|email',
      ]);

      //'id_usuario'=>'not_in:0',
      if($validacion->fails()){
        return response()->json(['errores' => $validacion->errors()]);
      }

      $usuario = \App\usuario::find($request->id_usuario);

        $usuario->update([
        'nombre'=>$request->nombre,
        'apellido_paterno' => $request->a_paterno,
        'apellido_materno' => $request->a_materno,
        'correo_electronico' => $request->correo,
      ]);

      return response()->json(['mensaje' => 'Se actualizó al usuario: '.$usuario->nombre.' correctamente.']);

    }

    public function activarUsr(Request $request){
      $validacion=Validator::make($request->all(),[
        'id_usuario'=>'required',
        'activado'=>'required',
      ]);

      if ($validacion->fails()) {
        return response()->json(['errores' => $validacion->errors()]);
      }
        $bandera ='hola';
        if($request->activado == 1){
            $bandera = 'activó';
        }else{
          $bandera = 'desactivó';
        }
        $usuario = \App\usuario::find($request->id_usuario);
        $usuario->update(['estatus'=> $request->activado]);
      return response()->json(['mensaje' => 'Se '.$bandera.' al usuario: '.$usuario.' correctamente.']);
    }

    public function delegarAdmin(Request $request){
      $usuario = \App\usuario::find($request->id_usuario);

      if($usuario != null){
        $arrayx = Config::get('variables');
        $arrayx ['admin']= $request->id_usuario;
        $datos = var_export($arrayx,1);
        if(File::put(base_path().'/config/variables.php',"<?php\n return $datos;"))
        {
          Artisan::call('config:cache');
          return response()->json(['mensaje' => 'El usuario '.$usuario->__toString().' ahora es administrador del sistema']);
        }
      } else{
        return response()->json(['errores' => ['Error del usuario.']]);
      }
    }
}
