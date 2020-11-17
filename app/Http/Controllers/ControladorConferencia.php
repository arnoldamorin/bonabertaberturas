<?php

    namespace App\Http\Controllers;

    use App\Entidades\Conferencia;
    use Illuminate\Http\Request;
    use App\Entidades\Sistema\Usuario;
    use App\Entidades\Sistema\Patente;

    require app_path() . '/start/constants.php';

    class ControladorConferencia extends Controller
    {
        public function index()
        {
            $titulo = "Conferencias";
            if (Usuario::autenticado() == true) {
                /*if (!Patente::autorizarOperacion("MENUCONSULTA")) {
                    $codigo = "MENUCONSULTA";
                    $mensaje = "No tiene permisos para la operaci&oacute;n.";
                    return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
                } else {*/
                    return view('conferencia.conferencia-listado', compact('titulo'));
                //}
            } else {
                return redirect('admin/login');
            }
        }

        public function cargarGrilla()
        {
            $request = $_REQUEST;
    
            $entidadConferencia = new Conferencia();
            $aConferencias = $entidadConferencia->obtenerFiltrado();
    
            $data = array();
    
            $inicio = $request['start'];
            $registros_por_pagina = $request['length'];
    
            if (count($aConferencias) > 0) {
                $cont = 0;
            }
    
            for ($i = $inicio; $i < count($aConferencias) && $cont < $registros_por_pagina; $i++) {
                $row = array();
                $row[] = $aConferencias[$i]->nombre;
                $row[] = $aConferencias[$i]->descripcion;
                $row[] = $aConferencias[$i]->imagen;
                $row[] = "<a href='/admin/conferencia/nuevo/".$aConferencias[$i]->idconferencia."'><i class='fas fa-search'></i></a>";
                $cont++;
                $data[] = $row;
            }
    
            $json_data = array(
                "draw" => intval($request['draw']),
                "recordsTotal" => count($aConferencias), //cantidad total de registros sin paginar
                "recordsFiltered" => count($aConferencias), //cantidad total de registros en la paginacion
                "data" => $data,
            );
            return json_encode($json_data);
        }

        public function nuevo()
        {
            $titulo = "Nueva Conferencia";
            return view('conferencia.conferencia-nuevo', compact('titulo'));
        }

        public function editar($id)
        {
            $titulo = "Modificar Conferencia";
            if (Usuario::autenticado() == true) {
                if (!Patente::autorizarOperacion("MENUMODIFICACION")) {
                    $codigo = "MENUMODIFICACION";
                    $mensaje = "No tiene pemisos para la operaci&oacute;n.";
                    return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
                } else {
                    $conferencia = new Conferencia();
                    $conferencia->obtenerPorId($id);
    
                    return view('conferencia.conferencia-nuevo', compact('conferencia', 'titulo'));
                }
            } else {
                return redirect('admin/login');
            }
        }

        public function guardar(Request $request)
        {
            try {
                //Define la entidad servicio
                $titulo = "Modificar conferencia";
                $entidad = new Conferencia();
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
                        $titulo = "Nueva Conferencia";
                        $entidad->insertar();
                        
                        $msg["ESTADO"] = MSG_SUCCESS;
                        $msg["MSG"] = OKINSERT;
                    }
                    $_POST["id"] = $entidad->idconferencia;
                    return view('conferencia.conferencia-nuevo', compact('titulo', 'msg'));
                }
            } catch (Exception $e) {
                $msg["ESTADO"] = MSG_ERROR;
                $msg["MSG"] = ERRORINSERT;
            }

            $id = $entidad->idconferencia;
            $conferencia = new Conferencia();
            $conferencia->obtenerPorId($id);

            return view('conferencia.conferencia-nuevo', compact('msg', 'conferencia', 'titulo')) . '?id=' . $conferencia->idconferencia;

        }


        public function eliminar(Request $request)
        {
            $id = $request->input('id');
    
            if (Usuario::autenticado() == true) {
                if (Patente::autorizarOperacion("MENUELIMINAR")) {
                    $entidad = new Conferencia();
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