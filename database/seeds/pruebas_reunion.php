<?php

use Illuminate\Database\Seeder;

class pruebas_reunion extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('reunion')->insert([
        'created_at'=> now(),
        'updated_at' => now(),
        'fecha_reunion' => now(),
        'id_tipo_reunion' => 1,
        'motivo' => 'prueba',
        'lugar' => 'cds',
      ]);

      for($i=0; $i<= config('variables.reunionDB'); $i++){
        DB::table('reunion')->insert([
          'created_at'=> now(),
          'updated_at' => now(),
          'fecha_reunion' => now(),
          'id_tipo_reunion' =>rand(1,config('variables.tipos_de_reunionDB')),
          'motivo' => str_random(70),
          'lugar' => str_random(30),
        ]);
      }
    }

}
