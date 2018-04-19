<?php

use Illuminate\Database\Seeder;

class prueba_compromiso extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('compromiso')->insert([
        'created_at'=> now(),
        'updated_at' => now(),
        'id_minuta' => 1,
        'id_orden_dia' => 1,
        'descripcion' => 'descripcion del primer tema pendiente',
        'fecha_limite'=> now(),
        'finalizado'=> true,
      ]);

      for($i=0; $i<= config('variables.tema_pendienteDB'); $i++){
        DB::table('compromiso')->insert([
          'created_at'=> now(),
          'updated_at' => now(),
          'id_minuta' => rand(1,config('variables.reunionDB')),
          'id_orden_dia' => rand(1,config('variables.orden_del_diaDB')),
          'descripcion' =>  str_random(25),
          'fecha_limite'=> now(),
          'finalizado'=> false,
        ]);
      }
    }
}
