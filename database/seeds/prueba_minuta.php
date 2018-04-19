<?php

use Illuminate\Database\Seeder;

class prueba_minuta extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('minuta')->insert([
        'created_at'=> now(),
        'updated_at' => now(),
        'fecha_elaboracion' => now(),
        'id_reunion' => 1,
        'codigo'=>'1234567898'
      ]);

      for($i=0; $i<= config('variables.reunionDB'); $i++){
        DB::table('minuta')->insert([
          'created_at'=> now(),
          'updated_at' => now(),
          'fecha_elaboracion' => now(),
          'id_reunion' =>rand(1,config('variables.reunionDB')),
          'codigo' => str_random(10),
        ]);
      }
    }
}
