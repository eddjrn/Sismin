<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Date\Date;

class compromiso extends Model
{
  protected $table = 'compromiso';

  protected $primaryKey = 'id_compromiso';

  protected $fillable = [
    'id_minuta',
    'id_orden_dia',
    'descripcion',
    'fecha_limite',
    'finalizado',
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

  public function responsables(){
   return $this->hasMany(compromiso_responsable::class,'id_compromiso');
  }

  public function setDescripcionAttribute($value){
    $con = strtolower($value);
    $descripcion = ucfirst($con);
    $this->attributes['descripcion'] = $descripcion;
  }

  public function getFecha(){
   Date::setLocale('es');
   return Date::parse($this->created_at)->format('\\A l j \\d\\e F \\d\\e\\ Y ');
  }


}
