<?php

use Illuminate\Database\Seeder;

class prueba_tipo_usuario extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('tipo_usuario')->insert([
        'created_at'=> now(),
        'updated_at' => now(),
        'descripcion' => 'Moderador',

      ]);

      for($i=0; $i<= config('variables.tipo_usuarioDB'); $i++){
        DB::table('tipo_usuario')->insert([
          'created_at'=> now(),
          'updated_at' => now(),
          'descripcion' => str_random(30),
        ]);
      }
    }
}
