<?php

namespace App\Http\Controllers;

use App\Entidades\Sistema\Patente;
use App\Entidades\Sistema\Usuario;
use Illuminate\Http\Request;

require app_path() . '/start/constants.php';

class ControladorVenta extends Controller
{
    public function index()
        {
            $titulo = "Ventas";
            if (Usuario::autenticado() == true) {
                /*if (!Patente::autorizarOperacion("MENUCONSULTA")) {
                    $codigo = "MENUCONSULTA";
                    $mensaje = "No tiene permisos para la operaci&oacute;n.";
                    return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
                } else {*/
                    return view('venta.venta-listar', compact('titulo'));
                //}
            } else {
                return redirect('admin/login');
            }
        }

        public function cargarGrilla()
        {
            $request = $_REQUEST;
    
            $entidadVentas = new Ventas();
            $aVentas = $entidadVentas->obtenerFiltrado();
    
            $data = array();
    
            $inicio = $request['start'];
            $registros_por_pagina = $request['length'];
    
            if (count($aVentas) > 0) {
                $cont = 0;
            }
    
            for ($i = $inicio; $i < count($aVentas) && $cont < $registros_por_pagina; $i++) {
                $row = array();
                $row[] = $aVentas[$i]->fecha;
                $row[] = $aVentas[$i]->importe;                
                $row[] = "<a href='/admin/ventas/nueva".$aVentas[$i]->idinscripciones."'><i class='fas fa-search'></i></a>";
                $cont++;
                $data[] = $row;
            }
    
            $json_data = array(
                "draw" => intval($request['draw']),
                "recordsTotal" => count($aVentas), //cantidad total de registros sin paginar
                "recordsFiltered" => count($aCategorias), //cantidad total de registros en la paginacion
                "data" => $data,
            );
            return json_encode($json_data);
        }

        public function nuevo()
        {
            $titulo = "Nuevo Categoria";
            return view('categoria.categoria-nuevo', compact('titulo'));
        }

        public function editar($id)
        {
            $titulo = "Modificar Categoria";
            if (Usuario::autenticado() == true) {
                if (!Patente::autorizarOperacion("MENUMODIFICACION")) {
                    $codigo = "MENUMODIFICACION";
                    $mensaje = "No tiene pemisos para la operaci&oacute;n.";
                    return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
                } else {
                    $categoria = new Categoria();
                    $categoria->obtenerPorId($id);
    
                    return view('categoria.categoria-nuevo', compact('categoria', 'titulo'));
                }
            } else {
                return redirect('admin/login');
            }
        }

        public function guardar(Request $request)
        {
            try {
                //Define la entidad servicio
                $titulo = "Modificar Categoria";
                $entidad = new Categoria();
                $entidad->cargarDesdeRequest($request);
    
                //validaciones
                if ($entidad->nombre == "") {
                    $msg["ESTADO"] = MSG_ERROR;
                    $msg["MSG"] = "Complete todos los datos";
                } else {
                    if ($_POST["id"] > 0) {
                        //Es actualizacion
                        $entidad->guardar();
    
                        $msg["ESTADO"] = MSG_SUCCESS;
                        $msg["MSG"] = OKINSERT;
                    } else {
                        //Es nuevo
                        $titulo = "Nuevo Categoria";
                        $entidad->insertar();
    
                        $msg["ESTADO"] = MSG_SUCCESS;
                        $msg["MSG"] = OKINSERT;
                    }
                    $_POST["id"] = $entidad->idCategoria;
                    return view('categoria.categoria-nuevo', compact('titulo', 'msg'));
                }
            } catch (Exception $e) {
                $msg["ESTADO"] = MSG_ERROR;
                $msg["MSG"] = ERRORINSERT;
            }
        }

        public function eliminar(Request $request)
        {
            $id = $request->input('id');
    
            if (Usuario::autenticado() == true) {
                if (Patente::autorizarOperacion("MENUELIMINAR")) {
                    $entidad = new Categoria();
                    $entidad->cargarDesdeRequest($request);
                   
                    if ($entidad->nombre != "") {
                        $entidad->eliminar();
                        $aResultado["err"] = EXIT_SUCCESS; //eliminado correctamente
                    } else {
                        $aResultado["err"] = MSG_ERROR;
                    }    
                } else {
                    $codigo = "ELIMINARPROFESIONAL";
                    $aResultado["err"] = "No tiene pemisos para la operaci&oacute;n.";
                }
                echo json_encode($aResultado);
            } else {
                return redirect('admin/login');
            }
        }

}

?>