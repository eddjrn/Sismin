<?php

use Illuminate\Database\Seeder;

class prueba_reunion_convocado extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('reunion_convocado')->insert([
        'created_at'=> now(),
        'updated_at' => now(),
        'id_reunion' => 1,
        'id_usuario' => 1,
        'asistencia' => true,
        'id_puesto' => 1,
      ]);

      for($i=2; $i <= config('variables.reunion_convocadoDB'); $i++){
        DB::table('reunion_convocado')->insert([
          'created_at'=> now(),
          'updated_at' => now(),
          'id_reunion' =>rand(1,config('variables.reunionDB')),
          'id_usuario' =>rand(1,config('variables.usuariosDB')),
          'asistencia' => false,
          'id_puesto' =>rand(1,config('variables.puesto_usuarioDB')),
        ]);
      }
    }
}
