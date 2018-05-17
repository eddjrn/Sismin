<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreacionDelTemaPendiente extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tema_pendiente', function (Blueprint $table) {
            $table->increments('id_tema_pendiente');
            $table->timestamps();
            $table->integer('id_minuta')->unsigned()->index();
            $table->foreign('id_minuta')->references('id_minuta')->on('minuta')->onDelete('cascade');
            $table->integer('id_orden_dia')->unsigned()->index();
            $table->foreign('id_orden_dia')->references('id_orden_dia')->on('orden_dia')->onDelete('cascade');
            $table->integer('id_usuario')->unsigned()->index();
            $table->foreign('id_usuario')->references('id_usuario')->on('usuario')->onDelete('cascade');
            $table->text('descripcion',100);
            $table->boolean('expirado')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('tema_pendiente', function(Blueprint $table){
        $table->dropForeign(['id_minuta']);
        $table->dropForeign(['id_orden_dia']);
        $table->dropForeign(['id_usuario']);
      });
      Schema::drop('tema_pendiente');
    }
}
