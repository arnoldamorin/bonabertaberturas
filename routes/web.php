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
    Route::get('/empresa', 'ControladorWebEmpresa@index');
    Route::get('/producto', 'ControladorWebProducto@index');
    Route::get('/productos', 'ControladorWebProductosss@index');

    Route::get('/Productoss', 'ControladorWebProductos@index');
    /*Route::get('/Productoss/compra{id}', 'ControladorWebProductos@compraProductos');*/
    Route::get('/Productoss/Productos-detalle/{id}', 'ControladorWebProductos@detalleProductos');
    Route::post('/Productoss/Productos-detalle/{id}', 'ControladorWebProductos@comprar');

    Route::get('/contacto', 'ControladorWebContacto@index');
    Route::post('/contacto', 'ControladorWebContacto@enviarCorreo');
    Route::get("/Productoss/compra-realizada/{id}", "ControladorWebProductos@CompraRealizada");
    Route::get("/Productoss/compra-pendiente/{id}", "ControladorWebProductos@compraPendiente");
    Route::get("/Productoss/compra-error/{id}", "ControladorWebProductos@compraError");


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
    /* CONTROLADOR PRODUCTOS                        */
    /* --------------------------------------------- */
    Route::get('/admin/productos/nuevo', 'ControladorProductos@nuevo');
    Route::post('/admin/productos/nuevo', 'ControladorProductos@guardar');
    Route::get('/admin/productos/cargarGrilla', 'ControladorProductos@cargarGrilla')->name('productos.cargarGrilla');
    Route::get('/admin/productos', 'ControladorProductos@index');
    Route::get('/admin/productos/nuevo/{id}', 'ControladorProductos@editar');
    Route::post('/admin/productos/nuevo/{id}', 'ControladorProductos@guardar');
    Route::get('/admin/productos/eliminar', 'ControladorProductos@eliminar');
    /* --------------------------------------------- */
    /* CONTROLADOR TIPOPRODUCTOS                        */
    /* --------------------------------------------- */
    Route::get('/admin/productos/tipodeproductos/nuevo', 'ControladorTipoProducto@nuevo');
    Route::post('/admin/productos/tipodeproductos/nuevo', 'ControladorTipoProducto@guardar');
    Route::get('/admin/productos/tipodeproductos/cargarGrilla', 'ControladorTipoProducto@cargarGrilla')->name('tipodeproductos.cargarGrilla');
    Route::get('/admin/productos/tipodeproductos', 'ControladorTipoProducto@index');
    Route::get('/admin/productos/tipodeproductos/nuevo/{id}', 'ControladorTipoProducto@editar');
    Route::post('/admin/productos/tipodeproductos/nuevo/{id}', 'ControladorTipoProducto@guardar');
    Route::get('/admin/productos/tipodeproductos/eliminar', 'ControladorTipoProducto@eliminar');

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
    Route::post('/admin/venta/nueva', 'ControladorVenta@guardar');
    Route::get('/admin/ventas/eliminar', 'ControladorVenta@eliminar');    
    //Route::get('/admin/ventas/cargarDetalle/{id}', 'ControladorVenta@cargarDetalle')->name('ventas.cargarDetalle');
        /* --------------------------------------------- */
    /* CONTROLADOR DETALLES                          */
    /* --------------------------------------------- */

    Route::get('/admin/detalle/nuevo', 'ControladorDetalle@nuevo');
    Route::post('/admin/detalle/nuevo', 'ControladorDetalle@guardar');
    Route::get('/admin/detalle/eliminar', 'ControladorDetalle@eliminar');
    Route::get('/admin/detalle', 'ControladorDetalle@index');
    Route::get('/admin/detalle/cargarGrilla', 'ControladorDetalle@cargarGrilla')->name('detalle.cargarGrilla');
    Route::get('/admin/detalle/nuevo/{id}', 'ControladorDetalle@editar');
    Route::post('/admin/detalle/nuevo/{id}', 'ControladorDetalle@guardar');
    Route::get('/admin/detalle/buscarProductos', 'ControladorDetalle@buscarProductos');
    Route::get('/admin/detalle/buscarProducto', 'ControladorDetalle@buscarProducto');
<<<<<<< HEAD
    Route::get('/admin/detalle/buscarDescrProducto', 'ControladorDetalle@buscarDescrProducto');
    Route::get('/admin/detalle/buscarCodProducto', 'ControladorDetalle@buscarCodProducto');
=======
>>>>>>> 1301a82ae7e4e0cf8b2d260eb9a1d458fe70dc07

});

    /* --------------------------------------------- */
    /* CONTROLADOR CLIENTES                          */
    /* --------------------------------------------- */
    Route::get('/admin/cliente/nuevo', 'ControladorCliente@nuevo');
    Route::post('/admin/cliente/nuevo', 'ControladorCliente@guardar');
    Route::get('/admin/cliente/eliminar', 'ControladorCliente@eliminar');
    Route::get('/admin/clientes', 'ControladorCliente@index');
    Route::get('/admin/clientes/cargarGrilla', 'ControladorCliente@cargarGrilla')->name('cliente.cargarGrilla');
    Route::get('/admin/cliente/nuevo/{id}', 'ControladorCliente@editar');
    Route::post('/admin/cliente/nuevo/{id}', 'ControladorCliente@guardar');



    