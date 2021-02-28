<?php

namespace App\Http\Controllers;

use App\Entidades\IngresoStock;
use App\Entidades\Producto;
use App\Entidades\TipoProducto;
use Illuminate\Http\Request;
use App\Entidades\Sistema\Usuario;
use App\Entidades\Sistema\Patente;

require app_path() . '/start/constants.php';

class ControladorIngreso extends Controller
{
    public function index()
    {
        $titulo = "Ingreso";
        if (Usuario::autenticado() == true) {
            if (!Patente::autorizarOperacion("INGRESOSCONSULTA")) {
                $codigo = "INGRESOSCONSULTA";
                $mensaje = "No tiene permisos para la operaci&oacute;n.";
                return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
            } else {
                return view('ingreso.ingreso-listar', compact('titulo'));
            }
        } else {
            return redirect('admin/login');
        }
    }

    public function cargarGrilla($id)
    {
        $request = $_REQUEST;                
        
        $entidadIngreso = new IngresoStock();       
        $aIngreso = $entidadIngreso->obtenerPorIdVenta($id);            

        $data = array();

        $inicio = $request['start'];
        $registros_por_pagina = $request['length'];

        if (count($aIngreso) > 0) {
            $cont = 0;
        }

        for ($i = $inicio; $i < count($aIngreso) && $cont < $registros_por_pagina; $i++) {
            $row = array();
            $row[] = $aIngreso[$i]->fk_idventa;
            $row[] = $aIngreso[$i]->fk_idtipo_producto;
            $row[] = $aIngreso[$i]->fk_codproducto;
            $row[] = $aIngreso[$i]->descrprod;
            $row[] = $aIngreso[$i]->cantidad;
            $row[] = "$" . number_format($aIngreso[$i]->preciounitario, 2, ",", "."); 
            $row[] = "$" . number_format($aIngreso[$i]->total, 2, ",", "."); 
            $row[] = "<a href='/admin/Ingreso/nuevo/".$aIngreso[$i]->idIngreso."'><i class='fas fa-edit'></i></a>";
            $cont++;
            $data[] = $row;
        }

        $json_data = array(
            "draw" => intval($request['draw']),
            "recordsTotal" => count($aIngreso), //cantidad total de registros sin paginar
            "recordsFiltered" => count($aIngreso), //cantidad total de registros en la paginacion
            "data" => $data,
        );
        return json_encode($json_data);
    }

    public function nuevo()
    {
        $tipoProducto = new TipoProducto();
        $array_TipoProducto = $tipoProducto->obtenerTodos();

        $titulo = "Nuevo Ingreso";
        $idVenta = $_GET["idVenta"];

        if (Usuario::autenticado() == true) {
            if (!Patente::autorizarOperacion("IngresoALTA")) {
                $codigo = "IngresoALTA";
                $mensaje = "No tiene pemisos para la operaci&oacute;n.";
                return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
            } else {
                return view('ingreso.ingreso-nuevo', compact('titulo', 'array_TipoProducto','idVenta'));
            }
        } else {
            return redirect('admin/login');
        }
    }

    public function editar($id)
    {
        $tipoProducto = new TipoProducto();
        $array_TipoProducto = $tipoProducto->obtenerTodos();
        $titulo = "Modificar Ingreso";
        if (Usuario::autenticado() == true) {
            if (!Patente::autorizarOperacion("IngresoEDITAR")) {
                $codigo = "IngresoEDITAR";
                $mensaje = "No tiene pemisos para la operaci&oacute;n.";
                return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
            } else {
                $Ingreso = new Ingreso();
                $Ingreso->obtenerPorId($id);
                $tipoProducto = new TipoProducto();
                $array_TipoProducto = $tipoProducto->obtenerTodos();

                return view('ingreso.ingreso-nuevo', compact('Ingreso', 'titulo', 'array_TipoProducto'));
                
            }
        } else {
            return redirect('admin/login');
        }
    }

    public function guardar(Request $request)
    {       
        try {
            //Define la entidad servicio
            $titulo = "Modificar Ingreso";
            $Ingreso = new Ingreso();
            $Ingreso->cargarDesdeRequest($request);

            //validaciones
            if ($Ingreso->fk_codproducto == "") {
                $msg["ESTADO"] = MSG_ERROR;
                $msg["MSG"] = "Complete todos los datos";
            } else {
                if ($_POST["id"] > 0) {
                    //Es actualizacion
                    $Ingreso->guardar();

                    $msg["ESTADO"] = MSG_SUCCESS;
                    $msg["MSG"] = OKINSERT;
                } else {
                    //Es nuevo
                    $titulo = "Nuevo Ingreso";
                    $Ingreso->insertar();

                    $msg["ESTADO"] = MSG_SUCCESS;
                    $msg["MSG"] = OKINSERT;
                    $tipoProducto = new TipoProducto();
                    $array_TipoProducto = $tipoProducto->obtenerTodos();
                    $idVenta =$Ingreso->fk_idventa;
                }              
                return view('ingreso.ingreso-nuevo', compact('titulo', 'msg', 'idVenta', 'array_TipoProducto'));
            }
        } catch (Exception $e) {
            $msg["ESTADO"] = MSG_ERROR;
            $msg["MSG"] = ERRORINSERT;
        }

        $id = $Ingreso->idIngreso;
        $entidad = new Ingreso;
        $entidad->obtenerPorId($id);

        return view('ingreso.ingreso-nuevo', compact('msg', 'entidad', 'titulo')) . '?id=' . $entidad->idIngreso;
    }

    public function eliminar(Request $request)
    {
        $id = $request->input('id');
        if (Usuario::autenticado() == true) {
            if (Patente::autorizarOperacion("IngresoBAJA")) {

                $Ingreso = new Ingreso();
                $Ingreso->cargarDesdeRequest($request);

                $Ingreso->eliminar();
                $aResultado["err"] = EXIT_SUCCESS; //eliminado correctamente                         
            } else {
                //$codigo = "ELIMINARIngreso"; no se porque no se usa
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
