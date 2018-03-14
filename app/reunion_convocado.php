<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Date\Date;


class reunion_convocado extends Model
{
  protected $table = 'reunion_convocado';

  protected $primaryKey = 'id_convocado';

  protected $fillable = [
    'id_reunion',
    'id_usuario',
    'asistencia',
    'id_rol',
    'id_tipo_usuario',
  ];

  public function __toString(){
  if($this->asistencia==true){
    return 'Asistió';
  }else{
    return 'no asistió';
  }
  }

  public function usuario(){
    return $this->hasMany(usuario::class,'id_usuario');
  }

  public function reunion(){
    return $this->belongsToMany(reunion::class,'id_reunion');
  }

  public function rol(){
    return $this->belongsTo(rol_usuario::class,'id_rol');
  }

  public function tipo(){
    return $this->belongsTo(tipo_usuario::class,'id_tipo_usuario');
  }

  public function getFecha(){
   Date::setLocale('es');
   return Date::parse($this->created_at)->format('j \\d\\e F \\d\\e\\l Y \\a \\l\\a\\s h:i:s A');
 }

}
