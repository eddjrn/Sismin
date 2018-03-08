<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class clave_usuarios extends Model
{
  protected $table = 'claves_usuarios';

  protected $fillable = [
    'correo_electronico',
    'codigo'
  ];
}
