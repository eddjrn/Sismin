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

Route::get('/login','controlador_usuarios@mostrar_login')->middleware('publico');
Route::get('/registro','controlador_usuarios@mostrar_registro')->middleware('publico');
Route::post('/registro','controlador_usuarios@crear')->middleware('publico');

Route::get('/recuperar_pass','controlador_usuarios@mostrar_recuperar_password')->middleware('publico');
Route::post('/recuperar_pass','controlador_usuarios@cambiar_password')->middleware('publico');
Route::get('/cambiar_password/{correo}/{codigo}','controlador_usuarios@mostrar_cambiar_password')->middleware('publico');
Route::post('/cambiar_password','controlador_usuarios@reestablecer_password')->middleware('publico');

Route::get('/acercade','controlador_acercade@mostrar_acercade')->middleware('sesion');
Route::get('/perfil','controlador_usuarios@mostrar_perfil')->middleware('sesion');

Route::post('/login','controlador_usuarios@iniciar_sesion')->middleware('publico');
Route::get('/logout','controlador_usuarios@cerrar_sesion');
Route::get('/','controlador_vista_general@mostrar_vista_principal')->middleware('sesion');
