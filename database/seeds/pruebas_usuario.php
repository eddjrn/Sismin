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
        'correo_electronico' => 'mayra291@gmail.com',
        'rubrica' => '1010',
        'password' => Hash::make('mayra1234'),
      ]);

      // for($i=0; $i<= config('variables.usuariosDB'); $i++){
      //   DB::table('usuario')->insert([
      //     'created_at'=> now(),
      //     'updated_at' => now(),
      //     'nombre' => str_random(7),
      //     'apellido_paterno' =>str_random(15),
      //     'apellido_materno' => str_random(15),
      //     'correo_electronico' => str_random(20).'@gmail.com',
      //     'rubrica' => '01010101',
      //     'password' => Hash::make('mayra1234'),
      //   ]);
      // }

      DB::table('usuario')->insert([
        'created_at'=> now(),
        'updated_at' => now(),
        'nombre' => 'Pedro Pepe',
        'apellido_paterno' =>'Pereira',
        'apellido_materno' => 'Perez',
        'correo_electronico' => 'pedro95@gmail.com',
        'rubrica' => '01010101',
        'password' => Hash::make('1234567'),
      ]);

      DB::table('usuario')->insert([
        'created_at'=> now(),
        'updated_at' => now(),
        'nombre' => 'Juan Jose',
        'apellido_paterno' =>'Ramirez',
        'apellido_materno' => 'Noriega',
        'correo_electronico' => 'junaskdw_43@gmail.com',
        'rubrica' => '01010101',
        'password' => Hash::make('1234567'),
      ]);

      DB::table('usuario')->insert([
        'created_at'=> now(),
        'updated_at' => now(),
        'nombre' => 'María Luisa',
        'apellido_paterno' =>'Del Rosario',
        'apellido_materno' => 'Lugo',
        'correo_electronico' => 'maria_bends@gmail.com',
        'rubrica' => '01010101',
        'password' => Hash::make('1234567'),
      ]);

      DB::table('usuario')->insert([
        'created_at'=> now(),
        'updated_at' => now(),
        'nombre' => 'María de los Angeles',
        'apellido_paterno' =>'Villavicencio',
        'apellido_materno' => 'Marquez',
        'correo_electronico' => 'villa_22@gmail.com',
        'rubrica' => '01010101',
        'password' => Hash::make('1234567'),
      ]);

      DB::table('usuario')->insert([
        'created_at'=> now(),
        'updated_at' => now(),
        'nombre' => 'Edd',
        'apellido_paterno' =>'Rey',
        'apellido_materno' => 'Nor',
        'correo_electronico' => 'eddsdrn@gmail.com',
        'rubrica' => '01010101',
        'password' => Hash::make('123456'),
      ]);
    }
}
