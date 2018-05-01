<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreacionDeLaMinuta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('minuta',function(Blueprint $table){
        $table->increments('id_minuta');
        $table->timestamps();
        $table->dateTime('fecha_elaboracion')->nullable();
        $table->integer('id_reunion')->unsigned()->index();
        $table->foreign('id_reunion')->references('id_reunion')->on('reunion');
        $table->text('notas', 255)->nullable();
        $table->string('codigo',10);
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('minuta', function(Blueprint $table){
        $table->dropForeign(['id_reunion']);
      });
      Schema::drop('minuta');
    }
}
