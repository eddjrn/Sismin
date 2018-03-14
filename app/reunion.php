<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Date\Date;

class reunion extends Model
{
  protected $table = 'reunion';

  protected $primaryKey = 'id_reunion';

  protected $fillable = [
    'fecha_reunion',
    'id_tipo_reunion',
    'motivo',
    'lugar',
  ];

  public function __toString(){
    return $this->motivo.' en el lugar '.$this->lugar;
  }

  public function tipo_reunion(){
    return $this->belongsTo(tipo_reunion::class,'id_tipo_reunion');
  }

  public function orden_dia(){
    return $this->hasMany(orden_dia::class,'id_reunion');
  }

 public function convocados(){
  return $this->belongsToMany(reunion_convocado::class,'id_reunion');
 }

  public function getFecha(){
   Date::setLocale('es');
   return Date::parse($this->created_at)->format('j \\d\\e F \\d\\e\\l Y \\a \\l\\a\\s h:i:s A');
 }

}
