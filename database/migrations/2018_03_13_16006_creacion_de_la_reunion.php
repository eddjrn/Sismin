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
            $table->dateTime('fecha_reunion_orden');
            $table->integer('id_tipo_reunion')->unsigned()->index();
            $table->foreign('id_tipo_reunion')->references('id_tipo_reunion')->on('tipo_reunion');
            $table->text('motivo',100);
            $table->text('lugar',100);
            $table->string('codigo',10);
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
      });
      Schema::drop('reunion');
    }
}
