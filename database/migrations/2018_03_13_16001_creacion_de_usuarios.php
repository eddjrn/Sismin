<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreacionDeUsuarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('usuario',function(Blueprint $table){
          $table->increments('id_usuario');
          $table->timestamps();
          $table->string('nombre',50);
          $table->string('apellido_paterno',50);
          $table->string('apellido_materno',50);
          $table->string('correo_electronico',50)->unique();
          $table->binary('rubrica');
          $table->string('password',60);
          $table->boolean('estatus')->default(true);
          $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('usuario');
    }
}
