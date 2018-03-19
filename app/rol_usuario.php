<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Date\Date;


class rol_usuario extends Model
{
  protected $table = 'rol_usuario';

  protected $primaryKey = 'id_rol';

  protected $fillable = [
    'descripcion',
  ];

  public function __toString(){
    return $this->descripcion;
  }

  public function convocados(){
    return $this->hasMany(reunion_convocado::class,'id_rol');
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
}
