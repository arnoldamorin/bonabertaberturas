<?php

    namespace App\Http\Controllers;

    use App\Entidades\Sistema\Alumno;
    use Illuminate\Http\Request;

    require app_path() . '/start/constants.php';

    class ControladorAlumno extends Controller
    {
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
                        $entidad->insertar();
    
                        $msg["ESTADO"] = MSG_SUCCESS;
                        $msg["MSG"] = OKINSERT;
                    }
                }
            } catch (Exception $e) {
                $msg["ESTADO"] = MSG_ERROR;
                $msg["MSG"] = ERRORINSERT;
            }
        }
    }

?>