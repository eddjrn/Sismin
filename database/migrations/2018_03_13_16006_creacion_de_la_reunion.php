<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreacionDeLaReunion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reunion', function (Blueprint $table) {
            $table->increments('id_reunion');
            $table->timestamps();
            $table->dateTime('fecha_reunion');
            $table->integer('id_tipo_reunion')->unsigned()->index();
            $table->foreign('id_tipo_reunion')->references('id_tipo_reunion')->on('tipo_reunion')->onDelete('cascade');
            $table->text('motivo',100);
            $table->text('lugar',100);
            $table->string('codigo',10);
            $table->integer('id_secretario')->unsigned()->index();
            $table->foreign('id_secretario')->references('id_usuario')->on('usuario')->onDelete('cascade');
            $table->integer('id_moderador')->unsigned()->index();
            $table->foreign('id_moderador')->references('id_usuario')->on('usuario')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     *
     */
    public function down()
    {
      Schema::table('reunion', function(Blueprint $table){
        $table->dropForeign(['id_tipo_reunion']);
        $table->dropForeign(['id_secretario']);
        $table->dropForeign(['id_moderador']);
      });
      Schema::drop('reunion');
    }
}
