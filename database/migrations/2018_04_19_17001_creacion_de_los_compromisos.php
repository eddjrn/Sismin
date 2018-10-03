<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreacionDeLosCompromisos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

      Schema::create('compromiso', function (Blueprint $table) {
          $table->increments('id_compromiso');
          $table->timestamps();
          $table->integer('id_minuta')->unsigned()->index();
          $table->foreign('id_minuta')->references('id_minuta')->on('minuta')->onDelete('cascade');
          $table->integer('id_orden_dia')->unsigned()->index();
          $table->foreign('id_orden_dia')->references('id_orden_dia')->on('orden_dia')->onDelete('cascade');
          $table->text('descripcion',5000);
          $table->dateTime('fecha_limite');
          $table->boolean('finalizado')->default(false);
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('compromiso', function(Blueprint $table){
        $table->dropForeign(['id_minuta']);
        $table->dropForeign(['id_orden_dia']);
      });
      Schema::drop('compromiso');
    }
}
