<?php

namespace App\Http\Controllers;

use App\Entidades\Sistema\Patente;
use App\Entidades\Sistema\Usuario;
use Illuminate\Http\Request;
use App\Entidades\Ventas;

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

    public function cargarGrilla()
        {
            $request = $_REQUEST;
    
            $entidadCategoria = new Categoria();
            $aCategorias = $entidadCategoria->obtenerFiltrado();
    
            $data = array();
    
            $inicio = $request['start'];
            $registros_por_pagina = $request['length'];
    
            if (count($aCategorias) > 0) {
                $cont = 0;
            }
    
            for ($i = $inicio; $i < count($aCategorias) && $cont < $registros_por_pagina; $i++) {
                $row = array();
                $row[] = $aCategorias[$i]->nombre;
                $row[] = $aCategorias[$i]->descripcion;                
                $row[] = "<a href='/admin/cursos/categorias/nuevo/".$aCategorias[$i]->idcategoria."'><i class='fas fa-search'></i></a>";
                $cont++;
                $data[] = $row;
            }
    
            $json_data = array(
                "draw" => intval($request['draw']),
                "recordsTotal" => count($aCategorias), //cantidad total de registros sin paginar
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
                $titulo = "Modificar Venta";
                $entidad = new Venta();
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