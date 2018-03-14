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
    return $this->hasOne(usuario::class,'id_usuario');
  }

  public function reunion(){
    return $this->hasOne(reunion::class,'id_reunion');
  }

  public function getFecha(){
   Date::setLocale('es');
   return Date::parse($this->created_at)->format('j \\d\\e F \\d\\e\\l Y \\a \\l\\a\\s h:i:s A');
 }

}