<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreacionGrupoUsuario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupo_usuario', function(Blueprint $table){
          $table->increments('id_grupo_usuario');
          $table->timestamps();
          $table->integer('id_tipo_reunion')->unsigned()->index();
          $table->foreign('id_tipo_reunion')->references('id_tipo_reunion')->on('tipo_reunion')->onDelete('cascade');
          $table->integer('id_usuario')->unsigned()->index();
          $table->foreign('id_usuario')->references('id_usuario')->on('usuario')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('grupo_usuario', function(Blueprint $table){
          $table->dropForeign(['id_tipo_reunion']);
          $table->dropForeign(['id_usuario']);
        });

        Schema::dropIfExists('grupo_usuario');
    }
}
