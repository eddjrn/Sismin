<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreacionPuestoUsuario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('puesto_usuario',function(Blueprint $table){
        $table->increments('id_puesto');
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
         Schema::drop('puesto_usuario');
     }
}
