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
        $table->integer('id_puesto')->unsigned()->index();
        $table->foreign('id_puesto')->references('id_puesto')->on('puesto_usuario')->onDelete('cascade');
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
        $table->dropForeign(['id_puesto']);
      });
      Schema::drop('reunion_convocado');
    }
}
