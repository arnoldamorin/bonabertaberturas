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

Route::group(array('domain' => '127.0.0.1'), function () {

    Route::get('/', 'ControladorWebHome@index');

    Route::get('/contacto', 'ControladorWebContacto@index');

    Route::get('/cursos', 'ControladorWebCurso@index');
    /*Route::get('/cursos/compra{id}', 'ControladorWebCurso@compraCurso');*/
    Route::get('/cursos/curso-detalle/{id}', 'ControladorWebCurso@detalleCurso');
    Route::post('/cursos/curso-detalle/{id}', 'ControladorWebCurso@comprar');

    Route::get('/contacto', 'ControladorWebContacto@index');
    Route::post('/contacto', 'ControladorWebContacto@enviarCorreo');
    Route::get("/cursos/compra-realizada/{id}", "ControladorWebCurso@CompraRealizada");
    Route::get("/cursos/compra-pendiente/{id}", "ControladorWebCurso@compraPendiente");
    Route::get("/cursos/compra-error/{id}", "ControladorWebCurso@compraError");


    Route::get('/admin/home', 'ControladorHome@index');
    Route::get('/admin', 'ControladorHome@index');


    /* --------------------------------------------- */
    /* CONTROLADOR LOGIN                           */
    /* --------------------------------------------- */
    Route::get('/admin/login', 'ControladorLogin@index');
    Route::get('/admin/logout', 'ControladorLogin@logout');
    Route::post('/admin/logout', 'ControladorLogin@entrar');
    Route::post('/admin/login', 'ControladorLogin@entrar');

    /* --------------------------------------------- */
    /* CONTROLADOR RECUPERO CLAVE                    */
    /* --------------------------------------------- */
    Route::get('/admin/recupero-clave', 'ControladorRecuperoClave@index');
    Route::post('/admin/recupero-clave', 'ControladorRecuperoClave@recuperar');

    /* --------------------------------------------- */
    /* CONTROLADOR PERMISO                           */
    /* --------------------------------------------- */
    Route::get('/admin/usuarios/cargarGrillaFamiliaDisponibles', 'ControladorPermiso@cargarGrillaFamiliaDisponibles')->name('usuarios.cargarGrillaFamiliaDisponibles');
    Route::get('/admin/usuarios/cargarGrillaFamiliasDelUsuario', 'ControladorPermiso@cargarGrillaFamiliasDelUsuario')->name('usuarios.cargarGrillaFamiliasDelUsuario');
    Route::get('/admin/permisos', 'ControladorPermiso@index');
    Route::get('/admin/permisos/cargarGrilla', 'ControladorPermiso@cargarGrilla')->name('permiso.cargarGrilla');
    Route::get('/admin/permiso/nuevo', 'ControladorPermiso@nuevo');
    Route::get('/admin/permiso/cargarGrillaPatentesPorFamilia', 'ControladorPermiso@cargarGrillaPatentesPorFamilia')->name('permiso.cargarGrillaPatentesPorFamilia');
    Route::get('/admin/permiso/cargarGrillaPatentesDisponibles', 'ControladorPermiso@cargarGrillaPatentesDisponibles')->name('permiso.cargarGrillaPatentesDisponibles');
    Route::get('/admin/permiso/{idpermiso}', 'ControladorPermiso@editar');
    Route::post('/admin/permiso/{idpermiso}', 'ControladorPermiso@guardar');

    /* --------------------------------------------- */
    /* CONTROLADOR GRUPO                             */
    /* --------------------------------------------- */
    Route::get('/admin/grupos', 'ControladorGrupo@index');
    Route::get('/admin/usuarios/cargarGrillaGruposDelUsuario', 'ControladorGrupo@cargarGrillaGruposDelUsuario')->name('usuarios.cargarGrillaGruposDelUsuario'); //otra cosa
    Route::get('/admin/usuarios/cargarGrillaGruposDisponibles', 'ControladorGrupo@cargarGrillaGruposDisponibles')->name('usuarios.cargarGrillaGruposDisponibles'); //otra cosa
    Route::get('/admin/grupos/cargarGrilla', 'ControladorGrupo@cargarGrilla')->name('grupo.cargarGrilla');
    Route::get('/admin/grupo/nuevo', 'ControladorGrupo@nuevo');
    Route::get('/admin/grupo/setearGrupo', 'ControladorGrupo@setearGrupo');
    Route::post('/admin/grupo/nuevo', 'ControladorGrupo@guardar');
    Route::get('/admin/grupo/{idgrupo}', 'ControladorGrupo@editar');
    Route::post('/admin/grupo/{idgrupo}', 'ControladorGrupo@guardar');

    /* --------------------------------------------- */
    /* CONTROLADOR USUARIO                           */
    /* --------------------------------------------- */
    Route::get('/admin/usuarios', 'ControladorUsuario@index');
    Route::get('/admin/usuarios/nuevo', 'ControladorUsuario@nuevo');
    Route::post('/admin/usuarios/nuevo', 'ControladorUsuario@guardar');
    Route::post('/admin/usuarios/{usuario}', 'ControladorUsuario@guardar');
    Route::get('/admin/usuarios/cargarGrilla', 'ControladorUsuario@cargarGrilla')->name('usuarios.cargarGrilla');
    Route::get('/admin/usuarios/buscarUsuario', 'ControladorUsuario@buscarUsuario');
    Route::get('/admin/usuarios/{usuario}', 'ControladorUsuario@editar');

    /* --------------------------------------------- */
    /* CONTROLADOR MENU                             */
    /* --------------------------------------------- */
    Route::get('/admin/sistema/menu', 'ControladorMenu@index');
    Route::get('/admin/sistema/menu/nuevo', 'ControladorMenu@nuevo');
    Route::post('/admin/sistema/menu/nuevo', 'ControladorMenu@guardar');
    Route::get('/admin/sistema/menu/cargarGrilla', 'ControladorMenu@cargarGrilla')->name('menu.cargarGrilla');
    Route::get('/admin/sistema/menu/eliminar', 'ControladorMenu@eliminar');
    Route::get('/admin/sistema/menu/{id}', 'ControladorMenu@editar');
    Route::post('/admin/sistema/menu/{id}', 'ControladorMenu@guardar');

    /* --------------------------------------------- */
    /* CONTROLADOR CURSOS                             */
    /* --------------------------------------------- */
    Route::get('/admin/curso/nuevo', 'ControladorCurso@nuevo');
    Route::post('/admin/curso/nuevo', 'ControladorCurso@guardar');
    Route::get('/admin/sistema/curso/cargarGrilla', 'ControladorCurso@cargarGrilla')->name('curso.cargarGrilla');
    Route::get('/admin/cursos', 'ControladorCurso@index');
    Route::get('/admin/curso/nuevo/{id}', 'ControladorCurso@editar');
    Route::post('/admin/curso/nuevo/{id}', 'ControladorCurso@guardar');
    Route::get('/admin/curso/eliminar', 'ControladorCurso@eliminar');

    /* --------------------------------------------- */
    /* CONTROLADOR PATENTES                          */
    /* --------------------------------------------- */
    Route::get('/admin/patentes', 'ControladorPatente@index');
    Route::get('/admin/patente/nuevo', 'ControladorPatente@nuevo');
    Route::post('/admin/patente/nuevo', 'ControladorPatente@guardar');
    Route::get('/admin/patente/cargarGrilla', 'ControladorPatente@cargarGrilla')->name('patente.cargarGrilla');
    Route::get('/admin/patente/eliminar', 'ControladorPatente@eliminar');
    Route::get('/admin/patente/nuevo/{id}', 'ControladorPatente@editar');
    Route::post('/admin/patente/nuevo/{id}', 'ControladorPatente@guardar');
 

    /* --------------------------------------------- */
    /* CONTROLADOR VENTAS                          */
    /* --------------------------------------------- */
    Route::get('/admin/venta/nueva', 'ControladorVenta@nuevo');
    Route::post('/admin/venta/nueva', 'ControladorVenta@guardar');
    Route::get('/admin/ventas', 'ControladorVenta@index');
    Route::get('/admin/venta/nueva/{id}', 'ControladorVenta@editar');
    Route::get('/admin/ventas/cargarGrilla', 'ControladorVenta@cargarGrilla')->name('ventas.cargarGrilla');
    Route::post('/admin/venta/nueva/{id}', 'ControladorVenta@guardar');
    Route::get('/admin/ventas/eliminar', 'ControladorVenta@eliminar');
});
