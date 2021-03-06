<?php

namespace App\Http\Controllers;

use App\Entidades\IngresoStock;
use App\Entidades\TipoProducto;
use App\Entidades\Producto;
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

    public function cargarGrilla()
    {
        $request = $_REQUEST;                
        
        $entidadIngreso = new IngresoStock();       
        $aIngreso = $entidadIngreso->obtenerFiltrado();   
        
        $tipoProducto = new TipoProducto();
        $producto = new Producto();

        $data = array();

        $inicio = $request['start'];
        $registros_por_pagina = $request['length'];

        if (count($aIngreso) > 0) {
            $cont = 0;
        }

        for ($i = $inicio; $i < count($aIngreso) && $cont < $registros_por_pagina; $i++) {
            $tipoProducto->obtenerPorId($aIngreso[$i]->fk_idtipo_producto);
            $row = array();
            $row[] = $tipoProducto->nombre;
            $producto->obtenerPorId($aIngreso[$i]->fk_codproducto);
            $row[] = $producto->codigo;            
            $row[] = $aIngreso[$i]->cantidad;   
            $row[] = $aIngreso[$i]->fecha_ingreso;              
            $row[] = "<a href='/admin/productos/ingreso/nuevo/".$aIngreso[$i]->idingreso."'><i class='fas fa-edit'></i></a>";
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

        if (Usuario::autenticado() == true) {
            if (!Patente::autorizarOperacion("INGRESOSALTA")) {
                $codigo = "INGRESOSALTA";
                $mensaje = "No tiene pemisos para la operaci&oacute;n.";
                return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
            } else {
                return view('ingreso.ingreso-nuevo', compact('titulo', 'array_TipoProducto'));
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
            if (!Patente::autorizarOperacion("INGRESOSEDITAR")) {
                $codigo = "INGRESOEDITAR";
                $mensaje = "No tiene pemisos para la operaci&oacute;n.";
                return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
            } else {
                $ingreso = new IngresoStock();
                $ingreso->obtenerPorId($id);
                $tipoProducto = new TipoProducto();
                $array_TipoProducto = $tipoProducto->obtenerTodos();
                $producto = new Producto();
                $producto->obtenerPorId($ingreso->fk_codproducto);

                return view('ingreso.ingreso-nuevo', compact('ingreso', 'titulo', 'array_TipoProducto', 'producto'));
                
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
            $ingreso = new IngresoStock();
            $ingreso->cargarDesdeRequest($request);

            //validaciones
            if ($ingreso->fk_codproducto == "") {
                $msg["ESTADO"] = MSG_ERROR;
                $msg["MSG"] = "Complete todos los datos";
            } else {
                if ($_POST["id"] > 0) {
                    //Es actualizacion
                    $ingreso->guardar();

                    $msg["ESTADO"] = MSG_SUCCESS;
                    $msg["MSG"] = OKINSERT;
                } else {
                    //Es nuevo
                    $titulo = "Nuevo Ingreso";
                    $ingreso->insertar();

                    $msg["ESTADO"] = MSG_SUCCESS;
                    $msg["MSG"] = OKINSERT;
            
                    
                }    
                $_POST["id"] = $ingreso->idingreso;          
                return view('ingreso.ingreso-listar', compact('titulo', 'msg'));
            }
        } catch (Exception $e) {
            $msg["ESTADO"] = MSG_ERROR;
            $msg["MSG"] = ERRORINSERT;
        }

        $id = $ingreso->idingreso;
        $entidad = new IngresoStock;
        $entidad->obtenerPorId($id);

        return view('ingreso.ingreso-nuevo', compact('msg', 'entidad', 'titulo')) . '?id=' . $entidad->idingreso;
    }

    public function eliminar(Request $request)
    {
        $id = $request->input('id');
        if (Usuario::autenticado() == true) {
            if (Patente::autorizarOperacion("INGRESOSBAJA")) {

                $ingreso = new IngresoStock();
                $ingreso->cargarDesdeRequest($request);

                $ingreso->eliminar();
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
  
}
