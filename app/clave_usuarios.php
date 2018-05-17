<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class clave_usuarios extends Model
{
  protected $table = 'clave_usuario';

  protected $fillable = [
    'correo_electronico',
    'codigo'
  ];
}
