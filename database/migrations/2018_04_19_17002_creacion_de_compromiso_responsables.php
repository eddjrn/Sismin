<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreacionDeCompromisoResponsables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compromiso_responsable', function (Blueprint $table) {
          $table->increments('id_compromiso_resp');
          $table->timestamps();
          $table->integer('id_compromiso')->unsigned()->index();
          $table->foreign('id_compromiso')->references('id_compromiso')->on('compromiso')->onDelete('cascade');
          $table->integer('id_usuario')->unsigned()->index();
          $table->foreign('id_usuario')->references('id_usuario')->on('usuario')->onDelete('cascade');
          $table->text('tarea',100)->nullable();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('compromiso_responsable', function(Blueprint $table){
        $table->dropForeign(['id_compromiso']);
        $table->dropForeign(['id_usuario']);
      });
      Schema::drop('compromiso_responsable');
    }
}
