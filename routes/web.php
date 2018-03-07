<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/t', function(){
  abort(419);
  $colores = array("bg-red","bg-orange");
  $mensajes = array("Error","warning");
  $tiempos = 1000;
  return view('/Layout/layout',['mensaje' => $mensajes, 'color'=> $colores, 'tiempo' => $tiempos]);
});

Route::get('/login','controlador_usuarios@mostrar_login');
Route::get('/registro','controlador_usuarios@mostrar_registro');
Route::post('/registro','controlador_usuarios@crear');
Route::get('/recuperar_pass','controlador_usuarios@mostrar_recuperar_password');
Route::post('/recuperar_pass','controlador_usuarios@cambiar_password');

Route::get('/acercade','controlador_acercade@mostrar_acercade');
Route::get('/perfil','controlador_usuarios@mostrar_perfil');

Route::post('/login','controlador_usuarios@iniciar_sesion');
Route::get('/logout','controlador_usuarios@cerrar_sesion');
Route::get('/','controlador_vista_general@mostrar_vista_principal')->middleware('sesion');
