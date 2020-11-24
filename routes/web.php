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

    Route::get('/cursos', 'ControladorWebCurso@index');

    Route::get('/conferencias', 'ControladorWebConferencias@index');

    Route::get('/testimonios', 'ControladorWebTestimonios@index');
  
    Route::get('/admin', 'ControladorHome@index');
    Route::get('/admin/legajo', 'ControladorLegajo@index');

    Route::get('/admin/home', 'ControladorHome@index');

    Route::get('/coaching/equipo', 'ControladorWebCoachingEquipo@index');

    Route::get('/coaching/ejecutivo', 'ControladorWebCoachingEjecutivo@index');

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
Route::get('/admin/curso/nuevo', 'ControladorCurso@nuevo');
Route::post('/admin/curso/nuevo', 'ControladorCurso@guardar');
Route::get('/admin/sistema/curso/cargarGrilla', 'ControladorCurso@cargarGrilla')->name('curso.cargarGrilla');
Route::get('/admin/cursos', 'ControladorCurso@index');
Route::get('/admin/curso/nuevo/{id}', 'ControladorCurso@editar');
Route::post('/admin/curso/nuevo/{id}', 'ControladorCurso@guardar');
Route::get('/admin/curso/eliminar', 'ControladorCurso@eliminar');


/* --------------------------------------------- */
/* CONTROLADOR TESTIMONIO                             */
/* --------------------------------------------- */
    Route::get('/admin/testimonio/nuevo', 'ControladorTestimonio@nuevo');
    Route::post('/admin/testimonio/nuevo', 'ControladorTestimonio@guardar');
    Route::get('/admin/testimonios', 'ControladorTestimonio@index');
    Route::get('/admin/testimonio/cargarGrilla', 'ControladorTestimonio@cargarGrilla')->name('testimonio.cargarGrilla');
    Route::get('/admin/testimonio/nuevo/{id}', 'ControladorTestimonio@editar');
    Route::post('/admin/testimonio/nuevo/{id}', 'ControladorTestimonio@guardar');
    Route::get('/admin/testimonio/eliminar', 'ControladorTestimonio@eliminar');

/* --------------------------------------------- */
/* CONTROLADOR ALUMNOS                           */
/* --------------------------------------------- */
    Route::get('/admin/alumno/nuevo', 'ControladorAlumno@nuevo');
    Route::post('/admin/alumno/nuevo', 'ControladorAlumno@guardar');
    Route::get('/admin/alumno/eliminar', 'ControladorAlumno@eliminar');
    Route::get('/admin/alumnos', 'ControladorAlumno@index');
    Route::get('/admin/alumnos/cargarGrilla', 'ControladorAlumno@cargarGrilla')->name('alumno.cargarGrilla');
    Route::get('/admin/alumno/nuevo/{id}', 'ControladorAlumno@editar');
    Route::post('/admin/alumno/nuevo/{id}', 'ControladorAlumno@guardar');

/* --------------------------------------------- */
/* CONTROLADOR CONFERENCIAS                          */
/* --------------------------------------------- */

    Route::get('/admin/conferencia/nuevo', 'ControladorConferencia@nuevo');
    Route::post('/admin/conferencia/nuevo', 'ControladorConferencia@guardar');
    Route::get('/admin/conferencias', 'ControladorConferencia@index');
    Route::get('/admin/conferencias/cargarGrilla', 'ControladorConferencia@cargarGrilla')->name('conferencia.cargarGrilla');
    Route::get('/admin/conferencia/nuevo/{id}', 'ControladorConferencia@editar');
    Route::post('/admin/conferencia/nuevo/{id}', 'ControladorConferencia@guardar');
    Route::get('/admin/conferencia/eliminar', 'ControladorConferencia@eliminar');

/* --------------------------------------------- */
/* CONTROLADOR CATEGORIAS                          */
/* --------------------------------------------- */
    Route::get('/admin/cursos/categoria/nuevo', 'ControladorCategoria@nuevo');
    Route::post('/admin/cursos/categoria/nuevo', 'ControladorCategoria@guardar');
    Route::get('/admin/cursos/categorias', 'ControladorCategoria@index');
    Route::get('/admin/cursos/categorias/cargarGrilla', 'ControladorCategoria@cargarGrilla')->name('categoria.cargarGrilla');
    Route::get('/admin/cursos/categoria/nuevo/{id}', 'ControladorCategoria@editar');
    Route::post('/admin/cursos/categoria/nuevo/{id}', 'ControladorCategoria@guardar');
    Route::get('/admin/cursos/categoria/eliminar', 'ControladorCategoria@eliminar');

/* --------------------------------------------- */
/* CONTROLADOR VENTAS                          */
/* --------------------------------------------- */
    Route::get('/admin/venta/nueva', 'ControladorVenta@nuevo');
    Route::post('/admin/venta/nueva', 'ControladorVenta@guardar');
    Route::get('/admin/ventas', 'ControladorVenta@index');
    Route::get('/admin/ventas/nuevo/{id}', 'ControladorVenta@editar');
    Route::get('/admin/ventas/cargarGrilla', 'ControladorVenta@cargarGrilla')->name('ventas.cargarGrilla');

});
