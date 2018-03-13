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
          $table->integer('id_reunion');
          $table->integer('id_usuario');
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
        Schema::drop('orden_dia');
    }
}
