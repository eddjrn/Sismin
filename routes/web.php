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

/*
|--------------------------------------------------------------------------
| Usuario Normal
|--------------------------------------------------------------------------
*/
Route::get('/login','controlador_usuarios@mostrar_login')->middleware('publica');
Route::get('/registro/{correo}/{codigo}','controlador_usuarios@mostrar_registro')->middleware('publica');
Route::post('/registro/{correo}/{codigo}','controlador_usuarios@crear')->middleware('publica');
Route::get('/solicitud_registro','controlador_usuarios@mostrar_solicitud_registro')->middleware('publica');
Route::post('/solicitud_registro','controlador_usuarios@solicitar_registro')->middleware('publica');

Route::get('/recuperar_pass','controlador_usuarios@mostrar_recuperar_password')->middleware('publica');
Route::post('/recuperar_pass','controlador_usuarios@cambiar_password')->middleware('publica');
Route::get('/cambiar_password/{correo}/{codigo}','controlador_usuarios@mostrar_cambiar_password')->middleware('publica');
Route::post('/cambiar_password','controlador_usuarios@reestablecer_password')->middleware('publica');

Route::get('/acercade','controlador_acercade@mostrar_acercade')->middleware('sesion');
Route::get('/perfil','controlador_usuarios@mostrar_perfil')->middleware('sesion');
Route::post('/perfil','controlador_usuarios@reestablecer_password_perfil')->middleware('sesion');

Route::post('/login','controlador_usuarios@iniciar_sesion')->middleware('publica');
Route::get('/logout','controlador_usuarios@cerrar_sesion');
Route::get('/','controlador_vista_general@mostrar_vista_principal')->middleware('sesion');
Route::post('/vista_principal_detalles','controlador_vista_general@mostrar_detalles_reunion')->middleware('sesion');
Route::post('/vista_principal_select','controlador_vista_general@cambiarSecre')->middleware('sesion');
Route::post('/vista_principal_eliminar/{id}/{codigo}','controlador_vista_general@eliminarReunion')->middleware('sesion');
Route::post('/vista_principal_tarea','controlador_vista_general@actualizarTarea')->middleware('sesion');

Route::get('/tipo_reunion','controlador_reunion@mostrar_vista_tipo_reunion')->middleware('sesion');
Route::post('/tipo_reunion','controlador_reunion@registrar_tipo_reunion')->middleware('sesion');

Route::get('/puesto_usuario','controlador_reunion@mostrar_vista_puesto_usuario')->middleware('sesion');
Route::post('/puesto_usuario','controlador_reunion@registrar_puesto_usuario')->middleware('sesion');

Route::get('/reunion','controlador_reunion@mostrar_vista_reunion')->middleware('sesion');
Route::post('/reunion_especifica', 'controlador_reunion@actualizar_vista')->middleware('sesion');
Route::post('/reunion','controlador_reunion@crear_reunion')->middleware('sesion');

Route::get('/pdf/{id}/{codigo}','controlador_reunion@pdf');

Route::get('/minuta/{id}/{codigo}','controlador_minuta@mostrar_vista_minuta')->middleware('sesion');
Route::post('/minuta','controlador_minuta@crear_minuta')->middleware('sesion');
Route::get('/pdf_minuta/{id}/{codigo}','controlador_minuta@pdf_minuta');
Route::post('/minuta/enterado','controlador_minuta@firmar')->middleware('sesion');

Route::get('/agenda','controlador_agenda@mostrar_vista_agenda')->middleware('sesion');

Route::get('/pendientes','controlador_pendientes@mostrar_vista_pendientes')->middleware('sesion');
Route::post('/pendientes','controlador_pendientes@actualizarEstatus')->middleware('sesion');

Route::get('/recuperacion','controlador_respaldo@mostrar_vista_respaldo')->middleware('sesion');
Route::get('/pdf_respaldo/{id}/{codigo}','controlador_respaldo@pdf');
Route::get('/pdf_minuta_respaldo/{id}/{codigo}','controlador_respaldo@pdf_minuta');


Route::get('/administrar_grupos','controlador_grupos@mostrar_vista_grupos')->middleware('sesion');
Route::post('/agregar_usrs','controlador_grupos@actualizar_grupos')->middleware('sesion');
Route::post('/puesto_usuario/editar_puesto','controlador_reunion@actualizar_puesto')->middleware('sesion');


/*
|--------------------------------------------------------------------------
| Administrador del sistema
|--------------------------------------------------------------------------
*/

Route::get('/base_datos', 'controlador_admin@mostrar_vista_DB')->middleware('sesion','admin');
Route::post('/tipo_reunion_admin', 'controlador_admin@cambiarAdmin')->middleware('sesion','admin');
Route::get('/crear_respaldo', 'controlador_admin@crearRespaldo')->middleware('sesion','admin');
Route::get('/descargar_respaldo/backups/{archivo}', 'controlador_admin@descargarRespaldo')->middleware('sesion','admin');
Route::get('/eliminar_respaldo/backups/{archivo}', 'controlador_admin@eliminarRespaldo')->middleware('sesion','admin');
Route::get('/descargar_respaldo/recuperacion/{archivo}', 'controlador_admin@descargarRespaldoRecuperacion')->middleware('sesion','admin');
Route::get('/activar_respaldo/recuperacion/{archivo}', 'controlador_admin@activarRespaldo')->middleware('sesion','admin');
Route::post('/subir_respaldo', 'controlador_admin@subirRespaldo')->middleware('sesion','admin');
Route::post('/actualizar_usuario', 'controlador_admin@Usuario_datos')->middleware('sesion','admin');
Route::post('/activar_estatus', 'controlador_admin@activarUsr')->middleware('sesion','admin');
Route::post('/delegar_responsabilidad', 'controlador_admin@delegarAdmin')->middleware('sesion','admin');
