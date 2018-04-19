<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Date\Date;

class orden_dia extends Model
{
  protected $table = 'orden_dia';

  protected $primaryKey = 'id_orden_dia';

  protected $fillable = [
    'id_reunion',
    'id_usuario',
    'descripcion',
    'descripcion_hechos',
  ];

  public function __toString(){
    return $this->descripcion;
  }

  public function usuario(){
    return $this->belongsTo(usuario::class,'id_usuario');
  }

  public function reunion(){
    return $this->belongsTo(reunion::class,'id_reunion');
  }

  public function temas_pendientes(){
   return $this->hasMany(temas_pendientes::class,'id_orden_dia');
  }

  public function compromisos(){
   return $this->hasMany(compromiso::class,'id_orden_dia');
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

 public function setDescripcionHechosAttribute($value){
   $con = strtolower($value);
   $descripcion = ucfirst($con);
   $this->attributes['descripcion_hechos'] = $descripcion;
 }

}
