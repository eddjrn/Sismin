<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Date\Date;

class tipo_reunion extends Model
{
  protected $table = 'tipo_reunion';

  protected $primaryKey = 'id_tipo_reunion';

  protected $fillable = [
    'id_tipo_reunion',
    'descripcion',
    'imagen_logo',
  ];

  public function __toString(){
    return $this->descripcion;
  }

  public function reuniones(){
    return $this->hasMany(reunion::class,'id_tipo_reunion')->orderBy('fecha_reunion', 'desc');
  }

  public function getFecha(){
   Date::setLocale('es');
   return Date::parse($this->created_at)->format('j \\d\\e F \\d\\e\\l Y \\a \\l\\a\\s h:i:s A');
  }

 public function setDescripcionAttribute($value){
   $con = strtolower($value);
   $descripcion = ucfirst($con);
   $this->attributes['descripcion'] = $descripcion;
 }

 public function getImagenLogoAttribute($value){
   return "data:image/jpeg;base64,".base64_encode($value);
 }

 public function temas_pendientes(){
   $reuniones = $this->reuniones;
   $arreglo_pendientes = array();
   foreach($reuniones as $reunion){
     $temas = \App\tema_pendiente::all()->where('id_minuta', '=', $reunion->id_reunion)->where('expirado', '=', 'false');
     if($temas->count() > 0){
       foreach($temas as $tema){
         array_push($arreglo_pendientes, $tema);
       }
     }
   }
   return $arreglo_pendientes;
 }

 public function administrador(){
   return $this->hasOne(usuario::class,'id_usuario');
 }

 public function usuarios(){
   return $this->hasMany(grupo_usuario::class,'id_tipo_reunion');
 }

 public function usuarios_grupo(){
   $reg_usuarios= $this->usuarios;
   $usuariosx= array();
   foreach($reg_usuarios as $reg_usuario){
     $usuario = $reg_usuario->usuario;
     array_push($usuariosx,$usuario);
   }
   return $usuariosx;
 }
}
