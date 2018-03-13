<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
  

}
