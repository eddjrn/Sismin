<?php

use Illuminate\Database\Seeder;

class prueba_compromiso_responsable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('compromiso_responsable')->insert([
        'created_at'=> now(),
        'updated_at' => now(),
        'id_compromiso' => 1,
        'id_usuario' => 1,
        'tarea' => 'esta es la descripcion de la primera tarea de los compromisos-responsables'
      ]);

      for($i=0; $i<= config('variables.tema_pendienteDB'); $i++){
        DB::table('compromiso_responsable')->insert([
          'created_at'=> now(),
          'updated_at' => now(),
          'id_compromiso' => rand(1,config('variables.tema_pendienteDB')),
          'id_usuario' => rand(1,config('variables.usuariosDB')),
          'tarea' => str_random(25),
        ]);
      }
    }
}
