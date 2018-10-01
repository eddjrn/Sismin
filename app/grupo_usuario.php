<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class grupo_usuario extends Model
{
    protected $table = 'grupo_usuario';

    protected $primaryKey = 'id_grupo_usuario';

    protected $fillable=[
      'id_usuario',
      'id_tipo_reunion',
    ];

    // public function grupo(){
    //   return $this->belongsToMany(tipo_reunion::class,'id_tipo_reunion');
    // }
    //
    // public function usuario(){
    //   return $this->belongsToMany(usuario::class,'id_usuario');
    // }

}
