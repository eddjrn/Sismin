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
    'id_usuario',
  ];

  public function __toString(){
    return $this->descripcion;
  }

  public function reuniones(){
    return $this->hasMany(reunion::class,'id_tipo_reunion')->orderBy('fecha_reunion', 'desc');
  }

  public function administrador(){
    return $this->belongsTo(usuario::class,'id_usuario');
  }

  public function usuarios(){
    return $this->belongsToMany(usuario::class,'grupo_usuario', 'id_tipo_reunion', 'id_usuario');
  }

  public function getFecha(){
   Date::setLocale('es');
   return Date::parse($this->created_at)->format('j \\d\\e F \\d\\e\\l Y \\a \\l\\a\\s h:i:s A');
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

}
