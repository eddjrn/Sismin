<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreacionReunionConvocado extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('reunion_convocado',function(Blueprint $table){
        $table->increments('id_convocado');
        $table->timestamps();
        $table->integer('id_reunion')->unsigned()->index();
        $table->foreign('id_reunion')->references('id_reunion')->on('reunion')->onDelete('cascade');
        $table->integer('id_usuario')->unsigned()->index();
        $table->foreign('id_usuario')->references('id_usuario')->on('usuario')->onDelete('cascade');
        $table->boolean('asistencia')->default(false);
        $table->integer('id_rol')->unsigned()->index();
        $table->foreign('id_rol')->references('id_rol')->on('rol_usuario')->onDelete('cascade');
        $table->integer('id_tipo_usuario')->unsigned()->index();
        $table->foreign('id_tipo_usuario')->references('id_tipo_usuario')->on('tipo_usuario')->onDelete('cascade');
        $table->boolean('enterado')->default(false);
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('reunion_convocado', function(Blueprint $table){
        $table->dropForeign(['id_usuario']);
        $table->dropForeign(['id_reunion']);
        $table->dropForeign(['id_rol']);
        $table->dropForeign(['id_tipo_usuario']);
      });
      Schema::drop('reunion_convocado');
    }
}
