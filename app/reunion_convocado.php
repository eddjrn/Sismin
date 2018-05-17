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
    'id_puesto',
    'enterado',
  ];

  public function __toString(){
  if($this->asistencia==true){
    return 'Presente';
  }else{
    return 'Ausente';
  }
  }

  public function usuario(){
    return $this->belongsTo(usuario::class,'id_usuario');
  }

  public function reunion(){
    return $this->belongsTo(reunion::class,'id_reunion');
  }

  public function puesto(){
    return $this->belongsTo(puesto_usuario::class,'id_puesto');
  }

  public function getFecha(){
   Date::setLocale('es');
   return Date::parse($this->created_at)->format('j \\d\\e F \\d\\e\\l Y \\a \\l\\a\\s h:i:s A');
 }

 public function es_secretario(){
   $us=$this->usuario->id_usuario;
   $rs=$this->reunion->secretario->id_usuario;
   if($us==$rs){
     return true;
   }else{
     return false;
   }
 }

 public function es_moderador(){
   $um=$this->usuario->id_usuario;
   $rm=$this->reunion->moderador->id_usuario;
   if($um==$rm){
     return true;
   }else{
     return false;
   }
 }

 public function rol(){
   if($this->es_moderador() && $this->es_secretario()){
       return 'Moderador y Secretario';
   }
   else if($this->es_moderador()){
       return 'Moderador';
   }
   else if($this->es_secretario()){
       return 'Secretario';
   }
   else{
     return 'Convocado';
   }
 }

}
