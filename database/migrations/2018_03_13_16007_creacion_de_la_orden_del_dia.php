<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreacionDeLaOrdenDelDia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orden_dia', function (Blueprint $table) {
          $table->increments('id_orden_dia');
          $table->timestamps();
          $table->integer('id_reunion')->unsigned()->index();
          $table->foreign('id_reunion')->references('id_reunion')->on('reunion');
          $table->integer('id_usuario')->unsigned()->index();
          $table->foreign('id_usuario')->references('id_usuario')->on('usuario');
          $table->text('descripcion',200);
          $table->text('descripcion_hechos',400);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orden_dia', function(Blueprint $table){
          $table->dropForeign(['id_usuario']);
          $table->dropForeign(['id_reunion']);
        });
        Schema::drop('orden_dia');

    }
}
