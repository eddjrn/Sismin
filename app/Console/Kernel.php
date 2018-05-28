<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Mail;
use Jenssegers\Date\Date;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
        //* * * * * php /var/www/html/Sismin/artisan schedule:run >> /dev/null 2>&1
        $schedule->call(function () {
            $usuarios = \App\usuario::all();
            foreach($usuarios as $usuario){
                $correo = $usuario->correo_electronico;
                $compromisos_responsables = $usuario->responsable_en;
                $compromisos = array();
                $fechaHoy = Date::now();
                $ejecutarCorreo = false;
                foreach($compromisos_responsables as $compromiso_responsable){
                    if($compromiso_responsable->compromisos->finalizado == false){
                        $fechaLimite = Date::parse($compromiso_responsable->compromisos->getOriginal()['fecha_limite']);
                        if($fechaLimite->greaterThan($fechaHoy)){
                            array_push($compromisos, $compromiso_responsable);
                            $ejecutarCorreo = true;
                        }
                    }
                }
                if($ejecutarCorreo){
                    Mail::send('Paginas.recordatoriosCompromisos', [
                        'usuario' => $usuario,
                        'compromisos' => $compromisos,
                    ], function($mensaje) use ($correo, $usuario){
                        $mensaje->to($correo);
                        $mensaje->subject("Hola $usuario->nombre tienes compromisos pendientes en el sistema SisMin");
                    });
                }
            }
         })->daily();
    }

    /**
     * Register the commands for the application.everyMinute
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
