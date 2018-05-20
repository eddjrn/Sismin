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
    'codigo',
    'id_secretario',
    'id_moderador'
  ];

  protected $dates = [
   'created_at', // Add if you're using timestamps on the model
   'updated_at', // Add if you're using timestamps on the model
   'fecha_reunion',
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
  return $this->hasMany(reunion_convocado::class,'id_reunion');
 }

 public function minuta(){
  return $this->hasOne(minuta::class,'id_reunion')->orderBy('id_minuta', 'desc');
 }

 public function moderador(){
  return $this->belongsTo(usuario::class,'id_moderador');
 }

 public function secretario(){
  return $this->belongsTo(usuario::class,'id_secretario');
 }

  public function getFecha(){
   Date::setLocale('es');
   return Date::parse($this->created_at)->format('\\A l j \\d\\e F \\d\\e\\ Y ');
  }

  public function getLimite(){
    $fecha = new Date($this->getOriginal('fecha_reunion'));
    return $fecha->diffForHumans();
  }

  public function getFechaReunionLegible(){
   Date::setLocale('es');
   return Date::parse($this->fecha_reunion)->format('l j \\d\\e F \\d\\e\\ Y \\a \\l\\a\\s H:i:s \\h\\o\\r\\a\\s ');
  }

  public function setFechaReunionAttribute($value){
    $this->attributes['fecha_reunion'] = Date::createFromFormat('Y-m-d H:i', $value)->format('Y-m-d H:i:s');
  }

  public function setMotivoAttribute($value){
   $con = strtolower($value);
   $Motivo = ucfirst($con);
   $this->attributes['motivo'] = $Motivo;
  }

  public function setLugarAttribute($value){
   $con = strtolower($value);
   $lugar = ucfirst($con);
   $this->attributes['lugar'] = $lugar;
  }

  public function reunion_temas_pendientes(){
    $reunion =$this->tipo_reunion->reuniones->sortByDesc('fecha_reunion')->get(1);
    $codigo = $reunion->minuta->fecha_elaboracion;
    if($reunion == null||$codigo ==""){
        return array();
    }else{
        return $reunion->minuta->temas_pendientes;
    }

  }

}
