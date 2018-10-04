<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Date\Date;

class tema_pendiente extends Model
{
  protected $table = 'tema_pendiente';

  protected $primaryKey = 'id_tema_pendiente';

  protected $fillable = [
    'id_minuta',
    'id_orden_dia',
    'id_usuario',
    'descripcion',
    'expirado',
  ];

  public function __toString(){
    return $this->descripcion;
  }

  public function minuta(){
    return $this->belongsTo(minuta::class,'id_minuta');
  }

  public function orden_dia(){
    return $this->belongsTo(orden_dia::class,'id_orden_dia');
  }

  public function usuario(){
   return $this->belongsTo(usuario::class,'id_usuario');
  }

  public function setDescripcionAttribute($value){
    $descripcion = trim($value, "\t\n");
    $this->attributes['descripcion'] = $descripcion;
  }

  public function getFecha(){
   Date::setLocale('es');
   return Date::parse($this->created_at)->format('\\A l j \\d\\e F \\d\\e\\ Y ');
  }

}
