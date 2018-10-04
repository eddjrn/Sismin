<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Date\Date;

class compromiso_responsable extends Model
{
  protected $table = 'compromiso_responsable';

  protected $primaryKey = 'id_compromiso_resp';

  protected $fillable = [
    'id_compromiso',
    'id_usuario',
    'tarea',
    'realizado',
  ];

  public function __toString(){
    return $this->descripcion;
  }

  public function compromisos(){
   return $this->belongsTo(compromiso::class,'id_compromiso');
  }

  public function usuario(){
   return $this->belongsTo(usuario::class,'id_usuario');
  }

  public function getFecha(){
   Date::setLocale('es');
   return Date::parse($this->created_at)->format('\\A l j \\d\\e F \\d\\e\\ Y ');
  }

}
