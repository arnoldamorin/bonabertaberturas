<?php

namespace App\Http\Controllers;

use App\Entidades\Venta;
use App\Entidades\Venta_estado;
use App\Entidades\Sistema\Patente;
use App\Entidades\Sistema\Usuario;
use App\Entidades\Cliente;
use App\Entidades\Detalle;
use App\Entidades\Producto;
use App\Entidades\TipoProducto;
use Illuminate\Http\Request;


require app_path() . '/start/constants.php';

class ControladorVenta extends Controller
{
    public function index()
    {
        $titulo = "Nuevo Venta";
        if (Usuario::autenticado() == true) {
            if (!Patente::autorizarOperacion("VENTAALTA")) {
                $codigo = "VENTAALTA";
                $mensaje = "No tiene permisos para la operaci&oacute;n.";
                return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
            } else {
                return view('venta.venta-listar', compact('titulo'));
            }
        } else {
            return redirect('admin/login');
        }
    }

    public function cargarGrilla()
    {
        $request = $_REQUEST;

        $entidadVenta = new Venta();
        $aVenta = $entidadVenta->obtenerTodos();

        $entidadDetalle = new Detalle();
        $aDetalle = $entidadDetalle->obtenerTodos();
        $entidadEstado = new Venta_estado();

        $data = array();

        $inicio = $request['start'];
        $registros_por_pagina = $request['length'];

        if (count($aVenta) > 0) {
            $cont = 0;
        }

        for ($i = $inicio; $i < count($aVenta) && $cont < $registros_por_pagina; $i++) {
            $row = array();
            $fecha_formateada = date("d/m/Y H:i", strtotime($aVenta[$i]->fecha));
            $row[] = $fecha_formateada;
            $row[] = $aVenta[$i]->telefono;
            $row[] = $aVenta[$i]->correo;
            $row[] = $aVenta[$i]->nombre_comprador;
            $row[] = $aVenta[$i]->apellido_comprador;
            $entidadEstado->obtenerPorID($aVenta[$i]->fk_idestado);
            $row[] = $entidadEstado->nombre;
            $row[] = "<a href='/admin/venta/nueva/" . $aVenta[$i]->idventa . "'><i class='fas fa-search'></i></a>";
            $cont++;
            $data[] = $row;
        }

        $json_data = array(
            "draw" => intval($request['draw']),
            "recordsTotal" => count($aVenta), //cantidad total de registros sin paginar
            "recordsFiltered" => count($aVenta), //cantidad total de registros en la paginacion
            "data" => $data,
        );
        return json_encode($json_data);
    }

    public function nuevo()
    {
        $detalle = new Detalle();
        $array_Detalle = $detalle->obtenerTodos();

        $venta_estado = new Venta_estado();
        $array_estado = $venta_estado->obtenerTodos();

        $producto = new Producto();
        $array_Producto = $producto->obtenerTodos();

        $tipoProducto = new TipoProducto();
        $array_TipoProducto = $tipoProducto->obtenerTodos();

        $titulo = "Nueva Venta";
        return view('venta.venta-nuevo', compact('titulo', 'array_Detalle', 'array_estado', 'array_Producto', 'array_TipoProducto'));
    }

    public function editar($id)
    {
        $entidad = new Detalle();
        $array_Detalle = $entidad->obtenerTodos();

        $venta_estado = new Venta_estado();
        $array_estado = $venta_estado->obtenerTodos();

        $producto = new Producto();
        $array_Producto = $producto->obtenerTodos();

        $tipoProducto = new TipoProducto();
        $array_TipoProducto = $tipoProducto->obtenerTodos();


        $titulo = "Modificar Venta";
        if (Usuario::autenticado() == true) {
            if (!Patente::autorizarOperacion("VENTACONSULTA")) {
                $codigo = "VENTACONSULTA";
                $mensaje = "No tiene pemisos para la operaci&oacute;n.";
                return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
            } else {
                $venta = new Venta();
                $venta->obtenerPorId($id);

                return view('venta.venta-nuevo', compact('venta', 'titulo', 'array_Detalle', 'array_estado', 'array_Producto', 'array_TipoProducto'));
            }
        } else {
            return redirect('admin/login');
        }
    }

    public function guardar(Request $request)
    {
        try {
            //Define la entidad servicio
            $titulo = "Modificar Venta";
            $entidad = new Venta();
            $entidad->cargarDesdeRequest($request);
            $entidadAnt = new Venta();
            $entidadAnt = $entidadAnt->obtenerPorId($entidad->idventa);

            //validaciones
            if ($entidad->fecha == "") {
                $msg["ESTADO"] = MSG_ERROR;
                $msg["MSG"] = "Complete todos los datos";
            } else {
                if ($_POST["id"] > 0) {
                    //Es actualizacion

                    if (($entidadAnt->fk_idestado == 1) && ($entidad->fk_idestado == 2)) {
                        $cliente = new Cliente();
                        $cliente = $cliente->obtenerPorCorreo($entidad->correo);
                        if (isset($cliente) && ($cliente->idcliente != "")) {
                            $cliente->nombre = $entidad->nombre_comprador;
                            $cliente->apellido = $entidad->apellido_comprador;
                            $cliente->telefono = $entidad->telefono;
                            $cliente->guardar();
                        } else {
                            $cliente = new cliente();
                            $cliente->nombre = $entidad->nombre_comprador;
                            $cliente->apellido = $entidad->apellido_comprador;
                            $cliente->dni = "";
                            $cliente->mail = $entidad->correo;
                            $cliente->telefono = $entidad->telefono;
                            $cliente->insertar();
                        }
                    }
                    $entidad->guardar();

                    $msg["ESTADO"] = MSG_SUCCESS;
                    $msg["MSG"] = OKINSERT;
                } else {
                    //Es nuevo
                    $titulo = "Nuevo Venta";
                    $entidad->insertar();

                    $msg["ESTADO"] = MSG_SUCCESS;
                    $msg["MSG"] = OKINSERT;
                    $_POST["id"] = $entidad->idventa;
                    return view('detalle.detalle-nuevo', compact('titulo', 'msg', 'entidad'));
                }
                $_POST["id"] = $entidad->idventa;
                return view('venta.venta-nuevo', compact('msg', 'venta', 'fecha', 'array_estado')) . '?id=' . $entidad->idventa;
            }
        } catch (Exception $e) {
            $msg["ESTADO"] = MSG_ERROR;
            $msg["MSG"] = ERRORINSERT;
        }
        $id = $entidad->idventa;
        $venta = new Venta();
        $venta->obtenerPorId($id);
        return view('venta.venta-nuevo', compact('msg', 'venta', 'fecha', 'array_estado')) . '?id=' . $venta->idventa;
    }

    public function eliminar(Request $request)
    {
        $id = $request->input('id');

        if (Usuario::autenticado() == true) {
            if (Patente::autorizarOperacion("VENTABAJA")) {
                $entidad = new Venta();
                $entidad->cargarDesdeRequest($request);

                if ($entidad->idventa > 0) {
                    $entidad->eliminar();
                    $aResultado["err"] = EXIT_SUCCESS; //eliminado correctamente
                } else {
                    $aResultado["err"] = MSG_ERROR;
                }
            } else {
                $codigo = "VENTABAJA";
                $aResultado["err"] = "No tiene pemisos para la operaci&oacute;n.";
            }
            echo json_encode($aResultado);
        } else {
            return redirect('admin/login');
        }
    }
    public function buscarProducto(Request $request)
    {
        $id = $request->input('id');
        $producto = new Producto;
        $array_Producto = $producto->obtenerTodosPorTipo($id);
        echo json_encode($array_Producto);
        exit;
    }
    /*public function cargarDetalle()
    {
        $request = $_REQUEST;     

        $entidadDetalle = new Detalle();
        $aDetalle = $entidadDetalle->obtenerPorId($_POST["id"]);           
        $data = array();
        $inicio = $request['start'];
        $registros_por_pagina = $request['length'];

        if (count($aDetalle) > 0) {
            $cont = 0;
        }

        for ($i = $inicio; $i < count($aDetalle) && $cont < $registros_por_pagina; $i++) {
            $row = array();          
            $row[] = $aDetalle[$i]->fk_idtipo_producto;
            $row[] = $aDetalle[$i]->obtenerDescrProducto($aDetalle[$i]->fk_idproducto);
            $row[] = $aDetalle[$i]->cantidad;          
            $row[] = $aDetalle[$i]->total;      
            $row[] = "<a href='/admin/detalle/editar/" . $aDetalle[$i]->iddetalle . "'><i class='fas fa-search'></i></a>";
            $cont++;
            $data[] = $row;
        }

        $json_data = array(
            "draw" => intval($request['draw']),
            "recordsTotal" => count($aDetalle), //cantidad total de registros sin paginar
            "recordsFiltered" => count($aDetalle), //cantidad total de registros en la paginacion
            "data" => $data,
        );
        return json_encode($json_data);
    }*/
}
