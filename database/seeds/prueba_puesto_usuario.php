<?php

use Illuminate\Database\Seeder;

class prueba_puesto_usuario extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('puesto_usuario')->insert([
        'created_at'=> now(),
        'updated_at' => now(),
        'descripcion' => 'Secretario',
      ]);

      for($i=0; $i<= config('variables.puesto_usuarioDB'); $i++){
        DB::table('puesto_usuario')->insert([
          'created_at'=> now(),
          'updated_at' => now(),
          'descripcion' => str_random(30),
        ]);
      }
    }
}
