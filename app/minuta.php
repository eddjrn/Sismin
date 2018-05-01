<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Date\Date;


class minuta extends Model
{
  protected $table = 'minuta';

  protected $primaryKey = 'id_minuta';

  protected $fillable = [
    'fecha_elaboracion',
    'id_reunion',
    'notas',
    'codigo',
  ];

  public function reunion(){
    return $this->belongsTo(reunion::class,'id_reunion');
  }

  public function temas_pendientes(){
    return $this->hasMany(tema_pendiente::class,'id_minuta');
  }

  public function compromisos(){
    return $this->hasMany(compromiso::class,'id_minuta');
  }

  public function getFecha(){
   Date::setLocale('es');
   return Date::parse($this->created_at)->format('\\A l j \\d\\e F \\d\\e\\ Y ');
  }

  public function getLimite(){
    $fecha = new Date($this->getOriginal('fecha_elaboracion'));
    return $fecha->diffForHumans();
  }

  public function getFechaElaboracionAttribute($value){
   Date::setLocale('es');
   return Date::parse($value)->format('l j \\d\\e F \\d\\e\\ Y \\a \\l\\a\\s H:i:s \\h\\o\\r\\a\\s ');
  }

  public function setFechaElaboracionAttribute($value){
    $this->attributes['fecha_elaboracion'] = Date::createFromFormat('Y-m-d H:i', $value)->format('Y-m-d H:i:s');
  }


}
