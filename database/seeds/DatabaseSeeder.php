<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      //  $this->call(UsersTableSeeder::class);
        $this->call(pruebas_usuario::class);
        $this->call(pruebas_tipo_de_reunion::class);
        $this->call(pruebas_reunion::class);
        $this->call(pruebas_orden_del_dia::class);
        $this->call(prueba_puesto_usuario::class);
        $this->call(prueba_reunion_convocado::class);
        $this->call(prueba_minuta::class);
        $this->call(prueba_tema_pendiente::class);
        $this->call(prueba_compromiso::class);
        $this->call(prueba_compromiso_responsable::class);
    }
}
