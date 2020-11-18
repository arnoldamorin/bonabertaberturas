<?php

namespace App\Http\Controllers;

use App\Entidades\Venta;
use App\Entidades\Sistema\Patente;
use App\Entidades\Sistema\Usuario;
use Illuminate\Http\Request;


require app_path() . '/start/constants.php';

class ControladorVenta extends Controller
{
    public function index()
    {
        $titulo = "Nuevo Venta";
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

    /*public function cargarGrilla()
        {
            $request = $_REQUEST;
    
            $entidadVenta = new Venta();
            $aCategorias = $entidadVenta->obtenerFiltrado();
    
            $data = array();
    
            $inicio = $request['start'];
            $registros_por_pagina = $request['length'];
    
            if (count($aVenta) > 0) {
                $cont = 0;
            }
    
            for ($i = $inicio; $i < count($aVenta) && $cont < $registros_por_pagina; $i++) {
                $row = array();
                $row[] = $aCategorias[$i]->fecha;
                $row[] = $aCategorias[$i]->importe;                
                $row[] = "<a href='/admin/venta/nueva/".$aVenta[$i]->idinscripcion."'><i class='fas fa-search'></i></a>";
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
            $titulo = "Nuevo Venta";
            return view('venta.venta-nuevo', compact('titulo'));
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
                    $categoria = new Venta();
                    $categoria->obtenerPorId($id);
    
                    return view('categoria.categoria-nuevo', compact('categoria', 'titulo'));
                }
            } else {
                return redirect('admin/login');
            }
        }*/

    public function guardar(Request $request)
        {
            try {
                //Define la entidad servicio
                $titulo = "Modificar Venta";
                $entidad = new Venta();
                $entidad->cargarDesdeRequest($request);
    
                //validaciones
                if ($entidad->fecha == "") {
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
                        $titulo = "Nuevo Venta";
                        $entidad->insertar();
    
                        $msg["ESTADO"] = MSG_SUCCESS;
                        $msg["MSG"] = OKINSERT;
                    }
                    $_POST["id"] = $entidad->idinscripcion;
                    return view('venta.venta-nuevo', compact('titulo', 'msg'));
                }
            } catch (Exception $e) {
                $msg["ESTADO"] = MSG_ERROR;
                $msg["MSG"] = ERRORINSERT;
            }
            $id = $entidad->idinscripcion;
            $venta = new Venta();
            $venta->obtenerPorId($id);
    
            return view('venta.venta-nuevo', compact('msg', 'fecha', 'importe','array_curso', 'array_alumno')) . '?id=' . $venta->idisncripcion;
        }

/*public function eliminar(Request $request)
        {
            $id = $request->input('id');
    
            if (Usuario::autenticado() == true) {
                if (Patente::autorizarOperacion("MENUELIMINAR")) {
                    $entidad = new Venta();
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
        }*/
    }

?>