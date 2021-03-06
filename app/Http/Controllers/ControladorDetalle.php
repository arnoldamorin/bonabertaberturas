<?php

namespace App\Http\Controllers;

use App\Entidades\Detalle;
use App\Entidades\Producto;
use App\Entidades\TipoProducto;
use Illuminate\Http\Request;
use App\Entidades\Sistema\Usuario;
use App\Entidades\Sistema\Patente;

require app_path() . '/start/constants.php';

class ControladorDetalle extends Controller
{
    public function index()
    {
        $titulo = "Detalle";
        if (Usuario::autenticado() == true) {
            if (!Patente::autorizarOperacion("MENUCONSULTA")) {
                $codigo = "MENUCONSULTA";
                $mensaje = "No tiene permisos para la operaci&oacute;n.";
                return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
            } else {
                return view('detalle.detalle-listar', compact('titulo'));
            }
        } else {
            return redirect('admin/login');
        }
    }

    public function cargarGrilla($id)
    {
        $request = $_REQUEST;                
        
        $entidadDetalle = new Detalle();       
        $aDetalle = $entidadDetalle->obtenerPorIdVenta($id);            

        $producto = new Producto();
        $tipoProducto = new TipoProducto();
        $data = array();

        $inicio = $request['start'];
        $registros_por_pagina = $request['length'];

        if (count($aDetalle) > 0) {
            $cont = 0;
        }

        for ($i = $inicio; $i < count($aDetalle) && $cont < $registros_por_pagina; $i++) {
            $row = array();
            $row[] = $aDetalle[$i]->fk_idventa;
            $tipoProducto->obtenerPorId($aDetalle[$i]->fk_idtipo_producto);
            $row[] = $tipoProducto->nombre;
            $producto->obtenerPorId($aDetalle[$i]->fk_codproducto);
            $row[] = $producto->codigo;
            $row[] = $aDetalle[$i]->descrprod;
            $row[] = $aDetalle[$i]->cantidad;
            $row[] = "$" . number_format($aDetalle[$i]->preciounitario, 2, ",", "."); 
            $row[] = "$" . number_format($aDetalle[$i]->total, 2, ",", "."); 
            $row[] = "<a href='/admin/detalle/nuevo/".$aDetalle[$i]->iddetalle."'><i class='fas fa-edit'></i></a>";
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
    }

    public function nuevo()
    {
        $tipoProducto = new TipoProducto();
        $array_TipoProducto = $tipoProducto->obtenerTodos();

        $titulo = "Nuevo Detalle";
        $idVenta = $_GET["idVenta"];

        if (Usuario::autenticado() == true) {
            if (!Patente::autorizarOperacion("DETALLEALTA")) {
                $codigo = "DETALLEALTA";
                $mensaje = "No tiene pemisos para la operaci&oacute;n.";
                return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
            } else {
                return view('detalle.detalle-nuevo', compact('titulo', 'array_TipoProducto','idVenta'));
            }
        } else {
            return redirect('admin/login');
        }
    }

    public function editar($id)
    {
        $tipoProducto = new TipoProducto();
        $array_TipoProducto = $tipoProducto->obtenerTodos();
        $titulo = "Modificar Detalle";
        if (Usuario::autenticado() == true) {
            if (!Patente::autorizarOperacion("DETALLEEDITAR")) {
                $codigo = "DETALLEEDITAR";
                $mensaje = "No tiene pemisos para la operaci&oacute;n.";
                return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
            } else {
                $detalle = new Detalle();
                $detalle->obtenerPorId($id);
                $tipoProducto = new TipoProducto();
                $array_TipoProducto = $tipoProducto->obtenerTodos();  
                $producto = new Producto();
                $producto->obtenerPorId($detalle->fk_codproducto);

                return view('detalle.detalle-nuevo', compact('detalle', 'titulo', 'array_TipoProducto', 'producto'));
                
            }
        } else {
            return redirect('admin/login');
        }
    }

    public function guardar(Request $request)
    {       
        try {
            $tipoProducto = new TipoProducto();
            $array_TipoProducto = $tipoProducto->obtenerTodos();
            $producto = new Producto();
            
            //Define la entidad servicio
            $titulo = "Modificar Detalle";
            $detalle = new Detalle();
            $detalle->cargarDesdeRequest($request);

            //validaciones
            if ($detalle->fk_codproducto == "") {
                $msg["ESTADO"] = MSG_ERROR;
                $msg["MSG"] = "Complete todos los datos";
            } else {
                if ($_POST["id"] > 0) {
                    //Es actualizacion
                    $detalle->guardar();

                    $msg["ESTADO"] = MSG_SUCCESS;
                    $msg["MSG"] = OKINSERT;
                } else {
                    //Es nuevo
                    $titulo = "Nuevo Detalle";
                    $detalle->insertar();

                    $msg["ESTADO"] = MSG_SUCCESS;
                    $msg["MSG"] = OKINSERT;
                   
                    $idVenta =$detalle->fk_idventa;
                    return view('detalle.detalle-nuevo', compact('titulo', 'msg', 'idVenta', 'array_TipoProducto'));
                }                             
            }
        } catch (Exception $e) {
            $msg["ESTADO"] = MSG_ERROR;
            $msg["MSG"] = ERRORINSERT;
        }

        $id = $detalle->iddetalle;        
        $detalle->obtenerPorId($id);
        $producto->obtenerPorId($detalle->fk_codproducto);
        return view('detalle.detalle-nuevo', compact('msg', 'detalle', 'titulo', 'array_TipoProducto','producto')) . '?id=' . $detalle->iddetalle;
    }

    public function eliminar(Request $request)
    {
        $id = $request->input('id');
        if (Usuario::autenticado() == true) {
            if (Patente::autorizarOperacion("DETALLEBAJA")) {

                $detalle = new detalle();
                $detalle->cargarDesdeRequest($request);

                $detalle->eliminar();
                $aResultado["err"] = EXIT_SUCCESS; //eliminado correctamente                         
            } else {
                //$codigo = "ELIMINARdetalle"; no se porque no se usa
                $aResultado["err"] = "No tiene pemisos para la operaci&oacute;n.";
            }
            echo json_encode($aResultado);
        } else {
            return redirect('admin/login');
        }
    }
    public function buscarProductos(Request $request)
    {
        $id = $request->input('id');
        $producto = new Producto;
        $array_Producto = $producto->obtenerCodigoPorTipo($id);
        echo json_encode($array_Producto);
        exit;
    }
    public function buscarProducto(Request $request)
    {
        $aResultado = array();
        $id = $request->input('id');
        $producto = new Producto();
        $producto->obtenerPorId($id);
        $aResultado["precio"] = $producto->precio_venta;
        $aResultado["cantidad"] = $producto->stock;
        $aResultado["descripcion"] = $producto->descripcion;
        echo json_encode($aResultado);
        exit;
    }
    public function buscarCodProducto(Request $request)
    {
        $descripcion = $request->input('descripcion');
        $producto = new Producto();
        $producto->obtenerPorDescr($descripcion);
        $aResultado["precio"] = $producto->precio_venta;
        $aResultado["cantidad"] = $producto->stock;
        $aResultado["descripcion"] = $producto->codigo;
        $aResultado["idproducto"] = $producto->idproducto;
        echo json_encode($aResultado);
        exit;
    }
    public function autocompletar(Request $request)
    {
        $palabra = $request->input('palabra');
        $tipoProducto = $request->input('tipoProducto');
        $producto = new Producto;
        $array_Producto = $producto->obtenerFiltradoPalabra($palabra, $tipoProducto);
        echo json_encode($array_Producto);
        exit;
    }
}
