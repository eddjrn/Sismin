<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Jenssegers\Date\Date;


class usuario extends Authenticatable
{
    use Notifiable;

    protected $guard = 'web';

    protected $table = 'usuario';

    protected $primaryKey = 'id_usuario';

    protected $fillable = [
      'nombre',
      'apellido_paterno',
      'apellido_materno',
      'correo_electronico',
      'rubrica',
      'password',
    ];

    protected $hidden = [
      'password',
      'remember_token',
    ];

    public function __toString(){
      return $this->nombre.' '.$this->apellido_paterno.' '.$this->apellido_materno;
    }

    public function setNombreAttribute($value){
      $con = strtolower($value);
      $nombre = ucwords($con);
      $this->attributes['nombre'] = $nombre;
    }

    public function setApellidoPaternoAttribute($value){
      $con = strtolower($value);
      $apelldo_paterno = ucwords($con);
      $this->attributes['apellido_paterno'] = $apelldo_paterno;
    }

    public function setApellidoMaternoAttribute($value){
      $con = strtolower($value);
      $apellido_materno = ucwords($con);
      $this->attributes['apellido_materno'] = $apellido_materno;
    }

    public function getRubricaAttribute($value){
      return "data:image/jpeg;base64,".base64_encode($value);
    }

    public function getFecha(){
       Date::setLocale('es');
       return Date::parse($this->created_at)->format('j \\d\\e F \\d\\e\\l Y \\a \\l\\a\\s h:i:s A');
     }

   public function orden_dia(){
     return $this->hasMany(orden_dia::class,'id_usuario');
   }

   public function convocado_en(){
     return $this->hasMany(reunion_convocado::class,'id_usuario');
   }

   public function numModerador(){
    $reuniones=$this->convocado_en->where('id_tipo_usuario','=','1');
    $cont=0;
    $id_reuniones =  array();

    foreach ($reuniones as $reunionMod) {
      $id =$reunionMod->reunion->id_tipo_reunion;

      if(!(in_array($id,$id_reuniones))){
        array_push($id_reuniones,$id);
        $cont++;
      }
    }

    // for($i=0; $i<count($reuniones); $i++)
    // {
    //     $id =$reuniones[$i]->reunion->id_tipo_reunion;
    //
    //     if(!(in_array($id,$id_reuniones))){
    //       $igualar=$reuniones[$i]->reunion;
    //       array_push($id_reuniones,$id);
    //       $cont++;
    //     }


   return $cont . ' reuniones recientes';
 }
}
