<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreacionDelTipoDeReunion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_reunion', function (Blueprint $table) {
            $table->increments('id_tipo_reunion');
            $table->timestamps();
            $table->string('descripcion',100)->unique();
            $table->binary('imagen_logo');
            $table->integer('id_usuario')->unsigned()->index()->nullable();
            $table->foreign('id_usuario')->references('id_usuario')->on('usuario')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

      Schema::table('tipo_reunion', function(Blueprint $table){
        $table->dropForeign(['id_usuario']);
      });
        Schema::dropIfExists('tipo_reunion');
    }
}
