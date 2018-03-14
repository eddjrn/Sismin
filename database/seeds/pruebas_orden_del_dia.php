<?php

use Illuminate\Database\Seeder;

class pruebas_orden_del_dia extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('orden_dia')->insert([
        'created_at'=> now(),
        'updated_at' => now(),
        'id_reunion' => 1,
        'id_usuario' =>1,
        'descripcion' => 'Esta es la descripcion de la orden del dia',
        'descripcion_hechos' => 'esta es la descripcion de los hechos de la orden del dia',
      ]);

      for($i=0; $i<= config('variables.orden_del_diaDB'); $i++){
        DB::table('orden_dia')->insert([
          'created_at'=> now(),
          'updated_at' => now(),
          'id_reunion' => rand(1,config('variables.reunionDB')),
          'id_usuario' =>rand(1,config('variables.usuariosDB')),
          'descripcion' => str_random(70),
          'descripcion_hechos' => str_random(100),
        ]);
      }
    }

}
