<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class pruebas_usuario extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('usuario')->insert([
        'created_at'=> now(),
        'updated_at' => now(),
        'nombre' => 'Mayra',
        'apellido_paterno' =>'Villavicencio',
        'apellido_materno' => 'Marquez',
        'correo_electronico' => 'mayra29109@gmail.com',
        'rubrica' =>'data:image/jpeg;base64,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',
        'password' => Hash::make('mayra1234'),
      ]);

      for($i=0; $i<= config('variables.usuariosDB'); $i++){
        DB::table('usuario')->insert([
          'created_at'=> now(),
          'updated_at' => now(),
          'nombre' => str_random(7),
          'apellido_paterno' =>str_random(15),
          'apellido_materno' => str_random(15),
          'correo_electronico' => str_random(20).'@gmail.com',
          'rubrica' => '01010101',
          'password' => Hash::make('mayra1234'),
        ]);
      }

      DB::table('usuario')->insert([
        'created_at'=> now(),
        'updated_at' => now(),
        'nombre' => 'Eduardo',
        'apellido_paterno' =>'Reyes',
        'apellido_materno' => 'Norman',
        'correo_electronico' => 'eddjrn@gmail.com',
        'rubrica' => '01010101',
        'password' => Hash::make('1234567'),
      ]);
    }
}
