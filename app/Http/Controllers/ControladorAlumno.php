<?php

    namespace App\Http\Controllers;

    use App\Entidades\Alumno;
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
            $aAlumnos = $entidadAlumno->obtenerFiltrado();
    
            $data = array();
    
            $inicio = $request['start'];
            $registros_por_pagina = $request['length'];
    
            if (count($aAlumnos) > 0) {
                $cont = 0;
            }
    
            for ($i = $inicio; $i < count($aAlumnos) && $cont < $registros_por_pagina; $i++) {
                $row = array();
                $row[] = $aAlumnos[$i]->nombre;
                $row[] = $aAlumnos[$i]->apellido;
                $row[] = $aAlumnos[$i]->dni;
                $row[] = $aAlumnos[$i]->mail;
                $row[] = "<a class='fab fa-whatsapp' aria-hidden='true' target='blank' href='https://web.whatsapp.com/send?phone=".$aAlumnos[$i]->telefono."'></a>".$aAlumnos[$i]->telefono;
                $row[] = "<a href='/admin/alumno/nuevo/".$aAlumnos[$i]->idalumno."'><i class='fas fa-search'></i></a>";
                $cont++;
                $data[] = $row;
            }
    
            $json_data = array(
                "draw" => intval($request['draw']),
                "recordsTotal" => count($aAlumnos), //cantidad total de registros sin paginar
                "recordsFiltered" => count($aAlumnos), //cantidad total de registros en la paginacion
                "data" => $data,
            );
            return json_encode($json_data);
        }

        public function nuevo()
        {
            $titulo = "Nuevo Alumno";
            return view('alumno.alumno-nuevo', compact('titulo'));
        }

        public function editar($id)
        {
            $titulo = "Modificar Alumno";
            if (Usuario::autenticado() == true) {
                if (!Patente::autorizarOperacion("MENUMODIFICACION")) {
                    $codigo = "MENUMODIFICACION";
                    $mensaje = "No tiene pemisos para la operaci&oacute;n.";
                    return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
                } else {
                    $alumno = new Alumno();
                    $alumno->obtenerPorId($id);
    
                    return view('alumno.alumno-nuevo', compact('alumno', 'titulo'));
                }
            } else {
                return redirect('admin/login');
            }
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
                        $entidad->insertar();
                        
                        $msg["ESTADO"] = MSG_SUCCESS;
                        $msg["MSG"] = OKINSERT;
                    }
                    $_POST["id"] = $entidad->idalumno;
                    return view('alumno.alumno-listar', compact('titulo', 'msg'));
                }
            } catch (Exception $e) {
                $msg["ESTADO"] = MSG_ERROR;
                $msg["MSG"] = ERRORINSERT;
            }

            $id = $entidad->idalumno;
            $alumno = new Alumno();
            $alumno->obtenerPorId($id);
    
            return view('alumno.alumno-nuevo', compact('msg', 'alumno', 'titulo')) . '?id=' . $alumno->idalumno;
        }

        public function eliminar(Request $request)
        {
            $id = $request->input('id');
    
            if (Usuario::autenticado() == true) {
                if (Patente::autorizarOperacion("MENUELIMINAR")) {
                    $entidad = new Alumno();
                    $entidad->cargarDesdeRequest($request);

                    $entidad->eliminar();
                    $aResultado["err"] = EXIT_SUCCESS; //eliminado correctamente
    
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