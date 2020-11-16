<?php

    namespace App\Http\Controllers;

    use App\Entidades\Sistema\Alumno;
    use Illuminate\Http\Request;
    use App\Entidades\Sistema\Usuario;
    use App\Entidades\Sistema\Patente;

    require app_path() . '/start/constants.php';

    class ControladorAlumno extends Controller
    {
        public function index()
        {
            $titulo = "Alumnos";
            if (Usuario::autenticado() == true) {
                /*if (!Patente::autorizarOperacion("MENUCONSULTA")) {
                    $codigo = "MENUCONSULTA";
                    $mensaje = "No tiene permisos para la operaci&oacute;n.";
                    return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
                } else {*/
                    return view('alumno.alumno-listar', compact('titulo'));
                //}
            } else {
                return redirect('admin/login');
            }
        }

        public function cargarGrilla()
        {
            $request = $_REQUEST;
    
            $entidadAlumno = new Alumno();
            $aMenu = $entidadAlumno->obtenerFiltrado();
    
            $data = array();
    
            $inicio = $request['start'];
            $registros_por_pagina = $request['length'];
    
            if (count($aMenu) > 0) {
                $cont = 0;
            }
    
            for ($i = $inicio; $i < count($aMenu) && $cont < $registros_por_pagina; $i++) {
                $row = array();
                $row[] = $aMenu[$i]->nombre;
                $row[] = $aMenu[$i]->apellido;
                $row[] = $aMenu[$i]->dni;
                $row[] = $aMenu[$i]->mail;
                $row[] = $aMenu[$i]->telefono;
                $cont++;
                $data[] = $row;
            }
    
            $json_data = array(
                "draw" => intval($request['draw']),
                "recordsTotal" => count($aMenu), //cantidad total de registros sin paginar
                "recordsFiltered" => count($aMenu), //cantidad total de registros en la paginacion
                "data" => $data,
            );
            return json_encode($json_data);
        }

        public function nuevo()
        {
            $titulo = "Nuevo Alumno";
            return view('alumno.alumno-nuevo', compact('titulo'));
        }

        public function guardar(Request $request)
        {
            try {
                //Define la entidad servicio
                $titulo = "Modificar alumno";
                $entidad = new Alumno();
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
                        $titulo = "Nuevo Alumno";
                        $entidad->insertar();
    
                        $msg["ESTADO"] = MSG_SUCCESS;
                        $msg["MSG"] = OKINSERT;
                    }
                    $_POST["id"] = $entidad->idalumno;
                    return view('alumno.alumno-nuevo', compact('titulo', 'msg'));
                }
            } catch (Exception $e) {
                $msg["ESTADO"] = MSG_ERROR;
                $msg["MSG"] = ERRORINSERT;
            }
        }
    }

?>