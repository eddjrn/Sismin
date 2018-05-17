<?php

use Illuminate\Database\Seeder;

class prueba_tema_pendiente extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('tema_pendiente')->insert([
        'created_at'=> now(),
        'updated_at' => now(),
        'id_minuta' => 1,
        'id_orden_dia' => 1,
        'id_usuario' => 1,
        'descripcion' => 'descripcion del primer tema pendiente',
      ]);

      for($i=0; $i<= config('variables.tema_pendienteDB'); $i++){
        DB::table('tema_pendiente')->insert([
          'created_at'=> now(),
          'updated_at' => now(),
          'id_minuta' => rand(1,config('variables.reunionDB')),
          'id_orden_dia' => rand(1,config('variables.orden_del_diaDB')),
          'id_usuario' => rand(1,config('variables.usuariosDB')),
          'descripcion' => str_random(25),
        ]);
      }
    }
}
