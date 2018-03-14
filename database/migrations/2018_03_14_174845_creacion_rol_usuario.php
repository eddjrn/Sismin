<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreacionRolUsuario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('rol_usuario',function(Blueprint $table){
        $table->increments('id_rol');
        $table->timestamps();
        $table->string('descripcion',50);
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
         Schema::drop('rol_usuario');
     }
}
