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

   public function temas_pendientes(){
     return $this->hasMany(tema_pendiente::class,'id_usuario');
   }

   public function convocado_en(){
     return $this->hasMany(reunion_convocado::class,'id_usuario')->orderBy('created_at', 'desc');
   }

   public function responsable_en(){
     return $this->hasMany(compromiso_responsable::class,'id_usuario');
   }

   public function secretario_de(){
     return $this->hasMany(reunion::class,'id_secretario');
   }

   public function moderador_de(){
     return $this->hasMany(reunion::class,'id_moderador');
   }

   public function reuniones_pendientes(){
     $reuniones = $this->convocado_en->sortByDesc('fecha_reunion');

     $reuniones_recientes =  array();

     for($i=0; $i<count($reuniones); $i++)
     {

         if($reuniones[$i]->reunion->minuta->existe() == false){
           $igualar=$reuniones[$i]->reunion;
           array_push($reuniones_recientes,$igualar);
         }
     }
     return $reuniones_recientes;
   }

   public function reuniones_historial(){
     $reuniones = $this->convocado_en;
     $reuniones_historial =  array();

     for($i=0; $i<count($reuniones); $i++)
     {

         if($reuniones[$i]->reunion->minuta->existe() == true){
           $igualar=$reuniones[$i]->reunion;
           array_push($reuniones_historial,$igualar);
         }
     }
     return $reuniones_historial;
   }

  public function minutas_recientes(){
    $minutas_recientes = array();
    foreach($this->convocado_en as $convocado_r){
      $minuta = $convocado_r->reunion->minuta;
      $fecha = $minuta->getOriginal()['fecha_elaboracion'];
      if($fecha != null){
        $fecha_elavoracion = Date::parse($fecha);
        if($fecha_elavoracion->diffInWeeks() < 3){
          array_push($minutas_recientes, $minuta);
        }
      }
    }
    return $minutas_recientes;
  }
}
