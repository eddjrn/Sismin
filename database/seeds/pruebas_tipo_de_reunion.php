<?php

use Illuminate\Database\Seeder;

class pruebas_tipo_de_reunion extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('tipo_reunion')->insert([
        'created_at'=> now(),
        'updated_at' => now(),
        'descripcion' => 'esta es la descripcion de un tipo de reunion',
        'imagen_logo' =>'010101',
      ]);

      for($i=0; $i<= config('variables.tipos_de_reunionDB'); $i++){
        DB::table('tipo_reunion')->insert([
          'created_at'=> now(),
          'updated_at' => now(),
          'descripcion' => str_random(15),
          'imagen_logo' => '01010101',
        ]);
      }
    }

}
