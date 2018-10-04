<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Date\Date;


class puesto_usuario extends Model
{
  protected $table = 'puesto_usuario';

  protected $primaryKey = 'id_puesto';

  protected $fillable = [
    'descripcion',
  ];

  public function __toString(){
    return $this->descripcion;
  }

  public function convocados(){
    return $this->hasMany(reunion_convocado::class,'id_puesto');
  }

  public function getFecha(){
   Date::setLocale('es');
   return Date::parse($this->created_at)->format('j \\d\\e F \\d\\e\\l Y \\a \\l\\a\\s h:i:s A');
  }
}
