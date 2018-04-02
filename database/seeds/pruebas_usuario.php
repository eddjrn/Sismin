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
        'rubrica' => '01010101',
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
