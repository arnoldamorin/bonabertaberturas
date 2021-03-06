<?php

namespace App\Http\Controllers;

use App\Entidades\Testimonio;
use Illuminate\Http\Request;
use App\Entidades\Sistema\Usuario;
use App\Entidades\Sistema\Menu;
use App\Entidades\Sistema\Patente;

require app_path() . '/start/constants.php';

class ControladorTestimonio extends Controller
{
    public function index()
    {
        $titulo = "Testimonio";
        if (Usuario::autenticado() == true) {
            /*if (!Patente::autorizarOperacion("MENUCONSULTA")) {
                $codigo = "MENUCONSULTA";
                $mensaje = "No tiene permisos para la operaci&oacute;n.";
                return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
            } else {*/
                return view('testimonio.testimonio-listado', compact('titulo'));
            //}
        } else {
            return redirect('admin/login');
        }
    }

    public function cargarGrilla()
        {
            $request = $_REQUEST;
    
            $entidadTestimonio = new Testimonio();
            $aTestimonios = $entidadTestimonio->obtenerFiltrado();
    
            $data = array();
    
            $inicio = $request['start'];
            $registros_por_pagina = $request['length'];
    
            if (count($aTestimonios) > 0) {
                $cont = 0;
            }
    
            for ($i = $inicio; $i < count($aTestimonios) && $cont < $registros_por_pagina; $i++) {
                $row = array();
                $row[] = '<a href="/admin/testimonio/nuevo/' . $aTestimonios[$i]->idtestimonio . '">' . $aTestimonios[$i]->nombre . '</a>';
                $row[] = $aTestimonios[$i]->descripcion;
                $row[] = $aTestimonios[$i]->video;
                $cont++;
                $data[] = $row;
            }
    
            $json_data = array(
                "draw" => intval($request['draw']),
                "recordsTotal" => count($aTestimonios), //cantidad total de registros sin paginar
                "recordsFiltered" => count($aTestimonios), //cantidad total de registros en la paginacion
                "data" => $data,
            );
            return json_encode($json_data);
        }


    public function nuevo()
    {
        $titulo = "Nuevo Testimonio";
        return view('testimonio.testimonio-nuevo', compact('titulo'));

    }

    public function editar($id)
        {
            $titulo = "Modificar testimonio";
            if (Usuario::autenticado() == true) {
                if (!Patente::autorizarOperacion("MENUMODIFICACION")) {
                    $codigo = "MENUMODIFICACION";
                    $mensaje = "No tiene pemisos para la operaci&oacute;n.";
                    return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
                } else {
                    $testimonio = new Testimonio();
                    $testimonio->obtenerPorId($id);
    
                    return view('testimonio.testimonio-nuevo', compact('testimonio', 'titulo'));
                }
            } else {
                return redirect('admin/login');
            }
        }


    public function guardar(Request $request)
    {
        try {
            //Define la entidad servicio
            $titulo = "Modificar testimonio";
            $entidad = new Testimonio();
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
            
                $_POST["id"] = $entidad->idtestimonio;
                return view('testimonio.testimonio-listado', compact('titulo', 'msg'));
            }
        } catch (Exception $e) {
            $msg["ESTADO"] = MSG_ERROR;
            $msg["MSG"] = ERRORINSERT;
        }

        $id = $entidad->idtestimonio;
        $testimonio = new Testimonio();
        $testimonio->obtenerPorId($id);

        return view('testimonio.testimonio-nuevo', compact('msg', 'testimonio', 'titulo')) . '?id=' . $testimonio->idtestimonio;

    }

    public function eliminar(Request $request)
        {
            $id = $request->input('id');
    
            if (Usuario::autenticado() == true) {
                if (Patente::autorizarOperacion("MENUELIMINAR")) {
                    $entidad = new Testimonio();
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
